<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <?= $nombre_opcion?>
                        <button type="button" class="btn btn-outline-primary btn-sm btn-flat" title="Registrar Nuevo Usuario" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Agregar</button>
                    </h1>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 d-none d-sm-block mt-1 pt-1">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">                      
                    <div class="card card-primary card-outline pb-0 mb-0">          
                        <!-- centro -->
                        <div class="card-body table-responsive" id="listado_registros">
                            <table id="tbllistado" class="table table-head-fixed table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>                    
                                <th class="all">#</th>
                                <th class="all">Nombre</th>
                                <th class="all">Rol</th>
                                <th class="all" title="">Usuario</th>
                                <th class="all" class="text-center">Imagen</th>
                                <th class="all">Estado</th>
                                <th class="all">Opciones</th>
                                </tr>
                            </thead>
                            </table><!-- cierre tabla -->
                        </div> <!-- cierre div -->
                        <!-- empieza modal -->
                        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title " id="titulo"> Registrar Nuevo Usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarform();">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                      
                                    <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                                        <div class="modal-body p-0 m-0">
                                            <div class="col-md-12 p-0 m-0" id="tabs">
                                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link rounded-0 active" id="custom-tabs1-tab" data-toggle="pill" href="#custom-tabs1" role="tab" aria-controls="custom-tabs1" aria-selected="true">Datos</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link rounded-0" id="custom-tabs2-tab" data-toggle="pill" href="#custom-tabs2" role="tab" aria-controls="custom-tabs2" aria-selected="false">Avatar</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs1" role="tabpanel" aria-labelledby="custom-tabs1-tab">
                                                    <div class="row pt-2 pl-3 pr-3">
                                                        <input type="hidden" id="usu_id" name="usu_id">
                                                        <div class="form-group col-sm-12">
                                                            <label>Organizador</label><label class="text-red">(*)</label>
                                                            <select name="cli_id" id="cli_id" class="form-control rounded-0 select2"></select>
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Nombre de Usuario</label><label class="text-red">(*)</label>
                                                            <input type="text" class="form-control rounded-0" placeholder="Nombre de Usuario" id="usu_nombre" name="usu_nombre"> 
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="div_contrasena">
                                                            <label>Contraseña</label><label class="text-red">(*)</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control rounded-0" name="usu_contrasena" id="usu_contrasena" placeholder="Contraseña">
                                                                <span class="input-group-append">
                                                                    <button id="btn_ver" type="button" class="btn btn-primary btn-flat" title="Mostrar Contraseña"><i class="fas fa-eye"></i></button>
                                                                    <button id="btn_ocultar" type="button" class="btn btn-primary btn-flat" title="Ocultar Contraseña"><i class="fas fa-eye-slash"></i></button>
                                                                </span>  
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="div_contrasena_rep">
                                                            <label>Repetir Contraseña</label><label class="text-red">(*)</label>
                                                            <div class="input-group">
                                                                <input type="password" class="form-control rounded-0" name="usu_contrasena_repetir" id="usu_contrasena_repetir" placeholder="Repetir Contraseña">
                                                                <span class="input-group-append">
                                                                    <button id="btn_ver_rep" type="button" class="btn btn-primary btn-flat" title="Mostrar Contraseña"><i class="fas fa-eye"></i></button>
                                                                    <button id="btn_ocultar_rep" type="button" class="btn btn-primary btn-flat" title="Ocultar Contraseña"><i class="fas fa-eye-slash"></i></button>
                                                                </span>  
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <label>Rol</label><label class="text-red">(*)</label>
                                                            <select class="form-control select2" id="usu_rol_id" name="usu_rol_id" style="width: 100%;"></select>
                                                        </div>
                                                    </div>      
                                                </div>
                                                <div class="tab-pane fade" id="custom-tabs2" role="tabpanel" aria-labelledby="custom-tabs2-tab">
                                                    <div class="row pt-2 pl-3 pr-3 pb-2">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 m-0">
                                                            <input type="hidden" id="temp_img1" name="temp_img1">
                                                            <input type="file" class="filepondPortada" name="usu_imagen" id="usu_imagen">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer pb-1 pt-1">
                                            <b class="text-red">Los Campos con (*) son requeridos</b>
                                            <button class="btn btn-outline-primary btn-sm btn-flat" type="submit" id="btn_guardar"><i class="fas fa-check-circle"></i> <ins>G</ins>uardar</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancelar" data-dismiss="modal"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                                        </div>
                                    </form>
                                </div>
                            <!-- /.modal-content --> 
                            </div>
                            <!-- /.modal-dialog -->
                        </div><!-- cierre modal -->
                        <div class="modal fade" id="myModalContrasena" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header mb-2 pb-2">
                                        <h5 class="modal-title " id="titulo"> Cambiar Contraseña</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarform_contrasena();">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                      
                                    <form id="formularioContrasena" name="formularioContrasena" method="POST" accept-charset="utf-8">
                                    <div class="modal-body pt-0">
                                            <div class="row">
                                                <input type="hidden" id="cont_usu_id" name="cont_usu_id">
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
                                            </div>      
                                        </div>
                                        <div class="modal-footer pt-1 pb-1">
                                            <b class="text-red">Los Campos con (*) son requeridos</b>
                                            <button class="btn btn-outline-primary btn-sm btn-flat" type="submit" id="btn_guardar_contrasena"><i class="fas fa-check-circle"></i> <ins>G</ins>uardar</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancelar_contrasena" data-dismiss="modal"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                                        </div>
                                    </form>
                                </div>
                            <!-- /.modal-content --> 
                            </div>
                            <!-- /.modal-dialog -->
                        </div><!-- cierre modal -->
                    </div><!-- cierre card -->
                </div> <!-- cierre col -->
            </div><!-- cierre row -->
        </div><!-- cierre fluid -->        
    </section>
</div> <!-- /.content-Wrapper -->
<!-- FIN DE CONTENIDO -->  
<script src="<?= _SERVER_;?>app/views/modulo_acceso/usuario/usuario.js" type="text/javascript" charset="utf-8" async defer></script>