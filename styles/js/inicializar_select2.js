//Inicializamos la clase select2 para todo el proyecto
$('.select2').select2({theme: "bootstrap4", placeholder: 'Seleccione una opcion', allowClear: true, width: '100%'});
$('.select3').select2({theme: "bootstrap4", placeholder: 'Seleccione una opcion', width: '100%'});
$('.selectGroup').select2({theme: "bootstrap4", placeholder: 'Seleccione una opcion', allowClear: true, width: '70%'});

$('.select2-sm').select2({placeholder: 'Seleccione una opcion', allowClear: true, width: '100%'});
$('.select2-sm_clear').select2({ placeholder: 'Seleccione una opcion', allowClear: false, width: '100%'});
//Aplicando la validacion del select cada vez que cambie
$('.select2, .select2-sm, .select2Html, .selectGroup, .select3, .select2-sm_clear').on('change', function() {$(this).trigger('blur');});
$('.select2, .select2-sm, .select2Html, .selectGroup, .select3, .select2-sm_clear').on('select2:open', function()
{
    setTimeout(() => { document.querySelector('.select2-dropdown.select2-dropdown--below .select2-search__field').focus(); },10);
});
$('.selectMultiple').select2({theme: "bootstrap4", placeholder: 'Seleccione una opcion', allowClear: true, width: '100%'});
function initializeSelect2HTML(selector, ajaxUrl, condicion, tema) 
{
    $('#'+selector).select2({
        theme: (tema == undefined)? "bootstrap4" : tema,
        placeholder: 'Seleccione una opcion',
        allowClear: true,
        width: 'resolve',
        containerCssClass : selector+"_show-hide",
        minimumInputLength: 0,
        ajax: {
            url: ajaxUrl,
            dataType: 'json',
            delay: 100,
            data: function(params) 
            {
                return {
                    q: params.term,
                    page: params.page || 1, // Página actual
                    condicion: condicion
                };
            },
            processResults: function(data, params) 
            {
                return {
                    results: data.items,
                    pagination: 
                    {
                        more: data.pagination.more // Si hay más resultados
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function(markup)
        {
            return markup;
        },
        templateResult: function(data)
        {
            return data.html;
        },
        templateSelection: function(data)
        {
            // datos_select2HTML = data;
            return data.text;
        },
        
    }).on('select2:open', function() 
    {
        // document.querySelector('.select2-dropdown.select2-dropdown--below .select2-search__field').focus();
    });
}
let ajaxTerminadoSeleccionarOpcion = false;
function seleccionarOpcionSelect2(valorASeleccionar, selector, ajaxUrl) 
{
    var $select = $('#'+selector);
    var currentPage = 1; // Página actual
    var initialOptions = $select.data('select2').options.options; // Obtener la configuración inicial de Select2

    function cargarPagina() 
    {
        ajaxTerminadoSeleccionarOpcion = false;
        $.ajax({
            url: ajaxUrl,
            dataType: 'json',
            data: 
            {
                q: $('#'+selector).prev('.select2-container').find('.select2-search__field').val(), // Obtener el valor del campo de búsqueda de Select2
                page: currentPage,
                limite: 1000
            },
            success: function(data) 
            {
                var options = data.items;
                if (options.length === 0) 
                {
                    ajaxTerminadoSeleccionarOpcion = true;
                    // No se encontraron más resultados
                    // console.log("No se encontraron más resultados.");
                } 
                else 
                {
                    // Concatenar los nuevos resultados con los datos existentes de Select2
                    var newData = $select.select2('data').concat(options);

                    // Agregar los nuevos resultados a Select2 sin sobrescribir la configuración original
                    $select.select2($.extend({}, initialOptions, 
                    {
                        data: newData,
                        multiple: false // Asegurarse de que Select2 esté en modo simple
                    }));

                    // Intentar seleccionar manualmente la opción deseada después de cargar los resultados
                    var optionEncontrada = options.find(function(option) 
                    {
                        return parseInt(option.id) === parseInt(valorASeleccionar);
                    });

                    if(optionEncontrada) 
                    {
                        // Se encontró la opción deseada, la seleccionamos manualmente
                        $select.val(valorASeleccionar).trigger('change'); // Forzar un cambio para actualizar la apariencia del Select2
                        ajaxTerminadoSeleccionarOpcion = true;
                    } 
                    else 
                    {
                        // La opción deseada no se encontró en esta página, continuamos cargando más resultados
                        currentPage++;
                        cargarPagina();
                    }
                }
            },
            error: function(xhr, status, error) 
            {
                alerta_global("error",'Hubo un error al tratar de seleccionar la Opcion, Error: ' + error); 
            }
        });
    }
    // Iniciar el proceso de carga de resultados
    cargarPagina();
}
function seleccionarOpcionSelect2Multiple(valoresASeleccionar, selector, ajaxUrl) 
{
    var $select = $('#' + selector);
    var currentPage = 1; // Página actual
    var initialOptions = $select.data('select2').options.options; // Obtener la configuración inicial de Select2
    var opcionesSeleccionadas = $select.val() || []; // Obtener los valores ya seleccionados

    function cargarPagina() 
    {
        ajaxTerminadoSeleccionarOpcion = false;
        $.ajax({
            url: ajaxUrl,
            dataType: 'json',
            data: 
            {
                q: $('#' + selector).prev('.select2-container').find('.select2-search__field').val(), // Obtener el valor del campo de búsqueda de Select2
                page: currentPage,
                limite: 1000
            },
            success: function(data) 
            {
                var options = data.items;
                if (options.length === 0) 
                {
                    ajaxTerminadoSeleccionarOpcion = true;
                    // No se encontraron más resultados
                    // console.log("No se encontraron más resultados.");
                } 
                else 
                {
                    // Concatenar los nuevos resultados con los datos existentes de Select2
                    var newData = $select.select2('data').concat(options);

                    // Agregar los nuevos resultados a Select2 sin sobrescribir la configuración original
                    $select.select2($.extend({}, initialOptions, 
                    {
                        data: newData,
                        multiple: true // Asegurarse de que Select2 esté en modo simple
                    }));

                    // Iterar sobre los valores que se desean seleccionar
                    valoresASeleccionar.forEach(function(valorASeleccionar) 
                    {
                        // Buscar la opción deseada en los resultados actuales
                        var optionEncontrada = options.find(function(option) 
                        {
                            return parseInt(option.id) === parseInt(valorASeleccionar);
                        });

                        if (optionEncontrada) 
                        {
                            // Agregar la opción encontrada a la lista de seleccionados si no está ya presente
                            if (!opcionesSeleccionadas.includes(valorASeleccionar.toString())) 
                            {
                                opcionesSeleccionadas.push(valorASeleccionar.toString());
                            }
                        }
                    });

                    // Actualizar el Select2 con los valores seleccionados
                    $select.val(opcionesSeleccionadas).trigger('change');

                    // Verificar si se encontraron todas las opciones deseadas
                    if (valoresASeleccionar.every(function(valor) 
                    {
                        return opcionesSeleccionadas.includes(valor.toString());
                    })) 
                    {
                        ajaxTerminadoSeleccionarOpcion = true;
                    } 
                    else 
                    {
                        // Si no se encontraron todas, cargar la siguiente página
                        currentPage++;
                        cargarPagina();
                    }
                }
            },
            error: function(xhr, status, error) 
            {
                alerta_global("error", 'Hubo un error al tratar de seleccionar la Opcion, Error: ' + error); 
            }
        });
    }

    // Iniciar el proceso de carga de resultados
    cargarPagina();
}