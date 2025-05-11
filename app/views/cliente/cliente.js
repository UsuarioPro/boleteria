let is_edit = false;
window.onload = function()
{
    $('#overlay_busqueda_sunat').hide();
    $('#myModal').on('shown.bs.modal', function () 
    {
        if(is_edit)
        {
            $('#cli_nombre').focus();
        }
        else
        {
            $('#cli_tipo').focus();
            $("#cli_tipo").select2("open");
        }
    });
    $('#myModal').on('hidden.bs.modal', function (e) 
    {
        is_edit = false;
        limpiar();
    });
    validar_formulario();     
    $("#formulario").on("submit",function(e)
    {
        guardar_editar(e);
    });
    listar_datatable();
    $('#btn_cancelar').click(cancelarform);
    $('#btn_sunat').click(busqueda_sunat);
    $('#cli_tipo').change(habilitar_campo_documento);

    seleccionar_tipo_documento();
    $('#cli_tipo').val(null).trigger('change');
}
function seleccionar_tipo_documento()
{
    //cargamos los sucursales en el select
    $.ajax({
        url: urlweb + '?c=Cliente&a=seleccionar_tipo_documento',
        type : 'POST',
    }).done(function(datos)
    {
        $('#cli_tipo').html(datos);
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
}
function habilitar_campo_documento()
{
    $("#spinner").hide();
    if($('#cli_tipo').val() != null)
    {
        setTimeout(() =>  { $('#cli_num_doc').focus(); }, 150);
        $('#cli_num_doc').attr('disabled', false);
        ($('#cli_tipo').val() == 4)? $('#cli_direccion').attr('required', true) : $('#cli_direccion').attr('required', false); 
        if($('#cli_tipo').val() == 2 || $('#cli_tipo').val() == 4)
        {
            $('#btn_sunat').attr('disabled', false);
            ($('#cli_tipo').val() == 2)? $('#cli_num_doc').attr('maxlength',8) : $('#cli_num_doc').attr('maxlength',11); 
            ($('#cli_tipo').val() == 2)? $('#cli_num_doc').attr('minlength',8) : $('#cli_num_doc').attr('minlength',11); 
        }
        else
        {
            $('#btn_sunat').attr('disabled', true);
            $('#cli_num_doc').removeAttr('maxlength');
            $('#cli_num_doc').removeAttr('minlength');
        }
    }
    else
    {
        $('#cli_num_doc').attr('disabled', true);
        $('#btn_sunat').attr('disabled', true);
    }
}
function busqueda_sunat()
{
    if($('#cli_num_doc').val() == null || $('#cli_num_doc').val() == '')
    {
        alerta_global('warning', 'Ingrese un Numero de Documento')
        return;
    }
    if($('#cli_tipo').val() == 2 && $('#cli_num_doc').val().length != 8)
    {
        alerta_global('warning', 'El DNI debe contener 8 digitos')
        return;
    }
    if($('#cli_tipo').val() == 4 && $('#cli_num_doc').val().length != 11)
    {
        alerta_global('warning', 'El RUC debe contener 11 digitos')
        return;
    }
    $.ajax({
        url: urlweb + '?c=Sunat&a=busqueda_sunat_datos_documento',
        data: { "num_documento": $("#cli_num_doc").val(), "tipo_documento": $("#cli_tipo").val() },
        type: "POST",
        dataType: "JSON",
        async: true,
        beforeSend: function()
        {
            $('#overlay_busqueda_sunat').show();
            $("#btn_sunat").attr("disabled",true);
            $("#btn_guardar").prop("disabled",true);
            $("#btn_cancelar").prop("disabled",true);
            $("#spinner").show();
        }, 
    }).done(function(data, textStatus, jqXHR)
    {
        if(data.success == true)
        {
            $('#cli_nombre').val(data.info.nombre_completo);
            $('#cli_direccion').val(data.info.direccion);
            $('#cli_nombre').focus();
            alerta_global('success', data.mensaje);
        }
        else
        {
            alerta_global('error', data.mensaje);
        }
    }).always(function()
    {
        $("#spinner").hide();
        $("#btn_sunat").attr("disabled",false);
        $("#btn_guardar").prop("disabled",false);
        $("#btn_cancelar").prop("disabled",false);
        $('#overlay_busqueda_sunat').hide();
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        if (buscar_cadena(jqXHR.responseText, 'Maximum execution time') == true)
        alerta_global("warning",'El Tiempo de Ejecucion Termino, Compruebe que tenga una Buena conexion a Internet');
        else
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
    $('#cli_id').val(null);
    $('#cli_nombre').val(null);
    $('#cli_tipo').val(null).trigger('change');
    $('#cli_num_doc').val(null);
    $('#cli_direccion').val(null);
    $('#cli_telefono').val(null);
    $('#cli_correo').val(null);
    document.getElementById('titulo').innerHTML='Registrar Cliente';
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
        "autoWidth": true,
        "select": true,
        "select": { info: false },
        "fixedColumns": 
        {
            left: 1,
            right: 1
        },
        "ajax":
        {
            url: urlweb + '?c=Cliente&a=listar', 
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
    });
}
//funcion para desaactivar
function desactivar(cli_estado, cli_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se desactivara el cliente</span> <br>
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
                    url : urlweb + '?c=Cliente&a=activar_desactivar',
                    type : 'POST',
                    data : {cli_id : cli_id, cli_estado : cli_estado},
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
//funcion para activar usuario
function activar(cli_estado, cli_id)
{
    mensaje_confirmacion.fire(
        { 
            icon : 'info',
            title: 'Necesitamos de tu Confirmación',
            html: `<span>Se activara el cliente</span> <br>
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
                    url : urlweb + '?c=Cliente&a=activar_desactivar',
                    type : 'POST',
                    data : {cli_id : cli_id, cli_estado : cli_estado},
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
//funcion para obtener el dato a editar
function editar(cli_id) 
{
    $.ajax({
        url: urlweb + '?c=Cliente&a=obtener',
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
        document.getElementById('titulo').innerHTML='Editar Cliente';
        $('#cli_id').val(data.cli_id);
        $('#cli_nombre').val(data.cli_nombre);
        $('#cli_tipo').val(data.tip_ide_id).trigger('change');
        $('#cli_num_doc').val(data.cli_num_doc);
        $('#cli_direccion').val(data.cli_direccion);
        $('#cli_telefono').val(data.cli_telefono);
        $('#cli_correo').val(data.cli_correo);
        $('#myModal').modal('show');
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
                        url : urlweb + "?c=Cliente&a=guardar_editar",
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