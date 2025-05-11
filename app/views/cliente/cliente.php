<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> <?= $nombre_opcion?>
                    <button type="button" class="btn btn-outline-primary btn-sm btn-flat" title="Registrar Nuevo Cliente" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-circle"></i> Agregar</button>
                    </h1>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 d-none d-sm-block mt-1">
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
                                <th class="all" title="Numero de fila">#</th>
                                <th class="all" title="Nombre del Cliente">Nombre</th>
                                <th class="all" title="Tipo de documento ">Tipo Doc</th>
                                <th class="all" title="Numero de Documento">Num Doc</th>
                                <th class="all" title="Direccion del Cliente">Direccion</th>
                                <th class="all" title="Telefono del Cliente">Telefono</th>
                                <th class="all" title="Correo Del Cliente">Correo</th>
                                <th class="all" title="Estado del Cliente">Estado</th>
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
                                        <h5 class="modal-title " id="titulo"> Registrar Nuevo Cliente</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarform();">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                      
                                    <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                                        <div class="modal-body pb-0 mb-0 pt-2" id="body_cliente">
                                            <div class="overlay-wrapper">
                                                <div class="overlay" id="overlay_busqueda_sunat">
                                                    <div class="text-center">
                                                        <i class="fa-duotone fa-spinner fa-spin-pulse fa-5x text-primary "></i> <br>
                                                        <span class="text-bold text-primary">Espere un momento, Estamos cargando la información</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                                    <label>Tipo Documento</label><label class="text-red">(*)</label>
                                                    <select name="cli_tipo" id="cli_tipo" class="form-control rounded-0 select2" required="seleccione tipo de documento">
                                                    </select>
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                                    <label>Num. Doc</label><label class="text-red">(*)</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control rounded-0 validacion_entero" maxlength="11" placeholder="Ingrese el Numero de Documento" id="cli_num_doc" name="cli_num_doc" required> 
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-primary btn-flat" id="btn_sunat"><i class="fa fa-search"></i> Sunat
                                                            <img id="spinner" name="spinner" src="<?= _SERVER_;?>styles/img/spinner.gif" style="width: 23px"> </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xl-12"> 
                                                    <label>Nombre/Razon Social</label><label class="text-red">(*)</label>
                                                    <input type="hidden" name="cli_id" id="cli_id">
                                                    <input type="text" class="form-control rounded-0 validacion_mayuscula" name="cli_nombre" id="cli_nombre" maxlength="250" placeholder="Nombre del Cliente"required>
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                                    <label>Direccion</label>
                                                    <input type="text" class="form-control rounded-0 validacion_mayuscula" name="cli_direccion" id="cli_direccion" maxlength="250" placeholder="Direccion">
                                                </div>  
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                                    <label>Telefono</label>
                                                    <input type="text" class="form-control rounded-0 validacion_entero" id="cli_telefono" name="cli_telefono" maxlength="12" placeholder="Telefono" >
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xl-12">
                                                    <label>Correo</label>
                                                    <input type="email" class="form-control rounded-0" id="cli_correo" name="cli_correo" maxlength="150" placeholder="correo electronico" >
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
                    </div><!-- cierre card -->
                </div> <!-- cierre col -->
            </div><!-- cierre row -->
        </div><!-- cierre fluid -->        
    </section>
</div> <!-- /.content-Wrapper -->
<!-- FIN DE CONTENIDO -->  
<script src="<?= _SERVER_ ;?>app/views/cliente/cliente.js" type="text/javascript" charset="utf-8" async defer></script>