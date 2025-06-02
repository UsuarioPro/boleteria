let urlweb = "http://localhost:8081/boleteria/";

let tamano_datatable_normal = 'calc(100vh - 320px)';
let tamano_datatable_ssm = 'calc(100vh - 348px)';
let tamano_datatable_reporte = 'calc(100vh - 337px)';
let tamano_datatable_reporte_sm = 'calc(100vh - 296px)';

// Carga el formato de fecha que usas
$.fn.dataTable.moment('DD/MM/YYYY hh:mm:ss A');

$('#overlay_general').hide();
$(".content-wrapper").click(function()
{
    if ($("body").hasClass("control-sidebar-slide-open"))
    {
        $("body").removeClass("control-sidebar-slide-open");
        $('#filtros').css('display', 'none');
    }
});
function cerrar_filtro()
{
    if ($("body").hasClass("control-sidebar-slide-open"))
    {
        $("body").removeClass("control-sidebar-slide-open");
        $('#filtros').css('display', 'none');
    }
}

tippy('.tooltip_tippy', {content: '', allowHTML: true});
Fancybox.bind('[data-fancybox="gallery"]',
{
    infinite: false,
    Image:
    {
        Panzoom:
        {
            zoomFriction: 0.2,
            maxScale: function ()
            {
                return 5;
            },
        },
    },
    keyboard: {
        Escape: "close",
        Delete: "close",
        Backspace: "close"
    },
    afterShow: (instance, slide) => {
        console.log("aa");
        // Ocultar el spinner cuando la imagen esté lista
        const imgElement = slide.$image[0];
        if (imgElement.complete) {
            alert('Error al cargar la imagen.');
            // loadingSpinner.style.display = 'none';
        } else {
            imgElement.onload = () => {
                alert('Error al cargar la imagen.');

                // loadingSpinner.style.display = 'none';
            };
            imgElement.onerror = () => {
                // loadingSpinner.style.display = 'none';
                alert('Error al cargar la imagen.');
            };
        }
    }
});

// let datos_select_multiple = Object();
function crear_select_multiple(input)
{
    data_select = $('#'+input).filterMultiSelect(
    {
        selectAllText:"SELECCIONAR TODO", 
        placeholderText:"Seleccione una o varias Opciones", 
        filterText:"Buscar ...", 
        caseSensitive:false
    });
    return data_select;
}

