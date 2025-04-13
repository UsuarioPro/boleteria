//funcion que se ejecuta al cargar la pagina
let urlweb = $('#urlweb').val();
window.onload = function()
{
    $('#formulario').on('submit',function(e)
    {
        loginsistema(e);
    });
    setTimeout(() => {
        $("#logina").focus();
    }, 700);
}
// funcion para entrar al sistema por medio del login
function loginsistema(e)
{
    e.preventDefault();//no se activara evento default
    if($("#logina").val() == "" &&  $('#clavea').val()== "")
    {
        alerta_global('warning','Por favor, Ingrese el usuario y la contraseña');
        $('#logina').focus();
    }
    else if($("#logina").val() == "")
    {
        alerta_global('warning','Por favor, Ingrese el usuario');
        $('#logina').focus();
    }
    else if($('#clavea').val()== "")
    {
        alerta_global('warning','Por favor, Ingrese la contraseña');
        $('#clavea').focus();
    }
    else
    {
        e.preventDefault();//no se activara evento default
        var formdata = new FormData($("#formulario")[0]);
        $.ajax({
            type: "POST",
            url: urlweb + "?c=Admin&a=loguearse",
            data: formdata,
            dataType: 'json',
            contentType : false,
            processData : false,
            beforeSend: function()
            {
                $("#btn_login").prop("disabled",true);
                alerta_showLoading("<label id='titulo'>Espere un momento</label>", "<label id='mensaje'>Verificando Credenciales...<label>");
            },
        }).done(function(data)
        {
            if(data.rpta  == 0)
            {
                $("#titulo").html("Ingreso Exitoso");
                $("#mensaje").html("Redireccionando...");
                location.href =  urlweb + "Admin/dashboard";
            }
            else if(data.rpta  == 1)
            {
                $('#clavea').val(null);
                $('#clavea').focus();
                alerta_global('warning', data.mensaje);
            }
            else if(data.rpta  == 'fail_licence')
            {
                location.href =  urlweb;
            }    
            else
            {
                $('#clavea').val(null);
                $('#logina').val(null);
                $('#logina').focus();
                alerta_global('error', data.mensaje);
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