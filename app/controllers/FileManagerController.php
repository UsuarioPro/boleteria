<?php
require_once 'app/models/Globals.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/IconManager.php';
require_once 'app/models/FileManager.php';
require_once 'app/models/Log.php';

class FileManagerController
{
    private $navbar;
    private $global;
    private $gestor;
    private $bitacora;
    private $iconManager;
    private $formatos_compatibles;
    private $log;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->global = new Config();
        $this->gestor = new FileManager();
        $this->bitacora = new Bitacora();
        $this->iconManager = new IconManager();
        $this->log = new Log();

        $this->formatos_compatibles = array(
            'video' => array('mp4', 'webm', 'ogv'),
            'image' => array('jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'),
            'embed' => array('pdf', 'txt', 'html', 'mp3', 'wav', 'ogg', 'xml', 'css'),
            'documento' => array('xlsx', 'xls', 'doc', 'docx')
        ); 
    }
    //funcion que muestra la vista para el admin general al inicar app web
    public function mostrar() 
    {
        $opc_modulo = $this->navbar->obtener_opcion_modulo($_GET['c']);
        $modulo = $opc_modulo->mod_nombre;

        $modulos = $this->navbar->obtener_modulos();
        $modulos_rol = $this->navbar->obtener_modulos_rol($_SESSION['rol_id']);
        $permisos_usuario = $this->navbar->obtener_permisos_rol($_SESSION['rol_id']);

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'gestor/gestor.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function delete_directory($carpeta) // Elimina de manera recursiva una carpeta y su contenido
    {
        foreach(glob($carpeta . "/*") as $archivos_carpeta) 
        {
            if (is_dir($archivos_carpeta)) 
            {
                $this->delete_directory($archivos_carpeta);
            } 
            else 
            {
                unlink($archivos_carpeta);
            }
        }
        rmdir($carpeta);
    }
    public function copy_directory($src, $dst) 
    {
        $success = true; // Variable para rastrear el éxito del proceso
    
        $dir = opendir($src); // Abre el directorio de origen
    
        if ($dir === false) // Verifica si el directorio pudo abrirse
        {
            return false;
        }
    
        if (!is_dir($dst)) // Crea el directorio de destino si no existe
        {
            if (!mkdir($dst, 0777, true)) 
            {
                closedir($dir);
                return false;
            }
        }
    
        while (($file = readdir($dir)) !== false) // Copia cada archivo y subdirectorio
        {
            if ($file != '.' && $file != '..') 
            {
                $srcPath = $src . '/' . $file;
                $dstPath = $dst . '/' . $file;
    
                if (is_dir($srcPath)) 
                {
                    if (!$this->copy_directory($srcPath, $dstPath)) // Recursivamente copia el subdirectorio
                    {
                        $success = false;
                    }
                } 
                else 
                {
                    if (!copy($srcPath, $dstPath)) // Copia el archivo
                    {
                        $success = false;
                    }
                }
            }
        }
    
        // Cierra el directorio de origen
        closedir($dir);
    
        return $success;
    }
    public function crear_arbol_carpetas()
    {
        $parent = $_POST['id'];
        $condicion = $_POST['condicion'];
        $model_mod = $this->gestor->obtener_carpetas_lazy_load($parent, $condicion);
        $folders = [];
        if(!empty($model_mod))
        {
            foreach($model_mod as $mod) // jstree-open
            {
                if($_SESSION['rol_id'] == 1)
                {
                    if($condicion == 0)
                    {
                        $option =  $mod->fol_fld == 'root' ? '#' : $mod->fol_fld;
                    }
                    else
                    {
                        $option = $mod->fol_fld == '' ? '#' : $mod->fol_fld;
                    }
                }
                else
                {
                    $option =  $mod->fol_fld == 'root' ? '#' : $mod->fol_fld;
                }
                $nombre = $mod->fol_nombre;
                if($mod->fol_tipo == 0 && $mod->fol_extension == 'share')
                {
                    $obtener_name = explode('.', $mod->fol_nombre);
                    $nombre = 'ROOT - '. $obtener_name[1]; // Obtiene la última parte después del guion
                }
                $data_option = array('fol_id' => $mod->fol_id, 'fol_url' => $mod->fol_url, 'fol_fld' => $mod->fol_fld, 'fol_cid' => $mod->fol_cid, 'encode_fol_url' => rawurlencode($mod->fol_url), 'encode_fol_url' => rawurlencode($mod->fol_nombre));
                $folders[] = [
                        'id' => $mod->fol_fld == '' ? 'root' : $mod->fol_cid,
                        'parent' => $option,
                        'text' => $nombre,
                        "icon" => ($mod->fol_tipo == 0)? "fas fa-folder text-primary" : "fas fa-file text-primary",
                        "data" => $data_option,
                        'children' => $mod->children > 0  
                    ];
            }
        }
        echo json_encode($folders);
    }
    function contar_archivos_y_subcarpetas($ruta) 
    {
        $resultado = [ 'archivos' => 0, 'subcarpetas' => 0 ];

        if (is_dir($ruta)) // Verificar si la ruta es un directorio válido
        {
            $elementos = scandir($ruta); // Obtener todos los elementos en la carpeta
            foreach ($elementos as $elemento) 
            {
                if ($elemento != '.' && $elemento != '..') 
                {
                    $ruta_completa = $ruta . DIRECTORY_SEPARATOR . $elemento;
                    if (is_file($ruta_completa)) 
                    {
                        $resultado['archivos']++;
                    } 
                    elseif (is_dir($ruta_completa)) 
                    {
                        $resultado['subcarpetas']++;
                    }
                }
            }
        }
        
        return $resultado; // Retornar la cantidad de archivos y subcarpetas
    }
    function obtener_tamano_carpeta($ruta) 
    {
        $tamañoTotal = 0;
        if (is_dir($ruta)) // Verificar si la ruta es un directorio válido
        {
            $elementos = scandir($ruta);
            foreach ($elementos as $elemento) 
            {
                if ($elemento != '.' && $elemento != '..') 
                {
                    $rutaCompleta = $ruta . DIRECTORY_SEPARATOR . $elemento;
                    
                    if (is_file($rutaCompleta)) 
                    {
                        $tamañoTotal += filesize($rutaCompleta);
                    } elseif (is_dir($rutaCompleta)) 
                    {
                        $tamañoTotal += $this->obtener_tamano_carpeta($rutaCompleta);
                    }
                }
            }
        }
        
        return $tamañoTotal;
    }
    function obtener_tamano_archivo($ruta) 
    {
        if(is_file($ruta))
        {
            $size = filesize($ruta);
            if ($size === false) 
            {
                $size = 0;
            }
        }
        else
        {
            $size = 'no existe';
        }
        return $size;
    }
    function tamano_formato($tamañoEnBytes) 
    {
        if ($tamañoEnBytes >= 1073741824) // >= 1 GB
        { 
            return number_format($tamañoEnBytes / 1073741824, 2) . ' GB';
        } 
        else if ($tamañoEnBytes >= 1048576) // >= 1 MB
        { 
            return number_format($tamañoEnBytes / 1048576, 2) . ' MB';
        } 
        else if ($tamañoEnBytes >= 1024) // >= 1 KB
        { 
            return number_format($tamañoEnBytes / 1024, 2) . ' KB';
        } 
        else 
        {
            return $tamañoEnBytes . ' BYTES';
        }
    }
    function obtener_fechas_carpeta($ruta) 
    {
        try
        {
            if (is_file($ruta) || is_dir($ruta))   // Verificar si la ruta es un archivo o carpeta válido 
            {
                $creationDate = @filectime($ruta);
                $modificationDate = @filemtime($ruta);
            
                $creationDate = $creationDate !== false ? date("Y-m-d H:i:s", $creationDate) : 0;
                $modificationDate = $modificationDate !== false ? date("Y-m-d H:i:s", $modificationDate) : 0;
            }
            else
            {
                $creationDate = 0;
                $modificationDate = 0;
            }
        }
        catch(Exception $e)
        {
            $creationDate = 0; $modificationDate = 0;
        }
        return [
            'creacion' => $creationDate,
            'modificacion' => $modificationDate
        ];
    }
    function tiempoRelativo($fecha) 
    {
        try
        {
            $fechaModificacion = new DateTime($fecha);
            $fechaActual = new DateTime();
            $intervalo = $fechaActual->diff($fechaModificacion);
        
            if ($intervalo->y > 1) {
                return "Ult. Modif: Hace " . $intervalo->y . " años";
            } elseif ($intervalo->y === 1) {
                return "Ult. Modif: Hace 1 año";
            } elseif ($intervalo->m > 1) {
                return "Ult. Modif: Hace " . $intervalo->m . " meses";
            } elseif ($intervalo->m === 1) {
                return "Ult. Modif: Hace 1 mes";
            } elseif ($intervalo->d > 1) {
                return "Ult. Modif: Hace " . $intervalo->d . " días";
            } elseif ($intervalo->d === 1) {
                return "Ult. Modif: Hace 1 día";
            } elseif ($intervalo->h > 1) {
                return "Ult. Modif: Hace " . $intervalo->h . " horas";
            } elseif ($intervalo->h === 1) {
                return "Ult. Modif: Hace 1 hora";
            } elseif ($intervalo->i > 1) {
                return "Ult. Modif: Hace " . $intervalo->i . " minutos";
            } elseif ($intervalo->i === 1) {
                return "Ult. Modif: Hace 1 minuto";
            } elseif ($intervalo->s > 1) {
                return "Ult. Modif: " . $intervalo->s . " sg";
            } else {
                return "Ult. Modif: Hace 1 segundo";
            }
        }
        catch(Exception $e)
        {
            return "Not Fount Exist";
        }
    }
    function verificarCompatibilidad($extension) 
    {        
        foreach ($this->formatos_compatibles as $tipo => $extensiones) 
        {
            if (in_array($extension, $extensiones)) 
            {
                return array('compatible' => true, 'tipo' => $tipo);
            }
        }
        return array('compatible' => false, 'tipo' => null);
    }
    public function listar_file_manager()
    {
        $fol_fld = $_POST['fol_fld'];
        $usu_id = $_SESSION['usu_id'];
        $numeracion = empty($_POST['numeracion'])? 1 : $_POST['numeracion'];
        $limite = 100;
        $empieza_limite = ($numeracion -1) * $limite;
        $archivos = $this->gestor->cantidad_archivos_filtro($usu_id, $fol_fld);
        $paginas = ceil(count($archivos) / $limite);
        $active_pag_inicio = ($numeracion == 1)? 'active' : '';
        $ocultar_inicio = '';
        $active_pag_final = ($numeracion == $paginas)? 'active' : '';
        $pag_anterior = ($numeracion == 1)? $paginas : ($numeracion - 1);  
        $act_pagina_anterior = ($numeracion == 1)? 'disabled' : '';  

        $pag_siguiente = ($numeracion == $paginas)? $paginas : ($numeracion + 1);  
        $act_pagina_siguiente = ($numeracion == $paginas)? 'disabled' : ''; 
        $inicio = 0; $rpta = ''; $html ='';
        if(empty($archivos))
        {
            $rpta = 'vacio';
            $html = '
                <div id="producto_vacio" tabindex="0" class="p-0 pt-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-0 text-center div_file_manager_vacio border">
                    <div class="form-group interno col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <img class="mb-2" style="border-radius: 0%; border:none" src="../styles/img/presentacion_vacio.svg" height ="125px" alt="">
                        <br>
                        <span class="text-bold">¡No se encontraron archivos o carpetas en la carpeta actual!</span>
                    </div>
                </div>
                <nav aria-label="Page navigation example" class="footer_filtro_producto_cuadricula" hidden>
                    <ul class="pagination justify-content-center m-0">
                        <li class="page-item disabled"><a class="page-link rounded-0"  href="#">Anterior</a></li>
                        <li class="page-item disabled"><a class="page-link rounded-0" href="#">Siguiente</a></li>
                    </ul>
                </nav>';
        } 
        else
        {
            $rpta = 'ok';
            if($paginas == 1)
            {
                $ocultar_nav = 'hidden';
                $ocultar_inicio = 'hidden';
                $ocultar_final = 'hidden';
                $ocultar_pag_final = 'hidden';
            }
            else
            {
                $ocultar_nav = '';
                $ocultar_pag_final = '';
                if(($numeracion <= 4) >= $paginas)
                {
                    $ocultar_inicio = 'hidden';
                    $ocultar_final = ($paginas <= 7)? 'hidden' : '';
                    $inicio = 2;
                    $final = ($paginas == 7)? 6: 5;
                    $pag_active = $numeracion;
                }
                else if(($numeracion + 3) >= $paginas)
                {
                    $ocultar_inicio = ($paginas == 7)? 'hidden' : '';
                    $ocultar_final = 'hidden';
                    $inicio = $paginas - 4;
                    $final = $paginas; 
                    $pag_active = $numeracion;
                }
                else
                {
                    $ocultar_final = '';
                    $inicio = abs($numeracion - 1);
                    $fin = $inicio + 2;
                    $final = ($fin == $numeracion)? $fin + 1 : $fin; 
                    $pag_active = ($numeracion == 0 || $numeracion == 1)? '': $final - 1;
                }
            }
            $model = $this->gestor->listar_file_manager($usu_id, $fol_fld, $empieza_limite, $limite); 
            $i=1;
            $html .= '<div class="row ajustar_dropdown" style="max-height: calc(100vh - 209px);overflow-y: auto; overflow-x: hidden; padding-top: 1px;">';
            foreach ($model as $m)
            {
                $verificar_share = ($_SESSION['rol_id'] == 1)? $this->gestor->verificar_carpeta_archivo_compartido($m->fol_id) : $this->gestor->verificar_carpeta_archivo_compartido_usuario($m->fol_id, $usu_id);
                $is_share_html = ''; $is_compartido = '';
                if(!empty($verificar_share) && ($verificar_share->sha_estado != null || $verificar_share->sha_estado != ''))
                {
                    if($verificar_share->sha_estado == 1)
                    {
                        $is_share_html = '<i class="fa-duotone fa-solid fa-share-from-square text-success pr-1 pb-1 tooltip_tippy" data-tippy-content="<small>Carpeta Compartida</small> " style="position: absolute; right: 0; bottom:0;"></i>';
                    }
                    else if($verificar_share->sha_estado_final == 1)
                    {
                        $is_share_html = '<i class="fa-duotone fa-solid fa-share-from-square text-secondary pr-1 pb-1 tooltip_tippy" data-tippy-content="<small>Carpeta Compartida</small> " style="position: absolute; right: 0; bottom:0;"></i>';
                    }

                    if($_SESSION['rol_id'] == 1)
                    {
                        $is_compartido = $verificar_share->fol_id;
                    }
                    else
                    {
                        $is_compartido =  ($verificar_share->sha_estado_final == 0)? '---' : $verificar_share->fol_id;
                    }
                }
                else
                {
                    if($_SESSION['rol_id'] == 1)
                    {
                        $is_compartido = isset($m->sha_id)? $m->fol_id: '';
                    }
                }

                $fechas = $this->obtener_fechas_carpeta($m->fol_url);
                $fecha_modificacion =  $this->tiempoRelativo($fechas['modificacion']);
                $compatible = ''; $tipo = ''; $descripcion = ''; $nombre = $m->fol_nombre;
                if($m->fol_tipo == 0 && $m->fol_extension == 'share')
                {
                    ($_SESSION['rol_id'] != 1)? $is_compartido = ($is_compartido == '')?'root' : '' : null;
                    $nombre = 'Root - Mis Archivos <i class="fa-duotone fa-solid fa-person-shelter"></i>';
                    $obtener_name = explode('.', $m->fol_nombre);
                    $descripcion = 'Pertenece a: '. $obtener_name[1]; // Obtiene la última parte después del guion
                }
                else if($m->fol_tipo == 0)
                {
                    $count_file = $this->contar_archivos_y_subcarpetas($m->fol_url);
                    $descripcion = $count_file['subcarpetas']. ' Sub Carpetas - '. $count_file['archivos']. ' Archivos';
                    if($count_file > 0)
                    {
                        $descripcion .= ' | '.$this->tamano_formato($this->obtener_tamano_carpeta($m->fol_url));
                    }
                }
                else
                {
                    $descripcion = "Ext. : " . $m->fol_extension . ' | '. $this->tamano_formato($this->obtener_tamano_archivo($m->fol_url));
                }
                $refrescar_variables = true;
                if($m->fol_tipo == 0)
                {
                    $ondblclick = 'file_manager(\''.$refrescar_variables.'\',\''.$m->fol_cid.'\',\''.rawurlencode($m->fol_url).'\',\''.rawurlencode($m->fol_nombre).'\', \'' . $m->fol_extension . '\', \'' . $m->fol_id_user . '\', \'' . $is_compartido . '\')';
                }
                else
                {
                    $resultado = $this->verificarCompatibilidad($m->fol_extension);
                    $ondblclick = 'mostrar_archivo(\''.$m->fol_nombre.'\',\''.$m->fol_extension.'\',\''.rawurlencode($m->fol_url).'\',\''.$resultado['compatible'].'\',\''.$resultado['tipo'].'\')';
                    $compatible = $resultado['compatible']; $tipo = $resultado['tipo'];
                }
                $hidden_file = ($m->fol_tipo == 0)? 'hidden' : '';
                $hidden_folder = ($m->fol_tipo == 1)? 'hidden' : '';
                $html.= '<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                        <div id="div_'.$m->fol_id.'" tabindex="0" class="info-box rounded-0 shadow-sm info_file_manager file_manager divs_files_folders" onclick="mostrar_opciones(\''.$m->fol_id.'\',\''.$m->fol_tipo.'\',\''.$refrescar_variables.'\',\''.$m->fol_cid.'\',\''.rawurlencode($m->fol_url).'\',\''.rawurlencode($m->fol_nombre).'\',\''.rawurlencode($m->fol_extension).'\',\''.$compatible.'\',\''.$tipo.'\',\''.$m->fol_id_user.'\', \'' . $is_compartido . '\')" 
                            ondblclick="'.$ondblclick.'" oncontextmenu="mostrar_menu_fila(event, '.$m->fol_id.',\''.$m->fol_tipo.'\',\''.$m->fol_extension.'\')">
                            <span class="info-box-icon">
                                <img src="'.$this->iconManager->getIcon($m->fol_extension).'" alt="">
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text text-bold">'.$nombre.'</span>
                                <span class="progress-description">'.$descripcion.' 
                                    <br> 
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" style="width: 100%"></div>
                                    </div>
                                    '.$fecha_modificacion.'
                                </span>
                            </div>
                            '.$is_share_html.'
                            <div class="dropdown file_options">
                                <span class="file_icon_options" data-toggle="dropdown">
                                    <i class="fa-regular fa-lg fa-ellipsis-vertical text-secondary tooltip_tippy" data-tippy-content="<small>Ver más Opciones</small>"></i>
                                </span>
                                <div aria-labelledby="dropdownSubMenu_Opc" class="dropdown-menu dropdown-menu-right" role="menu">';
                                    if($m->fol_extension == 'share')
                                    {
                                        $html .= '<a onclick="file_manager('.$refrescar_variables.',\'' . $m->fol_cid . '\', \'' . rawurlencode($m->fol_url) . '\', \'' . rawurlencode($m->fol_nombre) . '\', \'' . $m->fol_extension . '\', \'' . $m->fol_id_user . '\')" class="dropdown-item" href="#"><i class="fa-duotone fa-folder-open"></i> Abrir Carpeta</a>';
                                    }
                                    else
                                    {
                                        $hidden_compartir = '';
                                        if($_SESSION['usu_id'] != 1)
                                        {
                                            $hidden_compartir = ($is_compartido == '')? null : 'hidden';
                                        }
                                        $html .= '<a '.$hidden_file.' onclick="mostrar_archivo(\'' . rawurlencode($m->fol_nombre) . '\', \'' . $m->fol_extension . '\', \'' . rawurlencode($m->fol_url) . '\', \'' . $compatible . '\', \'' . $tipo . '\')" class="dropdown-item" href="#"><i class="fa-duotone fa-eye"></i> Ver Archivo</a>
                                        <a '.$hidden_folder.' onclick="file_manager('.$refrescar_variables.',\'' . $m->fol_cid . '\', \'' . rawurlencode($m->fol_url) . '\', \'' . rawurlencode($m->fol_nombre) . '\', \'' . $m->fol_extension . '\', \'' . $m->fol_id_user . '\')" class="dropdown-item" href="#"><i class="fa-duotone fa-folder-open"></i> Abrir Carpeta</a>
                                        <a class="dropdown-item" onclick="renombrar_file('.$m->fol_id.',\'' . $m->fol_tipo . '\', \'' . $m->fol_cid . '\', \'' . rawurlencode($m->fol_nombre) . '\', \'' . rawurlencode($m->fol_url) . '\', \'' . $m->fol_extension . '\')" href="#"><i class="fa-duotone fa-file-pen"></i> Renombrar</a>
                                        <a class="dropdown-item" onclick="mover_copiar_carpeta_archivo('.$m->fol_id.',\'' . $m->fol_tipo . '\', \'' . rawurlencode($m->fol_nombre) . '\', \'' . rawurlencode($m->fol_url) . '\',1)" href="#"><i class="fa-duotone fa-folder-arrow-up"></i> Mover</a>
                                        <a class="dropdown-item" onclick="mover_copiar_carpeta_archivo('.$m->fol_id.',\'' . $m->fol_tipo . '\', \'' . rawurlencode($m->fol_nombre) . '\', \'' . rawurlencode($m->fol_url) . '\',0)" href="#"><i class="fa-duotone fa-copy"></i> Copiar</a>
                                        <a class="dropdown-item" onclick="eliminar_archivo('.$m->fol_id.',\'' . $m->fol_tipo . '\', \'' . rawurlencode($m->fol_url) . '\', \'' . $m->fol_cid . '\')" href="#"><i class="fa-duotone fa-trash"></i> Eliminar</a>
                                        <a '.$hidden_compartir.' class="dropdown-item" onclick="compartir_archivo_carpeta('.$m->fol_id.',\'' . $m->fol_tipo . '\', \'' . rawurlencode($m->fol_nombre) . '\', \'' . rawurlencode($m->fol_url) . '\', \'' . $m->fol_cid . '\')" href="#"><i class="fa-duotone fa-share-nodes"></i> Compartir</a>
                                        <a '.$hidden_file.' onclick="descargar_archivo(\'' . $m->fol_nombre . '\', \'' . $m->fol_extension . '\', \'' . rawurlencode($m->fol_url) . '\')" class="dropdown-item" href="#"><i class="fa-duotone fa-download"></i> Descargar</a>';
                                    }
                                $html .='
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            $html .= '</div>';
            $html .= '
            <nav aria-label="Page navigation example" class="footer_filtro_producto_cuadricula" '.$ocultar_nav.'>
                <ul class="pagination justify-content-center m-0">
                    <li class="page-item '.$act_pagina_anterior.'"><a class="page-link rounded-0" onclick="pagina_anterior_siguiente_producto('.$pag_anterior.')"  href="#">Anterior</a></li>
                    <li class="page-item '.$active_pag_inicio.'"><a class="page-link" onclick="pagina_anterior_siguiente_producto(1)" href="#">1</a></li>
                    <li class="page-item disabled" '.$ocultar_inicio.'><a class="page-link" href="#">...</a></li>';
            for ($i = $inicio; $i < $paginas; $i ++) 
            {
                if($i !=0 && $i !=1)
                {
                    if($i <= $final)
                    {
                        $active = ($i == $pag_active)? 'active':'';
                        $html .= '<li class="page-item '.$active.'"><a class="page-link" onclick="pagina_anterior_siguiente_producto('.$i.')" href="#">'.$i.'</a></li>';
                    }
                }
            }
            $html .= '
                <li class="page-item disabled" '.$ocultar_final.'><a class="page-link" href="#">...</a></li>
                <li class="page-item '.$active_pag_final.'" '.$ocultar_pag_final.'><a class="page-link" onclick="pagina_anterior_siguiente_producto('.$paginas.')" href="#">'.$paginas.'</a></li>
                <li class="page-item '.$act_pagina_siguiente.'"><a class="page-link rounded-0" onclick="pagina_anterior_siguiente_producto('.$pag_siguiente.')" href="#">Siguiente</a></li>
                </ul>
            </nav>';
        }
        echo json_encode(array('rpta' => $rpta, 'html' =>$html));
    }
    function generateToken() 
    {
        $token = md5(uniqid(mt_rand(), false));
        return $token;
    } 
    public function guardar_editar_carpeta()  //funcion para guardar y editar los datos
    {      
        try
        {
            $cid = $this->generateToken();
            $targetDir = $_POST['url'];
            $targetDirCreate = $targetDir."/".$_POST['carpeta'];	
    
            if(file_exists($targetDir)) 
            {
                if(!file_exists($targetDirCreate)) 
                {
                    if (mkdir($targetDirCreate)) 
                    {
                        $model = new FileManager();
                        $model->fol_fld = $_POST['fol_fld'];
                        $model->fol_url = $targetDirCreate;
                        $model->fol_nombre = $_POST['carpeta'];
                        $model->fol_tipo = $_POST['fol_tipo'];
                        $model->fol_id_user = (empty($_POST['fol_pertenece']))? $_SESSION['usu_id'] : $_POST['fol_pertenece'];
                        $model->fol_extension = 'folder';
                        $model->fol_cid = $cid;
                        $model->option = 'nuevo';
                        $model->fol_compartido = $_POST['fol_compartido'];
                        
                        $result = $this->gestor->guardar_carpeta_archivo($model);
                        if($result == 1)
                        {
                            $rpta =  "ok";
                            $mensaje = "Carpeta Creada Correctamente";
                        }
                        else
                        {
                            rmdir($targetDirCreate); // eliminar carpeta si no se inserto correctamente en mysql
                            $rpta =  "error";
                            $mensaje = "Hubo un error al crear la carpeta";
                        }
                    }
                    else
                    {
                        $rpta =  "error";
                        $mensaje = 'Hubo un error al tratar de crear la carpeta '.$_POST['carpeta'];    
                    } 	  
                }
                else
                {
                    $rpta =  "existe";
                    $mensaje = 'La Carpeta con el Nombre "'.$_POST['carpeta']. '" ya existe. Intente con un nombre distinto';    
                }
            }
            else
            {
                $rpta =  "error";
                $mensaje = 'La Carpeta Principal [Root] no existe. Intente con un nombre distinto';        
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__); 
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
    public function guardar_subir_archivos()
    {
        try
        {
            $subidos = 0; $no_subidos = 0; $mensaje_consola = ''; $consola = '';
            // Verificar si hay archivos cargados
            if (isset($_FILES['prod_imagen_4'])) 
            {
                $files = $_FILES['prod_imagen_4'];
                for ($i = 0; $i < count($files['name']); $i++) // Recorrer cada archivo cargado
                {
                    $fileName = $files['name'][$i];
                    $fileTmpName = $files['tmp_name'][$i];
                    $fileSize = $files['size'][$i];
                    $fileError = $files['error'][$i];
                    $fileType = $files['type'][$i];
                    // Obtener la extensión del archivo
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                    if ($fileError === 0) // Verificar si no hay errores
                    {
                        $cid = $this->generateToken();
                        $targetDir = $_POST['up_url'];
                        $fileDestination = $targetDir."/".$fileName;	
                        if (file_exists($fileDestination)) 
                        {
                            if (move_uploaded_file($fileTmpName, $fileDestination))  // Mover el archivo de la carpeta temporal a la carpeta de destino
                            {
                                $subidos++;
                                $mensaje_consola = 'El Archivo con el nombre '.$fileName.' fue subido correctamente y reemplazo al existente';
                            }
                            else
                            {
                                $no_subidos++;
                                $mensaje_consola = 'Hubo un error al tratar de reemplazar el archivo con el nombre '.$fileName;                                
                            }
                        }    
                        else
                        {
                            if (move_uploaded_file($fileTmpName, $fileDestination))  // Mover el archivo de la carpeta temporal a la carpeta de destino
                            {
                                $model = new FileManager();
                                $model->fol_fld = $_POST['up_fol_fld'];
                                $model->fol_url = $fileDestination;
                                $model->fol_nombre = $fileName;
                                $model->fol_tipo = $_POST['up_fol_tipo'];
                                $model->fol_id_user = (empty($_POST['up_fol_pertenece']))? $_SESSION['usu_id'] : $_POST['up_fol_pertenece'];
                                $model->fol_extension = $fileExtension;
                                $model->fol_cid = $cid;
                                $model->option = 'nuevo';
                                $model->fol_compartido = $_POST['up_fol_compartido'];
                                $result = $this->gestor->guardar_carpeta_archivo($model);
                                if($result == 1)
                                {
                                    $subidos++;
                                    $mensaje_consola = 'El Archivo con el nombre '.$fileName.' fue subido correctamente ';                                
                                }
                                else
                                {
                                    $no_subidos++;
                                    $mensaje_consola = 'Hubo un error al tratar de guardar el archivo con el nombre '.$fileName;                                
                                }
                            } 
                            else 
                            {
                                $no_subidos++;
                                $mensaje_consola = 'Hubo un error al tratar de subir el archivo con el nombre '.$fileName;
                            }
                        }
                    } 
                    else 
                    {
                        $no_subidos++;
                        $mensaje_consola = 'Hubo un error al tratar de cargar el archivo con el nombre '.$fileName;
                    }

                    $consola .='<div class="direct-chat-msg mb-0">
                                <img class="direct-chat-img" src="../styles/img/mensaje.png" alt="message user image" style="background-color:#e8e8e8;">
                                <div class="direct-chat-text text-justify mb-1" style="top: 4px;">
                                    <small> '.$mensaje_consola.' </small>
                                </div>
                            </div>';
                }
                $rpta = 'ok';
                $mensaje = 'Se completo correctamente el proceso de Subida de Archivos <br> Revise el Detalle para saber si hubo inconvenientes en el proceso';
            } 
            else 
            {
                $rpta = 'error';
                $mensaje = 'No hay Archivos para subir';
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__); 
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje, "consola" => $consola, "subidos" => $subidos, "no_subidos" => $no_subidos));
    }
    public function guardar_renombrar()  //funcion para guardar y editar los datos
    {      
        try
        {
            $new_name = $_POST['renombrar_file'];
            if($_POST['ren_fol_tipo'] == 1)
            {
                $info = pathinfo($_POST['renombrar_file']); // Obtener información del archivo
                if (!isset($info['extension'])) // Si no tiene extensión, agregar
                {
                    $new_name = $_POST['renombrar_file'].'.'.$_POST['ren_fol_extension'];
                }
                else if ($info['extension'] !== $_POST['ren_fol_extension']) // Si tiene una extensión que no es .$_POST['fol_extension'], reemplazarla con ".$_POST['fol_extension']"
                {
                    $new_name = $info['filename'] . '.'.$_POST['ren_fol_extension'];
                }
            }
            $oldFolderName = $_POST['ren_fol_url']; // Ruta actual de la carpeta
            $newFolderName = $_POST['ren_url_file_manager'].'/'.$new_name;   // Nueva ruta de la carpeta
            $model = new FileManager();
            $model->fol_id = $_POST['ren_fol_id'];
            $model->fol_tipo = $_POST['ren_fol_tipo'];
            $model->fol_cip = $_POST['ren_fol_cid'];
            $model->fol_name = $new_name;
            // $model->fol_extension = $_POST['fol_extension'];
            $model->fol_old_url = $oldFolderName;
            $model->fol_new_url = $newFolderName;

            if (file_exists($oldFolderName)) 
            {
                if (!file_exists($newFolderName))
                {
                    if (@rename($oldFolderName, $newFolderName))
                    {
                        $result = $this->gestor->guardar_renombrar_archivo($model);
                        if($result == 1)
                        {
                            $rpta =  "ok";
                            $mensaje = ($model->fol_tipo == 0)? "Carpeta Renombrada correctamente" : 'Archivo Renombrado correctamente';
                        }
                        else
                        {
                            $rpta =  "error";
                            $mensaje = ($model->fol_tipo == 0)? "Hubo un error al intentar renombrar la carpeta" : 'Hubo un error al intentar renombrar el archivo';
                        }
                    }
                    else
                    {
                        $rpta =  "error";
                        $mensaje = ($model->fol_tipo == 0)? "Error al renombrar la carpeta. Verifica permisos y que la nueva ruta no exista" : 'Error al renombrar el archivo. Verifica permisos y que la nueva ruta no exista';
                    }
                }
                else
                {
                    $rpta =  "nombre";
                    $mensaje = ($model->fol_tipo == 0)? 'La carpeta con el nombre'.$new_name.' ya existe en el directorio actual <br>Intente con otro nombre ' : 'El Archivo con el nombre'.$new_name.' ya existe en el directorio actual <br>Intente con otro nombre';    
                }
            }
            else
            {
                $rpta =  "error";
                $mensaje = ($model->fol_tipo == 0)? 'La carpeta '.$oldFolderName.' no existe o no es un directorio' : 'El Archivo '.$oldFolderName.' no existe o no es un directorio';
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__); 
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
    public function eliminar_archivos()
    {
        try
        {
            $fol_id = $_POST['fol_id'];
            $tipo = $_POST['tipo'];
            $url = $_POST['url'];
            $fol_cid = $_POST['fol_cid'];

            $result = $this->gestor->eliminar_archivos($fol_id, $tipo, $url);
            if($result == 1)
            {
                if ($tipo == 0) 
                {
                    $this->delete_directory($url);
                    $rpta = 'ok';
                    $mensaje = "Carpeta eliminada correctamente";
                }
                else 
                { // Eliminar archivo
                    unlink($url);
                    $rpta = 'ok';
                    $mensaje = "El archivo se eliminó exitosamente";
                }
            }
            else
            {
                $rpta =  "error";
                $mensaje = "Hubo un error al intentar eliminar la carpeta";
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__); 
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
    public function copiar_mover_archivos() // es la misma funcion que renombrar
    {
        try
        {
            if($_POST['tipo_accion'] == 0)
            {
                $oldFolderName = $_POST['fol_url_actual']; // Ruta actual de la carpeta
                $newFolderName = $_POST['fol_url'].'/'.$_POST['fol_nombre'];   // Nueva ruta de la carpeta

                if (file_exists($oldFolderName)) 
                {
                    if (!file_exists($newFolderName))
                    {
                        $continuar = false;
                        if($_POST['tipo'] == 0)
                        {
                            $continuar = $this->copy_directory($oldFolderName, $newFolderName);
                        }
                        else
                        {
                            if (@copy($oldFolderName, $newFolderName))
                            {
                                $continuar = true;
                            }
                        }
    
                        if($continuar)
                        {
                            $cid = $this->generateToken();
                            $model = new FileManager();
                            $model->fol_fld = $_POST['fol_cid'];
                            $model->fol_url = $newFolderName;
                            $model->fol_nombre = $_POST['fol_nombre'];
                            $model->fol_id_user = $_SESSION['usu_id'];
                            $model->fol_tipo = $_POST['tipo'];
                            $model->fol_extension = ($_POST['tipo'] == 0)? 'folder' : pathinfo($_POST['fol_nombre'], PATHINFO_EXTENSION);
                            $model->fol_cid = $cid;
                            $model->option = 'copiar';
                            // --------------------------------------------------------------------
                            $model->mov_fil_seleccionado = $_POST['fol_id'];
                            $model->fol_url_principal = $oldFolderName;
                            $result = $this->gestor->guardar_carpeta_archivo($model);
                            if($result == 1)
                            {
                                $rpta =  "ok";
                                $mensaje = ($_POST['tipo'] == 0)? "Carpeta copiada correctamente" : 'El Archivo se creo correctamente';
                            }
                            else
                            {
                                $rpta =  "error";
                                $mensaje = ($_POST['tipo'] == 0)? "Error al copiar la carpeta. Verifica permisos y que la nueva ruta no exista" : 'Error al copiar el archivo. Verifica permisos y que la nueva ruta no exista';
                            }
                        }
                        else
                        {
                            $rpta =  "error";
                            $mensaje = ($_POST['tipo'] == 0)? "Error al copiar la carpeta. Verifica permisos y que la nueva ruta no exista" : 'Error al copiar el archivo. Verifica permisos y que la nueva ruta no exista';
                        }
                    }
                    else
                    {
                        $rpta =  "nombre";
                        $mensaje = ($_POST['tipo'] == 0)? 'La carpeta con el nombre '.$_POST['fol_nombre'].' ya existe en el directorio a copiar <br>No se pudo copiar la carpeta' : 'El Archivo con el nombre'.$_POST['fol_nombre'].' ya existe en el directorio a copiar <br>No se pudo copiar la carpeta';        
                    }
                }
                else
                {
                    $rpta =  "error";
                    $mensaje = ($_POST['tipo'] == 0)? 'La carpeta '.$_POST['fol_nombre'].' no existe o no es un directorio' : 'El Archivo '.$_POST['fol_nombre'].' no existe o no es un directorio';
                }
            }
            else
            {
                $oldFolderName = $_POST['fol_url_actual']; // Ruta actual de la carpeta
                $newFolderName = $_POST['fol_url'].'/'.$_POST['fol_nombre'];   // Nueva ruta de la carpeta
                $model = new FileManager();
                $model->fol_id = $_POST['fol_id'];
                $model->fol_tipo = $_POST['tipo'];
                $model->fol_cip = $_POST['fol_cid'];
                $model->tipo_accion = $_POST['tipo_accion'];
                $model->fol_old_url = $oldFolderName;
                $model->fol_new_url = $newFolderName;
                if (file_exists($oldFolderName)) 
                {
                    if (!file_exists($newFolderName))
                    {
                        if (@rename($oldFolderName, $newFolderName))
                        {
                            $result = $this->gestor->mover_copiar_archivos($model);
                            if($result == 1)
                            {
                                $rpta =  "ok";
                                $mensaje = ($model->fol_tipo == 0)? "Carpeta Movida correctamente" : 'Archivo Movido correctamente';
                            }
                            else
                            {
                                $rpta =  "error";
                                $mensaje = ($model->fol_tipo == 0)? "Hubo un error al intentar mover la carpeta" : 'Hubo un error al intentar mover el archivo';
                            }
                        }
                        else
                        {
                            $rpta =  "error";
                            $mensaje = ($model->fol_tipo == 0)? "Error al mover la carpeta. Verifica permisos y que la nueva ruta no exista" : 'Error al mover el archivo. Verifica permisos y que la nueva ruta no exista';
                        }
                    }
                    else
                    {
                        $rpta =  "nombre";
                        $mensaje = ($model->fol_tipo == 0)? 'La carpeta con el nombre '.$_POST['fol_nombre'].' ya existe en el directorio a mover <br>No se pudo mover la carpeta' : 'El Archivo con el nombre'.$_POST['fol_nombre'].' ya existe en el directorio a mover <br>No se pudo mover la carpeta';        
                    }
                }
                else
                {
                    $rpta =  "error";
                    $mensaje = ($model->fol_tipo == 0)? 'La carpeta '.$oldFolderName.' no existe o no es un directorio' : 'El Archivo '.$oldFolderName.' no existe o no es un directorio';
                }
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__); 
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
    public function seleccionar_usuario()
    {
        $limite = isset($_GET['limite']) ? $_GET['limite'] : 10;
        // $limite = 10;
        $searchTerm = isset($_GET['q']) ? "%" . $_GET['q'] . "%" : "%"; // Establecer el término de búsqueda (si no se proporciona, dejar en blanco para obtener todos los resultados)

        $rpta = $this->gestor->seleccionar_usuario_lazy_load($_GET['page'], $searchTerm, $_SESSION['usu_id'], $limite);
        // Calcular si hay más resultados
        $more = count($rpta) == $limite;

        // Construir el array de resultados para ser devuelto
        $result = 
        [
            'items' => [],
            'pagination' => 
            [
                'more' => $more
            ]
        ];
        // Recorrer los resultados y formatearlos
        foreach ($rpta as $reg) 
        {
            $result['items'][] = 
            [
                "selected" => true, // Marca este elemento como seleccionado
                
                "id"=>$reg->usu_id,
                "text"=>$reg->usu_tipo_doc.': '.$reg->usu_numero_doc.' - '.$reg->usu_nombre_completo,
                "html"=>'<div class="col-12 p-0 m-0">
                        <label>'.$reg->usu_nombre_completo.'<br>
                            <small>'.$reg->usu_tipo_doc.': '.$reg->usu_numero_doc.'</small>
                        </label>
                    </div>',
                "title"=>$reg->usu_tipo_doc.': '.$reg->usu_numero_doc.' - '.$reg->usu_nombre_completo,
                "nombre"=> $reg->usu_nombre_completo,
            ];
        }
        // Devolver los resultados en formato JSON
        echo json_encode($result);
    }
    public function seleccionar_usuario_compartido()
    {
        $limite = isset($_GET['limite']) ? $_GET['limite'] : 10;
        // $limite = 10;
        $searchTerm = isset($_GET['q']) ? "%" . $_GET['q'] . "%" : "%"; // Establecer el término de búsqueda (si no se proporciona, dejar en blanco para obtener todos los resultados)
        $fol_id = $_GET['condicion'];
        $rpta = $this->gestor->seleccionar_usuario_compartido_lazy_load($_GET['page'], $searchTerm, $_SESSION['usu_id'], $fol_id, $limite);
        // Calcular si hay más resultados
        $more = count($rpta) == $limite;

        // Construir el array de resultados para ser devuelto
        $result = 
        [
            'items' => [],
            'pagination' => 
            [
                'more' => $more
            ]
        ];
        // Recorrer los resultados y formatearlos
        foreach ($rpta as $reg) 
        {
            $result['items'][] = 
            [
                "selected" => true, // Marca este elemento como seleccionado
                
                "id"=>$reg->usu_id,
                "text"=>$reg->usu_tipo_doc.': '.$reg->usu_numero_doc.' - '.$reg->usu_nombre_completo,
                "html"=>'<div class="col-12 p-0 m-0">
                        <label>'.$reg->usu_nombre_completo.'<br>
                            <small>'.$reg->usu_tipo_doc.': '.$reg->usu_numero_doc.'</small>
                        </label>
                    </div>',
                "title"=>$reg->usu_tipo_doc.': '.$reg->usu_numero_doc.' - '.$reg->usu_nombre_completo,
                "nombre"=> $reg->usu_nombre_completo,
            ];
        }
        // Devolver los resultados en formato JSON
        echo json_encode($result);
    }
    //funcion para obtener un dato especifico
    public function usuarios_compartidos()
    {
        $fol_id = $_POST['fol_id'];
        $idsASeleccionar = [];
        $model = $this->gestor->usuarios_compartidos($fol_id);
        foreach($model as $m)
        {
            if($m->sha_estado == 1 || $m->sha_estado_final == 1)
            {
                $idsASeleccionar[] = $m->usu_id;
            }
        }
        echo json_encode($idsASeleccionar);
    }
    public function guardar_compartir()  //funcion para guardar y editar los datos
    {      
        try
        {
            $model = new FileManager();
            $model->usuarios = $_POST['usu_id'];
            $model->fol_id = $_POST['comp_fol_id'];
            $model->comp_tipo = $_POST['comp_tipo'];
            $model->comp_fol_url = $_POST['comp_fol_url'];
            $model->remover_usuario = (isset($_POST['remover_usuario']))? 1: 0;
            $result = $this->gestor->guardar_compartir($model);
            
            if($result == 1)
            {
                $rpta =  "ok";
                if($model->remover_usuario ==1)
                {
                    $mensaje = ($_POST['comp_tipo'] == 0)? 'Has revocado el acceso de un usuario <br> ya no podrá ver los archivos o carpetas compartidos' : 'Has revocado el acceso de un usuario <br> ya no podrá ver el archivo compartido.';
                }
                else
                {
                    $mensaje = ($_POST['comp_tipo'] == 0)? 'Se compartio correctamente la carpeta' : 'Se compartio correctamente el archivo';
                }
            }
            else
            {
                $rpta =  "error";
                if($model->remover_usuario ==1)
                {
                    $mensaje = 'Hubo un error al tratar de revocar el acceso a un usuario';
                }
                else
                {
                    $mensaje = ($_POST['comp_tipo'] == 0)? 'Hubo un error al tratar de compartir la Carpeta' : 'Hubo un error al tratar de compartir el Archivo';
                }
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__); 
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
}