<?php
//importamos los archivos del model
require_once 'app/models/Navbar.php';
require_once 'app/models/Anular.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php';
require_once 'app/models/Globals.php';
require_once 'app/models/Serverside.php';
//facturacion electronica
require_once 'asset/API_SUNAT_2.0/api/generar_xml.php';
require_once 'asset/API_SUNAT_2.0/api/api_sunat.php';

class AnularController
{
    private $navbar;
    private $anular;
    private $global;
    private $bitacora;
    private $log;
    private $serverside;   
    private $xml;
    private $api_sunat; 
    
    public function __construct()
    {
        $this->serverside = new Serverside();
        $this->navbar = new Navbar();
        $this->anular = new Anular();
        $this->bitacora = new Bitacora();
        $this->log = new Log();
        $this->global = new Config();
        $this->xml = new GenerarXML();
        $this->api_sunat = new ApiSunat();
    }
    //funcion para cargar la vista de anulacion de facturas electronicas
    public function mostrar()
    {
        $config = $this->global->obtener_configuracion();// para las configuraciones

        $opc_modulo = $this->navbar->obtener_opcion_modulo($_GET['c']);
        $modulo = $opc_modulo->mod_nombre;
        $ico_modulo = $opc_modulo->mod_icono;
        $nombre_opcion = $opc_modulo->opc_nombre;

        $modulos = $this->navbar->obtener_modulos();
        $modulos_rol = $this->navbar->obtener_modulos_rol($_SESSION['rol_id']);
        $permisos_usuario = $this->navbar->obtener_permisos_rol($_SESSION['rol_id']);

        $sucursales = $this->navbar->cantidad_sucursales($_SESSION['emp_id']); 

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'modulo_facturacion/anular/anular.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function seleccionar_trabajador()
    {
        $rpta = $this->global->seleccionar_trabajador();
        if($rpta)
        {
            echo '<option value="" disabled selected>Seleccione una opcion</option>';
            foreach ($rpta as $reg)
            {
                echo '<option value="'.$reg->tra_id.'" >'.$reg->tip_ide_abrev.': '.$reg->tra_num_doc.' - '.$reg->tra_nombre_completo.'</option>';
            }
        }
    }
    public function seleccionar_sucursal()
    {
        $emp_id = $_SESSION['emp_id'];
        $rpta = $this->global->seleccionar_sucursal($emp_id);
        if($rpta)
        {
            echo '<option value="" disabled selected>--Seleccione--</option>';
            foreach ($rpta as $reg)
            {
                echo '<option value='.$reg->suc_id.'>'.$reg->suc_nombre_comercial.'</option>';
            }
        }
    }
    public function listar_resumen_anulaciones()
    {
        $tabla= 'envio_resumen e inner join trabajador t on t.tra_id = e.tra_id INNER JOIN sucursal as s ON s.suc_id = e.suc_id
        INNER JOIN resumen_detalles as r ON e.env_id = r.res_id INNER JOIN venta as v ON v.ven_id = r.ven_id';

        $columnas = array(
            0 => 'e.observacion_sunat',
            1 => 's.suc_nombre_comercial',
            2 => 't.tra_nombre_completo', 
            3 => 'e.fecha_envio',
            4 => 'e.fecha_doc', 
            5 => 'e.env_identificador', 
            6 => 'e.nombre_xml',
            7 => 'e.ticket', 
            8 => 'e.estado', 
            9 => 'date_format(e.fecha_envio, "%d/%m/%Y %h:%m %p")',//creo esta columna para que el buscador del datatable pueda buscar en este formato la fecha 
            10 => 'date_format(e.fecha_doc, "%d/%m/%Y")',//creo esta columna para que el buscador del datatable pueda buscar en este formato la fecha 
            11 => 'e.codigo_sunat', 
            12 => 's.suc_direccion',
            13 => 'e.env_id',
            14 => 'e.suc_id',
            15 => 'v.ven_serie',
            16 => 'v.ven_correlativo',
            17 => 'r.ven_id',
        );   
        $filtro = "e.tipo_resumen IN (2,3)";
        if($_GET['select_filtro'] == 1)
        {
            $filtro = "DATE(e.fecha_envio) = '$_GET[filtro_fecha]'";
        }
        else if($_GET['select_filtro'] == 2)
        {
            $filtro = "( DATE(e.fecha_envio) BETWEEN '$_GET[filtro_fecha_inicio]' AND '$_GET[filtro_fecha_fin]' )";
        }
        else if($_GET['select_filtro'] == 3)
        {
            $filtro = "DATE_FORMAT(e.fecha_envio, '%Y-%m') = '$_GET[filtro_mes_anio]'";
        }

        if(($_GET['filtro_trabajador'] != 'null'))
        {
            if ( $filtro != "" ) { $filtro .= " AND "; }
            $filtro .=  "e.tra_id = '$_GET[filtro_trabajador]'";
        }
        if(($_GET['filtro_ticket'] != ''))
        {
            if ( $filtro != "" ) { $filtro .= " AND "; }
            $filtro .=  "e.ticket LIKE '%$_GET[filtro_ticket]%' ";
        }
        if(($_GET['filtro_estado_sunat'] != 'null'))
        {
            if ( $filtro != "" ) { $filtro .= " AND "; }
            $filtro .= "e.estado = '$_GET[filtro_estado_sunat]'"; 
        }
        if($_SESSION['suc_defecto'] != '0')
        {
            if ( $filtro != "" ) { $filtro .= " AND "; }
            $filtro .=  "e.suc_id = '$_GET[filtro_sucursal]' ";
        }
        $model = $this->serverside->listado_serverside($tabla, 'e.env_id', $columnas, $filtro, null);
        $data = array();
        $i= ($_GET['iDisplayStart'] + 1);

        foreach ($model['result'] as $m)
        {
            if($m->estado == 0) { $title = 'Resumen Aceptado'; $ico_estado_sunat = 'fas fa-check'; $estado_sunat = 'ACEPTADO'; $color_estado_sunat = 'success'; }
            else if($m->estado == 99) { $title = 'Resumen Rechazado'; $ico_estado_sunat = 'fas fa-ban'; $estado_sunat = 'RECHAZADO'; $color_estado_sunat = 'danger'; }
            else if($m->estado) { $title = 'Verificar Resumen'; $ico_estado_sunat = 'fa-solid fa-circle-info'; $estado_sunat = 'Verificar'; $color_estado_sunat = 'warning'; }

            $data[]=array(
                "0"=>$i,
                "1"=>'<span>'.$m->suc_nombre_comercial.'<br><small>DIRECCION: '.$m->suc_direccion.'</small></span>',
                "2"=>$m->tra_nombre_completo,
                "3"=>date("d/m/Y h:i A", strtotime(($m->fecha_envio))),
                "4"=>date("d/m/Y", strtotime(($m->fecha_doc))),
                "5"=>$m->env_identificador,
                "6"=>'<div class="text-center p-0 m-0">'.$m->ven_serie.'-'.$m->ven_correlativo.'</div>',
                "7"=>$m->ticket,
                "8"=>'<div class="text-center">
                        <a class="tooltip_tippy" href="../asset/API_SUNAT_2.0/documentos/xml/anulacion/'.$m->nombre_xml.'.xml" download="" data-tippy-content="<small>Descargar el XML</small>">
                            <img class="img_icon" src="../styles/img/archivo_xml.png" title="Descargar XML">
                        </a>
                        </div>',
                "9"=>($m->estado==='98')?'<div class="text-center tooltip_tippy" data-tippy-content="<small>Consultar Ticket en Sunat</small>"><img onclick="consultar_resumen('.$m->suc_id.','.$m->ven_id.','.$m->env_id.',\''.$m->ticket.'\',\''.$m->nombre_xml.'\')" class="img_icon" src="../styles/img/sunat_logo.png"></div>':
                    ($m->estado ==='99' || $m->estado ==='0')?
                    '<div class="text-center">
                            <a class="tooltip_tippy" href="../asset/API_SUNAT_2.0/documentos/cdr/anulacion/R-'.$m->nombre_xml.'.zip" download="" data-tippy-content="<small>Descargar el CDR</small>">
                                <img class="img_icon" src="../styles/img/archivo_cdr.png">                        
                            </a>
                    </div>' : 
                    '<div class="p-0 m-0 text-center">
                        <a class="nav-link text-warning badge tooltip_tippy" data-tippy-content="<small>Verificar Resumen</small>" data-toggle="dropdown" href="#" aria-expanded="true" style="font-size: 20px">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>    
                    </div>',
                "10"=>($m->estado==='98')?'<div class="text-center tooltip_tippy" data-tippy-content="<small>Consultar Ticket en Sunat</small>"><img onclick="consultar_resumen('.$m->suc_id.','.$m->ven_id.','.$m->env_id.',\''.$m->ticket.'\',\''.$m->nombre_xml.'\')" class="img_icon" src="../styles/img/sunat_logo.png"></div>':
                '<ul class="navbar-nav text-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-'.$color_estado_sunat.' badge" data-toggle="dropdown" href="#" aria-expanded="false" aria-haspopup="true" style="font-size: 20px">
                            <i class="'.$ico_estado_sunat.' tooltip_tippy" data-tippy-content="<small>'.$title.'</small>"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="width: 10%">
                            <span class="dropdown-item dropdown-header"  style="background-color: #f5f5f5; color: #333">INFORMACIÓN</span>
                                <a href="#" class="dropdown-item"> <i class="fas fa-file mr-2"></i>IDENTIFICADOR 
                                    <span class="float-right text-sm badge bg-gradient-'.$color_estado_sunat.'">'.$m->env_identificador.'</span>
                                </a>
                                <div id="" class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"> <i class="fas fa-file-invoice mr-2"></i>TICKET 
                                    <span class="float-right text-sm badge bg-gradient-'.$color_estado_sunat.'">'.$m->ticket .'</span>
                                </a>
                                <div id="" class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"> <i class="fas fa-circle mr-2"></i>ESTADO 
                                    <span class="float-right text-sm badge bg-gradient-'.$color_estado_sunat.'">'.$estado_sunat.'</span>
                                </a>
                                <div id="" class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"> <i class="fas fa-file-code mr-2"></i>CODIGO 
                                    <span class="float-right text-sm badge bg-gradient-'.$color_estado_sunat.'">'.$m->codigo_sunat.'</span>
                                </a>
                                <div id="" class="dropdown-divider"></div>
                            <span class="dropdown-item text-left dropdown-header col-12" style="background-color: #f5f5f5; color: #333; white-space: normal; word-wrap: break-word; text-align : justify !important;">
                                OBSERVACION: '.$m->observacion_sunat.'
                            </span>
                        </div>
                    </li>
                </ul>',
                "11"=>$m->estado,
            );
            $i++;
        }
		// Output
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $model['iTotalRecords'],
			"iTotalDisplayRecords" => $model['iTotalDisplayRecords'],
			"aaData" => $data
		);
		echo json_encode( $output );
    }
    //funcion para listar las boletas pendientes de envio
    public function listar_documentos()
    {
        $fechaBuscar = $_REQUEST['fecha_inicio'];
        $model = $this->anular->listar_documentos($fechaBuscar);
        $data = array();
        $i=1;
        foreach ($model as $m)
        {
            $data[]=array(
                "0"=>'<div class="text-center p-0 m-0">'.$i.'</div>',
                "1"=>'<span>'.$m->suc_nombre_comercial.'<br><small>DIRECCION: '.$m->suc_direccion.'</small></span>',
                "2"=>$m->ven_serie.'-'.$m->ven_correlativo.' <br><small>'.$m->tipo_nombre.'</small> ',
                "3"=>date("d/m/Y h:i:s A",strtotime($m->ven_fecha)),
                "4"=>date("d/m/Y",strtotime($m->ven_fecha_envio)),
                "5"=>'<div class="text-center p-0 m-0">'.$m->ven_importe_total.'</div> ',
                "6"=>'<div class="text-center p-0 m-0"><span class="badge bg-gradient-success">ACEPTADO</span></div>',
                "7"=>'<div class="text-center p-0 m-0"><button class="btn btn-outline-danger btn-flat btn-sm tooltip_tippy" type="button" onclick="anular_documento_electronico('.$m->ven_id.',\''.$m->ven_serie.'\',\''.$m->ven_correlativo.'\',\''.date("Y-m-d", strtotime($m->ven_fecha)).'\',\''.$m->suc_id.'\',\''.$m->ven_tipo_doc.'\',\''.$m->tipo_cod.'\')" data-tippy-content="<small>Anular documento electronico</small>"><i class="fa-regular fa-circle-xmark"></i> Anular</button></div>',
            );
            $i++;
        }
        $result = array(
            "sEcho"=>1,//para numerar el datatable   btn btn-success
            "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
            "iTotalDisplayRecords"=>count($data),//enviamos el total de registros  a visualizar al datatable
            "aaData"=>$data);
        echo json_encode($result);
    }
    public function correlativo_resumen($tipo)
    {
        $numeracion = ($tipo == 0)? $this->anular->correlativo_resumen_anulacion(date('Y-m-d')) : $this->anular->correlativo_resumen_anulacion_boletas(date('Y-m-d')); //correlativo del resumen
        $correlativo = (empty($numeracion))? 1 : $numeracion->correlativo + 1;
        return $correlativo;
    }
    public function anular_documento_electronico()
    {
        try
        {
            $conec = $this->global->com_internet();//verificamos la conexion del internet
            $ven_id = $_POST['ven_id'];
            $suc_id = $_POST['suc_id'];
            $tra_id = ($_POST['tra_id'] == '')? $_SESSION['tra_id'] : $_POST['tra_id'];
            $doc_serie = $_POST['serie'];
            $doc_correlativo = $_POST['correlativo'];
            $doc_codigo_documento = $_POST['cod_tipo'];
            $motivo_anulacion = preg_replace("/[\r\n|\n|\r]+/", " ", $_POST['motivo']);
            $fecha_documento = $_POST['fecha_emision'];
            $tipo_documento = $_POST['tipo_documento'];
            $verificar = $this->anular->verificar_nota_is_boleta($ven_id);
            if($conec)
            {
                $emisor = $this->global->obtener_datos_sucursal($suc_id);
                if($tipo_documento === '1' || ($tipo_documento === '3' && $verificar ===  '1') || ($tipo_documento == 4 && $verificar === '1'))
                {
                    $correlativo = $this->correlativo_resumen(0); //correlativo del resumen
                    $tipo_resumen = 2; 
                    $create_xml = $this->xml->generar_xml_baja_documento($emisor, $doc_serie, $doc_correlativo, $doc_codigo_documento, $motivo_anulacion, $correlativo, $fecha_documento);//generar xml
                }   
                else if($tipo_documento === '2' || ($tipo_documento === '3' && $verificar === '2') || ($tipo_documento == 4 && $verificar === '2'))
                {
                    $correlativo = $this->correlativo_resumen(1); //correlativo del resumen
                    $tipo_resumen = 3; 
                    $documento = $this->anular->obtener_documento($ven_id);
                    $create_xml = $this->xml->generar_xml_baja_resumen($emisor, $documento, $correlativo, $fecha_documento);//generar xml
                } 
                if($create_xml['rpta'] == "ok")
                {
                    $xml_firma = $this->xml->firmar_xml($emisor->emp_certificado, $emisor->emp_contrasena_cert, $emisor->emp_produccion, $create_xml['path_file']);
                    if($xml_firma['rpta'] == 'ok')
                    {
                        $ticket = $this->api_sunat->enviar_resumen_sunat($emisor->emp_ruc, $emisor->emp_usuario_sol, $emisor->emp_clave_sol, $emisor->emp_produccion, $create_xml['nombre_archivo'], 'RA');//enviamos el xml del resumen a sunat
                        if($ticket['rpta'] == 'ok')
                        {
                            $fecha_envio =  date('Y-m-d H:i:s');
                            $this->anular->guardar_resumen_envio_sunat($tra_id, $suc_id, $fecha_envio, $fecha_documento, $correlativo, $tipo_resumen, $create_xml['identificador'], $create_xml['nombre_archivo'], $ticket['ticket']);
                            $resumen = $this->anular->obtener_ultimo_resumen_id();
                            
                            $data = $this->anular->obtener_datos_documento($ven_id);
                            $this->anular->anular_comprobante_electronico($ven_id, $resumen->env_id, $data->suc_id, $tra_id, $motivo_anulacion, $data->ven_tipo_doc, $data->ven_serie, $data->ven_correlativo);
                            if($data->ven_movimiento === 'POS RESERVA')
                            {
                                $pago = $this->anular->obtener_pago_reserva($ven_id);
                                $res = $this->anular->estado_reserva($pago->res_id);
                                $this->anular->anular_pago_reserva($pago->pag_id, $pago->res_id, $tra_id, $res->res_estado);                    
                            }
                            if($data->ape_estado == 1 && ($data->ven_tipo_doc == 1 || $data->ven_tipo_doc == 2 || $data->ven_tipo_doc == 9) )//si la caja se encuenta cerrada y sea factura boleta o nota de venta
                            {
                                $salida = $data->ape_salida - $data->ven_importe_total;
                                $this->anular->actualizar_apertura($salida,$data->ape_id);
                            }
                            set_time_limit(50);
                            $consulta_ticket = $this->api_sunat->consultar_ticket_sunat($emisor->emp_ruc, $emisor->emp_usuario_sol, $emisor->emp_clave_sol, $emisor->emp_produccion, $create_xml['nombre_archivo'], $ticket['ticket'], 'RA');
                            if($consulta_ticket['rpta'] == 'ok')
                            {
                                if($consulta_ticket['cdr_ResponseCode'] == '98') // Sunat todavia se encuentra procesando la respuesta. Intentelo mas tarde 
                                {
                                    $respuesta['rpta'] = 'consultar';
                                    $respuesta['ticket'] = $ticket['ticket'];
                                    $respuesta['mensaje'] = $ticket['mensaje'];    
                                }
                                else
                                {
                                    $this->anular->guardar_respuesta_sunat_resumen($consulta_ticket['cdr_msj_sunat'], $consulta_ticket['cod_sunat'], $consulta_ticket['cdr_ResponseCode'], $resumen->env_id, $ven_id);
                                    $respuesta['rpta'] = 'ok';
                                    $respuesta['ticket'] = $ticket['ticket'];
                                    $respuesta['codigo'] = $consulta_ticket['cod_sunat'];
                                    $respuesta['mensaje'] = $consulta_ticket['cdr_msj_sunat'];
                                }
                            }
                            else // EN CASO QUE FALLE AL MOMENTO DE CONSULTAR EL TICKET SE ENVIARA LA RESPUESTA DEL TICKET(NO ENVIO EL ERROR DE LA CONSULTA POR QUE ESO LO ENVIARE EN LA FUNCION CONSULTAR RESUMEN)
                            {
                                $respuesta['rpta'] = 'consultar';
                                $respuesta['ticket'] = $ticket['ticket'];
                                $respuesta['mensaje'] = $ticket['mensaje'];
                            }    
                        }
                        else
                        {
                            $respuesta['rpta'] = 'error';
                            $respuesta['codigo'] = $ticket['codigo_sunat'];
                            $respuesta['mensaje'] = $ticket['mensaje'];
                        }
                    }
                    else
                    {
                        $respuesta['rpta'] = 'error';
                        $respuesta['codigo'] = 'firma_xml_error';
                        $respuesta['mensaje'] = $xml_firma['mensaje'];
                    }
                }
                else
                {
                    $respuesta['rpta'] = 'error';
                    $respuesta['codigo'] = 'crear_xml_error';
                    $respuesta['mensaje'] = $create_xml['mensaje'];
                }
            }
            else
            {
                $respuesta['rpta'] = 'conexion';
                $respuesta['codigo'] = 'internet';
                $respuesta['mensaje'] = 'No se pudo establecer conexion a Internet o la conexion es demasiado lenta,Intente una vez mas';
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $respuesta['rpta'] = 'error';
            $respuesta['codigo'] = 'error';
            $respuesta['mensaje'] = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode($respuesta);
    }
    public function consultar_resumen() //funcion para consultar el ticket del resumen
    {
        try
        {
            $ticket = $_POST['ticket'];
            $nombre_archivo = $_POST['nombre_archivo'];
            $env_id = $_POST['env_id'];
            $ven_id = $_POST['ven_id'];
            $suc_id = $_POST['suc_id'];
            $conec = $this->global->com_internet();//verificamos la conexion del internet
            if($conec)
            {
                $emisor = $this->global->obtener_datos_sucursal($suc_id);
                set_time_limit(50);
                $consulta_ticket = $this->api_sunat->consultar_ticket_sunat($emisor->emp_ruc, $emisor->emp_usuario_sol, $emisor->emp_clave_sol, $emisor->emp_produccion, $nombre_archivo, $ticket, 'RC');
                if($consulta_ticket['rpta'] == 'ok')
                {
                    if($consulta_ticket['cdr_ResponseCode'] == '98') // Sunat todavia se encuentra procesando la respuesta. Intentelo mas tarde 
                    {
                        $respuesta['rpta']      = 'consultar';
                        $respuesta['ticket']    = $ticket;
                        $respuesta['codigo']    = $consulta_ticket['cdr_ResponseCode'];
                        $respuesta['mensaje']   = $consulta_ticket['cdr_msj_sunat'];    
                    }
                    else
                    {
                        $this->anular->guardar_respuesta_sunat_resumen($consulta_ticket['cdr_msj_sunat'], $consulta_ticket['cod_sunat'], $consulta_ticket['cdr_ResponseCode'], $env_id, $ven_id);
                        $respuesta['rpta'] = 'ok';
                        $respuesta['ticket']    = $ticket;
                        $respuesta['codigo'] = $consulta_ticket['cod_sunat'];
                        $respuesta['mensaje'] = $consulta_ticket['cdr_msj_sunat'];
                    }
                }
                else 
                {
                    $respuesta['rpta'] = 'error';
                    $respuesta['codigo'] = $consulta_ticket['cod_sunat'];
                    $respuesta['mensaje'] = $consulta_ticket['cdr_msj_sunat'];
                }
            }
            else
            {
                $respuesta['rpta'] = 'conexion';
                $respuesta['codigo'] = 'internet';
                $respuesta['mensaje'] = 'No se pudo establecer conexion a Internet o la conexion es demasiado lenta,Intente una vez mas';
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $respuesta['rpta'] = 'error';
            $respuesta['codigo'] = 'error';
            $respuesta['mensaje'] = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode($respuesta);
    }
    public function verficar_contrasena_administrador()
    {
        $pass = $_POST['pass'];
        $result = $this->global->verficar_contrasena_administrador();
        if(empty($result))
        {
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        else
        {
            foreach ($result as $reg)
            {
                if(password_verify($pass, $reg->usu_clave))
                {
                    $rpta = 'ok';
                    $tra_id = $reg->tra_id;
                    $mensaje = 'Contraseña Ingresada Correctamente';
                    break;
                }
                else
                {
                    $rpta = 'error';
                    $mensaje = 'La Contraseña ingresada es Incorrecta, Por favor, Intente nuevamente.';
                    $tra_id = null;
                }
            }
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje, "tra_id" => $tra_id));
    }
}