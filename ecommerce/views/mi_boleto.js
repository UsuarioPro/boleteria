window.onload = function()
{
    llenar_card_cookies();
    $('.my_pagination').on('click', function(e) { e.preventDefault(); });    

    $('#coupon-code').on('keydown', function (e) 
    {
        if (e.key === 'Enter' || e.keyCode === 13) 
        {
            e.preventDefault();
            alerta_global('warning', 'El codigo o el cupon ingresado es incorrecto');
        }
    });
    $('#btn_cupon').click(function (e) { 
        alerta_global('warning', 'El codigo o el cupon ingresado es incorrecto');
    });
}
function llenar_card_cookies()
{
    let cookieData = getCookie('products_card');
    if (!cookieData) return;

    let cart = [];
    try 
    {
        cart = JSON.parse(cookieData);
    } 
    catch (e) 
    {
        console.error("Error al parsear el JSON del carrito:", e);
        return;
    }

    $('#mini_car').empty(); // Limpiamos antes

    cart.forEach(item => {
        let total = (item.precio * item.cantidad).toFixed(2);
        let html = `
        <li class="clearfix" id="fila${item.con_id}_${item.zon_id}">
            <input type="hidden" name="con_id[]" value="${item.con_id}">
            <input type="hidden" name="zon_id[]" value="${item.zon_id}">
            <input type="hidden" name="precio[]" value="${item.precio}">
            <input type="hidden" name="cantidad[]" value="${item.cantidad}">
            <a href="#">
                <img src="${item.ruta_imagen}" alt="Product">
                <span class="mini-item-name">${item.concierto_nombre}</span>
                <span class="mini-item-price">${item.nombre} <br> S/. ${item.precio} x ${item.cantidad} - Total: ${total} </span> <br>
                <span class="mini-item-quantity"> Det: ${item.detalle}</span>
            </a>
            <button type="button" class="button button-outline-secondary fas fa-trash" style="width: 100%" onclick="removeFromCart('${item.con_id}', '${item.zon_id}');"></button>
        </li>`;


        let html_tabla =
        `<tr id="tabla_fila${item.con_id}_${item.zon_id}">
            <td>
                <div class="cart-anchor-image">
                    <a href="${urlweb}Tienda/conciertos/${item.con_id}">
                        <img src="${item.ruta_imagen}" alt="Product">
                        <h6>${item.concierto_nombre} - ${item.detalle}</h6>
                    </a>
                </div>
            </td>
            <td>
                <div class="cart-price"> ${item.precio}</div>
            </td>
            <td>
                <div class="cart-quantity">
                    <div class="quantity">
                        <input type="text" readonly  class="quantity-text-field" value="${item.cantidad}">
                        <a hidden class="plus-a" data-max="10">&#43;</a>
                        <a hidden class="minus-a" data-min="1">&#45;</a>
                    </div>
                </div>
            </td>
            <td>
                <div class="cart-price"> ${total}</div>
            </td>
            <td>
                <div class="action-wrapper">
                    <button class="button button-outline-secondary fas fa-trash" onclick="removeFromCart('${item.con_id}', '${item.zon_id}');"></button>
                </div>
            </td>
        </tr>`;

        $('#tbl_carro tbody').append(html_tabla);
        $('#mini_car').append(html);
        calcular_total();
    });
}
function validar_producto_repetido(concierto, zona)
{
    let valor= false;
    let con = document.getElementsByName("con_id[]");
    let zon = document.getElementsByName("zon_id[]");
    for (var i = 0; i < con.length; i++)
    {
        var inpCon=con[i];
        var inpZon=zon[i];
        if(inpCon.value == concierto && inpZon.value == zona)
        {
            valor = true;
            return valor;
        }
    }
    return valor;
}
function addToCart(product) 
{
    let cart = [];
    // Leer la cookie si ya existe
    let cookieData = getCookie('products_card');
    if (cookieData) 
    {
        try 
        {
        cart = JSON.parse(cookieData);
        } 
        catch (e) 
        {
        console.error("JSON mal formado en cookie");
        cart = [];
        }
    }
    // Agregar el nuevo producto
    cart.push(product);
    // Guardar de nuevo la cookie
    setCookie('products_card', JSON.stringify(cart));
}
function removeFromCart(con_id, zon_id) 
{
    let cookieData = getCookie('products_card');
    if (!cookieData) return;

    let cart = JSON.parse(cookieData);

    // Filtrar los que no coincidan (eliminando el que sí coincide)
    cart = cart.filter(item => !(item.con_id === con_id && item.zon_id === zon_id));

    // Guardar nuevamente
    setCookie('products_card', JSON.stringify(cart));

    $("#fila"+con_id+"_"+zon_id).remove();
    $("#tabla_fila"+con_id+"_"+zon_id).remove();
    calcular_total();
    if($('#tbl_carro tbody tr').length == 0)
    {
        location.reload();
    }
}
function calcular_total()
{
    var precio = document.getElementsByName("precio[]");
    var cantidad = document.getElementsByName("cantidad[]");
    
    var total = 0.00;    
    for (var i=0; i < precio.length; i++)
    {
        var inpPre=precio[i];
        var inpCant=cantidad[i];

        total += (parseFloat(inpPre.value) * parseFloat(inpCant.value));
    }
    $("#lbl_info_total_card").html(total.toFixed(2));
    $("#lbl_info_cant").html(precio.length == 0 ? '' : precio.length);
    $("#lbl_info_total").html(total == 0? '' : total.toFixed(2));
    $("#lbt_subtotal").html(total == 0? 'S/. 0.00' : 'S/.' + total.toFixed(2));
    $("#lbl_total").html(total == 0? 'S/. 0.00' : 'S/.' + total.toFixed(2));
}