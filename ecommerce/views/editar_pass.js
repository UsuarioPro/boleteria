let urlweb = $('#urlweb').val();
window.onload = function()
{
    llenar_card_cookies();
    $("#formulario").on("submit",function(e)
    {
        guardar_cambiar_contrasena(e);
    });
    validar_formulario();
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
function validar_formulario()
{
    var validator = $("#formulario" ).validate({
        rules:
        {
            'cam_usu_contrasena':
            {
                required: true,
            },
            'cam_usu_contrasena_repetir':
            {
                equalTo: "#cam_usu_contrasena"
            },
        },
        messages:
        {
            'cam_usu_contrasena':
            {
                required: 'Por favor, ingrese una contraseña',
            },
            'cam_usu_contrasena_repetir':
            {
                required: 'Por favor, repita la contraseña',
                equalTo: "Las contraseñas no coinciden. Por favor, introdusca la contraseña"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) 
        {
            error.addClass('invalid-feedback');
            element.closest('.u-s-m-b-10').append(error);
        },
        highlight: function (element, errorClass, validClass) 
        {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) 
        {
            $(element).removeClass('is-invalid');
        }
    });

    return validator;
}
//funcion para activar usuario
function guardar_cambiar_contrasena(e)
{
    if(validar_formulario().form())
    {
        e.preventDefault();//no se activara evento default
        mensaje_confirmacion.fire(
            { 
                icon : 'info',
                title: 'Necesitamos de tu Confirmación',
                html: `<small>Se procederá a cambiar la contraseña del usuario</small> <br>
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
                width : '400px',
            }).then((result) =>
            {
                if (result.value == true)
                {
                    $.ajax({
                        url : urlweb + '?c=Tienda&a=guardar_cambiar_contrasena',
                        type : 'POST',
                        data : {usu_id : $('#cont_usu_id').val(), usu_contrasena : $('#cam_usu_contrasena').val()},
                        dataType: 'json',
                        beforeSend: function()
                        {
                            alerta_showLoading("Espere un segundo", "Cambiando Contraseña...");
                        },
                        }).done(function(data) 
                        {  
                            if(data.rpta == 'error')
                            {
                                alerta_global("error",data.mensaje);
                            }
                            else
                            {
                                alerta_global("success",data.mensaje);
                                $('#cam_usu_contrasena').val(null);
                                $('#cam_usu_contrasena_repetir').val(null);
                            }
                        }).always(function() 
                        {
                        }).fail(function(jqXHR, textStatus, errorThrown)
                        {
                            alerta_global("error",mensaje_error_ajax);
                        });
                }
            })
    }
}