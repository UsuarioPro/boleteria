    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Editar Perfil</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="#">Tienda</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Editar Perfil</a>
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
                        <h2 class="account-h2 u-s-m-b-0">Mi Perfil</h2>
                        <h6 class="account-h6 u-s-m-b-20">Modifica tu información personal y mantén tu perfil actualizado.</h6>
                        <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                            <div class="u-s-m-b-10">
                                <label for="tra_tipo_doc">Tipo de Documento
                                    <span class="astk">*</span>
                                </label>
                                <input type="hidden" id="usu_id" name="usu_id" value="<?= $editar_usuario->usu_id ?>">
                                <input type="hidden" id="cli_id" name="cli_id" value="<?= $editar_usuario->cli_id ?>">
                                <input type="hidden" id="value_select" value="<?= $editar_usuario->tip_ide_id ?>">
                                <select type="text" id="tra_tipo_doc" name="tra_tipo_doc" class="text-field" placeholder="Tipo de Documento" required>
                                    <option value="" disabled selected>Seleccione el Tipo de Documento</option>
                                    <?php 
                                        foreach($tipos_documento as $m)
                                        {
                                            echo '<option value="'.$m->tip_ide_id.'">'.$m->tip_ide_abrev.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="u-s-m-b-10">
                                <label for="tra_num_doc">Numero de Documento
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="tra_num_doc" name="tra_num_doc" class="text-field" placeholder="Ingrese el Numero de Documento" value="<?= $editar_usuario->cli_num_doc ?>" required>
                            </div>
                            <div class="u-s-m-b-10">
                                <label for="tra_nombre_completo">Nombre Completo
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="tra_nombre_completo" name="tra_nombre_completo" class="text-field" placeholder="Ingrese el Nombre Completo" value="<?= $editar_usuario->cli_nombre ?>" required>
                            </div>
                            <div class="u-s-m-b-10">
                                <label for="tra_direccion">Direccion
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="tra_direccion" name="tra_direccion" class="text-field" placeholder="Ingrese la Direccion" value="<?= $editar_usuario->cli_direccion ?>" required>
                            </div>
                            <div class="u-s-m-b-10">
                                <label for="tra_correo">Correo
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="tra_correo" name="tra_correo" class="text-field" placeholder="Ingrese el Correo Electronico" value="<?= $editar_usuario->cli_correo ?>" required>
                            </div>
                            <div class="u-s-m-b-10">
                                <label for="tra_telefono">Telefono
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="tra_telefono" name="tra_telefono" class="text-field" placeholder="Ingrese el numero de Telefono o Celular" value="<?= $editar_usuario->cli_telefono ?>" required>
                            </div>
                            <div class="u-s-m-b-10">
                                <label for="usu_nombre">Nombre de Usuario
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="usu_nombre" name="usu_nombre" class="text-field" placeholder="Ingrese el Nombre de Usuario" value="<?= $editar_usuario->usu_login ?>" required>
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100" type="submit">Actualizar Informacion</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/views/editar_usuario.js" type="text/javascript" charset="utf-8" async defer></script>
