<?php
//importamos los archivos del model
require_once 'app/models/Eventos.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php'; 

class MisEventosController
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
        require_once _VIEW_PATH_ . 'eventos/mis_eventos.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function verificar_permiso()
    {
        echo 'ok';
    }
    //funcion para listar los datos
    public function listar()
    {
        $model = $this->evento->listar();
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
                "10"=>($m->con_estado)?'<span class="badge bg-gradient-success"> YA REALIZADO</span>':'<span class="badge bg-gradient-danger">EN VENTA</span>',
                "11"=> 
                    $this->isDefaulf = ($m->con_estado == 0)?'<button data-tippy-content="<small>Editar Eventos</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="editar('.$m->con_id.')"><i class="fas fa-edit"></i></button></a>'.
                    ' <button data-tippy-content="<small>Desactivar Eventos</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="desactivar('."1".','.$m->con_id.')"><i class="fas fa-toggle-on"></i></button>'.
                    ' <button hidden data-tippy-content="<small>Eliminar Eventos</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="eliminar('.$m->con_id.')"><i class="fas fa-trash"></i></button>':
                    ' <button data-tippy-content="<small>Activar Eventos</small>" class="tooltip_tippy btn btn-success btn-circle btn-sm btn-flat" onclick="activar('."0".','.$m->con_id.')"><i class="fas fa-toggle-off"></i></button>'
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
    public function listar_por_cliente()
    {
        $model = $this->evento->listar_por_cliente($_SESSION['cli_id']);
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
                "1"=>$m->con_nombre.'<br><small>'.$m->con_subtitulo.'</small>' ,
                "2"=>'<span style="white-space: normal; word-wrap: break-word; text-align : justify !important;">'.$m->con_descripcion.'</span>',
                "3"=>date("d/m/Y h:i:s A", strtotime($m->con_fecha.' '.$m->con_hora)),
                "4"=>$m->loc_nombre.'<br><small>DIRECCION: '.$m->loc_direccion.' - CIUDAD: '.$m->loc_ciudad.'</small>' ,
                "5"=>$m->cat_nombre,
                "6"=>$templade,
                "7"=>($m->con_imagen)?"<div class='text-center'><img data-fancybox='gallery".$m->con_id."' src='"._SERVER_."media/concierto_logo/".$m->con_imagen."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",
                "8"=>($m->con_portada)?"<div class='text-center'><img data-fancybox='gallery".$m->con_id."' class='portada' src='"._SERVER_."media/concierto_portada/".$m->con_portada."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",
                "9"=>$this->estado = ($m->con_estado == 0)?'<span class="badge bg-gradient-orange"> ESPERANDO<br>CONFIRMACION  </span>': 
                    $this->estado = ($m->con_estado == 1)? '<span class="badge bg-gradient-danger">EVENTO<br>APROBADO</span>' : 
                    $this->estado = ($m->con_estado == 2)? '<span class="badge bg-gradient-warning">EVENTO<br>RECHAZADO</span>' : '<span class="badge bg-gradient-primary">EVENTO<br>REALIZADO</span>',
                "10"=> 
                    $this->isDefaulf = ($m->con_estado == 0)?'<button data-tippy-content="<small>Editar Eventos</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="editar('.$m->con_id.')"><i class="fas fa-edit"></i></button></a>'.
                    ' <button hidden data-tippy-content="<small>Desactivar Eventos</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="desactivar('."1".','.$m->con_id.')"><i class="fas fa-toggle-on"></i></button>'.
                    ' <button data-tippy-content="<small>Eliminar Eventos</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="eliminar('.$m->con_id.')"><i class="fas fa-trash"></i></button>':
                    ' <button hidden data-tippy-content="<small>Activar Eventos</small>" class="tooltip_tippy btn btn-success btn-circle btn-sm btn-flat" onclick="activar('."0".','.$m->con_id.')"><i class="fas fa-toggle-off"></i></button>'
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
    public function obtener_locales()
    {
        $model = $this->evento->listar_locales();
        echo '<option value="" disabled selected>Seleccione una opcion</option>';
        foreach ($model as $m)
        {
            echo '<option value="'.$m->loc_id.'">'.$m->loc_nombre.'</option>';
        }
    }
    public function obtener_clientes()
    {
        $model = $this->evento->obtener_clientes();
        echo '<option value="" disabled selected>Seleccione una opcion</option>';
        foreach ($model as $m)
        {
            echo '<option value="'.$m->cli_id.'">'.$m->cli_nombre.'</option>';
        }
    }
    public function obtener_categorias()
    {
        $model = $this->evento->listar_categorias();
        echo '<option value="" disabled selected>Seleccione una opcion</option>';
        foreach ($model as $m)
        {
            echo '<option value="'.$m->cat_id.'">'.$m->cat_nombre.'</option>';
        }
    }
    public function obtener_artistas()
    {
        $model = $this->evento->listar_artistas();
        echo '<option value="" disabled selected>Seleccione una opcion</option>';
        foreach ($model as $m)
        {
            echo '<option value="'.$m->art_id.'" data_nombre="'.$m->art_nombre.'" >'.$m->art_nombre.'</option>';
        }
    }
    public function name_imagen($file_temp, $file_name, $temp, $carpeta)
    {
        if (!file_exists($file_temp) || !is_uploaded_file($file_temp))
        {
            if (file_exists($carpeta.'/'.$temp) && !empty($temp)) //verificamos exite el archivo
            {
                unlink($carpeta.'/'.$temp);
            }
            $imagen = "";
        }
        else
        {
            if($file_name == $temp)
            {
                $imagen = $file_name;
            }
            else
            {
                if (file_exists($carpeta.'/'.$temp) && !empty($temp)) //verificamos exite el archivo
                {
                    unlink($carpeta.'/'.$temp);
                }
                $ext = explode("." , $file_name);
                $imagen = md5(uniqid()) .'.'. end($ext);
            }
        }
        return $imagen;
    }
    // //funcion para guardar y editar los datos
    public function guardar_editar() 
    {        
        try
        {
            $carpeta="media/concierto_logo";
            $carpeta2="media/concierto_portada";
            if (!file_exists($carpeta)) //verificamos exite la carpeta
            {
                mkdir($carpeta, 0777, true); //si no existe se crea la carpeta
            }
            $imagen4 = $this->name_imagen($_FILES['usu_imagen']['tmp_name'], $_FILES['usu_imagen']['name'], $_POST['temp_img1'], $carpeta);
            if (!file_exists($carpeta2)) //verificamos exite la carpeta
            {
                mkdir($carpeta2, 0777, true); //si no existe se crea la carpeta
            }
            $imagen5 = $this->name_imagen($_FILES['usu_portada']['tmp_name'], $_FILES['usu_portada']['name'], $_POST['temp_img2'], $carpeta2);

            $model = new Eventos();
            $model->con_id = $_POST['con_id']; 
            $model->cli_id = $_POST['cli_id']; 
            $model->loc_id = $_POST['loc_id'];
            $model->cat_id  = $_POST['cat_id'];
            $model->con_nombre = $_POST['con_nombre'];
            $model->con_subtitulo = $_POST['con_subtitulo'];
            $model->con_descripcion = $_POST['con_descripcion'];
            $model->con_fecha = $_POST['con_fecha'];
            $model->con_hora = $_POST['con_hora'];
            $model->con_imagen = $imagen4;
            $model->con_portada = $imagen5;
            $model->con_estado = $_POST['con_estado'];
            $model->art_id = $_POST['art_id'];
            $model->art_fecha_hora = $_POST['art_fecha_hora'];
            

            $model->zon_id = isset($_POST['zon_id'])? $_POST['zon_id'] : null;
            $model->zon_nombre = $_POST['zon_nombre'];
            $model->zon_precio = $_POST['zon_precio'];
            $model->zon_detalle = $_POST['zon_detalle'];
            $model->zon_stock = $_POST['zon_stock'];
            
            $result = $this->evento->guardar_editar($model);
            if($result == 1)
            {
                opendir($carpeta);
                $destino = $carpeta.'/'.$imagen4;
                empty($_FILES["usu_imagen"]["tmp_name"])?  "":copy($_FILES["usu_imagen"]["tmp_name"],$destino);

                opendir($carpeta2);
                $destino2 = $carpeta2.'/'.$imagen5;
                empty($_FILES["usu_portada"]["tmp_name"])?  "":copy($_FILES["usu_portada"]["tmp_name"],$destino2);
            }

            if($model->con_id)
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result ==1 ? $this->bitacora->guardar('Editó Eventos con ID:'.$model->con_id, 'Editar') : $this->bitacora->guardar('Error en editar Eventos con ID:'.$model->con_id, 'Editar_Error');
            } 
            else 
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Guardado Correctamente" : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
                $result == 1 ? $this->bitacora->guardar('Insertó Eventos con ID:'.$model->con_id, 'Guardar') : $this->bitacora->guardar('Error en registrar Eventos con ID:'.$model->con_id, 'Guardar_Error');
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
    public function obtener()
    {
        $con_id = $_POST['con_id'];
        $model = $this->evento->obtener($con_id);
        $artistas = $this->evento->obtener_artistas_concierto($con_id);
        $zonas = $this->evento->obtener_zonas_concierto($con_id);
        $html = '';
        $html_zonas = '';
        foreach($artistas as $m)
        {
            $html .= '<tr class="filas" id="fila_'.$m->art_id.'">
                    <td>'.$m->art_nombre.'</td>
                    <td>'
                        .date("d/m/Y h:i:s A", strtotime($m->art_con_horario_presentacion)).'
                        <input type="hidden" name="art_id[]" value="'.$m->art_id.'">
                        <input type="hidden" name="art_con_id[]" value="'.$m->art_con_id.'">
                        <input type="hidden" name="art_fecha_hora[]" value="'.$m->art_con_horario_presentacion.'">
                    </td>
                    <td><button type="button" class="btn btn-danger" onclick="eliminar_detalle('.$m->art_id.')"><i class="fas fa-trash"></i> </button>  </td>
                </tr>';
        }
        foreach($zonas as $m)
        {
            $html_zonas .= '<tr class="filas_zona" id="fila_zona_'.$m->zon_id.'">
                    <td>'.$m->zon_nombre.'</td>
                    <td>'.$m->zon_precio.'</td>
                    <td>'.$m->zon_stock.'</td>
                    <td>'.$m->zon_detalle.'
                        <input type="hidden" name="zon_id[]" value="'.$m->zon_id.'">
                        <input type="hidden" name="zon_nombre[]" value="'.$m->zon_nombre.'">
                        <input type="hidden" name="zon_precio[]" value="'.$m->zon_precio.'">
                        <input type="hidden" name="zon_detalle[]" value="'.$m->zon_detalle.'">
                        <input type="hidden" name="zon_stock[]" value="'.$m->zon_stock.'">
                    </td>
                    <td><button type="button" class="btn btn-danger" onclick="eliminar_detalle_zona('.$m->zon_id.')"><i class="fas fa-trash"></i> </button>  </td>
                </tr>';
        }
        echo json_encode(array("model" => $model, "html" => $html, "html_zonas" => $html_zonas));
    }
    // //funcion para activar o desactivar
    public function activar_desactivar()
    {
        try
        {
            $con_id = $_POST['con_id'];
            $con_estado = $_POST['con_estado'];
            
            $result = $this->evento->activar_desactivar($con_estado,$con_id);
            if($result !== 1 && $result !== 2) 
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
        } 
        catch (Throwable $e) 
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';        
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
    public function eliminar()
    {
        $con_id = $_POST['con_id'];
        $result = $this->evento->eliminar($con_id);
        if($result == 1)
        {
            $this->bitacora->guardar('Evento con ID: ' . $con_id, 'success');
            $rpta = 'ok';
            $mensaje = 'Evento Eliminado correctamente';        
        }
        else
        {
            $this->bitacora->guardar('Fallo al Eliminar el concierto con ID: ' . $con_id, 'error');
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';        
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
}