<?php
//importamos los archivos del model
require_once 'app/models/Eventos.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php'; 

class SolicitudesController
{
    private $navbar;
    private $evento;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->evento = new Eventos();
        $this->bitacora = new Bitacora();
        $this->log = new Log();
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
        require_once _VIEW_PATH_ . 'eventos/solicitud.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function listar()
    {
        $model = $this->evento->listar_pendientes();
        $data = array();
        $i=1;
        foreach ($model as $m)
        {
            $artistas = $this->evento->obtener_artistas_conciertos($m->con_id);
            $templade = '';
            foreach ($artistas as $a)
            {
                $templade .= '<li style="white-space: normal; word-wrap: break-word; text-align : justify !important;">'.$a->art_nombre.' -HORA PRESENTACION: '.date("d/m/Y h:i:s A", strtotime($a->art_con_horario_presentacion)).'</li> ';
            }

            $data[]=array(
                "0"=>$i,
                "1"=>$m->cli_nombre,
                "2"=>$m->con_nombre.'<br><small>'.$m->con_subtitulo.'</small>' ,
                "3"=>'<span style="white-space: normal; word-wrap: break-word; text-align : justify !important;">'.$m->con_descripcion.'</span>',
                "4"=>date("d/m/Y h:i:s A", strtotime($m->con_fecha.' '.$m->con_hora)),
                "5"=>$m->loc_nombre.'<br><small>DIRECCION: '.$m->loc_direccion.' - CIUDAD: '.$m->loc_ciudad.'</small>' ,
                "6"=>$m->cat_nombre,
                "7"=>$templade,
                "8"=>($m->con_imagen)?"<div class='text-center'><img data-fancybox='gallery".$m->con_id."' src='"._SERVER_."media/concierto_logo/".$m->con_imagen."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",
                "9"=>($m->con_portada)?"<div class='text-center'><img data-fancybox='gallery".$m->con_id."' class='portada' src='"._SERVER_."media/concierto_portada/".$m->con_portada."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",
                // "10"=>($m->con_estado)?'<span class="badge bg-gradient-success"> YA REALIZADO</span>':'<span class="badge bg-gradient-danger">EN VENTA</span>',
                "10"=>$this->estado = ($m->con_estado == 0)?'<span class="badge bg-gradient-orange"> ESPERANDO<br>CONFIRMACION  </span>': 
                    $this->estado = ($m->con_estado == 1)? '<span class="badge bg-gradient-success">EVENTO<br>APROBADO</span>' : 
                    $this->estado = ($m->con_estado == 2)? '<span class="badge bg-gradient-warning">EVENTO<br>RECHAZADO</span>' : '<span class="badge bg-gradient-primary">EVENTO<br>REALIZADO</span>',
                "11"=> ' <button data-tippy-content="<small>Activar Eventos</small>" class="tooltip_tippy btn btn-success btn-circle btn-sm btn-flat" onclick="activar('."1".','.$m->con_id.')"><i class="fas fa-check"></i> Aprobar</button>'.
                    ' <button data-tippy-content="<small>Rechazar Evento</small>"  class="tooltip_tippy btn btn-primary btn-circle btn-sm btn-flat" onclick="rechazar('."2".','.$m->con_id.')"><i class="fas fa-ban"></i> Rechazar</button>'
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
    public function activar_desactivar()
    {
        try
        {
            $con_id = $_POST['con_id'];
            $con_estado = $_POST['con_estado'];
            
            $result = $this->evento->activar_desactivar($con_estado,$con_id);
            if($result !== 1 && $result !== 2 && $result !== 3) 
            {
                $this->bitacora->guardar('Fallo Al cambiar estado de Eventos con ID: ' . $con_id, 'Falla Sistema');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Eventos activado con ID: ' . $con_id, 'Activado');
                $rpta = 'ok';
                $mensaje = 'La Eventos fue Activado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Eventos Desactivado con ID: ' . $con_id, 'Desactivado');
                $rpta = 'ok';
                $mensaje = 'La Eventos fue Desactivado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Eventos activado con ID: ' . $con_id, 'Activado');
                $rpta = 'ok';
                $mensaje = 'Evento Rechazado Correctamente correctamente';
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