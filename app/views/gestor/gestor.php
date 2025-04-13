<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content pt-xl-2 pt-lg-2 pt-md-2 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 d-none d-md-block border pt-2" style="background-color: transparent;">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button type="button" id="btn_agregar_folder" data-toggle="modal" data-target="#myModalCarpeta" class="btn btn-outline-primary btn-sm btn-flat col-12"><i class="fa-solid fa-folder-plus"></i> Nueva Carpeta</button>
                        </div>
                        <div class="col-12 mb-2 pb-2 border-bottom">
                            <button class="btn btn-outline-primary btn-sm btn-flat col-12" id="btn_agregar_archivos" data-toggle="modal" data-target="#myModalSubir" ><i class="fa-solid fa-file-arrow-up"></i> Subir Archivos</button>
                        </div>
                        <div class="col-12 text-center text-primary">
                            <h6>Directorios</h6>
                        </div>
                        <div class="col-12 p-0" id="div_modulos_sistema" style="height: 100vh; max-height: calc(100vh - 237px);overflow-y: auto;">
                        </div>
                        <div id="div_arbol_vacio" class="p-0 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-0 text-center div_arbol_file_manager_vacio">
                            <div class="form-group interno col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <img class="mb-2" style="border-radius: 0%; border:none; height: auto; width: 60%;" src="../styles/img/arbol_file_manager_empy.png" alt=""><br>
                                <span class="text-bold">¡No se encontraron carpetas!</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-10 col-lg-8 col-md-8 col-sm-12">
                    <input type="hidden" id="url_file_manager">
                    <input type="hidden" id="url_file_fol_fld">
                    <input type="hidden" id="url_file_rol_id" value="<?= $_SESSION['rol_id'] ?>">
                    <input type="hidden" id="url_file_compartido">
                    <input type="hidden" id="file_manager_fol_id">
                    <input type="hidden" id="url_fol_extension">
                    <input type="hidden" id="url_fol_pertenece">
                    <input type="hidden" id="url_fol_compartido">
                    <div class="row">
                        <div class="col-sm-12" style="margin-bottom: -17px;">
                            <ol class="breadcrumb bg-gradient-outline-primary" style="padding-bottom: 10px !important;" id="rutas">
                                <li class="breadcrumb-item" id="ruta_item_0"><a href="#" class="link_folder active"><i class="fa-sharp-duotone fa-solid fa-house"></i></a></li>
                            </ol>
                        </div>
                        <div class="col-md-12 pb-2" style="padding: 7px;">
                            <div class="mailbox-controls bg-light border">
                                <button type="button" id="btn_refrescar" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Refrescar</small>"><i class="fa-solid fa-sync-alt"></i> </button>
                                <button type="button" id="btn_new_folder" data-toggle="modal" data-target="#myModalCarpeta" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Nueva Carpeta</small>"><i class="fa-solid fa-folder-plus"></i> </button>
                                <button type="button" id="btn_new_file" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-toggle="modal" data-target="#myModalSubir" data-tippy-content="<small>Subir Archivo</small>"><i class="fa-solid fa-file-arrow-up"></i> </button>
                                <div class="btn-group border-left" id="opciones_files">
                                    <button type="button" id="btn_ver_archivo" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Ver Archivo</small>"><i class="fa-solid fa-eye"></i> </button>
                                    <button type="button" id="btn_abrir_carpeta" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Abrir Carpeta</small>"><i class="fa-solid fa-folder-open"></i> </button>
                                    <button type="button" id="btn_renombrar" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Renombrar</small>"><i class="fa-solid fa-file-pen"></i> </button>
                                    <button type="button" id="btn_mover" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Mover</small>"><i class="fa-solid fa-folder-arrow-up"></i> </button>
                                    <button type="button" id="btn_copiar" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Copiar</small>"><i class="fa-solid fa-copy"></i> </button>
                                    <button type="button" id="btn_eliminar" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Eliminar</small>"><i class="fa-solid fa-trash"></i> </button>
                                    <button type="button" id="btn_compartir" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Compartir</small>"><i class="fa-solid fa-share-nodes"></i> </button>
                                    <button type="button" id="btn_descargar" class="btn btn-default btn-sm tooltip_tippy btn-flat icono_solo" data-tippy-content="<small>Descargar</small>"><i class="fa-solid fa-download"></i> </button>
                                </div>
                                <div class="float-right">
                                    <div class="btn-group btn-group-sm btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-primary rounded-0 btn-sm tooltip_tippy icono_solo" data-tippy-content="<small>Ver en forma de lista</small>">
                                            <input type="radio" name="vista_producto[]" id="vista_producto_lista" onclick="seleccionar_vista()" value="vista_lista"><i class="fas fa-list"></i>
                                        </label>
                                        <label class="btn btn-outline-primary rounded-0 btn-sm tooltip_tippy active icono_solo" data-tippy-content="<small>Ver en forma de cuadricula</small>">
                                            <input type="radio" name="vista_producto[]" id="vista_producto_cudricula" onclick="seleccionar_vista()" value="vista_cuadricula" checked=""><i class="fas fa-th"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="overlay-wrapper">
                                <div class="overlay" id="overlay_producto_cuadricula">
                                    <div class="text-center">
                                        <i class="fa-duotone fa-spinner fa-spin-pulse fa-5x text-primary "></i> <br>
                                        <span class="text-bold text-primary">Espere un momento Estamos cargando la información</span>
                                    </div>
                                </div>
                            </div>
                            <div id="div_file_manager">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- cierre fluid -->
    </section> <!-- cierre de section -->
    <!-- /.content-header -->
