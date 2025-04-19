//funcion que se ejecuta al cargar la pagina
let urlweb = $('#urlweb').val();
window.onload = function()
{
    $('#formulario').on('submit',function(e)
    {
        registrar(e);
    });
    
    $("#logina").focus();
    validar_formulario();
}
// funcion para entrar al sistema por medio del login
function registrar(e)
{
    if(validar_formulario().form())
    {
        e.preventDefault();//no se activara evento default
        var formdata = new FormData($("#formulario")[0]);
        $.ajax({
            type: "POST",
            url: urlweb + "?c=Tienda&a=registrarse",
            data: formdata,
            dataType: 'json',
            contentType : false,
            processData : false,
            beforeSend: function()
            {
                $("#btn_login").prop("disabled",true);
                alerta_showLoading("<label id='titulo'>Espere un momento</label>", "<label id='mensaje'>Creando un nuevo usuario...<label>");
                $('body').removeClass('swal2-height-auto');
            },
        }).done(function(data)
        {
            if(data.rpta == "error"){alerta_global("error", data.mensaje); }
            else if(data.rpta == 'unico'){ alerta_global("warning",data.mensaje);}
            else 
            { 
                alerta_global("success",data.mensaje + ', Iniciando Sesion...'); 
                $.ajax({
                    type: "POST",
                    url: urlweb + "?c=Tienda&a=loguearse",
                    data: {logina : $('#logina').val(), clavea : $('#clavea').val()},
                    dataType: 'json',
                }).done(function(data)
                {
                    limpiar();
                    $("#titulo").html("Ingreso Exitoso");
                    $("#mensaje").html("Redireccionando...");
                    if(data.rpta  == 0)
                    {
                        location.href =  urlweb + "Tienda/bienvenida";
                    }
                    else
                    {
                        location.href =  urlweb + "Tienda/login";
                    }
                }).always(function()//cuando se completa 
                {
                    $("#btn_login").prop("disabled",false);
                }).fail(function(jqXHR, textStatus, errorThrown)
                {
                    alerta_global("error", mensaje_error_ajax);
                });
            }
        }).always(function()//cuando se completa 
        {
            $("#btn_login").prop("disabled",false);
        }).fail(function(jqXHR, textStatus, errorThrown)
        {
            alerta_global("error", mensaje_error_ajax);
        });
    }
}
function validar_formulario()
{
    var validator = $( "#formulario" ).validate({
        rules:
            {
                'logina': 
                {
                    required: true,
                },
                'correo': 
                {
                    required: true,
                },
                'clavea':
                {
                    required: true,
                },
                'pass_verificar':
                {
                    equalTo: "#clavea"
                },
            },
        messages:
            {
                'logina': 
                {
                    required: 'Por favor, Ingrese el nombre de usuario',
                },
                'correo': 
                {
                    required: 'Por favor, Ingrese un correo valido',
                },
                'clavea':
                {
                    required: 'Por favor, Ingrese la Contraseña',
                },
                'pass_verificar':
                {
                    equalTo: "Por favor, repita la Contraseña"
                },
            },
        errorElement: 'span',
        errorPlacement: function (error, element)
        {
            error.addClass('invalid-feedback');
            element.closest('.text-field').append(error);
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
function limpiar()
{
    $('#logina').val(null);
    $('#correo').val(null);
    $('#clavea').val(null);
    $('#pass_verificar').val(null);
}
validar_formulario().resetForm();
