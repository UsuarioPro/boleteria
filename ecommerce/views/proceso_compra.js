window.onload = function()
{
    llenar_card_cookies();
    if($('#value_select').val() != '')
    {
        $('#tra_tipo_doc').val($('#value_select').val());
    }
    $("#formulario").on("submit",function(e)
    {
        guardar_editar(e);
    });
    $('.payment-method').change(function () 
    { 
        valor = $(this).attr('data_valor');
        $('#tipo_pago').val(valor);
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
            <a href="#">
                <img src="${item.ruta_imagen}" alt="Product">
                <span class="mini-item-name">${item.concierto_nombre}</span>
                <span class="mini-item-price">${item.nombre} <br> S/. ${item.precio} x ${item.cantidad} - Total: ${total} </span> <br>
                <span class="mini-item-quantity"> Det: ${item.detalle}</span>
            </a>
            <button type="button" hidden class="button button-outline-secondary fas fa-trash" style="width: 100%" onclick="removeFromCart('${item.con_id}', '${item.zon_id}');"></button>
        </li>`;


        let html_tabla =
        `<tr id="tabla_fila${item.con_id}_${item.zon_id}">
            <input type="hidden" name="con_id[]" value="${item.con_id}">
            <input type="hidden" name="zon_id[]" value="${item.zon_id}">
            <input type="hidden" name="precio[]" value="${item.precio}">
            <input type="hidden" name="cantidad[]" value="${item.cantidad}">
            <td>
                <div class="cart-price"> ${item.concierto_nombre} - ${item.detalle}</div>
            </td>
            <td>
                <div class="cart-price">${item.cantidad}</div>
            </td>
            <td>
                <div class="cart-price">${item.precio}</div>
            </td>
            <td>
                <div class="cart-price"> ${total}</div>
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
    $("#total").val(total == 0? '0' : total.toFixed(2));
}
function validar_formulario()
{
    var validator = $( "#formulario" ).validate({
        rules:
        {
            'nombre':
            {
                required: true,
            },
            'tra_tipo_doc':
            {
                required: true,
            },
            'num_documento':
            {
                required: true,
            },
            'correo':
            {
                required: true,
            },
            'telefono':
            {
                required: true,
            },
        },
        messages:
        {
            // 'usu_rol_id':
            // {
            //     required: 'Por favor, seleccione un rol para el usuario',
            // },
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
function guardar_editar(e) //funcion para guardar o editar
{
    if(validar_formulario().form())
    {
        e.preventDefault();//no se activara evento default
        if($('#tipo_pago').val() == "")
        {
            alerta_global('warning', 'Es necesario seleccionar un tipo de pago')
        }
        else
        {
            mensaje_confirmacion.fire(
                { 
                    icon : 'info',
                    title: 'Necesitamos de tu Confirmación',
                    html: `<small>Se procederá a comprar los tickes seleccionados</small> <br>
                        <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
                    width : '400px',
                }).then((result) =>
                {
                    if (result.value == true)
                    {
                        alerta_showLoading("Espere un momento", 'Comprando Entradas...');
                        var formdata = new FormData($("#formulario")[0]);
                        $.ajax({
                            url : urlweb + "?c=Tienda&a=guardar_editar_comprar_entradas",
                            type : "POST",
                            data : formdata,
                            dataType: 'json',
                            contentType : false,
                            processData : false,
                        }).done(function(data, textStatus, jqXHR)
                        {
                            if(data.rpta == "error"){alerta_global("error", data.mensaje); }
                            else if(data.rpta == 'unico'){ alerta_global("warning",data.mensaje);}
                            else 
                            { 
                                alerta_global("success",data.mensaje); 
                                removeCookie('products_card');
                                window.location.href = urlweb + "Tienda/exito";
                            }
                        }).always(function() 
                        {
                        }).fail(function(jqXHR, textStatus, errorThrown)
                        {
                            alerta_global("error",mensaje_error_ajax);
                        });
                    }
                    else
                    {
                        Swal.close();
                    }
                })
        }
    }
}