</div>
<!-- empieza modal -->
<div class="modal fade" id="myModalCarpeta" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title" id="titulo">Crear Nueva Carpeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarform()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                      
            <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                <div class="modal-body pb-0 mb-0 pt-2">
                    <input type="hidden" id="url" name="url">
                    <input type="hidden" id="fol_fld" name="fol_fld">
                    <input type="hidden" id="fol_tipo" name="fol_tipo">
                    <input type="hidden" id="fol_extension" name="fol_extension">
                    <input type="hidden" id="fol_pertenece" name="fol_pertenece">
                    <input type="hidden" id="fol_compartido" name="fol_compartido">
                    <div class="form-group">
                        <label>Nombre de la Carpeta</label><label class="text-red">(*)</label>
                        <input type="text" class="form-control rounded-0" name="carpeta" id="carpeta" placeholder="Nueva Carpeta...">
                    </div>    
                </div>
                <div class="modal-footer pb-1 pt-1">
                    <small class="text-red text-bold">Los Campos con (*) son requeridos</small>
                    <button class="btn btn-outline-primary btn-sm btn-flat" type="submit" id="btn_guardar"><i class="fas fa-check-circle"></i> <ins>C</ins>rear</button>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancelar" data-dismiss="modal"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- Cierre modal -->
<!-- empieza modal -->
<div class="modal fade" id="myModalRenombrar" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title " id="titulo_renombrar">Renombrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarformRenombrar()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                   
            <form id="formulario_renombrar" name="formulario_renombrar" method="POST" accept-charset="utf-8">
                <input type="hidden" id="ren_fol_id" name="ren_fol_id">
                <input type="hidden" id="ren_fol_tipo" name="ren_fol_tipo">
                <input type="hidden" id="ren_fol_cid" name="ren_fol_cid">
                <input type="hidden" id="ren_fol_name" name="ren_fol_name">
                <input type="hidden" id="ren_fol_url" name="ren_fol_url">
                <input type="hidden" id="ren_fol_extension" name="ren_fol_extension">
                <input type="hidden" id="ren_url_file_manager" name="ren_url_file_manager">
                <div class="modal-body pb-0 mb-0 pt-2">
                    <div class="form-group">
                        <label>Nuevo Nombre</label><label class="text-red">(*)</label>
                        <input type="text" class="form-control rounded-0" name="renombrar_file" id="renombrar_file" placeholder="Nuevo Nombre...">
                    </div>    
                </div>
                <div class="modal-footer pb-1 pt-1">
                    <small class="text-red text-bold">Los Campos con (*) son requeridos</small>
                    <button class="btn btn-outline-primary btn-sm btn-flat" type="submit"><i class="fas fa-check-circle"></i> <ins>R</ins>enombrar</button>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancelar_renombrar" data-dismiss="modal"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- Cierre modal -->
<!-- empieza modal -->
<div class="modal fade" id="myModalMoverCopiar" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title " id="titulo_mover">Renombrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                   
            <div class="modal-body pb-0 mb-0 pt-2">
                <div class="row">
                    <input type="hidden" id="mov_fil_seleccionado" name="mov_fil_seleccionado">
                    <input type="hidden" id="fol_tipo_accion" name="fol_tipo_accion">
                    <input type="hidden" id="mov_fol_tipo" name="mov_fol_tipo">
                    <input type="hidden" id="mov_fol_cid" name="mov_fol_cid">
                    <input type="hidden" id="mov_fol_nombre" name="mov_fol_nombre">
                    <input type="hidden" id="mov_fol_url_actual" name="mov_fol_url_actual">
                    <input type="hidden" id="mov_fol_id" name="mov_fol_id">
                    <input type="hidden" id="mov_fol_url" name="mov_fol_url">
                    <div class="form-group mb-2 col-md-12">
                        <label for="">URL Actual</label>
                        <input type="text" id="url_view_mover" class="form-control form-control-sm rounded-0" disabled>
                    </div>
                    <div class="col-12 text-center text-primary">
                        <h6>Seleccione un Directorio</h6>
                    </div>
                    <div id="div_arbol_vacio_mover" class="p-0 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-0 text-center div_arbol_file_manager_vacio">
                        <div class="form-group interno col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <img class="mb-2" style="border-radius: 0%; border:none; height: auto; width: 60%;" src="../styles/img/arbol_file_manager_empy.png" alt=""><br>
                            <span class="text-bold">¡No se encontraron carpetas!</span>
                        </div>
                    </div>
                    <div class="col-12 mb-2" id="div_modulos_mover" style="max-height: calc(100vh - 300px);overflow-y: auto;">
                    </div>
                </div>
            </div>
            <div class="modal-footer pb-1 pt-1">
                <small class="text-red text-bold">Los Campos con (*) son requeridos</small>
                <button class="btn btn-outline-primary btn-sm btn-flat" type="button" id="btn_guardar_mover"><i class="fas fa-check-circle"></i> <ins>M</ins>over</button>
                <button class="btn btn-outline-primary btn-sm btn-flat" type="button" id="btn_guardar_copiar"><i class="fas fa-check-circle"></i> <ins>C</ins>opiar</button>
                <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancelar_mover" data-dismiss="modal"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
            </div>
        </div>
    </div>
