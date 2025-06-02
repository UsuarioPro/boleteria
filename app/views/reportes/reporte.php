<div class="content-wrapper">
    <div class="content-header pb-1 mb-1" id="div_container_header">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <h1 class="m-0 text-dark"> <?= $nombre_opcion?>
                        <button type="button" id="btn_exportar" data-tippy-content="<small>Exportar</small>"  class="btn btn-outline-primary btn-sm btn-flat tooltip_tippy dropdown-toggle d-none d-xl-none d-lg-none d-md-none d-inline-block" style="border: none; box-shadow: none !important;" data-toggle="dropdown">
                            <i class="fas fa-download"></i> <span class="d-none d-sm-inline-block d-xl-inline-block">Exportar</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <ul class="nav nav-pills flex-column p-0">
                                <li hidden class="nav-item exportacion" value="excel"><a class="nav-link" href="#"><i class="far fa-file-excel"></i> Exportar en Excel</a></li>
                                <li class="nav-item exportacion" value="pdf" ><a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Exportar en PDF</a></li>
                            </ul>
                        </div>                        
                    </h1>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 d-none d-xl-block" style="font-size: smaller;">
                    <ol class="breadcrumb float-sm-right" id="leyenda">
                        <li class="breadcrumb-item"><i class="nav-icon <?= $ico_modulo?>"></i><a href="#"> <?= $modulo?></a></li>
                        <li class="breadcrumb-item active text-primary"><?= $nombre_opcion?></li>
                        <li class="breadcrumb-item active text-primary">Asistencia General</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container">
            <input type="hidden" id="filtro_tiempo" name="filtro_tiempo">
            <input type="hidden" id="cli_id" name="cli_id" value="<?= $_SESSION['cli_id'] ?>">
            <div class="row">
                <input type="hidden" value="<?= $_SESSION['rol_id'] ?>" id="rol_id" name="rol_id">
                <div class="col-md-12" id="div_filtros">
                    <form id="filtros_section" name="filtros_section" method="POST" accept-charset="utf-8" class="p-0">
                        <div class="row mb-0" id="filtros_section">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2" id="div_filtro_organizador">
                                <label class="">Seleccione Organizador</label>
                                <select id="filtro_organizador" name="filtro_organizador" class="form-control select2-sm" data-placeholder="Seleccione un Organizador"></select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label class="">Seleccione Cliente</label>
                                <select id="filtro_cliente" name="filtro_cliente" class="form-control select2-sm" data-placeholder="Seleccione un Cliente"></select>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-0">
                                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mb-2 float-right">
                                    <label for="" class="d-none d-xl-none d-lg-none d-md-none d-inline-block">Seleccione un Periodo</label>
                                    <div class="input-group rounded-0" id="div_filtro_fecha">
                                        <input type="text" id="filtro_fecha" name="filtro_fecha" value="" readonly style="background-color: white;" placeholder="Seleccione una fecha..." class="form-control form-control-sm rounded-0 btn btn-flat btn-sm btn-outline-primary">
                                        <input required type="text" name="filtro_meses" id="filtro_meses" value="" style="background-color: white;" placeholder="Seleccione una mes y un año..." class="form-control form-control-sm rounded-0 flatpickr_mes btn btn-outline-primary">
                                        <input type="text" id="filtro_fecha_rango" name="filtro_fecha_rango" value="" readonly style="background-color: white;" placeholder="Seleccione una rango de fechas..." class="form-control form-control-sm rounded-0 btn btn-flat btn-sm btn-outline-primary">
                                        <div class="input-group-append">
                                            <button type="button"  class="btn btn-flat btn-sm btn-outline-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <i class="fa-regular fa-calendar"></i>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-left" role="menu">
                                                <ul class="nav nav-pills flex-column pl-2 pr-2">
                                                    <li class="nav-item filtro_tiempo" value="1"><a class="nav-link" href="#" data-toggle="tab">Filtrar por Fechas</a></li>
                                                    <li class="nav-item filtro_tiempo" value="2"><a class="nav-link active" href="#" data-toggle="tab">Filtrar por Rango de Fecha</a></li>
                                                    <li class="nav-item filtro_tiempo" value="3" id="filtro_tiempo_defaulf"><a class="nav-link" href="#" data-toggle="tab">Filtrar por mes</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="btn-group ml-2 d-none d-xl-block d-lg-block d-md-block">
                                            <button type="button" id="" class="btn btn-outline-primary btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa-regular fa-download"></i> <span class="d-none d-sm-inline-block d-xl-inline-block">Exportar</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                <ul class="nav nav-pills flex-column p-0">
                                                    <li hidden class="nav-item exportacion" value="excel"><a class="nav-link" href="#"><i class="far fa-file-excel"></i> Exportar en Excel</a></li>
                                                    <li class="nav-item exportacion" value="pdf" ><a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Exportar en PDF</a></li>
                                                </ul>
                                            </div>   
                                        </div>
                                        <div class="btn-group ml-2 d-none d-xl-block d-lg-block d-md-block">
                                            <button style="font-weight: 500;"  type="button" class="btn btn-flat btn-sm btn-primary buscador">
                                                <i class="fa-regular fa-search"></i> 
                                                <span class="">Buscar</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12" id="div_reporte_metodo">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="card rounded-0 card-outline card-primary pb-0 mb-0">
                                <div class="card-body" id="listado_registros">
                                    <div class="table-responsive">
                                        <table id="tbllistado" style="width: 100%;" class="table tablaMultiple table-head-fixed table-striped table-bordered table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Cliente</td>
                                                    <td>Tipo de Pago</td>
                                                    <td>Fecha</td>
                                                    <td>Total</td>
                                                    <td>Estado</td>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="<?= _SERVER_ ;?>app/views/reportes/reporte.js" type="text/javascript" charset="utf-8" async defer></script>
