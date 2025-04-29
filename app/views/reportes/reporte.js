let rango_fecha_inicio = '';
let rango_fecha_fin = '';
window.onload = function()
{
    $.ajax({
        url : urlweb + '?c=ReporteVenta&a=listar_clientes',
        type : 'POST',
        async: false
    }).done(function(data)
    {
        $('#filtro_cliente').html(data);
    }).always(function()
    {
    }).fail(function(jqXHR, textStatus, errorThrown)
    {
        alerta_global("error",mensaje_error_ajax);
    });
    
    $('#filtro_fecha').datepicker({language: 'es', container:'#div_filtro_fecha', todayBtn: 'linked', clearBtn: true, autoclose: true, endDate : 'today'});
    $('#filtro_fecha_rango').daterangepicker(
        {
            startDate: moment().startOf('month'),
            endDate  :  moment().endOf('month'),
            opens: 'left',
            dateLimit: { "days": 31 },
            maxDate: moment(),
            ranges   :
            {
                // 'Hoy'       : [moment(), moment()],
                // 'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Ultimos 7 dias' : [moment().subtract(6, 'days'), moment()],
                'Ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
                'El Mes Pasado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'El Mes Siguiente'  : [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')]
            },
            "locale":
            {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Aplicar",
                "cancelLabel": "Cancelar",
                'startLabel': 'Fecha Inicio:',
                'endLabel': 'Fecha Fin:',
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Rango Personalizado",
                "daysOfWeek": [ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
                "monthNames": [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agusto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
                "firstDay": 1
            }
        },
        function (start, end)
        {
            rango_fecha_inicio = start.format('YYYY-MM-DD');
            rango_fecha_fin = end.format('YYYY-MM-DD');
        }
    );
    $('#filtro_fecha').on('changeDate', function(event) 
    {
        if(event.date == undefined)
        {
            rango_fecha_inicio = '';
            rango_fecha_fin = '';
        }
        else
        {
            rango_fecha_inicio = moment(event.date).format('YYYY-MM-DD');
            rango_fecha_fin = moment(event.date).format('YYYY-MM-DD');
        }
    });
    flatpickr_mes.config.onValueUpdate.push(function(evento, date) 
    {
        rango_fecha_inicio =moment(date).startOf('month').format('YYYY-MM-DD');
        rango_fecha_fin = moment(date).endOf('month').format('YYYY-MM-DD');
    } );
    $('.filtro_tiempo').click(function()
    {
        seleccionar_filtro_tipo_tiempo($(this).attr('value'));
    });
    $('#filtro_tiempo_defaulf a').trigger('click');
    flatpickr_mes.setDate(moment().format("YYYY-MM"), true);
    listar_datatable();
    $('.buscador').click(mostrar_reporte);
    validar_formulario();
    $('.exportacion').click(function()
    {
        exportar_reporte($(this).attr('value'))
    });
    $('#btn_limpiar').click(limpiar_filtros);
}
function seleccionar_filtro_tipo_tiempo(valor)
{
    $('#filtro_tiempo').val(valor);
    rango_fecha_inicio = '';
    rango_fecha_fin = '';
    $('#filtro_fecha').val(null);
    $('#filtro_fecha_rango').val(null);
    flatpickr_mes.clear();
    if(valor == '' || valor == 0)
    {
        $('#filtro_fecha_rango').hide();
        $('#filtro_fecha').hide();
        $('.flatpickr_mes ').hide();
    }
    else if(valor == 1)
    {
        $('#filtro_fecha_rango').hide();
        $('.flatpickr_mes ').hide();
        $('#filtro_fecha').show();
    }
    else if(valor == 2)
    {
        $('#filtro_fecha').hide();
        $('.flatpickr_mes ').hide();
        $('#filtro_fecha_rango').show();
    }
    else if(valor == 3)
    {
        $('#filtro_fecha_rango').hide();
        $('#filtro_fecha').hide();
        $('.flatpickr_mes ').show();
    }
}
function mostrar_reporte()
{
    if(validar_formulario().form())
    {
        alerta_showLoading('Espere un momento', 'Buscando Registros...');
        setTimeout(() => {
            if ($.fn.DataTable.isDataTable('#tbllistado')) 
            {
                tabla.draw();
            }
            listar_datatable();
        }, 10);
    }
}
function validar_formulario()
{
    var validator = $( "#filtros_section" ).validate({
        rules: 
        {
            'filtro_fecha': 
            {
                required: true,
            },       
            'filtro_fecha_rango': 
            {
                required: true,
            },       
        },
        messages: 
        {
            'filtro_fecha': 
            {
                required: 'Por favor, seleccione una fecha',
            },       
            'filtro_fecha_rango': 
            {
                required: 'Por favor, seleccione un rango de fechas',
            },     
        },
        errorElement: 'span',
        errorPlacement: function (error, element) 
        {
            error.addClass('invalid-feedback');
            element.closest('div').append(error);
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
function limpiar_filtros()
{
    $('#filtro_turnos').val(null).trigger('change');
    $('#filtro_trabajador').val(null).trigger('change');
    $('#filtro_tiempo').val(null);
    rango_fecha_inicio = '';
    rango_fecha_fin = '';
    $('#filtro_fecha').val(null);
    $('#filtro_fecha_rango').val(null);
    flatpickr_mes.clear();
}
function listar_datatable()
{
    tabla = $('#tbllistado').dataTable({
        // "dom": '<"row" <"row col-sm-12 col-md-5 p-0 m-0" <"col-sm-12 col-md-3" l>  <"col-sm-12 col-md-9"B>>  <"col-sm-12 col-md-7"f>> rt <"row" <"col-sm-12 col-md-5"i> <"col-sm-12 col-md-7"p>>',
        "lengthMenu": [5, 10, 25, 50, 75, 100, 200],//mostramos el menú de registros a revisar
        "processing": true,
        "serverSide": true,
        "scrollY": tamano_datatable_normal,
        "scrollX": tamano_datatable_normal,
        "scrollCollapse": true,
        "responsive": true, 
        "autoWidth": false, 
        "select": true,
        "select": { info: false },
        "fixedColumns": 
        {
            left: false,
            right: false
        },  // "ordering": false,
        "sAjaxSource" : urlweb + '?c=ReporteVenta&a=reporte_general', 
        "fnServerParams": function ( aoData ) //no cambiar el nombre de las variables por que estan programadas con esas // con esto enviamos los parametros para el filtro de busqueda de rango de fechas 
        {
            aoData.push( 
                { "name": "filtro_fecha_inicio", "value": ""+rango_fecha_inicio+"" }, 
                { "name": "filtro_fecha_fin", "value": ""+rango_fecha_fin+"" }, 
                { "name": "filtro_cliente", "value": ""+ $('#filtro_cliente').val() +"" }, 
            ); 
        },
        "columnDefs":[
            {
                "data":null
            },
            {
                "targets":[0,1,3,4,5], //eliminamos el orden en estas columnas
                "orderable":false,
            },
        ],
        "language": 
        {
            "url": urlweb + "styles/plugins/datatables/idioma_es.json",
        },   
        "bDestroy": true,
        "iDisplayLength": 25,//Paginación
        "order": [[2, "desc"]],//Ordenar (columna,orden)
    }).DataTable();    
    tabla.on('draw', function () 
    {
        Swal.close();
        setTimeout(() => { tippy('.tooltip_tippy', {content: '', arrow: true, allowHTML: true}); }, 10);
    } );
}