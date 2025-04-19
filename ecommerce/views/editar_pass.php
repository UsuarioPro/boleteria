    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Cambiar Contraseña</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="#">Tienda</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Cambiar Contraseña</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-20">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">
                        <h2 class="account-h2 u-s-m-b-0">Cambiar Contraseña</h2>
                        <h6 class="account-h6 u-s-m-b-20">Cambia tu contraseña para mejorar la seguridad de tu cuenta.</h6>
                        <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                            <input type="hidden" id="cont_usu_id" name="cont_usu_id" value="<?= $editar_usuario->usu_id ?>">
                            <div class="u-s-m-b-10">
                                <label for="cam_usu_contrasena">Contraseña
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="cam_usu_contrasena" name="cam_usu_contrasena" class="text-field" placeholder="Ingrese la Contraseña" required>
                            </div>
                            <div class="u-s-m-b-10">
                                <label for="tra_direccion">Repertir Contraseña
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="cam_usu_contrasena_repetir" name="cam_usu_contrasena_repetir" class="text-field" placeholder="Repertir Contraseña" required>
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100" type="submit">Actualizar Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/views/editar_pass.js" type="text/javascript" charset="utf-8" async defer></script>