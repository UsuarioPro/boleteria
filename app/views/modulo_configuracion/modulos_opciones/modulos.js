window.onload = function()
{
    // jQuery UI sortable for the todo list
    $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
    });
    $("#formulario").on("submit",function(e)
    {
        cambiar_orden_modulos(e);
    });
    $("#formulario_opc").on("submit",function(e)
    {
        cambiar_orden_opciones(e);
    });
    $("#formulario_modulo").on("submit",function(e)
    {
        guardar_editar_modulo(e);
    });
    $("#formulario_opcion").on("submit",function(e)
    {
        guardar_editar_opcion(e);
    });

    $( "#ul_modulos" ).on( "sortdeactivate", function( event, ui ) 
    {
        $('#btn_cambiar_ord_mod').trigger('click');
    });
    $( "#ul_opciones" ).on( "sortdeactivate", function( event, ui ) 
    {
        $('#btn_cambiar_ord_opc').trigger('click');
    });
    mostrar_modulos();
    $('#btn_cancelar_opc').click(cancelarOpciones);
    validar_formulario_modulo();
    validar_formulario_opcion();
    $('#myModal').on('shown.bs.modal', function ()  
    {
        setTimeout(function ()
        {
            $('#reg_mod_nombre').focus(); 
        }, 200);
    });
    $('#myModal').on('hidden.bs.modal', function (e) 
    {
        limpiar_formulario_modulo();
    });
    $('#btn_cancel').click(cancelarformModulo);
    $('#btn_cancel_opc').click(cancelarformOpciones);

    $('#myModalOpciones').on('shown.bs.modal', function ()  
    {
        setTimeout(function ()
        {
            $('#reg_opc_nombre').focus(); 
        }, 200);
    });
    $('#myModalOpciones').on('hidden.bs.modal', function (e) 
    {
        limpiar_formulario_opcion();
    });

}
function mostrar_modulos()
{
    $.ajax({
        url: urlweb + '?c=Modulos&a=mostrar_modulos',
        type: 'POST',
        dataType: 'HTML',
    }).done(function(data, textStatus, jqXHR)
    {
        $('#ul_modulos').html(data);
    }).always(function()//cuando se completa 
    {
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function cambiar_orden_modulos(e)//funcion para guardar o editar 
{
    e.preventDefault();//no se activara evento default
    var formdata = new FormData($("#formulario")[0]);
    $.ajax({
        url : urlweb + "?c=Modulos&a=cambiar_orden_modulos",
        type : "POST",
        data : formdata,
        dataType: 'json',
        contentType : false,
        processData : false,
        beforeSend: function()
        {
            alerta_showLoading("Espere un segundo", 'Cambiando orden...');
        },    
    }).done(function(data, textStatus, jqXHR)
    {
        alerta_global('success',data.mensaje);
        // mostrar_modulos();
    }).always(function() 
    {
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alert("a")
        alerta_global("error",mensaje_error_ajax);
    });
}
function mostrar_opciones_modulo(mod_id, multiple, nombre, accion)
{
    $.ajax({
        url: urlweb + '?c=Modulos&a=mostrar_opciones_x_modulos',
        type: 'POST',
        data: {mod_id: mod_id},
        dataType: 'HTML',
        beforeSend: function()
        {
            (accion == undefined)? alerta_showLoading("Espere un segundo", 'Cargando Opciones...') : '';
        },    
    }).done(function(data, textStatus, jqXHR)
    {
        $('#cam_mod_id').val(mod_id);
        $('#cam_mod_multiple').val(multiple);
        $('#cam_mod_nombre').val(nombre);

        $('#lbl_opciones').html('OPCIONES DEL MODULO: ' + nombre.toUpperCase());
        (accion == undefined)? alerta_global('success', 'Opciones del Modulo Cargado Correctamente') : '';
        $('#overlay').hide();
        $('#ul_opciones').html(data);
    }).always(function()//cuando se completa 
    {
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function cambiar_orden_opciones(e)//funcion para guardar o editar 
{
    e.preventDefault();//no se activara evento default
    var formdata = new FormData($("#formulario_opc")[0]);
    $.ajax({
        url : urlweb + "?c=Modulos&a=cambiar_orden_opciones",
        type : "POST",
        data : formdata,
        dataType: 'json',
        contentType : false,
        processData : false,
        beforeSend: function()
        {
            alerta_showLoading("Espere un segundo", 'Cambiando orden...');
        },    
    }).done(function(data, textStatus, jqXHR)
    {
        alerta_global('success',data.mensaje);
        // mostrar_opciones_modulo($('#cam_mod_id').val(), $('#cam_mod_multiple').val(), $('#cam_mod_nombre').val(),1);
    }).always(function() 
    {
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alert("a")
        alerta_global("error",mensaje_error_ajax);
    });
}
function cancelarOpciones()
{
    $('#cam_mod_id').val(null);
    $('#lbl_opciones').html('OPCIONES');
    $('#ul_opciones').html(null);
    $('#overlay').show();
}
function editar_modulo(mod_id, nombre, icono, multiple)
{
    $('#titulo_mod').html('Editar Modulo');
    $('#reg_mod_id').val(mod_id);
    $('#reg_mod_nombre').val(nombre);
    $('#reg_mod_ico').val(icono);
    $('#reg_mod_multiple').val(multiple).trigger('change');
    $('#myModal').modal('show');
}
function validar_formulario_modulo()
{
    var validator = $( "#formulario_modulo" ).validate({
        rules: 
        {
            'reg_mod_nombre':
            {
                required: true,
            },
            'reg_mod_ico': 
            {
                required: true,
            },
            'reg_mod_multiple': 
            {
                required: true,
            },
        },
        messages: 
        {
            'reg_mod_nombre':
            {
                required: 'Por favor, Ingrese el nombre del modulo',
            },
            'reg_mod_ico': 
            {
                required: "Por favor, Ingrese el nombre del icono",
            },
            'reg_mod_multiple': 
            {
                required: 'Por favor, Indique si el modulo sera multiple o no',
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
function guardar_editar_modulo(e)
{
    if(validar_formulario_modulo().form())
    {
        e.preventDefault();//no se activara evento default
        var isNuevo = "Se procederá a crear el nuevo modulo con los datos proporcionados"
        var mensaje_sec = "Guardando..."
        if($('#reg_mod_id').val() != "") { isNuevo = "Se procederá a editar el modulo con los datos proporcionados"; mensaje_sec = "Editando..."  }

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
                    $('#reg_mod_orden').val($('#orden').val());
                    var formdata = new FormData($("#formulario_modulo")[0]);
                    $.ajax({
                        url : urlweb + "?c=Modulos&a=guardar_editar_modulo",
                        type : "POST",
                        dataType: 'json',
                        data : formdata,
                        contentType : false,
                        processData : false,
                        beforeSend: function()
                        {
                            alerta_showLoading("Espere un segundo", mensaje_sec);
                        },    
                    }).done(function(data, textStatus, jqXHR)
                    {
                        if(data.rpta == "error"){alerta_global("error", data.mensaje);}
                        else 
                        { 
                            alerta_global("success",data.mensaje); 
                            mostrar_modulos();
                            $('#myModal').modal('hide'); 
                            cancelarformModulo(); 
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown)
                    {
                        Swal.close();
                        alerta_global("error", "Hubo un error al contactarse con el servidor, compruebe nuevamente");
                    });
                }
                else
                {
                    Swal.close();
                }
            })
    }
}
function limpiar_formulario_modulo()
{
    $('#titulo_mod').html('Registrar Modulo');
    $('#reg_mod_id').val(null);
    $('#reg_mod_nombre').val(null);
    $('#reg_mod_ico').val(null);
    $('#reg_mod_orden').val(null);
    $('#reg_mod_multiple').val(null).trigger('change');
}
function cancelarformModulo()
{
    validar_formulario_modulo().resetForm();
}
function eliminar_modulo(mod_id, nombre) // ANULAR INTERNO
{
    mensaje_confirmacion.fire(
        {
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a eliminar el modulo `+nombre+`</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span><br>
                <small class="text-danger text-bold">Recuerde que esta opción es irreversible y no podra modificarlo.
                <br>Esto Eliminara todas las Opciones que tenga el Modulo, Incluido los permisos que tiene dentro de los Roles </small>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url: urlweb + "?c=Modulos&a=eliminar_modulos",
                    type: 'POST',
                    data : {mod_id : mod_id},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un segundo", "Eliminado Modulo...");
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
                        mostrar_modulos();
                        cancelarOpciones();
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
function validar_formulario_opcion()
{
    var validator = $( "#formulario_opcion" ).validate({
        rules: 
        {
            'reg_opc_nombre':
            {
                required: true,
            },
            'reg_opc_nombre_abrev':
            {
                required: true,
            },
            'reg_opc_controlador': 
            {
                required: true,
            },
            'reg_opc_funcion': 
            {
                required: true,
            },
        },
        messages: 
        {
            'reg_opc_nombre':
            {
                required: 'Por favor, Ingrese el nombre de la opcion',
            },
            'reg_opc_nombre_abrev':
            {
                required: 'Por favor, Ingrese el nombre de la opcion Abreviada',
            },
            'reg_opc_controlador': 
            {
                required: "Por favor, Ingrese el nombre del controlador",
            },
            'reg_opc_funcion': 
            {
                required: "Por favor, Ingrese el nombre de la funcion",
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
function editar_opcion(opc_id, per_id, nombre, nombre_abrev, funcion, controlador)
{
    $('#titulo_opc').html('Editar Opcion');
    $('#reg_opc_id').val(opc_id);
    $('#reg_per_id').val(per_id);
    $('#reg_opc_nombre').val(nombre);
    $('#reg_opc_nombre_abrev').val(nombre_abrev);
    
    $('#reg_opc_funcion').val(funcion);
    $('#reg_opc_controlador').val(controlador);
    $('#myModalOpciones').modal('show');
}
function guardar_editar_opcion(e)
{
    if(validar_formulario_opcion().form())
    {
        e.preventDefault();//no se activara evento default
        var isNuevo = "Se procederá a crear la nueva opcion con los datos proporcionados"
        var mensaje_sec = "Guardando..."
        if($('#reg_opc_id').val() != "") { isNuevo = "Se procederá a editar la opcion con los datos proporcionados"; mensaje_sec = "Editando..."  }
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
                    $('#reg_opc_orden').val($('#orden_opc').val());
                    $('#reg_opc_mod_id').val($('#cam_mod_id').val());
                    var formdata = new FormData($("#formulario_opcion")[0]);
                    $.ajax({
                        url : urlweb + "?c=Modulos&a=guardar_editar_opcion",
                        type : "POST",
                        dataType: 'json',
                        data : formdata,
                        contentType : false,
                        processData : false,
                        beforeSend: function()
                        {
                            alerta_showLoading("Espere un segundo", mensaje_sec);
                        },    
                    }).done(function(data, textStatus, jqXHR)
                    {
                        if(data.rpta == "error"){alerta_global("error", data.mensaje);}
                        else 
                        { 
                            alerta_global("success",data.mensaje); 
                            mostrar_opciones_modulo($('#cam_mod_id').val(), $('#cam_mod_multiple').val(), $('#cam_mod_nombre').val(),1);
                            $('#myModalOpciones').modal('hide'); 
                            cancelarformOpciones(); 
                        }
                    }).fail(function(jqXHR, textStatus, errorThrown)
                    {
                        Swal.close();
                        alerta_global("error", "Hubo un error al contactarse con el servidor, compruebe nuevamente");
                    });
                }
                else
                {
                    Swal.close();
                }
            })
    }
}
function limpiar_formulario_opcion()
{
    $('#titulo_opc').html('Registrar Opcion');
    $('#reg_opc_id').val(null);
    $('#reg_per_id').val(null);
    $('#reg_opc_nombre').val(null);
    $('#reg_opc_nombre_abrev').val(null);
    $('#reg_opc_funcion').val(null);
    $('#reg_opc_controlador').val(null);
}
function cancelarformOpciones()
{
    validar_formulario_opcion().resetForm();
}
function eliminar_opcion(opc_id, per_id, nombre) // ANULAR INTERNO
{
    mensaje_confirmacion.fire(
        {
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a eliminar la opcion `+nombre+`</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span><br>
                <small class="text-danger text-bold">Recuerde que esta opción es irreversible y no podra modificarlo.</small>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url: urlweb + "?c=Modulos&a=eliminar_opcion",
                    type: 'POST',
                    data : {opc_id : opc_id, per_id: per_id},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un segundo", "Eliminado Opcion...");
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
                        mostrar_opciones_modulo($('#cam_mod_id').val(), $('#cam_mod_multiple').val(), $('#cam_mod_nombre').val(),1);
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
//funcion para activar
function desactivar(estado, opc_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a activar la opcion seleccionada</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Modulos&a=activar_desactivar',
                    type : 'POST',
                    data : {opc_id : opc_id, estado : estado},
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
                            mostrar_opciones_modulo($('#cam_mod_id').val(), $('#cam_mod_multiple').val(), $('#cam_mod_nombre').val(),1);
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
//funcion para activar usuario
function activar(estado, opc_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a activar la opcion seleccionada</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Modulos&a=activar_desactivar',
                    type : 'POST',
                    data : {opc_id : opc_id, estado : estado},
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
                            mostrar_opciones_modulo($('#cam_mod_id').val(), $('#cam_mod_multiple').val(), $('#cam_mod_nombre').val(),1);
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
//funcion para activar
function desactivar_modulo(estado, mod_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a desactivar el modulo seleccionado</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Modulos&a=activar_desactivar_modulo',
                    type : 'POST',
                    data : {mod_id : mod_id, estado : estado},
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
                            mostrar_modulos();
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
//funcion para activar usuario
function activar_modulo(estado, mod_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a activar el modulo seleccionado</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Modulos&a=activar_desactivar_modulo',
                    type : 'POST',
                    data : {mod_id : mod_id, estado : estado},
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
                            mostrar_modulos();
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