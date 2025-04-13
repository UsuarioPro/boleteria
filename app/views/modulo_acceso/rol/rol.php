<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h1 class="m-0 text-dark"><?= $nombre_opcion?>             
                        <button type="submit" class="btn btn-outline-primary btn-sm btn-flat" title="Registrar Nuevo Cargo" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle"></i> <ins>A</ins>gregar</button>
                    </h1>
                </div><!-- /.col -->
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
                        <div class="card-body" id="listado_registros">
                            <table id="tbllistado" class="table table-head-fixed table-striped table-bordered table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th class="all" title="Numero de Fila">#</th>
                                    <th class="all" title="Nombre del Rol">Rol</th>
                                    <th title="Descripcion del Cargo">Descripcion</th>
                                    <th class="all" title="Condicion del Cargo">Estado</th>
                                    <th class="all text-nowrap">Opciones</th>
                                </tr>
                                </thead>
                            </table><!-- cierre tabla -->
                        </div> <!-- cierre div -->
                        <!-- empieza modal -->
                        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header pb-2">
                                        <h5 class="modal-title" id="titulo"> Registrar Rol</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarform();">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                                        <div class="modal-body pt-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Nombre del Rol</label><label class="text-red">(*)</label>
                                                        <input type="hidden" name="rol_id" id="rol_id">
                                                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control rounded-0" name="rol_nombre" id="rol_nombre" maxlength="50" placeholder="Nombre del Cargo"required>
                                                    </div>
                                                    <div class="">
                                                        <label>Descripcion</label>
                                                        <textarea name="rol_descripcion" id="rol_descripcion" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control rounded-0"
                                                        placeholder="Descripcion" cols="30" rows="17"></textarea>                                                
                                                    </div> 
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <h6 class="text-bold">Modulos del Sistema</h6>
                                                        </div>
                                                        <div class="form-group  col-6">
                                                            <button type="button" id="btn_marcar_todo" class="btn btn-outline-success btn-flat btn-sm" style="width: 100%;"> <i class="fas fa-check-double"></i> Marcar Todo</button>
                                                        </div>
                                                        <div class="form-group col-6">
                                                            <button type="button" id="btn_desmarcar_todo" class="btn btn-outline-danger  btn-flat btn-sm" style="width: 100%;"> <i class="fas fa-trash"></i> Desmarcar Todo</button>
                                                        </div>
                                                        <div class="col-12" id="div_modulos_sistema" style="min-height: 455px; max-height: calc(100vh - 300px);overflow-y: auto;">
                                                            <ul id="opciones_arbol" name="opciones_arbol">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div id="div_permisos">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer pb-1 pt-1">
                                            <b class="text-red">Los Campos con (*) son requeridos</b>
                                            <button class="btn btn-outline-primary btn-sm btn-flat" type="submit" id="btn_guardar"><i class="fas fa-check-circle"></i> <ins>G</ins>uardar</button>
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancel" data-dismiss="modal" onclick="cancelarform();"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                                        </div>
                                    </form>
                                    <!-- /.modal-content -->
                                </div>
                            </div><!-- /.modal-dialog -->
                        </div><!-- cierre modal -->
                    </div><!-- cierre card -->
                </div> <!-- cierre col -->
            </div><!-- cierre row -->
        </div><!-- cierre fluid -->
    </section> <!-- cierre de section -->
</div> <!-- /.content-Wrapper -->
<div class="modal fade" id="myModalPermisos" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title">Permisos del Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarformPermisos()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: calc(100vh - 200px);overflow-y: auto;">
                <div class="row">
                    <div class="col-12 disabledDiv" id="ver_div_modulos_sistema">
                        <ul id="ver_opciones_arbol" name="ver_opciones_arbol">
                        </ul>
                    </div>
                    <div id="div_permisos">
                    </div>
                </div>
            </div>
            <div class="modal-footer pb-1 pt-1">
                <button type="button" class="btn btn-outline-danger btn-sm btn-flat" data-dismiss="modal" onclick="cancelarformPermisos();"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
            </div>
            <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- cierre modal -->
<!-- FIN DE CONTENIDO -->
<script src="<?= _SERVER_;?>app/views/modulo_acceso/rol/rol.js" type="text/javascript" charset="utf-8" async defer></script>