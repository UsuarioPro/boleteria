let nuevo_usuario = true;
window.onload = function()
{
    file_4 = FilePond.create(document.querySelector('.filepondPortada'));
    file_4.setOptions(option_FilePondImage);
    $('#myModal').on('shown.bs.modal', function () 
    {
        (nuevo_usuario == true)? $("#tra_tipo_doc").select2("open") : $('#tra_nombre_completo').focus();
    });
    $('#myModalContrasena').on('shown.bs.modal', function () 
    {
        $('#cam_usu_contrasena').focus();
    });
    $('#myModal').on('hidden.bs.modal', function (e)
    {
        limpiar();
    });
    $('#myModalContrasena').on('hidden.bs.modal', function (e)
    {
        $('#cont_usu_id').val(null);   
        $("#cam_usu_contrasena").val(null);   
        $("#cam_usu_contrasena_repetir").val(null); 
        mostrar_boton_ocultar_cam();  
        mostrar_boton_ocultar_rep_cam();
    });

    validar_formulario();
    listar_datatable();
    seleccionar_rol();
    $("#formulario").on("submit",function(e)
    {
        guardar_editar(e);
    });
    mostrar_boton_ocultar();
    mostrar_boton_ocultar_rep();
    $('#btn_ver').click(mostrar_boton_ver);
    $('#btn_ocultar').click(mostrar_boton_ocultar);
    $('#btn_ver_rep').click(mostrar_boton_ver_rep);
    $('#btn_ocultar_rep').click(mostrar_boton_ocultar_rep);
    $('#btn_cancelar').click(cancelarform);

    mostrar_boton_ocultar_cam();
    mostrar_boton_ocultar_rep_cam();
    $('#btn_ver_cam').click(mostrar_boton_ver_cam);
    $('#btn_ocultar_cam').click(mostrar_boton_ocultar_cam);
    $('#btn_ver_rep_cam').click(mostrar_boton_ver_rep_cam);
    $('#btn_ocultar_rep_cam').click(mostrar_boton_ocultar_rep_cam);
    $('#btn_guardar_contrasena').click(guardar_cambiar_contrasena);
    $('#btn_cancelar_contrasena').click(cancelarformContrasena);
    validar_formulario_contrasena();
    // -----------------------------------------------------------------------
    $('#overlay_busqueda_sunat').hide();
    $('#tra_tipo_doc').change(habilitar_campo_documento);
    $('#tra_tipo_doc').trigger('change');
    $('#btn_sunat').click(busqueda_sunat_dni);
}
function habilitar_campo_documento()
{
    $("#spinner").hide();
    if($('#tra_tipo_doc').val() != null)
    {
        setTimeout(() =>  { $('#tra_num_doc').focus(); }, 150);
        $('#tra_num_doc').attr('disabled', false);
        ($('#tra_tipo_doc').val() == "DNI")?  $('#btn_sunat').attr('disabled', false) :  $('#btn_sunat').attr('disabled', true);
    }
    else
    {
        $('#tra_num_doc').attr('disabled', true);
        $('#btn_sunat').attr('disabled', true);
    }
}
function busqueda_sunat_dni()
{
    if($('#tra_num_doc').val() != '')
    {
        let tipo_conexion = 2;        
        $.ajax({
            data: { "ndni": $("#tra_num_doc").val() },
            type: "POST",
            dataType: "json",
            url: urlweb + '?c=Sunat&a=busqueda_sunat_dni',
            beforeSend: function()
            {
                $('#overlay_busqueda_sunat').show();
                $("#btn_sunat").attr("disabled",true);
                $("#btn_guardar").prop("disabled",true);
                $("#btn_cancelar").prop("disabled",true);
                $("#spinner").show();
            }, 
        }).done(function(datos, textStatus, jqXHR)
        {
            if(tipo_conexion == 1)
            {
                if(datos.rpta == 'error')
                {
                    alerta_global("error",datos['mensaje']);
                }
                else
                {
                    datos = JSON.parse(datos);
                    if(datos['success'] == false)
                    {
                        alerta_global("error",datos['message']);
                    }
                    else if(datos['success'] == true)
                    {
                        $('#tra_nombre_completo').val(datos['data']['nombres'] + " " + datos['data']['apellido_paterno'] + " " + datos['data']['apellido_materno']);
                        $('#tra_direccion').val(datos['data']['direccion'])
                        alerta_global('success', 'Datos cargados correctamente');
                    }
                }    
            }
            else if(tipo_conexion == 2)
            {
                if(datos == 'Not Found')
                {
                    alerta_global('warning', 'Este Numero de Documento no se encuentra registrado en nuesta base de datos. <br> Por favor introduzca o verifique el numero de documento.')
                }
                else
                {
                    if(datos['rpta'] == 'error')
                    {
                        alerta_global('warning', datos['mensaje'])
                    }
                    else
                    {
                        datos = JSON.parse(datos);
                        if(datos.error)
                        {
                            alerta_global('warning', datos.error)
                        }
                        else
                        {
                            $('#tra_nombre_completo').val(datos.nombres + " " + datos.apellidoPaterno + " " + datos.apellidoMaterno);
                            $('#tra_direccion').val(datos.direccion);
                            alerta_global('success', 'Datos cargados correctamente');
                        }
                    }
                }
            }
        }).always(function()
        {
            $('#overlay_busqueda_sunat').hide();
            $("#spinner").hide();
            $("#btn_sunat").attr("disabled",false);
            $("#btn_guardar").prop("disabled",false);
            $("#btn_cancelar").prop("disabled",false);
        }).fail(function(jqXHR, textStatus, errorThrown)
        {
            if (buscar_cadena(jqXHR.responseText, 'Maximum execution time') == true)
            alerta_global("warning",'El Tiempo de Ejecucion Termino, Compruebe que tenga una Buena conexion a Internet');
            else if (buscar_cadena(jqXHR.responseText, '¡UPS! Ya lo malograste') == true)
            alerta_global("warning",'Usted no cuenta con permiso para realizar la busqueda correspondiente');
            else
            alerta_global("error",mensaje_error_ajax);
        });
    }
    else
    {
        alerta_global('warning', 'Ingrese el numero de documento');
    }
}
function seleccionar_rol()
{
    //cargamos las sucursales en el select
    $.ajax({
        url: urlweb + '?c=Usuario&a=seleccionar_rol',
        type : 'POST',
    }).done(function(datos) 
    {  
        $('#usu_rol_id').html(datos);
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax); 
    });
}
function mostrar_boton_ver()
{
    $('#btn_ocultar').show();
    $('#btn_ver').hide();
    $('#usu_contrasena').get(0).type = 'text';
}
function mostrar_boton_ocultar()
{
    $('#btn_ocultar').hide();
    $('#btn_ver').show();
    $('#usu_contrasena').get(0).type = 'password';
}
function mostrar_boton_ver_rep()
{
    $('#btn_ocultar_rep').show();
    $('#btn_ver_rep').hide();
    $('#usu_contrasena_repetir').get(0).type = 'text';
}
function mostrar_boton_ocultar_rep()
{
    $('#btn_ocultar_rep').hide();
    $('#btn_ver_rep').show();
    $('#usu_contrasena_repetir').get(0).type = 'password';
}
// codigo que sirve para validar el fomulario 
function validar_formulario()
{
    var validator = $( "#formulario" ).validate({
        rules:
        {
            'usu_rol_id':
            {
                required: true,
            },
            'usu_nombre':
            {
                required: true,
            },
            'usu_contrasena':
            {
                required: true,
            },
            'usu_contrasena_repetir':
            {
                equalTo: "#usu_contrasena"
            },
        },
        messages:
        {
            'usu_rol_id':
            {
                required: 'Por favor, seleccione un rol para el usuario',
            },
            'usu_nombre':
            {
                required: 'Por favor, ingrese el nombre de usuario',
            },
            'usu_contrasena':
            {
                required: 'Por favor, ingrese una contraseña',
            },
            'usu_contrasena_repetir':
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
// -----------------------cierre validacion-------------------------------------------
//funcion cancelar form
function cancelarform()
{
    validar_formulario().resetForm();
}
//funcion para limpiar los inputs del form
function limpiar()
{
    $('#usu_id').val(null);
    $('#usu_rol_id').val(null).trigger('change');
    $('#usu_nombre').val(null);
    $('#usu_contrasena').val(null);
    $('#usu_contrasena_repetir').val(null);
    $('#usu_rol_id').val(null);
    $('#titulo').html('Registrar Nuevo Usuario');
    $('#div_contrasena').show();
    $('#div_contrasena_rep').show();
    $('#tra_tipo_doc').val(null).trigger('change');
    $('#tra_num_doc').val(null);
    $('#tra_nombre_completo').val(null);
    $('#tra_direccion').val(null);
    $('#tra_correo').val(null);
    $('#tra_telefono').val(null);
    $('#temp_img1').val(null);
    $('#usu_token').val(null);
    mostrar_boton_ocultar();  
    mostrar_boton_ocultar_rep();
    
    $('#custom-tabs1-tab').trigger('click');
    file_4.removeFiles({ revert: true });
    nuevo_usuario = true;
}
//funcion para obtener el dato a editar
function editar(usu_id)
{
    $.ajax({
        url: urlweb + '?c=Usuario&a=obtener',
        type: 'POST',
        dataType:'json',
        data: {usu_id : usu_id},
        beforeSend: function()
        {
            $('#overlay_busqueda_sunat').show();
        },
    }).done(function(data) 
    {  
        $('#titulo').html('Editar Usuario');
        $('#usu_id').val(data.usu_id);
        $('#usu_nombre').val(data.usu_login);
        $('#usu_rol_id').val(data.rol_id).trigger('change');
        //Esta es la variable que contiene la url de una imagen ejemplo, luego puedes poner la que quieras
        $('#div_contrasena').hide();
        $('#div_contrasena_rep').hide();
        $('#tra_tipo_doc').val(data.usu_tipo_doc).trigger('change');
        $('#tra_num_doc').val(data.usu_numero_doc);
        $('#tra_nombre_completo').val(data.usu_nombre_completo);
        $('#tra_direccion').val(data.usu_direccion);
        $('#tra_correo').val(data.usu_correo);
        $('#tra_telefono').val(data.usu_telefono);
        $('#usu_token').val(data.usu_token);

        $('#temp_img1').val(data.usu_imagen);
        if(data.usu_imagen != "")
        {
            file_1.addFile(urlweb + "media/usuario/"+data.usu_imagen+"?file4"+new Date().getTime());
        }
        nuevo_usuario = false;
        $('#myModal').modal('show');
    }).always(function() 
    {
        $('#overlay_busqueda_sunat').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function guardar_editar(e) //funcion para guardar o editar
{
    if(validar_formulario().form())
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
                    var formdata = new FormData($("#formulario")[0]);
                    $.ajax({
                        url : urlweb + "?c=Usuario&a=guardar_editar",
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
                            tabla.ajax.reload();
                            $('#myModal').modal('hide');
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
// ---------------- funcion para listar ----------------
function listar_datatable()
{
    tabla = $('#tbllistado').dataTable({
        "lengthMenu": [5, 10, 25, 75, 100, 200],//mostramos el menú de registros a revisar
        "aProcessing": true,//Activamos el procesamiento del datatables
        "aServerSide": true,//Paginación y filtrado realizados por el servidor
        "scrollY": tamano_datatable_normal,
        "scrollX": tamano_datatable_normal,
        "scrollCollapse": true,
        "responsive": true, 
        "autoWidth": false,     
        "select": true,
        "select": { info: false },    
        "ajax":
            {
                url: urlweb + '?c=Usuario&a=listar',
                dataType : "json",
                error: function(e)
                {
                    console.log(e.responseText);
                }
            },
        "language":
            {
                "url": urlweb + "styles/plugins/datatables/idioma_es.json",
            },
        "initComplete":function( settings, json)
        {
            setTimeout(() => { tippy('.tooltip_tippy', {content: '', allowHTML: true}); }, 10);
        },    
        "bDestroy": true,
        "iDisplayLength": 25,//Paginación
        "order": [[0, "desc"]],//Ordenar (columna,orden)
    }).DataTable();
    tabla.on('draw', function (settings, data) 
    {
        setTimeout(() => { tippy('.tooltip_tippy', {content: '', allowHTML: true}); }, 10);
    } );
}
//funcion para activar
function desactivar(usu_estado, usu_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a desactivar el usuario seleccionado</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
    }).then((result) =>
    {
        if (result.value == true)
        {
            $.ajax({
                url : urlweb + '?c=Usuario&a=activar_desactivar',
                type : 'POST',
                data : {usu_id : usu_id, usu_estado : usu_estado},
                dataType: 'json',
                beforeSend: function()
                {
                    alerta_showLoading("Espere un segundo", "Desactivando...");
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
                    tabla.ajax.reload();
                }).always(function() 
                {
                }).fail(function(jqXHR, textStatus, errorThrown)
                {
                    alerta_global("error",mensaje_error_ajax);
                });
        }
    })
}
//funcion para activar usuario
function activar(usu_estado, usu_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a activar el usuario seleccionado</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Usuario&a=activar_desactivar',
                    type : 'POST',
                    data : {usu_id : usu_id, usu_estado : usu_estado},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un segundo", "Desactivando...");
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
                        tabla.ajax.reload();
                    }).always(function() 
                    {
                    }).fail(function(jqXHR, textStatus, errorThrown)
                    {
                        alerta_global("error",mensaje_error_ajax);
                    });
            }
        })
}
//para cambiar contraseña
function cambiar_contrasena(usu_id)
{
    $('#cont_usu_id').val(usu_id)
    $('#myModalContrasena').modal('show');
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
//funcion cancelar form
function cancelarformContrasena()
{
    validar_formulario_contrasena().resetForm();
}
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
                        url : urlweb + '?c=Usuario&a=guardar_cambiar_contrasena',
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
                            $('#myModalContrasena').modal('hide');
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
function eliminar_usuario(usu_id)
{
    mensaje_confirmacion.fire(
        {
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se procederá a eliminar el Usuario</span> <br>
            <small class="text-bold text-danger">Recuerde que esta opción es irreversible y no podra modificarlo<br></small>
            <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',  
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url: urlweb + "?c=Usuario&a=eliminar_usuario",
                    type: 'POST',
                    data : {usu_id : usu_id},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un momento", "Eliminando Usuario...");
                    },
                }).done(function(data, textStatus, jqXHR)
                {
                    if(data.rpta == 'error')
                    {
                        alerta_global("error",data.mensaje);
                    }
                    else
                    {
                        alerta_global("success",data.mensaje);
                        tabla.ajax.reload();
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