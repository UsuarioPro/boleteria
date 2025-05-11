<style>
    .select-box {
    background-color: #f1f2f3;
    border: 1px solid #DFE3E6;
    color: #333333;
    font: 13px "Open Sans", sans-serif;
    height: 45px;
    padding: 6px 28px 6px 12px;
    text-align: left;
    transition: all .3s;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.5rem;
    }
</style>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registrate | TuBoleto</title>
        <link rel="apple-touch-icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        <link rel="shortcut icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= _SERVER_?>styles/css/login.css">
    </head>
    <body>
        <input type="hidden" id="urlweb" name="urlweb" value="<?= _SERVER_?>">
        <div class="form-wrapper">
            <aside class="info-side">
                <div class="blockquote-wrapper">
                    <img src="<?= _SERVER_?>styles/img/login/returns.png" alt="Returns" class="returns">
                    <div class="" style="text-align: center; font-size: 50px;">
                        <span class="author-name" style="color:red; font-weight: bold;">TU<span class="author-name">BOLETO</span></span>
                    </div>
                </div>
            </aside>
            <main class="form-side">
                <a href="<?= _SERVER_?>" title="Logo">
                    <img src="<?= _SERVER_?>styles/img/iconos_sistema/logo.png" alt="Laplace Logo" class="logo_right" style="height: 30px;" >
                </a>
                <form class="my-form" id="formulario" name="formulario" method="post">
                    <div class="form-welcome-row" style="margin-bottom: 0px;">
                        <h1>¡Crea una cuenta! &#128079;</h1>
                        <h2>¡Registrate ya!</h2>
                    </div>
                    <div class="divider">
                        <div class="divider-line"></div>
                    </div>
                    <div class="text-field">
                        <label for="email">Usuario</label>
                        <input type="text" id="logina" name="logina" placeholder="Ingrese el Usuario" autocomplete="off">
                    </div>
                    <div class="text-field">
                        <label for="email">Correo</label>
                        <input type="email" id="correo" name="correo" placeholder="Ingrese el Usuario Correo" autocomplete="off">
                    </div>
                    <div class="text-field">
                        <label for="rol_id">Tipo de Acceso</label>
                        <select type="text" id="rol_id" name="rol_id" class="select-box" placeholder="Seleccione el Tipo de Acceso" required="">
                            <option value="" disabled="" selected="">Seleccione el Tipo de Acceso</option>
                            <option value="2">CLIENTE</option>
                            <option value="4">MODO ORGANIZADOR</option>
                        </select>
                    </div>
                    <div class="text-field">
                        <label for="password">Contraseña</label>
                        <input type="password" minlength="6" maxlength="12" id="clavea" name="clavea" placeholder="Contraseña">
                    </div>
                    <div class="text-field">
                        <label for="password">Verificar Contraseña</label>
                        <input type="password" minlength="6"  maxlength="12" id="pass_verificar" name="pass_verificar" placeholder="Contraseña">
                    </div>

                    <button class="my-form__button" type="submit" id="btn_login" style="margin-top: 0px;">
                        Iniciar Sesion
                    </button>
                    <div class="my-form__actions" style="margin-top: -8px;">
                        <p style="font-size: 12px;">Tus datos personales se utilizarán para procesar tu pedido, mejorar tu experiencia en esta web, gestionar el acceso a tu cuenta y otros propósitos descritos en nuestra <a href="#" class="woocommerce-privacy-policy-link" target="_blank">política de privacidad</a>.</p>
                        <div class="my-form__row">
                            <a href="<?= _SERVER_ ?>Admin/login" title="Iniciar Sesion">
                                ¿ Tienes una Cuenta ? -  Iniciar Sesion
                            </a>
                        </div>
                    </div>
                </form>
            </main>
        </div>
        <script src="<?= _SERVER_?>styles/plugins/jquery/jquery.min.js"></script>
        <!-- sweetalert2 -->
        <script src="<?= _SERVER_?>styles/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script src="<?= _SERVER_?>styles/js/alerta_global.js" type="text/javascript" charset="utf-8" async defer></script>
        <script src="<?= _SERVER_?>app/views/admin/registrate.js" type="text/javascript" charset="utf-8" async defer></script>
        <!-- jquery validation -->
        <script src="<?= _SERVER_?>styles/plugins/jquery-validation/jquery.validate.js"></script>
    </body>
</html>