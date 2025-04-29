<?php
//importamos los archivos del model
require_once 'app/models/Banners.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php'; 

class BannersController
{
    private $navbar;
    private $banners;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->banners = new Banners();
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
        require_once _VIEW_PATH_ . 'banner/banner.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function verificar_permiso()
    {
        echo 'ok';
    }
    //funcion para listar los datos
    public function listar()
    {
        $model = $this->banners->listar();
        $data = array();
        $i=1;
        foreach ($model as $m)
        {
            $data[]=array(
                "0"=>$i,
                "1"=>$m->ban_nombre,
                "2"=>($m->ban_nombre)?"<div class='text-center'><img class='portada' data-fancybox='gallery' src='"._SERVER_."media/banners/".$m->ban_nombre."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",

                "3"=>($m->ban_estado)?'<span class="badge bg-gradient-success"> Activo</span>':'<span class="badge bg-gradient-danger">Inactivo</span>',
                "4"=> $this->isDefaulf = ($m->ban_id == 1 || $m->ban_id == 2)? 
                        '<button data-tippy-content="<small>Editar Banners</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="editar('.$m->ban_id.')"><i class="fas fa-edit"></i></button></a>':    
                    $this->isDefaulf = ($m->ban_estado)?
                    '<button data-tippy-content="<small>Editar Banners</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="editar('.$m->ban_id.')"><i class="fas fa-edit"></i></button></a>'.
                    ' <button data-tippy-content="<small>Desactivar Banners</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="desactivar('."0".','.$m->ban_id.')"><i class="fas fa-toggle-on"></i></button>'.
                    ' <button hidden data-tippy-content="<small>Eliminar Banners</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="eliminar('.$m->ban_id.')"><i class="fas fa-trash"></i></button>':
                    ' <button data-tippy-content="<small>Activar Banners</small>" class="tooltip_tippy btn btn-success btn-circle btn-sm btn-flat" onclick="activar('."1".','.$m->ban_id.')"><i class="fas fa-toggle-off"></i></button>'
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
            $carpeta="media/banners";
            if (!file_exists($carpeta)) //verificamos exite la carpeta
            {
                mkdir($carpeta, 0777, true); //si no existe se crea la carpeta
            }
            $imagen4 = $this->name_imagen($_FILES['usu_imagen']['tmp_name'], $_FILES['usu_imagen']['name'], $_POST['temp_img1'], $carpeta);
            $model = new Banners();
            $model->ban_id = $_POST['ban_id']; 
            $model->ban_nombre = $imagen4;
            $model->ban_tipo = $_POST['ban_tipo'];
            $result = $this->banners->guardar_editar($model);
            if($result == 1)
            {
                opendir($carpeta);
                $destino = $carpeta.'/'.$imagen4;
                empty($_FILES["usu_imagen"]["tmp_name"])?  "":copy($_FILES["usu_imagen"]["tmp_name"],$destino);
            }

            if($model->ban_id)
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result ==1 ? $this->bitacora->guardar('Editó Banners con ID:'.$model->ban_id, 'Editar') : $this->bitacora->guardar('Error en editar Banners con ID:'.$model->ban_id, 'Editar_Error');
            } 
            else 
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Guardado Correctamente" : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
                $result == 1 ? $this->bitacora->guardar('Insertó Banners con ID:'.$model->ban_id, 'Guardar') : $this->bitacora->guardar('Error en registrar Banners con ID:'.$model->ban_id, 'Guardar_Error');
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
        $ban_id = $_POST['ban_id'];
        $model = $this->banners->obtener($ban_id);
        echo json_encode($model);
    }
    //funcion para activar o desactivar
    public function activar_desactivar()
    {
        try
        {
            $ban_id = $_POST['ban_id'];
            $ban_estado = $_POST['ban_estado'];
            
            $result = $this->banners->activar_desactivar($ban_estado,$ban_id);
            if($result !== 1 && $result !== 2) 
            {
                $this->bitacora->guardar('Fallo Al cambiar estado de Banners con ID: ' . $ban_id, 'Falla Sistema');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Banners activado con ID: ' . $ban_id, 'Activado');
                $rpta = 'ok';
                $mensaje = 'La Banners fue Activado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Banners Desactivado con ID: ' . $ban_id, 'Desactivado');
                $rpta = 'ok';
                $mensaje = 'La Banners fue Desactivado correctamente';
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
        $ban_id = $_POST['ban_id'];
        $result = $this->banners->eliminar($ban_id);
        if($result == 1)
        {
            $this->bitacora->guardar('Banners Eliminada con ID: ' . $ban_id, 'success');
            $rpta = 'ok';
            $mensaje = 'Banners Eliminada correctamente';        
        }
        else if($result == 2)
        {
            $this->bitacora->guardar('Fallo al Eliminar la Banners con ID: ' . $ban_id . ' por que esta vinculada en los productos', 'warning');
            $rpta = 'error';
            $mensaje = 'Imposible Eliminar la Banners ya que esta se encuenta vinculada en productos.';        
        }
        else
        {
            $this->bitacora->guardar('Fallo al Eliminar la Banners con ID: ' . $ban_id, 'error');
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';        
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
}
