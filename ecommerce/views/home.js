//funcion que se ejecuta al cargar la pagina
let urlweb = $('#urlweb').val();
window.onload = function()
{
    llenar_card_cookies();
    mostrar_conciertos();
    $('#show-records').change(mostrar_conciertos);
}
function mostrar_conciertos()
{
    $.ajax({
        type : 'POST',
        dataType: 'json',
        url: urlweb + "?c=Tienda&a=mostrar_conciertos",
        data: {limite : $('#show-records').val(), ciudad : '', filtro : '' },
        beforeSend: function()
        {
            // alerta_showLoading("Espere un momento", "Desactivando...");
        },
        }).done(function(data) 
        {  
            $('#div_conciertos').html(data.eventos);
            $('#div_paginacion').html(data.paginacion);
            $('.my_pagination').on('click', function(e) { e.preventDefault(); });    
        }).always(function() 
        {
        }).fail(function(jqXHR, textStatus, errorThrown)
        {
            alerta_global("error",mensaje_error_ajax);
        });
}
function pagina_anterior_siguiente_producto(numeracion)
{
    $.ajax({
        url: urlweb + '?c=Tienda&a=mostrar_conciertos',
        data: {limite : $('#show-records').val(), ciudad : '', filtro : '' , numeracion : numeracion},
        type : 'POST',
        dataType: 'json',
        beforeSend: function()
        {
            // $('#overlay_producto_cuadricula').show();
        }
    }).done(function(data)
    {
        $('#div_conciertos').html(data.eventos);
        $('#div_paginacion').html(data.paginacion);
        $('.my_pagination').on('click', function(e) { e.preventDefault(); });    
    }).always(function(data)//cuando se completa 
    {
        // $('#overlay_producto_cuadricula').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function mostrar_detalle_concierto(valor)
{
    location.href =  urlweb + "Tienda/conciertos/"+valor;
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
        $('#mini_car').append(html);
        calcular_total();
    });
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
    calcular_total();
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
}