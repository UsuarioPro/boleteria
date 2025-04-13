<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Icono -->
        <link rel="apple-touch-icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        <link rel="shortcut icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= _SERVER_ ?>styles/css/error_database.css">
        <title>Error de acceso a la Base de Datos</title>
    </head>
    <body>
        <div class="container">
            <img src="<?= _SERVER_ ?>styles/img/error_bd/error.png" />
            <h1>
                <span>Error</span> <br />
                Conexion a la Base de Datos
            </h1>
            <p>Se ha producido un error intentando acceder a la base de datos. <br>Ya hemos dado el aviso, Intenta acceder pasado algunos minutos</p>
            <p class="info">
                Copyright &copy; <?php echo date("Y");?> <a href="#">Fact-Cloud.</a> 
            </p>
        </div>
    </body>
</html>