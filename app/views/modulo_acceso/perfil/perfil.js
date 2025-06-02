let is_edit = false;
window.onload = function()
{
    validar_formulario();     
    $("#formulario").on("submit",function(e)
    {
        guardar_editar(e);
    });
    $("#formulario_usuario").on("submit",function(e)
    {
        guardar_editar_usuario(e);
    });
    seleccionar_tipo_documento();
    $('#cli_tipo').val(null).trigger('change');
    editar($('#cli_id').val()); 
    mostrar_boton_ocultar_cam();
    mostrar_boton_ocultar_rep_cam();
    $('#btn_ver_cam').click(mostrar_boton_ver_cam);
    $('#btn_ocultar_cam').click(mostrar_boton_ocultar_cam);
    $('#btn_ver_rep_cam').click(mostrar_boton_ver_rep_cam);
    $('#btn_ocultar_rep_cam').click(mostrar_boton_ocultar_rep_cam);
    $('#btn_guardar_contrasena').click(guardar_cambiar_contrasena);
    seleccionar_rol();
    editar_usuario($('#usu_id').val());
    file_1 = FilePond.create(document.querySelector('.filepond'));
    file_1.setOptions(option_FilePondImage);
    $("#formulario_imagen").on("submit",function(e)
    {
        guardar_editar_imagen(e);
    });
    $('#myModal').on('hidden.bs.modal', function (e)
    {
        limpiar_imagen();
    });
}
function limpiar_imagen()
{
    file_1.removeFiles({ revert: true });
}
function seleccionar_tipo_documento()
{
    //cargamos los sucursales en el select
    $.ajax({
        url: urlweb + '?c=Perfil&a=seleccionar_tipo_documento',
        type : 'POST',
    }).done(function(datos)
    {
        $('#cli_tipo').html(datos);
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
// codigo que sirve para validar el fomulario 
function validar_formulario()
{
    var validator = $( "#formulario" ).validate({
        rules:
            {
                'cli_tipo': 
                {
                    required: true,
                },
                'cli_num_doc': 
                {
                    required: true,
                },
                'cli_nombre': 
                {
                    required: true,
                    maxlength: 250
                },
                'cli_direccion': 
                {
                    maxlength: 500
                },
            },
        messages:
            {
                'cli_tipo': 
                {
                    required: "Por favor, seleccione el Tipo de Documento del Cliente",
                },
                'cli_num_doc': 
                {
                    required: "Por favor, ingrese el Numero del Cliente",
                    maxlength: "El campo debe contener maximo {0} digitos",
                    minlength: "El campo debe contener maximo {0} digitos"
                },
                'cli_nombre': 
                {
                    required: "Por favor, ingrese el Nombre del Cliente",
                    maxlength: 'El nombre del cliente debe tener como maximo 250 caracteres'
                },
                'cli_direccion': 
                {
                    required: "Por favor, ingrese la Direccion del Cliente",
                    maxlength: 'La direccion del cliente debe tener como maximo 250 caracteres'
                },
                'cli_correo':
                {
                    email: 'Por favor, ingrese una direccion de correo valida'
                }
            },
        errorElement: 'span',
        errorPlacement: function (error, element)
        {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
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
// -----------------------cierre validacion-------------------------------------------
//funcion para limpiar los inputs del form 
function limpiar()
{
    // $('#cli_id').val(null);
    $('#cli_nombre').val(null);
    $('#cli_tipo').val(null).trigger('change');
    $('#cli_num_doc').val(null);
    $('#cli_direccion').val(null);
    $('#cli_telefono').val(null);
    $('#cli_correo').val(null);
}
//funcion cancelar form
function cancelarform()
{
    validar_formulario().resetForm();
}
//funcion para obtener el dato a editar
function editar(cli_id) 
{
    $.ajax({
        url: urlweb + '?c=Perfil&a=obtener',
        type: 'POST',
        dataType: 'json',
        data:{cli_id: cli_id},
        beforeSend: function()
        {
            $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        is_edit = true;
        
        $('#txt_info_nombre').html(data.cli_nombre);
        $('#txt_info_ruc').html(data.cli_num_doc);
        // $('#cli_id').val(data.cli_id);
        $('#cli_nombre').val(data.cli_nombre);
        $('#cli_tipo').val(data.tip_ide_id).trigger('change');
        $('#cli_num_doc').val(data.cli_num_doc);
        $('#cli_direccion').val(data.cli_direccion);
        $('#cli_telefono').val(data.cli_telefono);
        $('#cli_correo').val(data.cli_correo);
    }).always(function()//cuando se completa 
    {
        $('#overlay_general').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function guardar_editar(e)//funcion para guardar o editar 
{
    if(validar_formulario().form())
    {
        e.preventDefault();//no se activara evento default
        var isNuevo = "Se creará el siguiente cliente con los siguientes datos"
        var mensaje_sec = "Guardando..."
        if($('#cli_id').val() != "") { isNuevo = "Se editará el siguiente cliente con los siguientes datos"; mensaje_sec = "Editando..."  }
        mensaje_confirmacion.fire(
            { 
                icon : 'info',
                title: 'Necesitamos de tu Confirmación',
                html: `<small>`+isNuevo+`</small>
                    <div class="card p-0 m-0 shadow-none">
                        <div class="card-body pb-0 pl-2 pr-2" style="margin-top: -15px">        
                            <ul class="list-group list-group-unbordered mb-2">
                                <li class="list-group-item">
                                    <span class="float-left text-muted text-sm">NUM DE DOC.</span>
                                    <span class="float-right text-muted text-sm">`+$('#cli_num_doc').val()+`</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="float-left text-muted text-sm">CLIENTE</span>
                                    <span class="float-right text-muted text-sm">`+$('#cli_nombre').val()+`</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="float-left text-muted text-sm">DIRECCION</span>
                                    <span class="float-right text-muted text-sm">`+$('#cli_direccion').val()+`</span>
                                </li>
                            </ul>        
                        </div>
                    </div>        
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
                    width : '400px',
            }).then((result) =>
            {
                if (result.value == true)
                {
                    var formdata = new FormData($("#formulario")[0]);
                    $.ajax({
                        url : urlweb + "?c=Perfil&a=guardar_editar",
                        type : "POST",
                        data : formdata,
                        dataType: 'json',
                        contentType : false,
                        processData : false,
                        beforeSend: function()
                        {
                            alerta_showLoading("Espere un segundo...", mensaje_sec);
                        },    
                    }).done(function(data, textStatus, jqXHR)
                    {
                        if(data.rpta == "error"){alerta_global("error", data.mensaje); }
                        else if(data.rpta == "unico"){alerta_global("warning", data.mensaje); $('#cli_num_doc').focus();}
                        else 
                        { 
                            alerta_global("success",data.mensaje); 
                            tabla.ajax.reload();
                            cancelarform();
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
// -------------------------------------------------------------------
function validar_formulario_contrasena()
{
    var validator = $("#formularioContrasena" ).validate({
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
                equalTo: "Las contraseñas no coinciden. Por favor, introdusca la contraseña"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) 
        {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
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
    if(validar_formulario_contrasena().form())
    {
        e.preventDefault();//no se activara evento default
        mensaje_confirmacion.fire(
            { 
                icon : 'info',
                title: 'Necesitamos de tu Confirmación',
                html: `<small>Se procederá a cambiar la contraseña del usuario seleccionado</small> <br>
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
                width : '400px',
            }).then((result) =>
            {
                if (result.value == true)
                {
                    $.ajax({
                        url : urlweb + '?c=Perfil&a=guardar_cambiar_contrasena',
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
                            }
                            $('#cont_usu_id').val(null);   
                            $("#cam_usu_contrasena").val(null);   
                            $("#cam_usu_contrasena_repetir").val(null); 
                            mostrar_boton_ocultar_cam();  
                            mostrar_boton_ocultar_rep_cam();   
                            cancelarformContrasena();
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
function cancelarformContrasena()
{
    validar_formulario_contrasena().resetForm();
}
function mostrar_boton_ver_cam()
{
    $('#btn_ocultar_cam').show();
    $('#btn_ver_cam').hide();
    $('#cam_usu_contrasena').get(0).type = 'text';
}
function mostrar_boton_ocultar_cam()
{
    $('#btn_ocultar_cam').hide();
    $('#btn_ver_cam').show();
    $('#cam_usu_contrasena').get(0).type = 'password';
}
function mostrar_boton_ver_rep_cam()
{
    $('#btn_ocultar_rep_cam').show();
    $('#btn_ver_rep_cam').hide();
    $('#cam_usu_contrasena_repetir').get(0).type = 'text';
}
function mostrar_boton_ocultar_rep_cam()
{
    $('#btn_ocultar_rep_cam').hide();
    $('#btn_ver_rep_cam').show();
    $('#cam_usu_contrasena_repetir').get(0).type = 'password';
}
function seleccionar_rol()
{
    //cargamos las sucursales en el select
    $.ajax({
        url: urlweb + '?c=Perfil&a=seleccionar_rol',
        type : 'POST',
    }).done(function(datos) 
    {  
        $('#usu_rol_id').html(datos);
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax); 
    });
}
function editar_usuario(usu_id)
{
    $.ajax({
        url: urlweb + '?c=Perfil&a=obtener_data_usuario',
        type: 'POST',
        dataType:'json',
        data: {usu_id : usu_id},
        beforeSend: function()
        {
            $('#overlay_busqueda_sunat').show();
        },
    }).done(function(data) 
    {  
        $('#usu_id').val(data.usu_id);
        $('#cli_id').val(data.cli_id).trigger('change');
        $('#usu_nombre').val(data.usu_login);
        $('#usu_rol_id').val(data.rol_id).trigger('change');
        $('#temp_img1').val(data.usu_imagen);
        // $('#usu_imagen').val(data.usu_imagen);
        if(data.usu_imagen != "")
        {
            $('#img_logo').attr('src', "../media/usuarios/"+data.usu_imagen+"?"+new Date().getTime())
        }
    }).always(function() 
    {
        $('#overlay_busqueda_sunat').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function validar_formulario_usuario()
{
    var validator = $( "#formulario_usuario" ).validate({
        rules:
        {
            'cli_id':
            {
                required: true,
            },
            'usu_rol_id':
            {
                required: true,
            },
            'usu_nombre':
            {
                required: true,
            },
        },
        messages:
        {
            'cli_id':
            {
                required: 'Por favor, seleccione un cliente',
            },
            'usu_rol_id':
            {
                required: 'Por favor, seleccione un rol para el usuario',
            },
            'usu_nombre':
            {
                required: 'Por favor, ingrese el nombre de usuario',
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) 
        {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
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
function guardar_editar_usuario(e) //funcion para guardar o editar
{
    if(validar_formulario_usuario().form())
    {
        e.preventDefault();//no se activara evento default
        var isNuevo = "Se procederá a crear el nuevo usuario con los datos proporcionados"
        var mensaje_sec = "Editando..."
        if($('#usu_rol_id').val() != "") { isNuevo = "Se procederá a editar el usuario con los datos proporcionados"; mensaje_sec = "Editando..."  }
        mensaje_confirmacion.fire(
            { 
                icon : 'info',
                title: 'Necesitamos de tu Confirmación',
                html: `<small>`+isNuevo+`</small> <br>
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
                width : '400px',
            }).then((result) =>
            {
                if (result.value == true)
                {
                    alerta_showLoading("Espere un segundo", mensaje_sec);
                    var formdata = new FormData($("#formulario_usuario")[0]);
                    $.ajax({
                        url : urlweb + "?c=Perfil&a=guardar_editar_usuario",
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
function guardar_editar_imagen(e)
{
    e.preventDefault();//no se activara evento default
    mensaje_confirmacion.fire(
        {
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span style="line-height: 30px">Se Actualizara el Logo de la Empresa</span> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                var formdata = new FormData($("#formulario_imagen")[0]);
                    $.ajax({
                        url : urlweb + "?c=Perfil&a=guardar_editar_imagen",
                        type : "POST",
                        data : formdata,
                        dataType: 'json',
                        contentType : false,
                        processData : false,
                        beforeSend: function()
                        {
                            alerta_showLoading("Espere un momento", 'Guardando...');
                        },    
                    }).done(function(data, textStatus, jqXHR)
                    {
                        if(data.rpta == "error"){alerta_global("error", data.mensaje); }
                        else 
                        { 
                            (data.imagen != "")? $('#img_logo').attr('src', "../media/usuarios/"+data.imagen+"?"+new Date().getTime()) : $('#img_logo').attr('src', "../styles/img/imagen-no-disponible.jpg");
                            alerta_global("success",data.mensaje); 
                            $('#myModal').modal('hide');
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