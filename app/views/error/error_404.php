<?php
    if(!empty($_SESSION['rol_id']))
    {
        if($_SESSION['rol_id'] == 5)
        {
            header('Location: index.php?c=Comanda&a=mostrar');   
        }
    }
?>
    <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Icono -->
            <link rel="apple-touch-icon" href="<?= _SERVER_ ?>styles/img/recursos_sistema/faviconEmpresa.ico">
            <link rel="shortcut icon" href="<?= _SERVER_ ?>styles/img/recursos_sistema/faviconEmpresa.ico">
            
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="<?= _SERVER_ ?>styles/css/error_404.css">
            <title>¡UPS! Ya lo malograste</title>
            <!-- <title>IC-CLOUD - Desarrollando sistemas Informaticos</title> -->
        </head>
        <body>
            <div class="mars"></div>
            <img src="<?= _SERVER_ ?>styles/img/error_404/404.svg" class="logo-404" />
            <img src="<?= _SERVER_ ?>styles/img/error_404/meteor.svg" class="meteor" />
            <p class="title">¿Perdido en el <span>ESPACIO </span>?</p>
            <p class="subtitle">
                O estás escribiendo mal la URL <br /> o solicitando una página que ya no está aquí.
            </p>
            <div align="center">
                <a class="btn-back" href="#" onclick="retroceder()">Volver a la página anterior</a>
            </div>
            <img src="<?= _SERVER_ ?>styles/img/error_404/astronaut.svg" class="astronaut" />
            <img src="<?= _SERVER_ ?>styles/img/error_404/spaceship.svg" class="spaceship" />

            <script src='<?= _SERVER_ ?>styles/img/error_404/particles.min.js'></script>
        </body>
    </html>
    <script>
        function retroceder()
        {
            window.history.back();
        }
    </script>