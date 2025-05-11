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
                                    <th class="all" title="Numero de Fila">Organizador</th>
                                    <th class="all" title="Nombre de la Categoria">Evento</th>
                                    <th class="all" title="">Descripcion Evento</th>
                                    <th class="all" title="Descripcion de la Categoria">Fecha y Hora</th>
                                    <th class="all" title="Condicion de la Categoria">Local/Direccion</th>
                                    <th class="all">Tipo Evento</th>
                                    <th class="all">Artistas en Concierto</th>
                                    <th class="all">Logo</th>
                                    <th class="all">Portada</th>
                                    <th class="all">Estado</th>
                                    <th class="all">Opciones</th>
                                </tr>
                                </thead>
                            </table><!-- cierre tabla -->
                        </div> <!-- cierre div -->
                        <!-- empieza modal -->
                        <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header pb-2">
                                        <h5 class="modal-title" id="titulo">Registrar Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarform();">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                                        <div class="modal-body pb-0 mb-0">
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label>Organizador</label><label class="text-red">(*)</label>
                                                    <select name="cli_id" id="cli_id" class="form-control rounded-0 select2"></select>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>Nombre Concierto</label><label class="text-red">(*)</label>
                                                    <input type="hidden" name="con_id" id="con_id">
                                                    <input type="text" class="form-control rounded-0 validacion_mayuscula" name="con_nombre" id="con_nombre" placeholder="Nombre de Concierto "required>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>Subtitulo Concierto</label><label class="text-red">(*)</label>
                                                    <input type="text" class="form-control rounded-0 validacion_mayuscula" name="con_subtitulo" id="con_subtitulo" placeholder="Subtitulo"required>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>Locacion</label><label class="text-red">(*)</label>
                                                    <select name="loc_id" id="loc_id" class="form-control rounded-0 select2" required></select>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>Categoria / Tipo Evento</label><label class="text-red">(*)</label>
                                                    <select name="cat_id" id="cat_id" class="form-control rounded-0 select2" required></select>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label>Descripcion</label>
                                                    <textarea name="con_descripcion" id="con_descripcion" class="form-control rounded-0 validacion_mayuscula"
                                                    placeholder="Descripcion" cols="30" rows="2" required></textarea>                                                
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>Fecha Evento</label><label class="text-red">(*)</label>
                                                    <input type="date" class="form-control rounded-0 validacion_mayuscula" name="con_fecha" id="con_fecha" placeholder="Fecha Evento"required>
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label>Hora Evento</label><label class="text-red">(*)</label>
                                                    <input type="time" class="form-control rounded-0 validacion_mayuscula" name="con_hora" id="con_hora" placeholder="Fecha Evento"required>
                                                </div> 
                                                <div class="form-group col-6 mb-0">
                                                    <label class="tooltip_tippy " data-tippy-content="<small>Tener en cuenta que la imagen tiene que se cuadrada 500 x 500 px minimo(*)</small>" >Logo <i class="fas fa-circle-info text-orange"></i> </label> <span class="text-red text-bold">(*)</span>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 m-0">
                                                        <input type="hidden" id="temp_img1" name="temp_img1">
                                                        <input type="file" class="filepond" name="usu_imagen" id="usu_imagen">
                                                    </div>
                                                </div>
                                                <div class="form-group col-6 mb-0">
                                                    <label class="tooltip_tippy " data-tippy-content="<small>Tener en cuenta que la imagen tiene que se cuadrada 1500 x 500 px minimo(*)</small>" >Portada <i class="fas fa-circle-info text-orange"></i> </label> <span class="text-red text-bold">(*)</span>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0 m-0">
                                                        <input type="hidden" id="temp_img2" name="temp_img2">
                                                        <input type="file" class="filepond2" name="usu_portada" id="usu_portada">
                                                    </div>
                                                </div>
                                                <div class="form-group col-12 mb-0">
                                                    <div class="row">
                                                        <div class="form-group mt-2 mb-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-primary p-2">
                                                            <label class="mb-0">Seleccione el o los Artistas</label>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label>Artista</label><label class="text-red">(*)</label>
                                                            <select name="select_artista" id="select_artista" class="form-control rounded-0 select2"></select>
                                                        </div>
                                                        <div class="form-group col-sm-6">
                                                            <label>Fecha y Hora de Presentacion</label><label class="text-red">(*)</label>
                                                            <input type="datetime-local" class="form-control rounded-0 validacion_mayuscula" name="fecha_hora" id="fecha_hora" placeholder="Fecha Evento">
                                                        </div>
                                                        <div class="form-group col-sm-12 pt-0 mt-0">
                                                            <a id="btn_agregar_pago" style="margin-top: -10px;" type="button" class="btn btn-success text-bold float-right">[ + AGREGAR ARTISTA ]</a>
                                                        </div>
                                                    </div>
                                                    <table id="tbl_artista" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="3" class="text-center">ARTISTAS SELECCIONADOS</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Artista</th>
                                                                <th>Hora Presentacion</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-group col-12 mb-0">
                                                    <div class="row">
                                                        <div class="form-group mt-2 mb-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-primary p-2">
                                                            <label class="mb-0">Agregar Zonas y sus Precios</label>
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <label>Nombre Zona</label><label class="text-red">(*)</label>
                                                            <input type="text" class="form-control rounded-0 validacion_mayuscula" name="nombre_zona" id="nombre_zona" placeholder="Nombre Zona">
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <label>Descripcion Zona</label><label class="text-red">(*)</label>
                                                            <input type="text" class="form-control rounded-0 validacion_mayuscula" name="descripcion_zona" id="descripcion_zona" placeholder="Descripcion Zona">
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <label>Precio Zona</label><label class="text-red">(*)</label>
                                                            <input type="text" class="form-control rounded-0 validacion_decimal" name="precio_zona" id="precio_zona" placeholder="Precio Zona">
                                                        </div>
                                                        <div class="form-group col-sm-3">
                                                            <label>Stock Zona</label><label class="text-red">(*)</label>
                                                            <input type="text" class="form-control rounded-0 validacion_decimal" name="stock_zona" id="stock_zona" placeholder="Stock Zona">
                                                        </div>
                                                        <div class="form-group col-sm-12 pt-0 mt-0">
                                                            <a id="btn_agregar_zona" style="margin-top: -10px;" type="button" class="btn btn-success text-bold float-right">[ + AGREGAR ZONA - PRECIO ]</a>
                                                        </div>
                                                    </div>
                                                    <table id="tbl_zonas" class="table">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="5" class="text-center">ZONAS - PRECIOS</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Nombre Zona</th>
                                                                <th>Precio</th>
                                                                <th>Stock</th>
                                                                <th>Descripcion</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
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
<script src="<?= _SERVER_ ?>app/views/eventos/eventos.js" type="text/javascript" charset="utf-8" async defer></script>