</div> <!-- Cierre modal -->
<!-- empieza modal -->
<div class="modal fade" id="myModalSubir" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title">Subir Archivos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarform()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>            
            <form id="formulario_subir" name="formulario_subir" method="POST" accept-charset="utf-8">
                <input type="hidden" id="up_url" name="up_url">
                <input type="hidden" id="up_fol_fld" name="up_fol_fld">
                <input type="hidden" id="up_fol_tipo" name="up_fol_tipo">
                <input type="hidden" id="up_fol_extension" name="up_fol_extension">
                <input type="hidden" id="up_fol_pertenece" name="up_fol_pertenece">
                <input type="hidden" id="up_fol_compartido" name="up_fol_compartido">
                <div class="modal-body p-0 m-0" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-2">
                        <input type="file" class="filepondPortada" name="prod_imagen_4[]" id="prod_imagen_4" multiple>
                    </div>
                </div>
                <div class="modal-footer pb-1 pt-1">
                    <small class="text-red text-bold">Los Campos con (*) son requeridos</small>
                    <button class="btn btn-outline-primary btn-sm btn-flat" type="submit"><i class="fas fa-check-circle"></i> <ins>S</ins>ubir Archivos</button>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-flat" id="btn_cancelar_subit" data-dismiss="modal"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- Cierre modal -->
<div class="modal fade" id="myModalCompartir" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pb-2">
                <h5 class="modal-title" id="titulo_compartir">Compartir Archivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelarformCompartir()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>            
            <form id="formulario_compartir" name="formulario_compartir" method="POST" accept-charset="utf-8">
                <div class="modal-body pb-0 mb-0 pt-2" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                    <div class="overlay-wrapper">
                        <div class="overlay" id="overlay_compartir">
                            <div class="text-center">
                                <i class="fa-duotone fa-spinner fa-spin-pulse fa-5x text-primary "></i> <br>
                                <span class="text-bold text-primary">Espere un momento Estamos cargando la información</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="comp_tipo" name="comp_tipo">
                    <input type="hidden" id="comp_fol_id" name="comp_fol_id">
                    <input type="hidden" id="comp_nombre" name="comp_nombre">
                    <input type="hidden" id="comp_fol_url" name="comp_fol_url">
                    <input type="hidden" id="comp_fol_user_id" name="comp_fol_user_id">
                    <input type="hidden" id="comp_usuarios" name="comp_usuarios[]">
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 pb-0 mb-0" id="div_informacion">
                            <div class="alert alert-outline-success alert-dismissible pb-0 pl-0 ml-0 pr-4 text-justify mb-2">
                                <ul class="mb-1 ml-0 pl-3" style="margin-top: -6px; font-size: 12px;">
                                    <li class="media">
                                        <div><a href="#"><i class="icon fas fa-circle-info"></i></a></div>
                                        <div id="text_compartir"> Importante!!!. Al compartir la carpeta se compartira todas las subscarpetas y archivos que estan dentro de la carpeta principal.</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="">Seleccione uno o mas usuarios</label>
                            <select name="usu_id[]" id="usu_id" class="form-control"  data-placeholder="Seleccione una o mas usuarios" multiple></select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mb-1" style="margin-top: -10px;" id="div_remover_usuario">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="remover_usuario" name="remover_usuario">
                                <label class="custom-control-label" for="remover_usuario"> Remover usuario(s) compartido</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pb-1 pt-1">
                    <small class="text-red text-bold">Los Campos con (*) son requeridos</small>
                    <button class="btn btn-outline-primary btn-sm btn-flat" type="submit"><i class="fas fa-check-circle"></i> <ins>C</ins>ompartir</button>
                    <button type="button" class="btn btn-outline-danger btn-sm btn-flat" data-dismiss="modal" id="btn_cancelar_compartir"><i class="fas fa-times-circle"></i> <ins>C</ins>ancelar</button>
                </div>
            </form>
        </div>
    </div>
</div> <!-- Cierre modal -->
<div class="modal fade" id="myModalInformacion" data-backdrop="document" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0 m-0">
                <div class="row">
                    <embed id="mostrar_archivo" src="" type="" width="100%" style="height: calc(100vh - 100px);">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- cierre modal -->
<script src="<?= _SERVER_ ?>app/views/gestor/gestor.js" type="text/javascript" charset="utf-8" async defer></script>
<!-- /.content-wrapper -->