<?php
//importamos los archivos del model
require_once 'app/models/Artistas.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php'; 

class ArtistasController
{
    private $navbar;
    private $artista;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->artista = new Artistas();
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
        require_once _VIEW_PATH_ . 'artistas/artistas.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function verificar_permiso()
    {
        echo 'ok';
    }
    //funcion para listar los datos
    public function listar()
    {
        $model = $this->artista->listar();
        $data = array();
        $i=1;
        foreach ($model as $m)
        {
            $data[]=array(
                "0"=>$i,
                "1"=>$m->art_nombre,
                "2"=>'<span style="white-space: normal; word-wrap: break-word; text-align : justify !important;">'.$m->art_descripcion.'</span>',
                "3"=>$m->art_genero,
                "4"=>($m->art_imagen_logo)?"<div class='text-center'><img data-fancybox='gallery".$m->art_id."' src='"._SERVER_."media/artistas_logo/".$m->art_imagen_logo."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",
                "5"=>($m->art_imagen_portada)?"<div class='text-center'><img data-fancybox='gallery".$m->art_id."' src='"._SERVER_."media/artistas_portada/".$m->art_imagen_portada."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/imagen-no-disponible.jpg' height='50px' width='60px'></div>",
                "6"=>($m->art_estado)?'<span class="badge bg-gradient-success"> Activo</span>':'<span class="badge bg-gradient-danger">Inactivo</span>',
                "7"=> 
                    $this->isDefaulf = ($m->art_estado)?'<button data-tippy-content="<small>Editar Artistas</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="editar('.$m->art_id.')"><i class="fas fa-edit"></i></button></a>'.
                    ' <button data-tippy-content="<small>Desactivar Artistas</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="desactivar('."0".','.$m->art_id.')"><i class="fas fa-toggle-on"></i></button>'.
                    ' <button hidden data-tippy-content="<small>Eliminar Artistas</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="eliminar('.$m->art_id.')"><i class="fas fa-trash"></i></button>':
                    ' <button data-tippy-content="<small>Activar Artistas</small>" class="tooltip_tippy btn btn-success btn-circle btn-sm btn-flat" onclick="activar('."1".','.$m->art_id.')"><i class="fas fa-toggle-off"></i></button>'
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
            $carpeta="media/artistas_logo";
            $carpeta2="media/artistas_portada";
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

            $model = new Artistas();
            $model->art_id = $_POST['art_id']; 
            $model->art_nombre = $_POST['art_nombre'];
            $model->art_genero = $_POST['art_genero'];
            $model->art_descripcion = $_POST['art_descripcion'];
            $model->art_imagen_logo = $imagen4;
            $model->art_imagen_portada = $imagen5;
            $result = $this->artista->guardar_editar($model);
            if($result == 1)
            {
                opendir($carpeta);
                $destino = $carpeta.'/'.$imagen4;
                empty($_FILES["usu_imagen"]["tmp_name"])?  "":copy($_FILES["usu_imagen"]["tmp_name"],$destino);

                opendir($carpeta2);
                $destino2 = $carpeta2.'/'.$imagen5;
                empty($_FILES["usu_portada"]["tmp_name"])?  "":copy($_FILES["usu_portada"]["tmp_name"],$destino2);
            }

            if($model->art_id)
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result ==1 ? $this->bitacora->guardar('Editó Artistas con ID:'.$model->art_id, 'Editar') : $this->bitacora->guardar('Error en editar Artistas con ID:'.$model->art_id, 'Editar_Error');
            } 
            else 
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Guardado Correctamente" : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
                $result == 1 ? $this->bitacora->guardar('Insertó Artistas con ID:'.$model->art_id, 'Guardar') : $this->bitacora->guardar('Error en registrar Artistas con ID:'.$model->art_id, 'Guardar_Error');
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
        $art_id = $_POST['art_id'];
        $model = $this->artista->obtener($art_id);
        echo json_encode($model);
    }
    //funcion para activar o desactivar
    public function activar_desactivar()
    {
        try
        {
            $art_id = $_POST['art_id'];
            $art_estado = $_POST['art_estado'];
            
            $result = $this->artista->activar_desactivar($art_estado,$art_id);
            if($result !== 1 && $result !== 2) 
            {
                $this->bitacora->guardar('Fallo Al cambiar estado de Artistas con ID: ' . $art_id, 'Falla Sistema');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Artistas activado con ID: ' . $art_id, 'Activado');
                $rpta = 'ok';
                $mensaje = 'La Artistas fue Activado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Artistas Desactivado con ID: ' . $art_id, 'Desactivado');
                $rpta = 'ok';
                $mensaje = 'La Artistas fue Desactivado correctamente';
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
        $art_id = $_POST['art_id'];
        $result = $this->artista->eliminar($art_id);
        if($result == 1)
        {
            $this->bitacora->guardar('Artistas Eliminada con ID: ' . $art_id, 'success');
            $rpta = 'ok';
            $mensaje = 'Artistas Eliminada correctamente';        
        }
        else if($result == 2)
        {
            $this->bitacora->guardar('Fallo al Eliminar la Artistas con ID: ' . $art_id . ' por que esta vinculada en los productos', 'warning');
            $rpta = 'error';
            $mensaje = 'Imposible Eliminar la Artistas ya que esta se encuenta vinculada en productos.';        
        }
        else
        {
            $this->bitacora->guardar('Fallo al Eliminar la Artistas con ID: ' . $art_id, 'error');
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';        
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
}
