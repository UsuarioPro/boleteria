<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <h1 class="m-0 text-dark"><?= $nombre_opcion?>                    
                        <button type="button" class="btn btn-outline-primary btn-flat btn-sm" title="Registrar Nueva Categoria" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> <ins>A</ins>gregar</button>
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
                                    <th class="all" title="Nombre de la Categoria">Nombre</th>
                                    <th title="">Direccion</th>
                                    <th title="">Ciudad</th>
                                    <th class="all" title="">Logo</th>
                                    <th class="all" title="">Escenario</th>
                                    <th class="all" title="Condicion de la Categoria">Estado</th>
                                    <th class="all">Opciones</th>
                                </tr>
                                </thead>
                            </table><!-- cierre tabla -->
                        </div> <!-- cierre div -->
                        <!-- empieza modal -->
                        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header pb-2">
                                        <h5 class="modal-title" id="titulo">Registrar Categoria</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarform();">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nombre del Local</label><label class="text-red">(*)</label>
                                                <input type="hidden" name="loc_id" id="loc_id">
                                                <input type="text" class="form-control rounded-0 validacion_mayuscula" name="loc_nombre" id="loc_nombre" maxlength="100" placeholder="Nombre de la Categoria"required>
                                            </div>
                                            <div class="form-group">
                                                <label>Direccion</label><label class="text-red">(*)</label>
                                                <input type="text" class="form-control rounded-0 validacion_mayuscula" name="loc_direccion" id="loc_direccion" maxlength="100" placeholder="Direccion" required>
                                            </div> 
                                            <div class="form-group">
                                                <label>Ciudad</label>
                                                <input type="text" class="form-control rounded-0 validacion_mayuscula" name="loc_ciudad" id="loc_ciudad" maxlength="100" placeholder="Direccion" required>
                                            </div> 
                                            <div class="form-group">
                                                <label class="tooltip_tippy " data-tippy-content="<small>Tener en cuenta que la imagen tiene que se cuadrada 500 x 500 px minimo(*)</small>" >Logo <i class="fas fa-circle-info text-orange"></i> </label> <span class="text-red text-bold">(*)</span>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 m-0">
                                                    <input type="hidden" id="temp_img1" name="temp_img1">
                                                    <input type="file" class="filepond" name="usu_imagen" id="usu_imagen">
                                                </div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label class="tooltip_tippy " data-tippy-content="<small>Tener en cuenta que la imagen tiene que se cuadrada 500 x 500 px minimo(*)</small>" >Imagen Escenario <i class="fas fa-circle-info text-orange"></i> </label> <span class="text-red text-bold">(*)</span>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 m-0">
                                                    <input type="hidden" id="temp_img2" name="temp_img2">
                                                    <input type="file" class="filepond2" name="usu_portada" id="usu_portada" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer pb-1 pt-1">
                                            <b class="text-red">Los Campos con (*) son requeridos</b>
                                            <button class="btn btn-outline-primary btn-flat btn-sm" type="submit" id="btn_guardar"><i class="fas fa-check-circle"></i> <ins>G</ins>uardar</button>
                                            <button type="button" class="btn btn-outline-danger btn-flat btn-sm" id="btn_cancelar" data-dismiss="modal"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-dialog -->
                        </div><!-- cierre modal -->
                    </div><!-- cierre card -->
                </div> <!-- cierre col -->
            </div><!-- cierre row -->
        </div><!-- cierre fluid -->
    </section> <!-- cierre de section -->
</div> <!-- /.content-Wrapper -->
<!-- FIN DE CONTENIDO -->
<script src="<?= _SERVER_ ?>app/views/local/local.js" type="text/javascript" charset="utf-8" async defer></script>
