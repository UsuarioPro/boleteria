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
    // $('.btn-comprar').click(function () 
    // {
    //     const card = $(this).closest('.card');
    //     $(this).hide();
    //     card.find('.buy-container').slideDown();
    // });
    // $('.btn-cerrar').click(function () 
    // {
    //     const card = $(this).closest('.card');
    //     card.find('.buy-container').slideUp(function () {
    //         card.find('.btn-comprar').show();
    //     });
    // });
    // $('.btn-sumar').click(function () {
    //     const qtyInput = $(this).siblings('input.qty');
    //     let value = parseInt(qtyInput.val());
    //     if (value < 10) {
    //     value++;
    //     qtyInput.val(value);
    //     qtyInput.closest('.buy-container').find('.cantidad-texto').text(value);
    //     }
    // });
    // $('.btn-restar').click(function () {
    //     const qtyInput = $(this).siblings('input.qty');
    //     let value = parseInt(qtyInput.val());
    //     if (value > 1) {
    //     value--;
    //     qtyInput.val(value);
    //     qtyInput.closest('.buy-container').find('.cantidad-texto').text(value);
    //     }
    // });
    // $('.btn_carro').click(function () 
    // {
    //     let cantidad = $('#cantidad'+$(this).attr('data_indice')).val();
    //     let img_logo = ($(this).attr('data_imagen') == '')? urlweb + 'ecommerce/media/conciertos-logo/default.jpg' : urlweb + 'ecommerce/media/conciertos-logo/'+$(this).attr('data_imagen');

    //     let data = { con_id: $(this).attr('data_con_id'), zon_id: $(this).attr('data_id'), nombre: $(this).attr('data_nombre'), precio: $(this).attr('data_precio'),
    //     detalle: $(this).attr('data_detalle'), stock: $(this).attr('data_stock'), concierto_nombre: $(this).attr('data_concierto_nombre'), imagen: $(this).attr('data_imagen'),
    //     ruta_imagen : img_logo, cantidad : cantidad };

    //     if(validar_producto_repetido(data.con_id, data.zon_id) === false)
    //     {
    //     let total = (data.precio * data.cantidad).toFixed(2);
    //     html = `
    //     <li class="clearfix" id="fila${data.con_id}_${data.zon_id}">
    //         <input type="hidden" name="con_id[]" value="${data.con_id}">
    //         <input type="hidden" name="zon_id[]" value="${data.zon_id}">
    //         <input type="hidden" name="precio[]" value="${data.precio}">
    //         <input type="hidden" name="cantidad[]" value="${data.cantidad}">
    //         <a href="#">
    //             <img src="${data.ruta_imagen}" alt="Product">
    //             <span class="mini-item-name">${data.concierto_nombre}</span>
    //             <span class="mini-item-price">${data.nombre} <br> S/. ${data.precio} x ${data.cantidad} - Total: ${total} </span> <br>
    //             <span class="mini-item-quantity"> Det: ${data.detalle}</span>
    //         </a>
    //         <button type="button" class="button button-outline-secondary fas fa-trash" onclick="removeFromCart('${data.con_id}', '${data.zon_id}');" style="width: 100%"></button>
    //         </li>`;
    //         $('#mini_car').append(html);
    //         addToCart(data);        
    //         calcular_total();
    //         alerta_global('success', 'Concierto Agregado Correctamente');
    //     }
    //     else
    //     {
    //         alerta_global('warning', 'El Producto ya se encuentra en Carrito de Ventas');
    //     }
    // })
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