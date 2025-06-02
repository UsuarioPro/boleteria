window.onload = function()
{
    tema = (detectCookie('dark_mode') == true)? 'dark-mode' : '';
    $('body').attr('class','hold-transition sidebar-mini sidebar-collapse layout-fixed layout-footer-fixed text-sm pace-primary ' + tema);//esconder navbar

    file_1 = FilePond.create(document.querySelector('.filepond'));
    file_1.setOptions(option_FilePondImage);
    file_2 = FilePond.create(document.querySelector('.filepond2'));
    file_2.setOptions(option_FilePondImage);

    $('#myModal').on('shown.bs.modal', function () 
    {
        setTimeout(function () 
        {
            $('#con_nombre').focus();
        }, 200);
    });
    $('#myModal').on('hidden.bs.modal', function (e) 
    {
        limpiar();
    });
    validar_formulario().form();
    $("#formulario").on("submit",function(e)
    {
        guardar_editar(e);
    });
    listar_datatable(); 
    obtener_locales();
    obtener_categoria();
    obtener_artista();
    obtener_clientes();
    $('#btn_cancelar').click(cancelarform);
    $('#btn_agregar_pago').click(agregar_artista);
    $('#btn_agregar_zona').click(agregar_zona);
}
// codigo que sirve para validar el fomulario 
function validar_formulario()
{
    var validator = $( "#formulario" ).validate({
        rules: 
        {
            'con_nombre': 
            {
                required: true,
            },
            'usu_imagen': 
            {
                required: true,
            },      
            'usu_portada': 
            {
                required: true,
            },      
            'con_fecha':
            {
                required: true,
                min: true,
            }
        },
        messages: 
        {
            'con_nombre': 
            {
                required: "Por favor, ingrese el nombre de la categoria",
            },
            'usu_imagen': 
            {
                required: 'Por favor, seleccione una imagen',
            },      
            'usu_portada': 
            {
                required: 'Por favor, seleccione una imagen',
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
function obtener_locales() 
{
    $.ajax({
        url: urlweb + '?c=Eventos&a=obtener_locales',
        type: 'POST',
        beforeSend: function()
        {
            // $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        $('#loc_id').html(data);
    }).always(function()//cuando se completa 
    {
        // $('#overlay_general').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function obtener_clientes() 
{
    $.ajax({
        url: urlweb + '?c=Eventos&a=obtener_clientes',
        type: 'POST',
        beforeSend: function()
        {
            // $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        $('#cli_id').html(data);
    }).always(function()//cuando se completa 
    {
        // $('#overlay_general').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function obtener_categoria()
{
    $.ajax({
        url: urlweb + '?c=Eventos&a=obtener_categorias',
        type: 'POST',
        beforeSend: function()
        {
            // $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        $('#cat_id').html(data);
    }).always(function()//cuando se completa 
    {
        // $('#overlay_general').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function obtener_artista()
{
    $.ajax({
        url: urlweb + '?c=Eventos&a=obtener_artistas',
        type: 'POST',
        beforeSend: function()
        {
            // $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        $('#select_artista').html(data);
    }).always(function()//cuando se completa 
    {
        // $('#overlay_general').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
// -----------------------cierre validacion-------------------------------------------
//funcion para limpiar los inputs del form 
function limpiar()
{
    $('#con_id').val(null);
    $('#con_nombre').val(null); 
    $('#con_subtitulo').val(null);
    $('#loc_id').val(null).trigger('change');
    $('#cat_id').val(null).trigger('change');
    $('#con_descripcion').val(null);
    $('#con_fecha').val(null);
    $('#con_hora').val(null);
    $('#select_artista').val(null).trigger('change');
    $('#fecha_hora').val(null);
    $('#nombre_zona').val(null);
    $('#descripcion_zona').val(null);
    $('#precio_zona').val(null);
    $('#stock_zona').val(null);
    $('#temp_img1').val(null);
    $('#temp_img2').val(null);
    $('#tbl_artista tbody').html(null);
    $('#tbl_zonas tbody').html(null);
    contador = 1000;
    file_1.removeFiles({ revert: true });
    file_2.removeFiles({ revert: true });
    document.getElementById('titulo').innerHTML='Registrar Concierto';
}
//funcion cancelar form
function cancelarform()
{
    validar_formulario().resetForm();
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
        "fixedColumns": 
        {
            left: 1,
            right: 1
        },
        "ajax":
        {
            url: urlweb + '?c=Eventos&a=listar', 
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
            setTimeout(() => { tippy('.tooltip_tippy', {content: '', allowHTML: true});}, 10);
        },
        "bDestroy": true,
        "iDisplayLength": 25,//Paginación
        "order": [[3, "desc"]],//Ordenar (columna,orden)
    }).DataTable();
    tabla.on('draw', function (settings, data) 
    {
        setTimeout(() => { tippy('.tooltip_tippy', {content: '', allowHTML: true});}, 10);
    } );
}
//funcion para desaactivar
function desactivar(con_estado, con_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se procedera a marcar el evento como ya realizado</span> <br>
                <div class="mt-2">
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>
                </div>
                `,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Eventos&a=activar_desactivar',
                    type : 'POST',
                    data : {con_id : con_id, con_estado : con_estado},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un segundo...", "Desactivando...");
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
function rechazar(con_estado, con_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se procedera a rechazar el evento que propuso el organizador</span> <br>
                <div class="mt-2">
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>
                </div>
                `,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Eventos&a=activar_desactivar',
                    type : 'POST',
                    data : {con_id : con_id, con_estado : con_estado},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un segundo...", "Desactivando...");
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
function activar(con_estado, con_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se procedera a marcar el evento como vigente</span> <br>
                <div class="mt-2">
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>
                </div>
                `,
            width : '400px',
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Eventos&a=activar_desactivar',
                    type : 'POST',
                    data : {con_id : con_id, con_estado : con_estado},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un segundo...", "Desactivando...");
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
// funcion para editar
//funcion para obtener el dato a editar
function editar(con_id) 
{
    $.ajax({
        url: urlweb + '?c=Eventos&a=obtener',
        type: 'POST',
        dataType: 'json',
        data:{con_id: con_id},
        beforeSend: function()
        {
            $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        document.getElementById('titulo').innerHTML='Editar Categoria';
        $('#con_id').val(data['model'].con_id);
        $('#loc_id').val(data['model'].loc_id).trigger('change');
        $('#cat_id').val(data['model'].cat_id).trigger('change');
        $('#cli_id').val(data['model'].cli_id).trigger('change');
        $('#con_nombre').val(data['model'].con_nombre);
        $('#con_subtitulo').val(data['model'].con_subtitulo);
        $('#con_descripcion').val(data['model'].con_descripcion);
        $('#con_fecha').val(data['model'].con_fecha);
        $('#con_hora').val(data['model'].con_hora);
        $('#temp_img1').val(data['model'].con_imagen);
        $('#temp_img2').val(data['model'].con_portada);
        $('#tbl_artista tbody').html(data['html']);
        $('#tbl_zonas tbody').html(data['html_zonas']);
        if(data['model'].con_imagen != "")
        {
            file_1.addFile(urlweb + "media/concierto_logo/"+data['model'].con_imagen+"?file"+new Date().getTime());
        }
        if(data.con_portada != "")
        {
            file_2.addFile(urlweb + "media/concierto_portada/"+data['model'].con_portada+"?file2"+new Date().getTime());
        }    
        $('#myModal').modal('show');
    }).always(function()//cuando se completa 
    {
        $('#overlay_general').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
// para guardar los datos
//funcion para guardar o editar
function guardar_editar(e) 
{
    e.preventDefault();//no se activara evento default
    if(validar_formulario().form())
    {
        if($('#tbl_artista tbody tr').length != '0')
        {
            if($('#tbl_zonas tbody tr').length != '0')
            {
                var isNuevo = "Se procedera a guardar una nueva categoria"
                var mensaje_sec = "Guardando..."
                if($('#con_id').val() != "") { isNuevo = "Se procedera a editar la categoria"; mensaje_sec = "Editando..."  }
                mensaje_confirmacion.fire(
                    { 
                        icon : 'info',
                        title: 'Necesitamos de tu Confirmación',
                        html: `<span>`+isNuevo+`</span> <br>
                            <div class="mt-2">
                                <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>
                            </div>
                            `,
                        width : '400px',
                    }).then((result) =>
                    {
                        if (result.value == true)
                        {
                            var formdata = new FormData($("#formulario")[0]);
                            $.ajax({
                                url : urlweb + "?c=Eventos&a=guardar_editar",
                                type : "POST",
                                dataType: 'json',
                                data : formdata,
                                contentType : false,
                                processData : false,
                                beforeSend: function()
                                {
                                    alerta_showLoading("Espere un segundo...", mensaje_sec);
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
            else
            {
                alerta_global('warning', 'Es necesario tener al menos una zona con precios')
            }    
        }
        else
        {
            alerta_global('warning', 'Es necesario tener al menos un artistas seleccionado')
        }
    }
}
function eliminar(con_id)
{
    mensaje_confirmacion.fire(
        {
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se eliminará la categoria</span> <br>
                <div class="mt-2">
                    <small class="text-danger text-bold">Recuerde que esta opcion es Irreversible. <br>
                        Solo se podra eliminar la categoria si no se tiene registrado productos con esta.</small> <br>
                    <span class="text-success text-bold">¿Esta usted de Acuerdo?</span>
                </div>
                `,
            width : '400px',    
        }).then((result) =>
        {
            if (result.value == true)
            {
                $.ajax({
                    url : urlweb + '?c=Eventos&a=eliminar',
                    type : 'POST',
                    data : {con_id : con_id},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un segundo...", "Eliminando Categoria...");
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
function agregar_artista()
{
    if($('#select_artista').val() != null)
    {
        if($('#fecha_hora').val() != '')
        {
            let hora1 = $('#con_hora').val();      // Ejemplo: "14:30"
            let hora2 = $('#fecha_hora').val();    // Ejemplo: "13:45"
            let h1 = moment(hora1, 'HH:mm');
            let h2 = moment(hora2, 'HH:mm');
            
            if (h2.isBefore(h1)) 
            {
                    alerta_global('warning', 'La hora de la presentacion no puede ser menor que la hora del evento');                
            }
            else
            {
                let art_id = $('#select_artista').val();
                if(validar_producto_repetido(art_id) === false)
                {
                    let fecha_hora = $('#fecha_hora').val();
                    let fechaFormateada = moment(fecha_hora).format('DD/MM/YYYY hh:mm A');
                    var nombre = $('#select_artista option:selected').attr('data_nombre');
                    let html = `<tr class="filas" id="fila_`+art_id+`">
                            <td>`+nombre+`</td>
                            <td>
                                `+fechaFormateada+`
                                <input type="hidden" name="art_id[]" value="`+art_id+`">
                                <input type="hidden" name="art_fecha_hora[]" value="`+fecha_hora+`">
                            </td>
                            <td><button type="button" class="btn btn-danger" onclick="eliminar_detalle(`+art_id+`)"><i class="fas fa-trash"></i> </button>  </td>
                        </tr>`;
                    $('#tbl_artista tbody').append(html);
                    setTimeout(() => {
                        $('#fecha_hora').val(null);
                        $('#select_artista').val(null).trigger('change');
                    }, 100);
                }
                else
                {
                    alerta_global('warning', 'Este Artista o Grupo ya se encuentra seleccionado');
                }
            }
        }
        else
        {
            alerta_global('warning', 'Seleccione una fecha y hora');
        }
    }
    else
    {
        alerta_global('warning', 'Seleccione un artista');
    }
}
function validar_producto_repetido(art_id)
{
    let valor= false;
    let con = document.getElementsByName("art_id[]");
    for (var i = 0; i < con.length; i++)
    {
        var inpCon=con[i];
        if(inpCon.value == art_id)
        {
            valor = true;
            return valor;
        }
    }
    return valor;
}
function eliminar_detalle(art_id)
{
    $("#fila_"+art_id).remove();
}
let contador = 1000;
function agregar_zona()
{
    if($('#nombre_zona').val() != '')
    {
        if($('#descripcion_zona').val() != '')
        {
            if($('#precio_zona').val() != '')
            {
                if($('#stock_zona').val() != '')
                {
                    if(validar_zona_repetido($('#nombre_zona').val()) === false)
                    {
                        let html = `<tr class="filas_zona" id="fila_zona_`+contador+`">
                                <td>`+$('#nombre_zona').val()+`</td>
                                <td>`+$('#precio_zona').val()+`</td>
                                <td>`+$('#stock_zona').val()+`</td>
                                <td>`+$('#descripcion_zona').val()+`
                                    <input type="hidden" name="zon_nombre[]" value="`+$('#nombre_zona').val()+`">
                                    <input type="hidden" name="zon_precio[]" value="`+$('#precio_zona').val()+`">
                                    <input type="hidden" name="zon_detalle[]" value="`+$('#descripcion_zona').val()+`">
                                    <input type="hidden" name="zon_stock[]" value="`+$('#stock_zona').val()+`">
                                </td>
                                <td><button type="button" class="btn btn-danger" onclick="eliminar_detalle_zona(`+contador+`)"><i class="fas fa-trash"></i> </button>  </td>
                            </tr>`;
                        $('#tbl_zonas tbody').append(html);
                        contador++;
                        setTimeout(() => {
                            $('#nombre_zona').val(null);
                            $('#descripcion_zona').val(null);
                            $('#precio_zona').val(null);
                            $('#stock_zona').val(null);                        
                        }, 100);
                    }
                    else
                    {
                        alerta_global('warning', 'El nombre de la zona ya se encuentra seleccionado');
                    }
                }    
                else
                {
                    alerta_global('warning', 'Ingrese el stock de la zona');
                }            
            }      
            else
            {
                alerta_global('warning', 'Ingrese un precio a la zonas');
            }
        }
        else
        {
            alerta_global('warning', 'Ingrese una descripcion a la zona');
        }
    }
    else
    {
        alerta_global('warning', 'Ingrese el nombre de la zona');
    }
}
function validar_zona_repetido(zon_nombre)
{
    let valor= false;
    let con = document.getElementsByName("zon_nombre[]");
    for (var i = 0; i < con.length; i++)
    {
        var inpCon=con[i];
        console.log(inpCon.value);
        console.log(zon_nombre);
        if(inpCon.value == zon_nombre)
        {
            valor = true;
            return valor;
        }
    }
    return valor;
}
function eliminar_detalle_zona(zon_id)
{
    $("#fila_zona_"+zon_id).remove();
}