const flatpickr_mes = flatpickr(".flatpickr_mes", 
{
    locale : 'es',
    altInput : true,
    altFormat : 'F Y',
    allowInput : true,
    disableMobile : true,
    plugins : [ new monthSelectPlugin({dateFormat: 'Y-m', shorthand: true,}) ]
});
const mes_anio = flatpickr(".mes_flatpickr",
{
    locale : 'es',
    altInput : true,
    altFormat : 'F Y',
    allowInput : true,
    wrap: true,
    disableMobile : true,
    plugins : [ new monthSelectPlugin({dateFormat: 'Y-m', shorthand: true,}) ]
});
const generarNumeroAleatorio = (num) => //Para generar numeros aleatorios
{
    const characters ='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let result1= '';
    const charactersLength = characters.length;
    for ( let i = 0; i < num; i++ )
    {
        result1 += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result1;
}
$(".is_activado").on('click', function()
{
    $(".nav-link").removeClass('active');
    $(this).addClass('active');
})
window.addEventListener('resize', start);
function start()
{
    redimencionar_datatable();
}
function buscar_cadena(oracion, palabra)
{
    let cadena = oracion;
    let termino = palabra; // esta es la palabra a buscar
    let posicion = cadena.toLowerCase().indexOf(termino.toLowerCase()); // para buscar la palabra hacemos
    if (posicion !== -1)
    return true;
    else
    return false;
}
function cortar_cadena(cadena, indice, split = '-')
{
    var nombresincortar = cadena;
    var nombrecortado = nombresincortar.split(split);
    var primernombre = nombrecortado[indice];
    return primernombre;
}
function estamos_trabajando()
{
    alerta_global('warning', 'Estamos Trabajando, Proximamente se Habilitara esta funcion');
}
function obtener_altura_elemento(element_id)
{
    var element = document.getElementById(element_id);
    return element.clientHeight;
}
function redimencionar_datatable()
{
    setTimeout(() =>
    {
        // $($.fn.dataTable.tables(true)).DataTable().draw();
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    }, 300);
}
$(document).on('shown.bs.dropdown', '.table-responsive', function (e)
{
    // The .dropdown container
    var $container = $(e.target);

    // Find the actual .dropdown-menu
    var $dropdown = $container.find('.dropdown-menu');
    if ($dropdown.length) {
        // Save a reference to it, so we can find it after we've attached it to the body
        $container.data('dropdown-menu', $dropdown);
    } else {
        $dropdown = $container.data('dropdown-menu');
    }

    $dropdown.css('top', ($container.offset().top + $container.outerHeight()) + 'px');
    $dropdown.css('left', $container.offset().left + 'px');
    $dropdown.css('position', 'absolute');
    $dropdown.css('display', 'block');
    $dropdown.css('z-index', '9999');
    $dropdown.appendTo('body');
});
$(document).on('hide.bs.dropdown', '.table-responsive', function (e)
{
    // Hide the dropdown menu bound to this button
    $(e.target).data('dropdown-menu').css('display', 'none');
});
$(document).on('shown.bs.dropdown', '.ajustar_dropdown', function (e)
{
    // The .dropdown container
    var $container = $(e.target);

    // Find the actual .dropdown-menu
    var $dropdown = $container.find('.dropdown-menu');
    if ($dropdown.length) {
        // Save a reference to it, so we can find it after we've attached it to the body
        $container.data('dropdown-menu', $dropdown);
    } else {
        $dropdown = $container.data('dropdown-menu');
    }

    $dropdown.css('top', ($container.offset().top + $container.outerHeight()) + 'px');
    $dropdown.css('left', $container.offset().left + 'px');
    $dropdown.css('position', 'absolute');
    $dropdown.css('display', 'block');
    $dropdown.css('z-index', '9999');
    $dropdown.appendTo('.ajustar_dropdown');
});
$(document).on('hide.bs.dropdown', '.ajustar_dropdown', function (e)
{
    // Hide the dropdown menu bound to this button
    $(e.target).data('dropdown-menu').css('display', 'none');
});
$(".mis_notificaciones").on('click', function() //esta en el navbar para la animacion del drowp de las notificaciones
{
    if($(this).attr('aria-expanded') == 'true')
    {
        $('.dropdown_notificaciones').removeClass('animate__animated animate__zoomIn animate__faster')
        $('.dropdown_notificaciones').addClass('animate__animated animate__backOutDown')
    }
    else
    {
        $('.dropdown_notificaciones').addClass('animate__animated animate__zoomIn animate__faster')
    }
})
function calcular_diferencias_horas(hora_inicio, hora_final)
{
    // Calcula los minutos de cada hora
    var minutos_inicio = hora_inicio.split(':').reduce((p, c) => parseInt(p) * 60 + parseInt(c));
    var minutos_final = hora_final.split(':').reduce((p, c) => parseInt(p) * 60 + parseInt(c));

    var diferencia = '';
    var horas = '';
    // Si la hora final es anterior a la hora inicial sale
    if (minutos_final < minutos_inicio)
    {
        diferencia = minutos_inicio - minutos_final;
        horas = Math.floor(diferencia / 60);

        return (22 - (horas / 60));
    }

    // Diferencia de minutos
    diferencia = minutos_final - minutos_inicio;

    // Cálculo de horas y minutos de la diferencia
    horas = Math.floor(diferencia / 60);
    var minutos = diferencia % 60;

    return (horas / 60);
}

var miEvento = new CustomEvent('CerrarSessionElectron'); // 1. Definir el evento personalizado
window.dispatchEvent(miEvento);// 2. Despachar (disparar) el evento
window.addEventListener('CerrarSessionElectron', function(event) // 3. Agregar un listener para manejar el evento
{
    window.location = $('#btn_salir_app').attr('href')+'_electron';
});

function toggleTheme()
{
    if($('#toogle_tema').attr('data-value') == 'light')
    {
        $('#toogle_tema').attr('data-value', 'dark');
        $('body').addClass('dark-mode');
        $('nav.main-header').removeClass('navbar-white navbar-light');
        $('nav.main-header').addClass('navbar-dark');

        $('.chart').removeClass('highcharts-light');
        $('.chart').addClass('highcharts-dark');
        Highcharts.charts.forEach(function(chart) 
        {
            if (chart) // Asegúrate de que el gráfico no sea null
            { 
                chart.update(darkUnicaTheme, true);
            }
        });
        setCookie('dark_mode', true, 365);
    }
    else
    {
        $('#toogle_tema').attr('data-value', 'light');
        $('body').removeClass('dark-mode');
        $('nav.main-header').removeClass('navbar-dark');
        $('nav.main-header').addClass('navbar-white navbar-light');

        $('.chart').removeClass('highcharts-dark');
        $('.chart').addClass('highcharts-light');
    
        // Highcharts.setOptions(lightUnicaTheme);
        Highcharts.charts.forEach(function(chart) 
        {
            if (chart) // Asegúrate de que el gráfico no sea null
            { 
                chart.update(lightUnicaTheme, true);
            }
        });
        removeCookie('dark_mode');
    }
}