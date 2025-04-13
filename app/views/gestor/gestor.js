let contador_ruta = 1;
let currentIndex = 0;
let columns = 0;
let isKeyDownEventAttached = false; // Variable para rastrear si el evento keydown ha sido agregado
let isEmptyUsers = false; // Variable para rastrear si el evento keydown ha sido agregado
window.onload = function()
{
    document.oncontextmenu = function() {return false;};
    $('#overlay_compartir').hide();
    $('#overlay_producto_cuadricula').hide();
    arbol_file_manager();
    arbol_file_manager_mover();
    file_manager(true,'root', '');
    validar_formulario();
    $('#imagen').hide();
    file_4 = FilePond.create(document.querySelector('.filepondPortada'));
    
    $('#myModalCarpeta').on('shown.bs.modal', function () 
    {
        $('#carpeta').focus();
        $('#url').val($('#url_file_manager').val());
        $('#fol_fld').val($('#url_file_fol_fld').val());
        $('#fol_extension').val($('#url_fol_extension').val());
        $('#fol_pertenece').val($('#url_fol_pertenece').val());
        $('#fol_compartido').val($('#url_fol_compartido').val());

        $('#fol_tipo').val(0);
    });
    $('#myModalCarpeta').on('hidden.bs.modal', function (e) 
    {
        $('#carpeta').val(null);
        $('#url').val(null);
        $('#fol_fld').val(null);
        $('#fol_tipo').val(null);
        $('#fol_extension').val(null);
        $('#fol_pertenece').val(null);
        $('#fol_compartido').val(null);
    });
    $("#formulario").on("submit",function(e)
    {
        guardar_editar(e);
    });
    $('#btn_cancelar').click(cancelarform);
    $('#ruta_item_0').click(function()
    {
        refrescar_por_ruta(0, true, 'root', '', '')
    });
    $('#btn_refrescar').attr('onclick', 'refrescar_por_ruta(0, true,"root","","")');

    $('#myModalRenombrar').on('shown.bs.modal', function () 
    {
        $('#renombrar_file').focus();
        $('#renombrar_file').select();
    });
    $('#myModalRenombrar').on('hidden.bs.modal', function (e) 
    {
        $('#renombrar_file').val(null);
        $('#ren_fol_id').val(null);
        $('#ren_fol_tipo').val(null);
        $('#ren_fol_cid').val(null);
        $('#ren_fol_name').val(null);
        $('#ren_url_file_manager').val(null);
        $('#ren_fol_url').val(null);
        $('#ren_fol_extension').val(null);
    });
    $("#formulario_renombrar").on("submit",function(e)
    {
        guardar_renombrar_file(e);
    });
    $('#btn_cancelar_renombrar').click(cancelarformRenombrar);
    validar_formulario_renombrar();
    $('#opciones_files').hide();
    $('#btn_guardar_mover').click(copiar_mover_archivos);
    $('#btn_guardar_copiar').click(copiar_mover_archivos);
    $('#myModalMoverCopiar').on('hidden.bs.modal', function (e) 
    {
        $('#fol_tipo_accion').val(null);
        $('#mov_fil_seleccionado').val(null);
        $('#mov_fol_tipo').val(null);
        $('#mov_fol_cid').val(null);
        $('#mov_fol_nombre').val(null);
        $('#mov_fol_url_actual').val(null);
        $('#mov_fol_id').val(null);
        $('#mov_fol_url').val(null);
        $('#url_view_mover').val(null);
        $('#div_modulos_mover').jstree("deselect_all");
        $('#div_modulos_mover').jstree('close_all');
    });
    $('#btn_guardar_copiar').hide();
    $('#btn_guardar_mover').hide();
    $("#formulario_subir").on("submit",function(e)
    {
        guardar_subir_archivos(e);
    });
    $('#myModalSubir').on('shown.bs.modal', function () 
    {
        $('#up_url').val($('#url_file_manager').val());
        $('#up_fol_fld').val($('#url_file_fol_fld').val());
        $('#up_fol_tipo').val(1);
        $('#up_fol_extension').val($('#url_fol_extension').val());
        $('#up_fol_pertenece').val($('#url_fol_pertenece').val());
        $('#up_fol_compartido').val($('#url_fol_compartido').val());

        document.activeElement.blur();
    });
    $('#myModalSubir').on('hidden.bs.modal', function (e) 
    {
        $('#up_url').val(null);
        $('#up_fol_fld').val(null);
        $('#up_fol_tipo').val(null);
        $('#up_fol_extension').val(null);
        $('#up_fol_pertenece').val(null);
        $('#up_fol_compartido').val(null);
        file_4.removeFiles({ revert: true });
        document.activeElement.blur();
    });
    $('#myModalInformacion').on('hidden.bs.modal', function (e) 
    {
        $('#mostrar_archivo').attr('src', null);
    });
    $('#myModalCompartir').on('show.bs.modal', function (e) 
    {
        (isEmptyUsers)? setTimeout(() => {$('#usu_id').val("").trigger('change');}, 200) : null;
    });
    $('#myModalCompartir').on('shown.bs.modal', function (e) 
    {
        (isEmptyUsers)? $("#usu_id").select2("open") : null; 
    });
    $('#myModalCompartir').on('hidden.bs.modal', function (e) 
    {
        $('#usu_id').val(null).trigger('change');
        $('#comp_tipo').val(null);
        $('#comp_nombre').val(null);
        $('#comp_fol_id').val(null);    
        $('#comp_fol_url').val(null);
        $('#comp_usuarios').val(null);
        $('#comp_fol_user_id').val(null);    
        if($('#remover_usuario').prop('checked'))
        {
            $('#remover_usuario').prop('checked', false).trigger('change')
        } 
    });
    $("#formulario_compartir").on("submit",function(e)
    {
        guardar_editar_compartir(e);
    });
    $('#btn_cancelar_compartir').click(cancelarformCompartir);
    validar_formulario_compartir();
    initializeSelect2HTML('usu_id', urlweb + '?c=FileManager&a=seleccionar_usuario', null, 'bootstrap4');
    $('#remover_usuario').change(mostrar_usuarios_seleccionados);
}
function arbol_file_manager()
{
    $('#div_modulos_sistema').jstree({
        'core': {
            'data': function (node, cb) 
            {
                $.ajax({
                    url: urlweb + '?c=FileManager&a=crear_arbol_carpetas',
                    type: 'POST',
                    data: { condicion : 0, id: node.id },
                    dataType: 'json',
                }).done(function(data) 
                { 
                    if(data.length == 0)
                    {
                        $('#div_modulos_sistema').hide();
                        $('#div_arbol_vacio').show();
                    }
                    else
                    {
                        $('#div_arbol_vacio').hide();
                        $('#div_modulos_sistema').show();
                        cb(data);
                    }
                }).always(function() 
                {
                }).fail(function(jqXHR, textStatus, errorThrown)
                {
                    alerta_global("error",mensaje_error_ajax);
                });
            },
            "themes" : 
            {
                "stripes" : true,
                "variant" : "large",
            }
        },
        'plugins':['wholerow', 'types', 'changed']
    }).on('loaded.jstree', function(e, data) 
    {
    }).on('open_node.jstree', function (e, data) {
        data.instance.set_icon(data.node, 'fa-duotone fa-solid fa-folder-open text-primary'); // cambiar a carpeta abierta
    }).on('close_node.jstree', function (e, data) {
        data.instance.set_icon(data.node, 'fas fa-folder text-primary'); // cambiar a carpeta cerrada
    }).on('ready.jstree', function(e, data) {
        // if (data.instance.get_json().length === 0) {
        //     $('#div_modulos_sistema').html('<div class="jstree-empty-text">No hay datos disponibles</div>');
        // }, '.jstree-anchor',
    })
    // .on('dblclick.jstree', '.jstree-node', function(e, data) 
    // {
    //     var node = $('#div_modulos_sistema').jstree(true).get_node(this);
    //     file_manager(1, node.data.fol_cid, node.data.encode_fol_url, node.data.fol_nombre)
    // '1','e9bebfe24efe39363283275aca01562b','files%2Fdocumentos','documentos'
    // });

    //     setTimeout(() => {
    //         $('#div_modulos_sistema').jstree('open_all');
    //     }, 300);
}
function arbol_file_manager_mover()
{
    $('#div_modulos_mover').jstree({
        'core': {
            'data': function (node, cb) 
            {
                $.ajax({
                    url: urlweb + '?c=FileManager&a=crear_arbol_carpetas',
                    type: 'POST',
                    data: { condicion : 1, id: node.id},
                    dataType: 'json',
                }).done(function(data) 
                { 
                    if(data.length == 0)
                    {
                        $('#div_modulos_mover').hide();
                        $('#div_arbol_vacio_mover').show();
                    }
                    else
                    {
                        $('#div_arbol_vacio_mover').hide();
                        $('#div_modulos_mover').show();
                        cb(data);
                    }
                }).always(function() 
                {
                }).fail(function(jqXHR, textStatus, errorThrown)
                {
                    alerta_global("error",mensaje_error_ajax);
                });
            },
            "themes" : 
            {
                "stripes" : true,
                "variant" : "large",
            },
        },
        'plugins':['wholerow', 'types', 'changed', 'checkbox'],
        'checkbox': {
            'three_state': false, // Disables cascading selection
            // 'whole_node': false,  // Disables the whole node being clickable
            // 'tie_selection': false // Keeps the checkbox and node selection separate
        }
        }).on('open_node.jstree', function (e, data) {
            data.instance.set_icon(data.node, 'fa-duotone fa-solid fa-folder-open text-primary'); // cambiar a carpeta abierta
        }).on('close_node.jstree', function (e, data) {
            data.instance.set_icon(data.node, 'fas fa-folder text-primary'); // cambiar a carpeta cerrada
        }).on('ready.jstree', function(e, data) {
            // if (data.instance.get_json().length === 0) {
            //     $('#div_modulos_sistema').html('<div class="jstree-empty-text">No hay datos disponibles</div>');
            // }
        }).on('changed.jstree', function(e, data) 
        {
            if (data.action === 'deselect_node' && data.selected.length == 0) 
            {
                $('#mov_fol_id').val(null);
                $('#mov_fol_url').val(null);
                $('#mov_fol_cid').val(null);
            }
            if (data.action === 'select_node') 
            {
                var selectedNodes = data.selected.filter(function(nodeId) 
                {
                    return nodeId !== data.node.id;
                });
                if (selectedNodes.length > 0) 
                {
                    data.instance.deselect_node(selectedNodes);
                }
                $('#mov_fol_id').val(data.node.data.fol_id);
                $('#mov_fol_url').val(data.node.data.fol_url);
                $('#mov_fol_cid').val(data.node.data.fol_cid);
            }
        })
}
function refrescar_por_ruta(contador, refrescar, fol_fld, encode_fol_url, fol_nombre, fol_extension, fol_pertenece, compartido)
{
    (contador == 0)? $('.link_folder').removeClass('text-dark') : null;
    let inicio = (contador == 0)? contador + 1 : contador;

    for(let i= inicio; i <= contador_ruta; i++)
    {
        $("#ruta_item_"+i).remove();
    }
    file_manager(refrescar, fol_fld, encode_fol_url, fol_nombre, fol_extension, fol_pertenece, compartido);
}
function file_manager(refrescar, fol_fld, encode_fol_url, fol_nombre, fol_extension, fol_pertenece, compartido)
{
    if(refrescar)
    {
        if(encode_fol_url != '')
        {
            var url = decodeURIComponent(encode_fol_url);
            var nombre = decodeURIComponent(fol_nombre);
            $('#url_file_manager').val(url);
            $('#url_file_fol_fld').val(fol_fld);
            $('#url_fol_extension').val(fol_extension);
            $('#url_fol_pertenece').val(fol_pertenece);
            $('#url_fol_compartido').val(compartido);
            $('.link_folder').addClass('text-dark');
            $('#rutas').append('<li id="ruta_item_'+contador_ruta+'" class="breadcrumb-item"><a href="#" onclick="refrescar_por_ruta('+contador_ruta+',1,\'' + fol_fld + '\', \'' + encode_fol_url + '\', \'' + fol_nombre + '\', \'' + fol_extension + '\', \'' + fol_pertenece + '\', \'' + compartido + '\')" class="link_folder">' + nombre + '</a></li>');
            $('#btn_refrescar').attr('onclick', 'refrescar_por_ruta('+contador_ruta+',1,\'' + fol_fld + '\', \'' + encode_fol_url + '\', \'' + fol_nombre + '\', \'' + fol_extension + '\', \'' + fol_pertenece + '\', \'' + compartido + '\')');
            contador_ruta++;

            if($('#url_file_rol_id').val() != 1 && $('#url_file_fol_fld').val() != 'root' && compartido != '')
            {
                $('#btn_new_folder').show();
                $('#btn_new_file').show();
                $('#btn_agregar_folder').attr('disabled', false);
                $('#btn_agregar_archivos').attr('disabled', false);
            }    
        }
        else
        {
            $('#btn_refrescar').attr('onclick', 'refrescar_por_ruta(0, true,"root","","")');
            $('#url_file_manager').val('files');
            $('#url_file_fol_fld').val('root');
            $('#url_fol_extension').val(null);
            $('#url_fol_pertenece').val(null);
            $('#url_fol_compartido').val(null);
            if($('#url_file_rol_id').val() != 1 && $('#url_file_fol_fld').val() == 'root')
            {
                $('#btn_new_folder').hide();
                $('#btn_new_file').hide();
                $('#btn_agregar_folder').attr('disabled', true);
                $('#btn_agregar_archivos').attr('disabled', true);
            }
        }
    }
    $.ajax({
        url: urlweb + '?c=FileManager&a=listar_file_manager',
        type : 'POST',
        data: {fol_fld: fol_fld},
        dataType: 'JSON',
        beforeSend: function()
        {
            $('#overlay_producto_cuadricula').show();
        }
    }).done(function(data)
    {
        $('#div_file_manager').html(data.html);
        if(data.rpta == 'ok')
        {
            currentIndex = 0;
            columns = $('.divs_files_folders');
            if (isKeyDownEventAttached) 
            {
                $('#div_file_manager').off('keydown', moverse_file_manager);
                isKeyDownEventAttached = false;
            }
            $('#div_file_manager').keydown(moverse_file_manager); 
            isKeyDownEventAttached = true;
            columns.click(activar_option);

            setTimeout(() => {
                $(columns[currentIndex]).trigger('click');
            }, 100);
            tippy('.tooltip_tippy', {content: '', allowHTML: true});
        }
        else
        {
            $('#producto_vacio').focus(); 
            if ($('#opciones_files').is(':visible')) 
            {
                $('#opciones_files').hide();
            }
        }
    }).always(function(data)//cuando se completa 
    {
        $('#overlay_producto_cuadricula').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)    
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function activar_option()
{
    if ($(this).hasClass('active_file')) { return; }

    $(columns[currentIndex]).removeClass('active_file');
    currentIndex = columns.index(this);
    $(this).addClass('active_file').focus();
}
function pagina_anterior_siguiente_producto(numeracion)
{
    $.ajax({
        url: urlweb + '?c=FileManager&a=listar_file_manager',
        data: {fol_fld : $('#url_file_fol_fld').val(), numeracion : numeracion},
        type : 'POST',
        beforeSend: function()
        {
            $('#overlay_producto_cuadricula').show();
        }
    }).done(function(datos)
    {
        $('#div_file_manager').html(datos);
    }).always(function(data)//cuando se completa 
    {
        $('#overlay_producto_cuadricula').hide();
        $('#opciones_files').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function validar_formulario()
{
    var validator = $( "#formulario" ).validate({
        rules:
            {
                'carpeta': 
                {
                    required: true,
                },
            },
        messages:
            {
                'carpeta': 
                {
                    required: "Por favor, Ingrese el Nombre para la carpeta",
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
function validar_formulario_renombrar()
{
    var validator = $( "#formulario_renombrar" ).validate({
        rules:
            {
                'renombrar_file': 
                {
                    required: true,
                },
            },
        messages:
            {
                'renombrar_file': 
                {
                    required: "Por favor, Ingrese el Nombre nuevo",
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
function validar_formulario_compartir()
{
    var validator = $( "#formulario_compartir" ).validate({
        rules:
            {
                'usu_id[]': 
                {
                    required: true,
                },
            },
        messages:
            {
                'usu_id[]': 
                {
                    required: "Por favor, Seleccione uno o mas usuarios",
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
function cancelarform()
{
    validar_formulario().resetForm();
}
function cancelarformCompartir()
{
    validar_formulario_compartir().resetForm();
}
function cancelarformRenombrar()
{
    validar_formulario_renombrar().resetForm();
}
function guardar_editar(e)//funcion para guardar o editar 
{
    if(validar_formulario().form())
    {
        e.preventDefault();//no se activara evento default
        if($('#url_file_rol_id').val() != 1 && $('#url_file_fol_fld').val() == 'root')
        {
            alerta_global('warning', 'No cuenta con permisos suficiente para crear carpetas en la Raiz <br>Necesitas ser SuperUsuario');
        }
        else
        {
            var formdata = new FormData($("#formulario")[0]);
            $.ajax({
                url : urlweb + "?c=FileManager&a=guardar_editar_carpeta",
                type : "POST",
                data : formdata,
                dataType: 'json',
                contentType : false,
                processData : false,
                beforeSend: function()
                {
                    alerta_showLoading("Espere un momento", 'Creando carpeta...');
                },    
            }).done(function(data, textStatus, jqXHR)
            {
                if(data.rpta == 'existe')
                {
                    alerta_global("warning",data.mensaje); 
                    $('#carpeta').focus();
                    $('#carpeta').select();
                    return;
                }
                if(data.rpta == 'ok')
                {
                    alerta_global("success",data.mensaje); 
                    file_manager(false, $('#url_file_fol_fld').val(), '');
                    $('#div_modulos_sistema').jstree(true).refresh();
                    $('#div_modulos_mover').jstree(true).refresh();
                }
                else
                {
                    alerta_global("error",data.mensaje); 
                }
                $('#myModalCarpeta').modal('hide');
                cancelarform();
            }).always(function() 
            {
            }).fail(function(jqXHR, textStatus, errorThrown)
            {
                alerta_global("error",mensaje_error_ajax);
            });
        }
    }
}
function renombrar_file(fol_id, tipo, fol_cid, fol_nombre, fol_url, fol_extension)
{
    nombre = decodeURIComponent(fol_nombre);
    url = decodeURIComponent(fol_url);
    
    $('#ren_fol_id').val(fol_id);
    $('#ren_fol_tipo').val(tipo);
    $('#ren_fol_cid').val(fol_cid);
    $('#ren_fol_name').val(nombre);
    $('#ren_fol_url').val(url);
    $('#renombrar_file').val(nombre);
    $('#ren_fol_extension').val(fol_extension);
    $('#ren_url_file_manager').val($('#url_file_manager').val());
    (tipo == 0)? $('#titulo_renombrar').html('Renombrar Carpeta') : $('#titulo_renombrar').html('Renombrar Archivo');
    $('#myModalRenombrar').modal('show');
}
function guardar_renombrar_file(e)
{
    if(validar_formulario_renombrar().form())
    {
        e.preventDefault();//no se activara evento default
        isNuevo = ($('#ren_fol_tipo').val() == "0") ? 'Se renombrara la Carpeta Seleccionada' : 'Se renombrara el Archivo seleccionado';
        mensaje_confirmacion.fire(
            {
                icon : 'info',
                title: 'Necesitamos de tu Confirmación',
                html: `<small>`+isNuevo+`</small>
                    <div class="card p-0 m-0 shadow-none">
                        <div class="card-body pb-0 pl-2 pr-2" style="margin-top: -15px">
                            <ul class="list-group list-group-unbordered mb-2">
                                <li class="list-group-item">
                                    <span class="float-left text-muted text-sm">Nombre Actual</span>
                                    <span class="float-right text-muted text-sm">`+$('#ren_fol_name').val() +`</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="float-left text-muted text-sm">Se cambiara por</span>
                                    <span class="float-right text-muted text-sm">`+$('#renombrar_file').val() +`</span>
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
                    var formdata = new FormData($("#formulario_renombrar")[0]);
                    $.ajax({
                        url : urlweb + "?c=FileManager&a=guardar_renombrar",
                        type : "POST",
                        data : formdata,
                        dataType: 'json',
                        contentType : false,
                        processData : false,
                        beforeSend: function()
                        {
                            alerta_showLoading("Espere un momento", 'Renombrando...');
                        }, 
                    }).done(function(data, textStatus, jqXHR)
                    {
                        if(data.rpta == 'ok')
                        {
                            alerta_global("success",data.mensaje); 
                            file_manager(false, $('#url_file_fol_fld').val(), '');
                            $('#div_modulos_sistema').jstree(true).refresh();
                            $('#div_modulos_mover').jstree(true).refresh();            
                            $('#myModalRenombrar').modal('hide');
                        }
                        else if(data.rpta == 'nombre')
                        {
                            alerta_global("warning",data.mensaje);
                            $('#renombrar_file').focus(); 
                            $('#renombrar_file').select(); 
                        }
                        else
                        {
                            alerta_global("error",data.mensaje); 
                        }
                    }).always(function()
                    {
                        cancelarformRenombrar();                
                    }).fail(function(jqXHR, textStatus, errorThrown)
                    {
                        alerta_global("error",mensaje_error_ajax);
                    });
                }
            })
    }
}
function eliminar_archivo(fol_id, tipo, encode_fol_url, fol_cid)
{
    url = decodeURIComponent(encode_fol_url);
    isTitulo = (tipo == '0')? 'Se procedera a eliminar la carpeta y el contenido que contiene (subcarpetas y archivos)' : 'Se procedera a eliminar el archivo'
    mensaje_confirmacion.fire(
        {
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<small>`+isTitulo+`</small>
            <br>
                <small>Recuerde que esta opción es irreversible y no podra rectificarlo</small>
                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=FileManager&a=eliminar_archivos',
                    type : 'POST',
                    data : {fol_id : fol_id, tipo : tipo, url : url, fol_cid : fol_cid},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un momento", "Eliminando...");
                    },
                    }).done(function(data) 
                    {  
                        if(data.rpta == 'ok')
                        {
                            alerta_global("success",data.mensaje); 
                            file_manager(false, $('#url_file_fol_fld').val(), '');
                            $('#div_modulos_sistema').jstree(true).refresh();
                            $('#div_modulos_mover').jstree(true).refresh();            
                        }
                        else
                        {
                            alerta_global("error",data.mensaje); 
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
function mover_copiar_carpeta_archivo(fol_id, tipo, encode_fol_nombre, encode_fol_url, tipo_accion)
{
    if(tipo_accion == 0)
    {
        (tipo == 0)? $('#titulo_mover').html('Copiar Carpeta') : $('#titulo_mover').html('Copiar Archivo');
        $('#btn_guardar_mover').hide();    
        $('#btn_guardar_copiar').show();
    }
    else
    {
        (tipo == 0)? $('#titulo_mover').html('Mover Carpeta') : $('#titulo_mover').html('Mover Archivo');
        $('#btn_guardar_copiar').hide();
        $('#btn_guardar_mover').show();    
    }
    $('#fol_tipo_accion').val(tipo_accion);
    $('#mov_fil_seleccionado').val(fol_id);
    $('#mov_fol_tipo').val(tipo);
    url = decodeURIComponent(encode_fol_url);
    nombre = decodeURIComponent(encode_fol_nombre);
    $('#mov_fol_nombre').val(nombre);
    $('#url_view_mover').val(url);
    $('#mov_fol_url_actual').val(url);
    $('#myModalMoverCopiar').modal('show');
}
function copiar_mover_archivos()
{
    accion = ($('#fol_tipo_accion').val() == 0)? 'copiar' : 'mover';
    if($('#mov_fol_id').val() == '')
    {
        alerta_global('warning', 'Por favor, seleccione la ruta nueva');        
    }
    else if($('#mov_fol_url').val() == $('#url_file_manager').val())
    {
        alerta_global('warning', 'Es necesario seleccionar una ruta diferente de la Ruta del <br> Archivo o Carpeta que quieras '+ accion);
    }
    else if($('#mov_fil_seleccionado').val() == $('#mov_fol_id').val())
    {
        alerta_global('warning', 'Estas Intentando '+accion+' el Archivo o Carpeta dentro de la misma. <br>No se podra realizar la accion');
    }
    else
    {
        mensaje_secundario = $('#fol_tipo_accion').val() == 0 ? 'Copiando...' : 'Moviendo...';
        $.ajax({
            url : urlweb + '?c=FileManager&a=copiar_mover_archivos',
            type : 'POST',
            data : { fol_id : $('#mov_fil_seleccionado').val(), tipo : $('#mov_fol_tipo').val(), fol_cid : $('#mov_fol_cid').val(), fol_nombre : $('#mov_fol_nombre').val(), 
                    fol_url_actual : $('#mov_fol_url_actual').val(), fol_url : $('#mov_fol_url').val(), tipo_accion : $('#fol_tipo_accion').val()},
            dataType: 'json',
            beforeSend: function()
            {
                alerta_showLoading("Espere un momento", mensaje_secundario);
            },
        }).done(function(data) 
        {  
            if(data.rpta == 'ok')
            {
                alerta_global("success",data.mensaje); 
                file_manager(false, $('#url_file_fol_fld').val(), '');
                $('#div_modulos_sistema').jstree(true).refresh();
                $('#div_modulos_mover').jstree(true).refresh();
                $('#myModalMoverCopiar').modal('hide');
            }
            else if(data.rpta == 'nombre')
            {
                alerta_global("warning",data.mensaje);
            }
            else
            {
                alerta_global("error",data.mensaje); 
            }
        }).always(function() 
        {
        }).fail(function(jqXHR, textStatus, errorThrown)
        {
            alerta_global("error",mensaje_error_ajax);
        });
    }
}
function mostrar_opciones(fol_id, fol_tipo, refrescar, fol_fld, encode_fol_url, fol_nombre, fol_extension, compatible, tipo, fol_pertenece, compartido)
{
    $('#url_file_compartido').val(compartido);
    $('#btn_descargar').attr('onclick', 'descargar_archivo(\'' + fol_nombre + '\', \'' + fol_extension + '\', \'' + encode_fol_url + '\')');
    $('#btn_ver_archivo').attr('onclick', 'mostrar_archivo(\'' + fol_nombre + '\', \'' + fol_extension + '\', \'' + encode_fol_url + '\', \'' + compatible + '\', \'' + tipo + '\')');
    $('#btn_abrir_carpeta').attr('onclick', 'file_manager('+refrescar+',\'' + fol_fld + '\', \'' + encode_fol_url + '\', \'' + fol_nombre + '\', \'' + fol_extension + '\', \'' + fol_pertenece + '\', \'' + compartido + '\')');
    $('#btn_renombrar').attr('onclick', 'renombrar_file('+fol_id+',\'' + fol_tipo + '\', \'' + fol_fld + '\', \'' + fol_nombre + '\', \'' + encode_fol_url + '\', \'' + fol_extension + '\')');
    $('#btn_eliminar').attr('onclick', 'eliminar_archivo('+fol_id+',\'' + fol_tipo + '\', \'' + encode_fol_url + '\', \'' + fol_fld + '\')');
    $('#btn_copiar').attr('onclick', 'mover_copiar_carpeta_archivo('+fol_id+',\'' + fol_tipo + '\', \'' + fol_nombre + '\', \'' + encode_fol_url + '\',0)');
    $('#btn_mover').attr('onclick', 'mover_copiar_carpeta_archivo('+fol_id+',\'' + fol_tipo + '\', \'' + fol_nombre + '\', \'' + encode_fol_url + '\',1)');
    $('#btn_compartir').attr('onclick', 'compartir_archivo_carpeta('+fol_id+',\'' + fol_tipo + '\', \'' + fol_nombre + '\', \'' + encode_fol_url + '\', \'' + fol_fld + '\', \'' + fol_pertenece + '\')');
    if(fol_extension == 'share')
    {
        $('#btn_descargar').hide();
        $('#btn_renombrar').hide();
        $('#btn_mover').hide();
        $('#btn_copiar').hide();
        $('#btn_eliminar').hide();
        $('#btn_compartir').hide();
        $('#btn_ver_archivo').hide();
        $('#opciones_files').show();
    }
    else
    {
        $('#btn_renombrar').show();
        $('#btn_mover').show();
        $('#btn_copiar').show();
        $('#btn_eliminar').show();
        if($('#url_file_rol_id').val() == 1)
        {
            $('#btn_compartir').show();
        }
        else
        {
            (compartido == '')? $('#btn_compartir').show() : $('#btn_compartir').hide();
        }
        if(tipo == 0)
        {
            $('#btn_descargar').hide();
            $('#btn_ver_archivo').hide();
            $('#btn_abrir_carpeta').show();
        }
        else
        {
            $('#btn_descargar').show();
            $('#btn_abrir_carpeta').hide();
            $('#btn_ver_archivo').show();
        }
        $('#opciones_files').show();
    }
}
function descargar_archivo(encodename, extension, encode_fol_url)
{
    url = decodeURIComponent(encode_fol_url);
    nombre = decodeURIComponent(encodename);

    const a = document.createElement('a');
    a.href = urlweb + url;
    a.download = nombre;
    a.target = '_blank';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
function guardar_subir_archivos(e)
{
    e.preventDefault();//no se activara evento default
    // Obtener los archivos de FilePond
    mis_files = file_4.getFiles();
    if (mis_files.length === 0) 
    {
        alerta_global('warning', 'Ese necesario seleccionar uno o mas archivos')
    }
    else if($('#url_file_rol_id').val() != 1 && $('#url_file_fol_fld').val() == 'root')
    {
        alerta_global('warning', 'No cuenta con permisos suficiente para subir archivos en la Raiz <br>Necesitas ser SuperUsuario');
    }
    else
    {
        mensaje_confirmacion.fire(
            {
                icon : 'info',
                title: 'Necesitamos de tu Confirmación',
                html: `<small>Se procedera a subir los siguientes archivos al servidor privado. 
                    Ten en cuenta que los archivos se subiran con el mismo nombre que el archivo original 
                    y que si existe el archivo en el servidor este sera 
                    <span class="text-danger text-bold">reemplazado</span> por el nuevo archivo</small> <br>
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>`,
                width : '400px',
            }).then((result) =>
            {
                if (result.value == true)
                {
                    var formdata = new FormData($("#formulario_subir")[0]);
                    $.ajax({
                        url : urlweb + "?c=FileManager&a=guardar_subir_archivos",
                        type : "POST",
                        data : formdata,
                        dataType: 'json',
                        contentType : false,
                        processData : false,
                        beforeSend: function()
                        {
                            alerta_showLoading("Espere un momento", 'Subiendo Archivos...');
                        }, 
                    }).done(function(data, textStatus, jqXHR)
                    {
                        if(data.rpta == 'ok')
                        {
                            alerta_global("success",data.mensaje); 
                            resultado_envio(data.subidos, data.no_subidos, data.consola);
                            file_manager(false, $('#url_file_fol_fld').val(), '');
                        }
                        else
                        {
                            alerta_global("error",data.mensaje); 
                        }
                    }).always(function()
                    {
                        $('#myModalSubir').modal('hide');
                    }).fail(function(jqXHR, textStatus, errorThrown)
                    {
                        alerta_global("error",mensaje_error_ajax);
                    });
                }
            })
    }
}
function resultado_envio(ok, recha, consola)  //funcion para mostrar el resultado luego del envio de facturas
{
    mensaje_confirmacion.fire(
        {
            title: '<label><i class=""></i> Resumen Subida de Archivos</label>',
            html:`<div class="row border-bottom ml-2 mr-2 mt-0">
                    <div class="col-6 pb-0 pt-2"><label for="" class="text-success">SUBIDOS</label></div>
                    <div class="col-6 pb-0 pt-2"><label for="" class="text-danger">NO SUBIDOS</label></div>
                </div>
                <div class="row border-bottom ml-2 mr-2 mt-0">
                    <div class="col-6 col-6 pb-0 pt-2"><h1 class="text-success">`+ok+`</h1></div>
                    <div class="col-6 col-6 pb-0 pt-2"><h1 class="text-danger">`+recha+`</h1></div>
                </div>                
                <div class="row m-0 pt-2" style="margin-top: 5px; display: ;" id="div_consola">
                    <div class="col-12">
                        <div class="card card-primary card-outline rounded-0 pb-0 mb-0 text-left">
                            <div class="card-header rounded-0 pt-1 pb-1">
                                <span class="text-bold text-sm">Resumen Detallado de Subida de Archivos</span>
                            </div>
                            <div class="card-body p-0">
                                <div class="direct-chat-messages" style="height: auto !important; max-height: 250px; overflow-y: auto; overflow-x: auto">
                                    `+consola+`
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`,
            showConfirmButton: true,
            showCancelButton: false,
            width: '450px',
        }).then((result) =>
            {
                if (result.value == true)
                {
                }
            })
}
function mostrar_archivo(name, extension, encode_fol_url, compatibilidad, tipo)
{
    if(compatibilidad)
    {
        url = decodeURIComponent(encode_fol_url);
        if(tipo == 'image' || tipo == 'video')
        {
            Fancybox.show([{
                src: urlweb + url, // Aquí puedes poner la URL de la imagen generada por PHP
                type: tipo,
            }]);
        }
        else if(tipo == 'embed')
        {
            $('#mostrar_archivo').attr('src', urlweb + url + '?' +new Date().getTime());
            // $('#mostrar_archivo').attr('type', 'application/pdf');
            $('#myModalInformacion').modal('show');
        }
        else
        {
            $('#mostrar_archivo').attr('src', '//view.officeapps.live.com/op/embed.aspx?src='+ ruta_completa + '?' + new Date().getTime());
            $('#myModalInformacion').modal('show');
        }
    }
    else
    {
        alerta_global('warning', 'No es posible visualizar el archivo. El formato no es compatible <br>Intente descargar el archivo si desea verlo');
    }
}
function mostrar_usuarios_seleccionados()
{
    if($(this).prop('checked'))
    {
        $('#text_compartir').html('Importante!!! Al seleccionar al usuario se le quitara el privilegio de ver y modificar las subcarpetas y archivos que contiene la carpeta.');
        $('#usu_id').html(null);
        initializeSelect2HTML('usu_id', urlweb + '?c=FileManager&a=seleccionar_usuario_compartido', $('#comp_fol_id').val(), 'bootstrap4');
    }
    else
    {
        $('#text_compartir').html('Importante!!!. Al compartir la carpeta se compartira todas las subscarpetas y archivos que estan dentro de la carpeta principal.');
        $('#usu_id').html(null);
        initializeSelect2HTML('usu_id', urlweb + '?c=FileManager&a=seleccionar_usuario', null, 'bootstrap4');
        if($('#comp_usuarios').val() != "")
        {
            $('#overlay_compartir').show();
            let valores = $('#comp_usuarios').val().split(',').map(Number);
            seleccionarOpcionSelect2Multiple(valores, 'usu_id' , urlweb + '?c=FileManager&a=seleccionar_usuario');
            (function waitForAjaxSeleccionarOpcion() 
            {
                if (!ajaxTerminadoSeleccionarOpcion) 
                {
                    setTimeout(waitForAjaxSeleccionarOpcion, 100); // Esperar 100ms y verificar de nuevo
                } 
                else 
                {
                    $('#overlay_compartir').hide();
                }
            })();
        }
    }
}
function compartir_archivo_carpeta(fol_id, tipo, encode_fol_nombre, encode_fol_url, fol_cid, fol_user_id)
{
    nombre = decodeURIComponent(encode_fol_nombre);
    url = decodeURIComponent(encode_fol_url);
    $('#comp_tipo').val(tipo);
    $('#comp_nombre').val(nombre);
    $('#comp_fol_id').val(fol_id);
    $('#comp_fol_url').val(url);    
    $('#comp_fol_user_id').val(fol_user_id);    
    (tipo == 1)? $('#titulo_compartir').html("Compartir Archivo") : $('#titulo_compartir').html("Compartir Carpeta");
    (tipo == 1)? $('#div_informacion').hide() : $('#div_informacion').show();
    $.ajax({
        url : urlweb + '?c=FileManager&a=usuarios_compartidos',
        type : 'POST',
        data : {fol_id : fol_id},
        dataType: 'json',
        beforeSend: function()
        {
            alerta_showLoading("Espere un momento", "Recopilando Informacion...");
        },
        }).done(function(data) 
        {  
            if(data.length == 0)
            {
                $('#comp_usuarios').val(null);
                $('#div_remover_usuario').hide();
                isEmptyUsers = true;
                Swal.close();
                $('#myModalCompartir').modal('show');
            }
            else
            {
                $('#comp_usuarios').val(data);
                $('#div_remover_usuario').show();
                isEmptyUsers = false;
                seleccionarOpcionSelect2Multiple(data, 'usu_id' , urlweb + '?c=FileManager&a=seleccionar_usuario');
                (function waitForAjaxSeleccionarOpcion() 
                {
                    if (!ajaxTerminadoSeleccionarOpcion) 
                    {
                        setTimeout(waitForAjaxSeleccionarOpcion, 100); // Esperar 100ms y verificar de nuevo
                    } 
                    else 
                    {
                        Swal.close();
                        $('#myModalCompartir').modal('show');
                    }
                })();
            }
        }).always(function() 
        {
        }).fail(function(jqXHR, textStatus, errorThrown)
        {
            alerta_global("error",mensaje_error_ajax);
        });
}
function validar_usuarios_compartidos(tipo_valores)
{
    // let validador = false;
    let valoresPrevios = (tipo_valores == 0)? $('#comp_usuarios').val().split(',').map(Number) : $('#comp_fol_user_id').val().split(',').map(Number); // Convierte los valores previos a números
    let valoresSeleccionados = $('#usu_id').val(); // Obtener los valores seleccionados del select múltiple
    let encontrado = valoresSeleccionados.some(valor => {
        if (valoresPrevios.includes(parseInt(valor))) {
            // Obtener el texto de la opción seleccionada
            let textoOpcion = $(`#usu_id option[value="${valor}"]`).text();
            let mensaje = (tipo_valores == 0)? 'La Carpeta o Archivo ya se encuentra compartido con el siguiente usuario <br> ' + textoOpcion : 
                'No se puede compartir con el usuario con '+textoOpcion + ' <br>La carpeta raiz le pertenece';
            alerta_global('warning', mensaje)
            return true; // Detener la búsqueda, `some` devuelve `true`
        }
        return false; // Continuar buscando
    });
    return (encontrado)? true : false;
}
function guardar_editar_compartir(e)//funcion para guardar o editar 
{
    if(validar_formulario_compartir().form())
    {
        e.preventDefault();//no se activara evento default
        if($('#remover_usuario').prop('checked') == false)
        {
            if(validar_usuarios_compartidos(0)) { return;}
            if(validar_usuarios_compartidos(1)) { return;}
        }
        titulo_comp = ($('#comp_tipo').val() == 0)? 'la carpeta' : 'el archivo';
        myHtml = $('#remover_usuario').prop('checked')? 
                `<small>Se procedera a quitar la `+titulo_comp+` compartida a todos los usuarios que previamente seleccionaste</small> `:
                `<small>Se procedera a compartir `+titulo_comp+` con el nombre <span class="text-danger text-bold">`+$('#comp_nombre').val() +` </span> con los usuarios previamente seleccionados</small>`;
        mensaje_confirmacion.fire(
            {
                icon : 'info',
                title: 'Necesitamos de tu Confirmación',
                html: myHtml+`
                    <br><div class="mt-2">
                        <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>
                    </div> `,
                width : '400px',
            }).then((result) =>
            {
                if (result.value == true)
                {
                    var formdata = new FormData($("#formulario_compartir")[0]);
                    $.ajax({
                        url : urlweb + "?c=FileManager&a=guardar_compartir",
                        type : "POST",
                        data : formdata,
                        dataType: 'json',
                        contentType : false,
                        processData : false,
                        beforeSend: function()
                        {
                            alerta_showLoading("Espere un momento", 'Compartiendo...');
                        }, 
                    }).done(function(data, textStatus, jqXHR)
                    {
                        if(data.rpta == 'ok')
                        {
                            alerta_global("success",data.mensaje);
                            var rutaNavegacion = $('#rutas li');
                            var activo = rutaNavegacion.last(); // Selecciona el último elemento de la lista (carpeta actual)
                            var enlace = activo.find('a');
                            enlace.click(); // Activa el evento click en el enlace de la carpeta anterior                            
                        }
                        else
                        {
                            alerta_global("error",data.mensaje); 
                        }
                        $('#myModalCompartir').modal('hide');
                    }).always(function()
                    {
                        // $('#myModalSubir').modal('hide');
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
function generateContextMenu(isFile, extension) 
{
    let specificMenu = isFile
        ? [
            {
                icon: 'fa-duotone fa-eye',
                label: '<small>Ver Archivo</small>',
                action: function(option, contextMenuIndex, optionIndex) {
                    superCm.destroyMenu();
                    $('#btn_ver_archivo').trigger('click');
                    setTimeout(() => {
                        $('#file_manager_fol_id').val(null);
                    }, 200);
                },
                submenu: null,
                disabled: false
            }
        ]
        : [
            {
                icon: 'fa-duotone fa-folder-open',
                label: '<small>Abrir Carpeta</small>',
                action: function(option, contextMenuIndex, optionIndex) {
                    superCm.destroyMenu();
                    $('#div_'+$('#file_manager_fol_id').val()).dblclick();
                    setTimeout(() => {
                        $('#file_manager_fol_id').val(null);
                    }, 200);
                },
                submenu: null,
                disabled: false
            }
        ];

    let myMenu = 
        [
            {
                // This example uses Font Awesome Iconic Font.
                icon: 'fa-duotone fa-file-pen',
                // Menu Label
                label: '<small>Renombrar</small>',
                // Callback
                action: function(option, contextMenuIndex, optionIndex) 
                {
                    superCm.destroyMenu();
                    $('#btn_renombrar').trigger('click');
                    setTimeout(() => {
                        $('#file_manager_fol_id').val(null);
                    }, 200);
                },
                // An array of submenu objects
                submenu: null,
                // is disabled?
                disabled: false   //Disabled status of the option
            },
            {
                // This example uses Font Awesome Iconic Font.
                icon: 'fa-duotone fa-folder-arrow-up',
                // Menu Label
                label: '<small>Mover</small>',
                // Callback
                action: function(option, contextMenuIndex, optionIndex) 
                {
                    superCm.destroyMenu();
                    $('#btn_mover').trigger('click');
                    setTimeout(() => {
                        $('#file_manager_fol_id').val(null);
                    }, 200);
                },
                // An array of submenu objects
                submenu: null,
                // is disabled?
                disabled: false   //Disabled status of the option
            },
            {
                // This example uses Font Awesome Iconic Font.
                icon: 'fa-duotone fa-copy',
                // Menu Label
                label: '<small>Copiar</small>',
                // Callback
                action: function(option, contextMenuIndex, optionIndex) 
                {
                    superCm.destroyMenu();
                    $('#btn_copiar').trigger('click');
                    setTimeout(() => {
                        $('#file_manager_fol_id').val(null);
                    }, 200);
                },
                // An array of submenu objects
                submenu: null,
                // is disabled?
                disabled: false   //Disabled status of the option
            },
            {
                // This example uses Font Awesome Iconic Font.
                icon: 'fa-duotone fa-trash',
                // Menu Label
                label: '<small>Eliminar</small>',
                // Callback
                action: function(option, contextMenuIndex, optionIndex) 
                {
                    superCm.destroyMenu();
                    $('#btn_eliminar').trigger('click');
                    setTimeout(() => {
                        $('#file_manager_fol_id').val(null);
                    }, 200);
                },
                // An array of submenu objects
                submenu: null,
                // is disabled?
                disabled: false   //Disabled status of the option
            }
        ];

    if($('#url_file_rol_id').val() == 1)
    {
        myMenu.push({
                icon: 'fa-duotone fa-share-nodes',
                label: '<small>Compartir</small>',
                action: function(option, contextMenuIndex, optionIndex) 
                {
                    superCm.destroyMenu();
                    $('#btn_compartir').trigger('click');
                    setTimeout(() => {
                        $('#file_manager_fol_id').val(null);
                    }, 200);
                },
                submenu: null,
                disabled: false   
            });
    }
    else
    {
        if($('#url_file_compartido').val() == '')
        {
            myMenu.push({
                icon: 'fa-duotone fa-share-nodes',
                label: '<small>Compartir</small>',
                action: function(option, contextMenuIndex, optionIndex) 
                {
                    superCm.destroyMenu();
                    $('#btn_compartir').trigger('click');
                    setTimeout(() => {
                        $('#file_manager_fol_id').val(null);
                    }, 200);
                },
                submenu: null,
                disabled: false   
            });
        }
    }
    if (isFile) 
    {
        myMenu.push({
            icon: 'fa-duotone fa-download',
            label: '<small>Descargar</small>',
            action: function(option, contextMenuIndex, optionIndex) 
            {
                superCm.destroyMenu();
                $('#btn_descargar').trigger('click');
                setTimeout(() => {
                    $('#file_manager_fol_id').val(null);
                }, 200);
            },
            submenu: null,
            disabled: false
        });
    }

    return (extension == 'share')? specificMenu : specificMenu.concat(myMenu);
}
function mostrar_menu_fila(e, fol_id, tipo, extension) 
{
    $('#div_'+fol_id).trigger('click');
    $('#file_manager_fol_id').val(fol_id);
    myMenuContext = (tipo == 0)? generateContextMenu(false, extension) : generateContextMenu(true, extension); 
    superCm.createMenu(myMenuContext, e);
}
function getColumnsPerRow() 
{
    let width = $(window).width();
    if (width >= 1200) return 4; // xl (4 columns)
    if (width >= 992) return 3;  // lg (3 columns)
    if (width >= 768) return 2;  // md (2 columns)
    if (width >= 576) return 2;  // sm (2 columns)
    return 1; // xs (1 column)
}
function moverse_file_manager(e) // e, es el evento keydown
{
    let columnsPerRow = getColumnsPerRow();
    switch(e.which) 
    {
        case 37: // left arrow key
            $(columns[currentIndex]).removeClass('active_file');
            if (currentIndex % columnsPerRow !== 0) 
            {
                currentIndex--;
            } 
            else if (currentIndex !== 0) 
            {
                currentIndex -= columnsPerRow;  // Mover al último elemento de la fila anterior
                currentIndex += (columnsPerRow - 1); 
            } 
            else 
            {
                currentIndex = columns.length - 1; // Si es el primer elemento, moverse al último
            }
            $(columns[currentIndex]).addClass('active_file').focus();
            break;

        case 39: // right arrow key
            $(columns[currentIndex]).removeClass('active_file');
            if ((currentIndex + 1) % columnsPerRow !== 0 && currentIndex < columns.length - 1) 
            {
                currentIndex++;
            } 
            else if (currentIndex + 1 < columns.length) 
            {
                currentIndex += (columnsPerRow - (currentIndex % columnsPerRow));
            } 
            else 
            {
                currentIndex = 0; // Regresar al primer elemento si es el último
            }
            $(columns[currentIndex]).addClass('active_file').focus();
            break;

        case 38: // up arrow key
            $(columns[currentIndex]).removeClass('active_file');
            if (currentIndex - columnsPerRow >= 0) 
            {
                currentIndex -= columnsPerRow;
            } 
            else 
            {
                currentIndex = (currentIndex % columnsPerRow) + columnsPerRow * (Math.floor((columns.length - 1) / columnsPerRow));
                if (currentIndex >= columns.length) 
                {
                    currentIndex = (currentIndex % columnsPerRow);
                }
            }
            $(columns[currentIndex]).addClass('active_file').focus();
            break;

        case 40: // down arrow key
            $(columns[currentIndex]).removeClass('active_file');
            if (currentIndex + columnsPerRow < columns.length) 
            {
                currentIndex += columnsPerRow;
            } 
            else 
            {
                currentIndex = currentIndex % columnsPerRow; // Mover al principio de la columna actual
            }
            $(columns[currentIndex]).addClass('active_file').focus();
            break;
        case 13: // down arrow key
            {
                $(columns[currentIndex]).dblclick(); // Trigger the click event for the active element
                break;
            }
        case 8: //teclada backspace
            {
                var rutaNavegacion = $('#rutas li');
                var activo = rutaNavegacion.last(); // Selecciona el último elemento de la lista (carpeta actual)
                var previo = activo.prev(); // Selecciona el <li> anterior
                
                if (previo.length > 0) 
                {
                    var enlaceAnterior = previo.find('a');
                    enlaceAnterior.click(); // Activa el evento click en el enlace de la carpeta anterior
                } 
                break;
            }
        case 46: //tecla suprimir
            {
                if (!$('#producto_vacio').is(':visible')) 
                {
                    $('#btn_eliminar').trigger('click');
                }
                break;
            }
        default: return; // salir del manejador para otras teclas
    }
    setTimeout(() => {
        if(e.which != 13 && e.which != 46)
        {
            $(columns[currentIndex]).trigger('click');
        }
    }, 100);
    e.preventDefault(); // prevenir la acción predeterminada (scroll / mover caret)
}