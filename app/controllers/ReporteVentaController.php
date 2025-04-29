<?php
//importamos los archivos del model
require_once 'app/models/ReporteVenta.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php'; 
require_once 'app/models/Serverside.php';

class ReporteVentaController
{
    private $navbar;
    private $reporte;
    private $bitacora;
    private $log;
    private $serverside;    
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->reporte = new ReporteVenta();
        $this->bitacora = new Bitacora();
        $this->log = new Log();
        $this->serverside = new Serverside();
    }
    //funcion para cargar la vista
    public function mostrar() 
    {
        $opc_modulo = $this->navbar->obtener_opcion_modulo($_GET['c']);
        $modulo = $opc_modulo->mod_nombre;
        $ico_modulo = $opc_modulo->mod_icono;
        $nombre_opcion = $opc_modulo->opc_nombre;

        $modulos = $this->navbar->obtener_modulos();
        $modulos_rol = $this->navbar->obtener_modulos_rol($_SESSION['rol_id']);
        $permisos_usuario = $this->navbar->obtener_permisos_rol($_SESSION['rol_id']);

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'reportes/reporte.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function listar_clientes()
    {
        $model = $this->reporte->listar_clientes();
        echo '<option value="" disabled selected>Seleccione una opcion</option>';
        foreach ($model as $m)
        {
            echo '<option value="'.$m->usu_id.'">'.$m->usu_nombre_completo.'</option>';
        }
    }
    public function reporte_general()
    {
        $tabla= 'venta as v INNER JOIN usuario as u ON u.usu_id = v.usu_id';

        $columnas = array(
            0 => 'v.ven_id', 
            1 => 'v.usu_id', 
            2 => 'v.tipo_pago', 
            3 => 'v.ven_fecha', 
            4 => 'v.ven_total', 
            5 => 'v.ven_estado',
            6 => 'u.usu_nombre_completo',
            7 => 'u.usu_numero_doc',
            8 => 'u.usu_tipo_doc', 
            28 => 'date_format(v.ven_fecha, "%d/%m/%Y %h:%i %p")',//creo esta columna para que el buscador del datatable pueda buscar en este formato la fecha 
        );   

        $filtro = "";
        
        if ( $filtro != "" ) { $filtro .= " AND "; }
        $filtro .= "( DATE(v.ven_fecha) BETWEEN '$_GET[filtro_fecha_inicio]' AND '$_GET[filtro_fecha_fin]' )";


        if(!empty($_GET['filtro_cliente']) && $_GET['filtro_cliente'] != 'null')
        {
            if ( $filtro != "" ) { $filtro .= " AND "; }
            $filtro .=  "v.usu_id IN (".$_GET['filtro_cliente'].") ";
        }

        $model = $this->serverside->listado_serverside($tabla, 'v.ven_id', $columnas, $filtro, null);
        $data = array();
        $i= ($_GET['iDisplayStart'] + 1);
        foreach ($model['result'] as $m)
        {
            $data[]=array(
                "0"=> $i,
                "1"=>'<span>'.$m->usu_nombre_completo.'<br><small>'.$m->usu_tipo_doc.' : '.$m->usu_numero_doc.'</small></span>',
                "2"=>$m->tipo_pago,
                "3"=>date("d/m/Y h:i A", strtotime($m->ven_fecha)),
                "4"=>$m->ven_total,
                "5"=>($m->ven_estado)?'<span class="badge bg-gradient-success"> Activo</span>':'<span class="badge bg-gradient-danger">Inactivo</span>',
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
    public function generar_documento()
    {
        $filtro = "";
        $name_filtro = "";
        if($_POST['select_filtro'] == 1)
        {
            $name_filtro = 'DEL DIA '.date("d/m/Y", strtotime($_POST['filtro_fecha_inicio']));
        }
        else if($_POST['select_filtro'] == 2)
        {
            $name_filtro = 'DEL '.date("d/m/Y", strtotime($_POST['filtro_fecha_inicio'])). ' AL '. date("d/m/Y", strtotime($_POST['filtro_fecha_fin']));
        }
        else if($_POST['select_filtro'] == 3)
        {
            $mes = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SETIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];
            $name_filtro = 'DEL MES DE '. $mes[date("n", strtotime(($_POST['filtro_fecha_inicio']))) - 1]. ' DEL '.date("Y", strtotime(($_POST['filtro_fecha_fin'])));
        }
        $filtro = "( DATE(v.ven_fecha) BETWEEN '$_POST[filtro_fecha_inicio]' AND '$_POST[filtro_fecha_fin]' )";
        
        if(!empty($_POST['filtro_cliente']) && $_POST['filtro_cliente'] != 'null')
        {
            if ( $filtro != "" ) { $filtro .= " AND "; }
            $suc_id =  $_POST['filtro_cliente'];
            $filtro .=  "v.usu_id IN (".$_GET['filtro_cliente'].") ";
        }
        
        $registros = $this->reporte->reporte_venta($filtro);
        require 'reportes/dompdf/reporte_ventas.php';

        $response =  array( 'rpta' => $rpta, 'mensaje' => $mensaje, 'name' => $nombre_pdf, 'file' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData));
        echo json_encode($response);
    }
}
