<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <?= $nombre_opcion?>
                        <button style="visibility: hidden;" type="button" class="btn btn-outline-primary btn-flat btn-sm"><i class="fa fa-plus-circle"></i> <ins>A</ins>gregar</button>
                    </h1>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><i class="nav-icon <?= $ico_modulo?>"></i><a href="#"> <?= $modulo?></a></li>
                        <li class="breadcrumb-item active text-primary"><?= $nombre_opcion?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid --> 
    </div><!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
            <div id="tui-image-editor"></div>
                <div class="col-12">
                    <div class="card pb-0 mb-3">
                        <div class="user-profile-header-banner">
                            <img src="../styles/img/profile-banner.png" alt="Banner image" class="rounded-top">
                        </div>
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-3">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                <img data-fancybox="gallery" src="../styles/img/imagen-no-disponible.jpg" id="img_logo" alt="user image" class="d-block h-auto ml-0 ml-sm-3 rounded user-profile-img">
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-5">
                                <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4 id="txt_info_nombre" class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2 text-bold">
                                        </h4>
                                        <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                            <li class="list-inline-item fw-medium" id="txt_info_ruc">saas</li>
                                        </ul>
                                    </div>
                                    <button class="btn btn-primary text-nowrap btn-flat" id="txt_estado_activo" type="button" data-toggle="modal" data-target="#myModal"><i class="fa-solid fa-upload"></i> Subir Logo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <ul class="nav nav-pills ml-auto pb-0 mb-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="#custom-tabs-general" data-toggle="pill" role="tab">Datos Pesonales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#custom-tabs-usuario" data-toggle="pill" role="tab">Editar Usuario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#custom-tabs-entorno" data-toggle="pill" role="tab">Cambiar Contraseña </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-general" role="tabpanel">
                    <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xl-3">
                                <label>Tipo Documento</label><label class="text-red">(*)</label>
                                <select name="cli_tipo" id="cli_tipo" class="form-control rounded-0 select2" required="seleccione tipo de documento">
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xl-3">
                                <label>Num. Doc</label><label class="text-red">(*)</label>
                                <input type="text" class="form-control rounded-0 validacion_entero" maxlength="11" placeholder="Ingrese el Numero de Documento" id="cli_num_doc" name="cli_num_doc" required> 
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xl-6"> 
                                <label>Nombre/Razon Social</label><label class="text-red">(*)</label>
                                <input type="hidden" name="cli_id" id="cli_id" value="<?= $_SESSION['cli_id'] ?>">
                                <input type="text" class="form-control rounded-0 validacion_mayuscula" name="cli_nombre" id="cli_nombre" maxlength="250" placeholder="Nombre del Cliente"required>
                            </div>
                            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xl-8">
                                <label>Correo</label>
                                <input type="email" class="form-control rounded-0" id="cli_correo" name="cli_correo" maxlength="150" placeholder="correo electronico" >
                            </div>
                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xl-4">
                                <label>Telefono</label>
                                <input type="text" class="form-control rounded-0 validacion_entero" id="cli_telefono" name="cli_telefono" maxlength="12" placeholder="Telefono" >
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                <label>Direccion</label>
                                <input type="text" class="form-control rounded-0 validacion_mayuscula" name="cli_direccion" id="cli_direccion" maxlength="250" placeholder="Direccion">
                            </div>  
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <button class="btn btn-primary btn-flat float-right" type="submit" ><i class="fa-sharp fa-solid fa-floppy-disk"></i>   Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="custom-tabs-usuario" role="tabpanel">
                    <form id="formulario_usuario" name="formulario_usuario" method="POST" accept-charset="utf-8">
                        <div class="row">
                            <input type="hidden" id="usu_id" name="usu_id" value="<?= $_SESSION['usu_id']?>">
                            <input type="hidden" id="usu_cli_id" name="cli_id"  value="<?= $_SESSION['cli_id'] ?>">
                            <input type="hidden" id="usu_imagen2" name="usu_imagen">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Nombre de Usuario</label><label class="text-red">(*)</label>
                                <input type="text" class="form-control rounded-0" placeholder="Nombre de Usuario" id="usu_nombre" name="usu_nombre"> 
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Rol</label><label class="text-red">(*)</label>
                                <select  class="form-control select2" id="usu_rol_id" name="usu_rol_id" style="width: 100%;" readonly></select>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <button class="btn btn-primary btn-flat float-right" type="submit" ><i class="fa-sharp fa-solid fa-floppy-disk"></i> Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="custom-tabs-entorno" role="tabpanel">
                    <form id="formularioContrasena" name="formularioContrasena" method="POST" accept-charset="utf-8">
                        <div class="row">
                            <input type="hidden" id="cont_usu_id" name="cont_usu_id" value="<?= $_SESSION['usu_id']?>">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Contraseña</label><label class="text-red">(*)</label>
                                <div class="input-group">
                                    <input type="password" class="form-control rounded-0" name="cam_usu_contrasena" id="cam_usu_contrasena" placeholder="Contraseña">
                                    <span class="input-group-append">
                                        <button id="btn_ver_cam" type="button" class="btn btn-primary btn-flat" title="Mostrar Contraseña"><i class="fas fa-eye"></i></button>
                                        <button id="btn_ocultar_cam" type="button" class="btn btn-primary btn-flat" title="Ocultar Contraseña"><i class="fas fa-eye-slash"></i></button>
                                    </span>  
                                </div>
                            </div>
                            <div class="form-group mb-0 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Repetir Contraseña</label><label class="text-red">(*)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control rounded-0" name="cam_usu_contrasena_repetir" id="cam_usu_contrasena_repetir" placeholder="Repetir Contraseña">
                                    <span class="input-group-append">
                                        <button id="btn_ver_rep_cam" type="button" class="btn btn-primary btn-flat" title="Mostrar Contraseña"><i class="fas fa-eye"></i></button>
                                        <button id="btn_ocultar_rep_cam" type="button" class="btn btn-primary btn-flat" title="Ocultar Contraseña"><i class="fas fa-eye-slash"></i></button>
                                    </span>  
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 mt-3">
                                <button class="btn btn-primary btn-flat float-right" type="submit" id="btn_guardar_contrasena" ><i class="fa-sharp fa-solid fa-floppy-disk"></i>   Guardar</button>
                            </div>
                        </div>      
                    </form>
                </div>
            </div>
        </div><!-- cierre fluid -->
    </section> 
</div> <!-- /.content-Wrapper -->
<!-- empieza modal -->
<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formulario_imagen" name="formulario_imagen" method="POST" accept-charset="utf-8">
                <div class="modal-body p-2">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 m-0">
                        <input type="hidden" id="temp_img1" name="temp_img1">
                        <input type="file" class="filepond" name="usu_imagen" id="usu_imagen">
                    </div>
                </div>
                <div class="modal-footer pb-1 pt-1">
                    <button class="btn btn-outline-primary btn-sm btn-flat" type="submit" id="btn_guardar_imagen"><i class="fas fa-check-circle"></i> <ins>G</ins>uardar Imagen</button>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-flat" data-dismiss="modal"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                </div>
            </form>
        </div>
    <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog -->
</div><!-- cierre modal -->
<!-- FIN DE CONTENIDO -->
<script src="<?= _SERVER_ ;?>app/views/modulo_acceso/perfil/perfil.js" type="text/javascript" charset="utf-8" async defer></script>