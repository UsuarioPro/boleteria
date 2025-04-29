<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Iniciar Sesion | TuBoleto</title>
        <link rel="apple-touch-icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        <link rel="shortcut icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= _SERVER_?>styles/css/login.css">
    </head>
    <body>
        <input type="hidden" id="urlweb" name="urlweb" value="<?= _SERVER_?>">
        <div class="form-wrapper">
            <main class="form-side">
                <a href="#" title="Logo">
                    <img src="<?= _SERVER_?>styles/img/iconos_sistema/logo.png" alt="Laplace Logo" class="logo" style="height: 30px;" >
                </a>
                <form class="my-form" id="formulario" method="post">
                    <div class="form-welcome-row" style="margin-bottom: 0px;">
                        <h1>¡Bienvenido de nuevo! &#128079;</h1>
                        <h2>¡Inicia sesión con tu cuenta!</h2>
                    </div>
                    <div class="divider">
                        <div class="divider-line"></div>
                    </div>
                    <div class="text-field">
                        <label for="email">Usuario</label>
                        <input type="text" id="logina" name="logina" placeholder="Ingrese el Usuario o el Correo" autocomplete="off">
                    </div>
                    <div class="text-field">
                        <label for="password">Contraseña</label>
                        <input type="password" id="clavea" name="clavea" placeholder="Contraseña">
                    </div>
                    <button class="my-form__button" type="submit" id="btn_login">
                        Iniciar Sesion
                    </button>
                    <div class="my-form__actions">
                        <div class="my-form__row">
                            <span>¿No tienes una cuenta?</span>
                            <a href="<?= _SERVER_ ?>Admin/registrate" title="Reset Password">
                                Regístrate ahora
                            </a>
                        </div>
                    </div>
                </form>
            </main>
            <aside class="info-side">
                <div class="blockquote-wrapper">
                    <img src="<?= _SERVER_?>styles/img/login/returns.png" alt="Returns" class="returns">
                    <div class="" style="text-align: center; font-size: 50px;">
                        <span class="author-name" style="color:red; font-weight: bold;">TU<span class="author-name">BOLETO</span></span>
                    </div>
                </div>
            </aside>
        </div>
        <script src="<?= _SERVER_?>styles/plugins/jquery/jquery.min.js"></script>
        <!-- sweetalert2 -->
        <script src="<?= _SERVER_?>styles/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="<?= _SERVER_?>styles/js/alerta_global.js" type="text/javascript" charset="utf-8" async defer></script>
        <script src="<?= _SERVER_?>app/views/admin/login.js" type="text/javascript" charset="utf-8" async defer></script>
    </body>
</html>