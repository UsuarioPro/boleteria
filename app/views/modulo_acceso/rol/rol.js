window.onload = function()
{    
    suc_id = $('#session_suc_id').val();//variable que recibe el rol del usuario
    rol_id = $('#rol_id').val();//variable para obtener la sucursal

    $('#myModal').on('shown.bs.modal', function ()  
    {
        setTimeout(function ()
        {
            $('#rol_nombre').focus(); 
        }, 200);
    });
    validar_formulario();
    $("#formulario").on("submit",function(e)
    {
        guardar_editar(e);
    });
    $('#div_modulos_sistema').on('changed.jstree', function(evt, data)
    {
        $("#div_permisos").html(null);
        let productos_seleccionados = $('#div_modulos_sistema').jstree('get_selected',true);
        $.each(productos_seleccionados,function()
        {
            if(buscar_cadena(this.id, 'nav_') == false)
            {
                $("#div_permisos").append($('<input>',
                {
                    id: 'per_id[]',
                    name: 'per_id[]',
                    value: this.id,
                    type: 'hidden'
                }))
            }
        })
    })
    listar_datatable();
    atajos_teclado();
    arbol_navbar('opciones_arbol','div_modulos_sistema');
    arbol_navbar('ver_opciones_arbol','ver_div_modulos_sistema');
    $('#btn_desmarcar_todo').click(desmarcar_todo);
    $('#btn_marcar_todo').click(marcar_todo);
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
            url: urlweb + '?c=Rol&a=listar',
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
function arbol_navbar(arbol, contenedor)
{
    $.ajax({
        url: urlweb + '?c=Rol&a=crear_arbol_navbar',
        type: 'POST',
        beforeSend: function()
        {
        },
    }).done(function(respuesta) 
    {  
        $("#"+arbol).html(respuesta)
        $('#'+contenedor).jstree(
        {
            "core" : 
            {
                "themes" : 
                {
                    "stripes" : true,
                    "variant" : "large",
                }
            },
            // 'core':
            // {
            //     'check_callback': true,
            // },
            'check_callback':
            {
                'keep_selected_style':false
            },
            'plugins':['wholerow', 'checkbox', 'types', 'changed']
        });
        setTimeout(() => {
            
            $('#div_modulos_sistema').jstree(true).select_node(3);
        }, 500);
    }).always(function() 
    {
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
//funcion para activar
function desactivar(rol_estado, rol_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a desactivar el rol seleccionado</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Rol&a=activar_desactivar',
                    type : 'POST',
                    data : {rol_id : rol_id, rol_estado : rol_estado},
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
function activar(rol_estado, rol_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>Se procederá a activar el rol seleccionado</small> <br>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Rol&a=activar_desactivar',
                    type : 'POST',
                    data : {rol_id : rol_id, rol_estado : rol_estado},
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
// codigo que sirve para validar el fomulario 
function validar_formulario()
{
    var validator = $( "#formulario" ).validate({
        rules: 
        {
            'rol_nombre':
            {
                required: true,
            },
            'per_id[]': 
            {
                required: true,
            },
        },
        messages: 
        {
            'rol_nombre':
            {
                required: 'Por favor, ingrese un nombre para el rol',
            },
            'per_id[]': 
            {
                required: "",
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
//funcion para limpiar los inputs del form 
function limpiar()
{
    $('#div_modulos_sistema').jstree("deselect_all");
    $('#div_modulos_sistema').jstree('open_all');
    $('#div_modulos_sistema').jstree(true).select_node(3);
    $('#rol_id').val(null);
    $('#rol_nombre').val(null);
    $('#rol_descripcion').val(null);
    document.getElementById('titulo').innerHTML='Registrar Rol';
}
function desmarcar_todo()
{
    $('#div_modulos_sistema').jstree("deselect_all");
    $('#div_modulos_sistema').jstree(true).select_node(3);
}
function marcar_todo()
{
    $('#div_modulos_sistema').jstree("select_all");
}
//funcion cancelar form
function cancelarform()
{
    validar_formulario().resetForm();
    $('#myModal').on('hidden.bs.modal', function (e) 
    {
        limpiar();
    });
}
function editar(rol_id)// funcion para editar
{
    $.ajax({
        url: urlweb + '?c=Rol&a=obtener',
        type: 'POST',
        // async: false,
        dataType: 'json',
        data:{rol_id: rol_id},
        beforeSend: function()
        {
            $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        document.getElementById('titulo').innerHTML='Editar Rol';
        $('#rol_id').val(data['datos'].rol_id);
        $('#rol_nombre').val(data['datos'].rol_nombre);
        $('#rol_descripcion').val(data['datos'].rol_descripcion);
        ver_permisos_rol(data['permisos'], 'div_modulos_sistema') 
        $('#myModal').modal('show');
    }).always(function()//cuando se completa 
    {
        $('#overlay_general').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function ver_permisos_rol(data, div) 
{
    let los_cboxes = document.getElementsByName('per_id_mul[]');
        for (var i = 0, j = los_cboxes.length; i < j; i++)
        {
            for (var k = 0, m = data.length; k < m; k++)
            {
                if(los_cboxes[i].id == data[k])
                {
                    $('#'+div).jstree(true).select_node(los_cboxes[i].id);
                }
            }
        }
}
function obtener_permisos_rol(rol_id)
{
    $.ajax({
        url: urlweb + '?c=Rol&a=obtener_permisos_rol',
        type: 'POST',
        dataType: 'json',
        data:{rol_id: rol_id},
        beforeSend: function()
        {
            $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        ver_permisos_rol(data, 'ver_div_modulos_sistema');
        $('#myModalPermisos').modal('show');
    }).always(function()//cuando se completa 
    {
        $('#overlay_general').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
//funcion para guardar o editar
function guardar_editar(e)
{
    let is_per = document.getElementsByName('per_id[]');
    if(validar_formulario().form())
    {
        if(is_per.length == 0)
        {
            alerta_global('warning', 'Por favor es necesario al menos poner un modulo al rol')
            e.preventDefault();//no se activara evento default
            return ;
        }
        e.preventDefault();//no se activara evento default
        var isNuevo = "Se procederá a crear el nuevo rol con los datos proporcionados"
        var mensaje_sec = "Editando..."
        if($('#rol_id').val() != "") { isNuevo = "Se procederá a editar el rol con los datos proporcionados"; mensaje_sec = "Editando..."  }
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
                    var formdata = new FormData($("#formulario")[0]);
                    $.ajax({
                        url : urlweb + "?c=Rol&a=guardar_editar",
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
                            tabla.ajax.reload(); 
                            $('#myModal').modal('hide'); 
                            cancelarform(); 
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
function atajos_teclado()
{
    shortcut.add("Alt+A",function() 
    {
        $('#myModal').modal('show');
    });
    shortcut.add("Alt+C",function() 
    {
        $('#myModal').modal('hide');
        cancelarform()
    });
    shortcut.add("Alt+G",function() 
    {
        if($('#myModal').is(':visible') == true)
        {
            $("#btn_guardar").trigger("click");
        }   
    });
}
function cancelarformPermisos()//funcion cancelar form
{
    $('#myModalPermisos').on('hidden.bs.modal', function (e) 
    {
        $('#ver_div_modulos_sistema').jstree("deselect_all");
        $('#ver_div_modulos_sistema').jstree('open_all');
    });
}