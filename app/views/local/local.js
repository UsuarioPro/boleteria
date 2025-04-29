window.onload = function()
{
    file_1 = FilePond.create(document.querySelector('.filepond'));
    file_1.setOptions(option_FilePondImage);

    file_2 = FilePond.create(document.querySelector('.filepond2'));
    file_2.setOptions(option_FilePondImage);

    $('#myModal').on('shown.bs.modal', function () 
    {
        setTimeout(function () 
        {
            $('#loc_nombre').focus();
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
    $('#btn_cancelar').click(cancelarform);
}
// codigo que sirve para validar el fomulario 
function validar_formulario()
{
    var validator = $( "#formulario" ).validate({
        rules: 
        {
            'loc_nombre': 
            {
                required: true,
            },
            'usu_imagen': 
            {
                required: true,
            },       
        },
        messages: 
        {
            'loc_nombre': 
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
// -----------------------cierre validacion-------------------------------------------
//funcion para limpiar los inputs del form 
function limpiar()
{
    $('#loc_id').val(null);
    $('#loc_nombre').val(null); 
    $('#loc_direccion').val(null);
    $('#loc_ciudad').val(null);
    $('#temp_img1').val(null);
    $('#temp_img2').val(null);
    file_1.removeFiles({ revert: true });
    file_2.removeFiles({ revert: true });
    document.getElementById('titulo').innerHTML='Registrar Local';
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
        "ajax":
        {
            url: urlweb + '?c=Locales&a=listar', 
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
        "order": [[0, "desc"]],//Ordenar (columna,orden)
    }).DataTable();
    tabla.on('draw', function (settings, data) 
    {
        setTimeout(() => { tippy('.tooltip_tippy', {content: '', allowHTML: true});}, 10);
    } );
}
//funcion para desaactivar
function desactivar(loc_estado, loc_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se desactivara la categoria</span> <br>
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
                    url : urlweb + '?c=Locales&a=activar_desactivar',
                    type : 'POST',
                    data : {loc_id : loc_id, loc_estado : loc_estado},
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
function activar(loc_estado, loc_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se desactivara la categoria</span> <br>
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
                    url : urlweb + '?c=Locales&a=activar_desactivar',
                    type : 'POST',
                    data : {loc_id : loc_id, loc_estado : loc_estado},
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
function editar(loc_id) 
{
    $.ajax({
        url: urlweb + '?c=Locales&a=obtener',
        type: 'POST',
        dataType: 'json',
        data:{loc_id: loc_id},
        beforeSend: function()
        {
            $('#overlay_general').show();
        },
    }).done(function(data, textStatus, jqXHR)
    {
        document.getElementById('titulo').innerHTML='Editar Local';
        $('#loc_id').val(data.loc_id);
        $('#loc_nombre').val(data.loc_nombre);
        $('#loc_ciudad').val(data.loc_ciudad);
        $('#loc_direccion').val(data.loc_direccion);
        $('#myModal').modal('show');
        $('#temp_img1').val(data.loc_imagen_logo);
        if(data.loc_imagen_logo != "")
        {
            file_1.addFile(urlweb + "media/locales/"+data.loc_imagen_logo+"?file"+new Date().getTime());
        }

        $('#temp_img2').val(data.loc_escenario_img);
        if(data.loc_escenario_img != "")
        {
            file_2.addFile(urlweb + "media/escenarios/"+data.loc_escenario_img+"?file2"+new Date().getTime());
        }

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
    if(validar_formulario().form())
    {
        e.preventDefault();//no se activara evento default
        var isNuevo = "Se procedera a guardar una nueva categoria"
        var mensaje_sec = "Guardando..."
        if($('#loc_id').val() != "") { isNuevo = "Se procedera a editar la categoria"; mensaje_sec = "Editando..."  }
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
                        url : urlweb + "?c=Locales&a=guardar_editar",
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
}
function eliminar(loc_id)
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
                    url : urlweb + '?c=Locales&a=eliminar',
                    type : 'POST',
                    data : {loc_id : loc_id},
                    dataType: 'json',
                    beforeSend: function()
                    {
                        alerta_showLoading("Espere un segundo...", "Eliminando Local...");
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