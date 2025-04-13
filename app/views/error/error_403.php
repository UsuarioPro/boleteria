<!DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>IC-CLOUD - Desarrollando sistemas Informaticos</title>
            <!-- Icono -->
            <link rel="apple-touch-icon" href="<?= _SERVER_ ?>styles/img/recursos_sistema/faviconEmpresa.ico">
            <link rel="shortcut icon" href="<?= _SERVER_ ?>styles/img/recursos_sistema/faviconEmpresa.ico">
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="<?= _SERVER_ ?>styles/fonts/montserrat.css">
            <link rel="stylesheet" href="<?= _SERVER_ ?>styles/css/error_403.css">
        </head>
        <body>
            <h1>403</h1>
            <div><p>> <span>CÓDIGO DE ERROR</span>: "<i>HTTP 403 Forbidden</i>"</p>
            <p>> <span>DESCRIPCIÓN DEL ERROR</span>: "<i>Acceso denegado. No tiene permiso para acceder a esta página en este servidor</i>"</p>
            <p style="text-align: justify;">> <span>ERROR POSIBLEMENTE CAUSADO POR</span>: [<b>acceso de ejecución prohibido, acceso de lectura prohibido, acceso de escritura prohibido, 
                ssl requerido, ssl 128 requerido, dirección IP rechazada, se requiere certificado de cliente, acceso denegado al sitio, demasiados usuarios, configuración no válida, 
                cambio de contraseña, acceso denegado al asignador, certificado de cliente revocado, listado de directorio denegado, se excedieron las licencias de acceso del cliente, 
                el certificado del cliente no es de confianza o no es válido, el certificado del cliente ha caducado o aún no es válido, el inicio de sesión del pasaporte falló, 
                se denegó el acceso a la fuente, se denegó la profundidad infinita, demasiadas solicitudes de la misma ip de cliente</b>...]</p>
            <p>> <span>ALGUNAS PÁGINAS DE ESTE SERVIDOR A LAS QUE USTED TIENE PERMISO PARA ACCEDER</span>: [<a href="/">Home Page</a>, <a href="/">About Us</a>, <a href="/">Contact Us</a>, <a href="/">Blog</a>...]</p><p>
            > <span> QUE TENGA UN BUEN DÍA SEÑOR :-)</span></p>
            </div>
        </body>
    </html>
    <script>
        var str = document.getElementsByTagName('div')[0].innerHTML.toString();
        var i = 0;
        document.getElementsByTagName('div')[0].innerHTML = "";

        setTimeout(function() 
        {
            var se = setInterval(function() 
            {
                i++;
                document.getElementsByTagName('div')[0].innerHTML = str.slice(0, i) + "|";
                if (i == str.length) 
                {
                    clearInterval(se);
                    document.getElementsByTagName('div')[0].innerHTML = str;
                }
            }, 10);
        },0);

    </script>