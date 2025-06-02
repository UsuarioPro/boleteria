window.onload = function()
{
    tema = (detectCookie('dark_mode') == true)? 'dark-mode' : '';
    $('body').attr('class','hold-transition sidebar-mini sidebar-collapse layout-fixed layout-footer-fixed text-sm pace-primary ' + tema);//esconder navbar   
    listar_datatable();
}
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
            url: urlweb + '?c=Solicitudes&a=listar', 
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
                    url : urlweb + '?c=Solicitudes&a=activar_desactivar',
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
                    url : urlweb + '?c=Solicitudes&a=activar_desactivar',
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