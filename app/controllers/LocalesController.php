<?php
//importamos los archivos del model
require_once 'app/models/Locales.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php'; 

class LocalesController
{
    private $navbar;
    private $local;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->local = new Locales();
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
        require_once _VIEW_PATH_ . 'local/local.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function verificar_permiso()
    {
        echo 'ok';
    }
    //funcion para listar los datos
    public function listar()
    {
        $model = $this->local->listar();
        $data = array();
        $i=1;
        foreach ($model as $m)
        {
            $data[]=array(
                "0"=>$i,
                "1"=>$m->loc_nombre,
                "2"=>$m->loc_direccion,
                "3"=>$m->loc_ciudad,
                "4"=>($m->loc_imagen_logo)?"<div class='text-center'><img data-fancybox='gallery".$m->loc_id."' src='"._SERVER_."media/locales/".$m->loc_imagen_logo."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",
                "5"=>($m->loc_escenario_img)?"<div class='text-center'><img data-fancybox='gallery".$m->loc_id."' src='"._SERVER_."media/escenarios/".$m->loc_escenario_img."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",
                "6"=>($m->loc_estado)?'<span class="badge bg-gradient-success"> Activo</span>':'<span class="badge bg-gradient-danger">Inactivo</span>',
                "7"=> 
                    $this->isDefaulf = ($m->loc_estado)?'<button data-tippy-content="<small>Editar Locales</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="editar('.$m->loc_id.')"><i class="fas fa-edit"></i></button></a>'.
                    ' <button data-tippy-content="<small>Desactivar Locales</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="desactivar('."0".','.$m->loc_id.')"><i class="fas fa-toggle-on"></i></button>'.
                    ' <button hidden data-tippy-content="<small>Eliminar Locales</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="eliminar('.$m->loc_id.')"><i class="fas fa-trash"></i></button>':
                    ' <button data-tippy-content="<small>Activar Locales</small>" class="tooltip_tippy btn btn-success btn-circle btn-sm btn-flat" onclick="activar('."1".','.$m->loc_id.')"><i class="fas fa-toggle-off"></i></button>'
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
    //funcion para guardar y editar los datos
    public function guardar_editar() 
    {        
        try
        {
            $carpeta="media/locales";
            $carpeta2="media/escenarios";
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

            $model = new Locales();
            $model->loc_id = $_POST['loc_id']; 
            $model->loc_nombre = $_POST['loc_nombre'];
            $model->loc_ciudad = $_POST['loc_ciudad'];
            $model->loc_direccion = $_POST['loc_direccion'];
            $model->loc_imagen_logo = $imagen4;
            $model->loc_escenario_img = $imagen5;
            $result = $this->local->guardar_editar($model);
            if($result == 1)
            {
                opendir($carpeta);
                $destino = $carpeta.'/'.$imagen4;
                empty($_FILES["usu_imagen"]["tmp_name"])?  "":copy($_FILES["usu_imagen"]["tmp_name"],$destino);

                opendir($carpeta2);
                $destino2 = $carpeta2.'/'.$imagen5;
                empty($_FILES["usu_portada"]["tmp_name"])?  "":copy($_FILES["usu_portada"]["tmp_name"],$destino2);
            }

            if($model->loc_id)
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result ==1 ? $this->bitacora->guardar('Editó Locales con ID:'.$model->loc_id, 'Editar') : $this->bitacora->guardar('Error en editar Locales con ID:'.$model->loc_id, 'Editar_Error');
            } 
            else 
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Guardado Correctamente" : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
                $result == 1 ? $this->bitacora->guardar('Insertó Locales con ID:'.$model->loc_id, 'Guardar') : $this->bitacora->guardar('Error en registrar Locales con ID:'.$model->loc_id, 'Guardar_Error');
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
    //funcion para obtener un dato especifico
    public function obtener()
    {
        $loc_id = $_POST['loc_id'];
        $model = $this->local->obtener($loc_id);
        echo json_encode($model);
    }
    //funcion para activar o desactivar
    public function activar_desactivar()
    {
        try
        {
            $loc_id = $_POST['loc_id'];
            $loc_estado = $_POST['loc_estado'];
            
            $result = $this->local->activar_desactivar($loc_estado,$loc_id);
            if($result !== 1 && $result !== 2) 
            {
                $this->bitacora->guardar('Fallo Al cambiar estado de Locales con ID: ' . $loc_id, 'Falla Sistema');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Locales activado con ID: ' . $loc_id, 'Activado');
                $rpta = 'ok';
                $mensaje = 'La Locales fue Activado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Locales Desactivado con ID: ' . $loc_id, 'Desactivado');
                $rpta = 'ok';
                $mensaje = 'La Locales fue Desactivado correctamente';
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
        $loc_id = $_POST['loc_id'];
        $result = $this->local->eliminar($loc_id);
        if($result == 1)
        {
            $this->bitacora->guardar('Locales Eliminada con ID: ' . $loc_id, 'success');
            $rpta = 'ok';
            $mensaje = 'Locales Eliminada correctamente';        
        }
        else if($result == 2)
        {
            $this->bitacora->guardar('Fallo al Eliminar la Locales con ID: ' . $loc_id . ' por que esta vinculada en los productos', 'warning');
            $rpta = 'error';
            $mensaje = 'Imposible Eliminar la Locales ya que esta se encuenta vinculada en productos.';        
        }
        else
        {
            $this->bitacora->guardar('Fallo al Eliminar la Locales con ID: ' . $loc_id, 'error');
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';        
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
}
