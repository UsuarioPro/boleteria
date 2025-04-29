<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <?= $nombre_opcion?></h1>
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
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
                    <div class="card pb-1 mb-1">
                        <div class="card-header pb-0">
                            <h5 class="text-bold">MODULOS</h5>
                        </div>
                        <div class="card-body p-1 m-1">
                            <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                                <ul class="todo-list" data-widget="todo-list" id="ul_modulos" style="height: calc(100vh - 265px); overflow-y: auto;"></ul>
                                <button hidden type="submit" class="btn btn-primary float-right" id="btn_cambiar_ord_mod"><i class="fas fa-plus"></i> Cambiar Orden</button>
                            </form>
                        </div>
                        <div class="card-footer clearfix pt-1 pb-1 pr-2">
                            <button type="button" class="btn btn-primary float-right btn-flat btn-sm" title="Registrar Nuevo Cargo" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle"></i> Agregar Nuevo Modulo</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
                    <div class="card pb-1 mb-1">
                        <div class="card-header pb-0">
                            <h5 class="text-bold" id="lbl_opciones">OPCIONES</h5>
                        </div>
                        <div class="card-body p-1 m-1">
                            <form id="formulario_opc" name="formulario_opc" method="POST" accept-charset="utf-8">
                                <input type="hidden" id="cam_mod_id" name="cam_mod_id">
                                <input type="hidden" id="cam_mod_nombre" name="cam_mod_nombre">
                                <input type="hidden" id="cam_mod_multiple" name="cam_mod_multiple">
                                <div class="overlay-wrapper">
                                    <div class="overlay" id="overlay">
                                        <div class="text-center">
                                            <i class="fas fa-list fa-7x text-primary"></i><br>
                                            <span class="text-bold">Selecciona un modulo para mostrar las Opciones</span>
                                        </div>
                                    </div>
                                    <ul class="todo-list" data-widget="todo-list" id="ul_opciones" style="height: calc(100vh - 265px); overflow-y: auto;"></ul>
                                </div>
                                <button hidden type="submit" class="btn btn-primary float-right" id="btn_cambiar_ord_opc"><i class="fas fa-plus"></i> Cambiar Orden</button>
                            </form>
                        </div>
                        <div class="card-footer clearfix pt-1 pb-1 pr-2">
                            <button type="button" class="btn btn-danger float-right btn-flat ml-2 btn-sm" id="btn_cancelar_opc"><i class="fas fa-times-circle"></i> Cancelar</button>
                            <button type="button" class="btn btn-primary float-right btn-flat btn-sm" title="Registrar Nueva Opcion" data-toggle="modal" data-target="#myModalOpciones"><i class="fas fa-plus-circle"></i> Agregar Nueva Opcion</button>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- cierre fluid -->
    </section> <!-- cierre de section -->
</div> <!-- /.content-Wrapper -->
<!-- empieza modal -->
<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title" id="titulo_mod"> Registrar Modulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarformModulo();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario_modulo" name="formulario_modulo" method="POST" accept-charset="utf-8">
                <div class="modal-body pt-2 pb-0 mb-0">
                    <div class="alert alert-success alert-dismissible pb-0 mb-2">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p class="mb-0 text-sm" style="font-size: small !important;"><i class="icon fas fa-paper-plane"></i> Para Crear o Editar un Modulo debes tener en cuenta lo siguiente:</p>
                        <ul class="pl-4 mb-2" style="font-size: small !important;">
                            <li class="media">
                                <div><a href="#"><i class="icon fas fa-check"></i></a></div>
                                <div>Si eliges Multi Opciones el modulo mostrara todas las opciones que tiene el modulo, caso contrario solo mostrara la primera opcion.</div>
                            </li>
                            <li class="media">
                                <div><a href="#"><i class="icon fas fa-check"></i></a></div>
                                <div>Puedes Elegir uno Icono en <a href="https://fontawesome.com/search" target="_blank">fontawesome.com</a></div>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Nombre del Modulo</label><label class="text-red">(*)</label>
                        <input type="hidden" name="reg_mod_id" id="reg_mod_id">
                        <input type="hidden" name="reg_mod_orden" id="reg_mod_orden">
                        <input type="text" class="form-control rounded-0" name="reg_mod_nombre" id="reg_mod_nombre" maxlength="50" placeholder="Nombre del Modulo" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre del Icono</label><label class="text-red">(*)</label>
                        <input type="text" class="form-control rounded-0" name="reg_mod_ico" id="reg_mod_ico" maxlength="50" placeholder="Ejemplo: fa-solid fa-database" required>
                    </div>
                    <div class="form-group">
                        <label>El Modulo es Multi Opciones</label><label class="text-red">(*)</label>
                        <select name="reg_mod_multiple" id="reg_mod_multiple" class="form-control rounded-0 select2">
                            <option value="" disabled selected>Seleccione una Opcion</option>
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer pb-1 pt-1">
                    <b class="text-red">Los Campos con (*) son requeridos</b>
                    <button class="btn btn-outline-primary btn-sm btn-flat" type="submit" id="btn_guardar"><i class="fas fa-check-circle"></i> <ins>G</ins>uardar</button>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancel" data-dismiss="modal" ><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- cierre modal -->
<div class="modal fade" id="myModalOpciones" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title" id="titulo_opc"> Registrar Opcion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarformOpciones();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formulario_opcion" name="formulario_opcion" method="POST" accept-charset="utf-8">
                <div class="modal-body pt-2 pb-0 mb-0">
                    <div class="form-group">
                        <label>Nombre de la Opcion</label><label class="text-red">(*)</label>
                        <input type="hidden" name="reg_opc_id" id="reg_opc_id">
                        <input type="hidden" name="reg_per_id" id="reg_per_id">
                        <input type="hidden" name="reg_opc_mod_id" id="reg_opc_mod_id">
                        <input type="hidden" name="reg_opc_orden" id="reg_opc_orden">
                        <input type="text" class="form-control rounded-0" name="reg_opc_nombre" id="reg_opc_nombre" maxlength="50" placeholder="Nombre de la Opcion" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre de la Opcion Abreviada</label><label class="text-red">(*)</label>
                        <input type="text" class="form-control rounded-0" name="reg_opc_nombre_abrev" id="reg_opc_nombre_abrev" maxlength="50" placeholder="Nombre de la opcion Abreviada" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre del Controlador</label><label class="text-red">(*)</label>
                        <input type="text" class="form-control rounded-0" name="reg_opc_controlador" id="reg_opc_controlador" maxlength="50" placeholder="Nombre del Controlador" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre de la Funcion</label><label class="text-red">(*)</label>
                        <input type="text" class="form-control rounded-0" name="reg_opc_funcion" id="reg_opc_funcion" maxlength="50" placeholder="Nombre de la Funcion" required>
                    </div>
                </div>
                <div class="modal-footer pb-1 pt-1">
                    <b class="text-red">Los Campos con (*) son requeridos</b>
                    <button class="btn btn-outline-primary btn-sm btn-flat" type="submit" id="btn_guardar"><i class="fas fa-check-circle"></i> <ins>G</ins>uardar</button>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancel_opc" data-dismiss="modal" ><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- cierre modal -->
<!-- FIN DE CONTENIDO -->
<script src="<?= _SERVER_ ;?>app/views/modulo_configuracion/modulos_opciones/modulos.js" type="text/javascript" charset="utf-8" async defer></script>