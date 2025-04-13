<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Fact-Cloud - Private Server</title>
        <meta name="description" content="Desarrollando sistemas Informaticos">
        <meta name="author" content="Fact-Cloud">
        <meta name="robots" content="Fact-Cloud">
        <!-- Icono -->
        <link rel="apple-touch-icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        <link rel="shortcut icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?= _SERVER_?>styles/fonts/mulish.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= _SERVER_?>styles/css/login.css">
    </head>
    <body>
        <input type="hidden" id="urlweb" name="urlweb" value="<?= _SERVER_?>">
        <div class="background"></div>
        <div class="centering">
            <form class="my-form" id="formulario" method="post">
                <div class="login-welcome-row">
                    <img class="login-welcome" src="<?= _SERVER_?>styles/img/login/cloud-server.png" alt="Astronaut">
                    <h1>SERVIDOR PRIVADO</h1>
                    <span>Inicie sesion para continuar...</span>
                </div>
                <div class="text-field">
                    <label for="email">Nombre de Usuario:</label>
                    <input type="text" id="logina" name="logina" placeholder="Ingrese el nombre de usuario">
                    <img alt="Email Icon" title="Email Icon" src="<?= _SERVER_?>styles/img/login/user.png">
                </div>
                <div class="text-field">
                    <label for="password">Contraseña:</label>
                    <input id="clavea" type="password" name="clavea" placeholder="Ingrese la Contraseña">
                    <img alt="Password Icon" title="Password Icon" src="<?= _SERVER_?>styles/img/login/lock.png">
                </div>
                <input type="submit" class="my-form__button" value="Ingresar" id="btn_login">
                <div class="my-form__actions">
                    <div class="my-form__signup">
                        <a>Fact-Cloud - Desarrollando Sistemas Informaticos</a>
                    </div>
                    <div class="my-form__signup">
                    <!-- <a href="#" title="Create Account">Fact-Cloud</a> -->
                    Copyright &copy; <?= date('Y') ?> - Version <?= version_proyecto ?>
                    </div>
                </div>
            </form>
        </div>
        <!-- jQuery -->
        <script src="<?= _SERVER_?>styles/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?= _SERVER_?>styles/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- sweetalert2 -->
        <script src="<?= _SERVER_?>styles/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="<?= _SERVER_?>styles/js/alerta_global.js" type="text/javascript" charset="utf-8" async defer></script>
        <script src="<?= _SERVER_?>app/views/admin/login.js" type="text/javascript" charset="utf-8" async defer></script>
    </body>
</html>