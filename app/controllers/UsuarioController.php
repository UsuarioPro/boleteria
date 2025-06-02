<?php
//importamos los archivos del model
require_once 'app/models/Navbar.php';
require_once 'app/models/Usuario.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php';
require_once 'app/models/Globals.php';
class UsuarioController
{
    private $navbar;
    private $usuario;
    private $bitacora;
    private $log;
    private $global;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->usuario = new Usuario();
        $this->bitacora = new Bitacora();
        $this->log = new Log();
        $this->global = new Config();
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
        require_once _VIEW_PATH_ . 'modulo_acceso/usuario/usuario.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    //funcion para listar los datos
    public function listar()
    {
        $model = $this->usuario->listar();
        $data = array();
        $i=1;
        foreach ($model as $m)
        {
            $data[]=array(
                "0"=>$i,
                "1"=>'<span>'.$m->cli_nombre.'</span> <br> <small>'.$m->tip_ide_abrev.': '.$m->cli_num_doc.'</small> ',
                "2"=>$m->rol_nombre,
                "3"=>$m->usu_login,
                "4"=>($m->usu_imagen)?"<div class='text-center'><img data-fancybox='gallery' src='"._SERVER_."media/usuarios/".$m->usu_imagen."' height='50px' width='60px'></div>":
                "<div class='text-center'><img src='"._SERVER_."styles/img/default_photo.png' height='50px' width='60px'></div>",
                "5"=>($m->usu_estado)?'<span class="badge bg-gradient-success"> Activo</span>':'<span class="badge bg-gradient-danger">Inactivo</span>',
                "6"=>$this->isUsuario = ($m->rol_id=='1')?'<button data-tippy-content="<small>Editar Usuario</small>" class="tooltip_tippy btn btn-warning btn-sm btn-flat" onclick="editar('.$m->usu_id.')"><i class="fas fa-edit"></i></button></a>'.
                        ' <button data-tippy-content="<small>Cambiar Contraseña</small>" class="tooltip_tippy btn btn-success btn-sm btn-flat" onclick="cambiar_contrasena('.$m->usu_id.')"><i class="fas fa-lock"></i></button>':''.
                    $this->isUsuario = ($m->usu_estado)?'<button data-tippy-content="<small>Editar Usuario</small>" class="tooltip_tippy btn btn-warning btn-sm btn-flat" onclick="editar('.$m->usu_id.')"><i class="fas fa-edit"></i></button></a>'.
                ' <button data-tippy-content="<small>Cambiar Contraseña</small>" class="tooltip_tippy btn btn-success btn-sm btn-flat" onclick="cambiar_contrasena('.$m->usu_id.')"><i class="fas fa-lock"></i></button>'.
                ' <button data-tippy-content="<small>Desactivar Usuario</small>" class="tooltip_tippy btn btn-danger btn-sm btn-flat" onclick="desactivar('."0".','.$m->usu_id.')"><i class="fas fa-toggle-on"></i></button>'.
                ' <button data-tippy-content="<small>Eliminar Usuario</small>" class="tooltip_tippy btn btn-danger btn-sm btn-flat" onclick="eliminar_usuario('.$m->usu_id.')"><i class="fas fa-trash"></i></button>':
                ' <button data-tippy-content="<small>Activar Usuario</small>" class="tooltip_tippy btn btn-success btn-sm btn-flat" onclick="activar('."1".','.$m->usu_id.')"><i class="fas fa-toggle-off"></i></button>',
            );
            $i++;
        }
        $result = array(
            "sEcho"=>1,//para numerar el datatable
            "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
            "iTotalDisplayRecords"=>count($data),//enviamos el total de registros  a visualizar al datatable
            "aaData"=>$data);
        echo json_encode($result);
    }
    //funcion para activar o desactivar
    public function activar_desactivar()
    {
        try
        {
            $usu_id = $_POST['usu_id'];
            $usu_estado = $_POST['usu_estado'];
            $result = $this->usuario->activar_desactivar($usu_estado,$usu_id);
            if($result !== 1 && $result !== 2)
            {
                $this->bitacora->guardar('Fallo Al cambiar estado de Usuario con ID: ' . $usu_id, 'error');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            }
            else if($result==1)
            {
                $this->bitacora->guardar('Usuario activado con ID: ' . $usu_id, 'ok');
                $rpta = 'ok';
                $mensaje = 'El Usuario fue activado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Usuario Desactivado con ID: ' . $usu_id, 'ok');
                $rpta = 'ok';
                $mensaje = 'El Usuario fue desactivado correctamente';
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
    //funcion para activar o desactivar
    public function eliminar_usuario()
    {
        try
        {
            $usu_id = $_POST['usu_id'];
            $result = $this->usuario->eliminar_usuario($usu_id);
            if($result==1)
            {
                $this->bitacora->guardar('Usuario eliminado con ID: ' . $usu_id, 'success');
                $rpta = 'ok';
                $mensaje = 'El Usuario fue eliminado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Fallo al eliminar el Usuario con ID: ' . $usu_id, 'error');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
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
    //funcion para activar o desactivar
    public function guardar_cambiar_contrasena()
    {
        try
        {
            $usu_id = $_POST['usu_id'];
            $usu_contrasena = password_hash($_POST['usu_contrasena'],PASSWORD_DEFAULT);

            $result = $this->usuario->guardar_cambiar_contrasena($usu_id, $usu_contrasena);
            if($result == 1)
            {
                $this->bitacora->guardar('Cambio de Contraseña de Usuario con ID: ' . $usu_id, 'Cambio');
                $rpta = 'ok';
                $mensaje = 'La Contraseña del Usuario fue cambiado correctamente';
            }
            else
            {
                $this->bitacora->guardar('Fallo Al cambiar la Contraseña de Usuario con ID: ' . $usu_id, 'Falla Sistema');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
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
            $carpeta="media/usuarios";
            if (!file_exists($carpeta)) //verificamos exite la carpeta
            {
                mkdir($carpeta, 0777, true); //si no existe se crea la carpeta
            }
            $imagen4 = $this->name_imagen($_FILES['usu_imagen']['tmp_name'], $_FILES['usu_imagen']['name'], $_POST['temp_img1'], $carpeta);

            $model = new Usuario();
            $model->usu_id = isset($_POST['usu_id'])? $_POST['usu_id'] : null;
            $model->tra_id = isset($_POST['tra_id'])? $_POST['tra_id'] : null;
            $model->rol_id = $_POST['usu_rol_id'];
            $model->cli_id = $_POST['cli_id'];
            $model->usu_nombre = $_POST['usu_nombre'];
            $model->usu_contrasena = password_hash($_POST['usu_contrasena'],PASSWORD_DEFAULT);
            $model->usu_imagen = $imagen4;
            $result = $this->usuario->guardar_editar($model);
            if($result == 1)
            {
                opendir($carpeta);
                $destino = $carpeta.'/'.$imagen4;
                empty($_FILES["usu_imagen"]["tmp_name"])?  "":copy($_FILES["usu_imagen"]["tmp_name"],$destino);
            }
            if($model->usu_id)
            {
                $rpta = ($result == 1)? "ok" : $rpta = ($result == 3)? 'unico': "error";
                $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : $mensaje = ($result == 3)? 'Este Nombre de Usuario o el numero de documento ya se encuentra registrado, intente con otro Nombre de Usuario' : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result ? $this->bitacora->guardar('Editó Usuario con ID:'.$model->usu_id, 'ok') : $this->bitacora->guardar('Error en editar Usuario con ID:'.$model->usu_id, 'error');
            }
            else
            {
                $rpta = ($result == 1)? "ok" : $rpta = ($result == 3)? 'unico': "error";
                $mensaje = ($result == 1)? "Registro Guardado Correctamente" : $mensaje = ($result == 3)? 'Este Nombre de Usuario o el numero de documento ya se encuentra registrado, intente con otro Nombre de Usuario' : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
                $result ? $this->bitacora->guardar('Insertó Usuario', 'ok') : $this->bitacora->guardar('Error en registrar Usuario', 'error');
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
        $usu_id = $_POST['usu_id'];
        $model = $this->usuario->obtener($usu_id);
        echo json_encode($model);
    }
    //funcion para cargar los sucursales en el select
    public function seleccionar_rol()
    {
        $rpta = $this->usuario->seleccionar_rol();
        if($rpta)
        {
            echo '<option value="" disabled selected>--Seleccione--</option>';
            foreach ($rpta as $reg) 
            {
                echo '<option value='.$reg->rol_id.'>'.$reg->rol_nombre.'</option>';
            }
        }
    }
    public function obtener_clientes()
    {
        $model = $this->usuario->obtener_clientes();
        echo '<option value="" disabled selected>Seleccione una opcion</option>';
        foreach ($model as $m)
        {
            echo '<option value="'.$m->cli_id.'">'.$m->cli_nombre.'</option>';
        }
    }    
}
