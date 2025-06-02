<?php
//importamos los archivos del model
require_once 'app/models/Cliente.php';
require_once 'app/models/Usuario.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php';
require_once 'app/models/Globals.php';

class PerfilController
{
    private $global;
    private $navbar;
    private $cliente;
    private $usuario;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->global = new Config();
        $this->navbar = new Navbar();
        $this->cliente = new Cliente();
        $this->usuario = new Usuario();
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
        require_once _VIEW_PATH_ . 'modulo_acceso/perfil/perfil.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
      //funcion para cargar los sucursales en el select
    public function seleccionar_tipo_documento()
    {
        $rpta = $this->cliente->seleccionar_tipo_documento();
        if($rpta)
        {
            echo '<option value="" disabled selected>--Seleccione--</option>';
            foreach ($rpta as $reg) 
            {
                echo '<option value='.$reg->tip_ide_id.' title="'.$reg->tip_ide_nombre.'">'.$reg->tip_ide_abrev.'</option>';
            }
        }
    }
       //funcion para obtener un dato especifico
    public function obtener()
    {
        $cli_id = $_POST['cli_id'];
        $model = $this->cliente->obtener($cli_id);
        echo json_encode($model);
    }
    public function guardar_editar()  
    {        
        try
        {
            $model = new Cliente();
            $model->cli_id = $_POST['cli_id'];
            $model->cli_nombre = $_POST['cli_nombre'];
            $model->cli_tipo = $_POST['cli_tipo'];
            $model->cli_num_doc = $_POST['cli_num_doc'];
            $model->cli_direccion = $_POST['cli_direccion'];
            $model->cli_telefono = $_POST['cli_telefono'];
            $model->cli_correo = $_POST['cli_correo'];

            $result = $this->cliente->guardar_editar($model);

            if($model->cli_id)
            {
                $rpta = ($result['rpta'] == 1)? "ok" : $rpta = ($result['rpta'] == 3)? 'unico': "error";
                $mensaje = ($result['rpta'] == 1)? "Registro Actualizado Correctamente" : $mensaje = ($result['rpta'] == 3)? 'Este Cliente ya se encuentra registrado, intente con otro Numero de Documento' : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result['rpta'] ? $this->bitacora->guardar('Editó Cliente con ID:'.$model->cli_id, 'editar') : $this->bitacora->guardar('Error en editar Cliente con ID:'.$model->cli_id, 'error');
            }
            else
            {
                $rpta = ($result['rpta'] == 1)? "ok" : $rpta = ($result['rpta'] == 3)? 'unico': "error";
                $mensaje = ($result['rpta'] == 1)? "Registro Guardado Correctamente" : $mensaje = ($result['rpta'] == 3)? 'Este Cliente ya se encuentra registrado, intente con otro Numero de Documento' : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
                $result['rpta'] ? $this->bitacora->guardar('Inserto Cliente', 'guardar') : $this->bitacora->guardar('Error en Insertar Cliente', 'error');
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__); 
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje, "cli_id" => $result['cli_id']));
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
    public function obtener_data_usuario()
    {
        $usu_id = $_POST['usu_id'];
        $model = $this->usuario->obtener($usu_id);
        echo json_encode($model);
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
    public function guardar_editar_usuario()
    {
        try
        {
            $model = new Usuario();
            $model->usu_id = isset($_POST['usu_id'])? $_POST['usu_id'] : null;
            $model->tra_id = isset($_POST['tra_id'])? $_POST['tra_id'] : null;
            $model->rol_id = $_POST['usu_rol_id'];
            $model->cli_id = $_POST['cli_id'];
            $model->usu_nombre = $_POST['usu_nombre'];
            $model->usu_imagen = $_POST['usu_imagen'];
            $result = $this->usuario->guardar_editar($model);
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
    public function guardar_editar_imagen()
    {
        try
        {
            $carpeta="media/usuarios";
            if (!file_exists($carpeta)) //verificamos exite la carpeta
            {
                mkdir($carpeta, 0777, true); //si no existe se crea la carpeta
            }
            $imagen4 = $this->name_imagen($_FILES['usu_imagen']['tmp_name'], $_FILES['usu_imagen']['name'], $_POST['temp_img1'], $carpeta);


            $result = $this->usuario->guardar_editar_logo($imagen4, $_SESSION['usu_id']);
            if($result == 1)
            {
                opendir($carpeta);
                $destino = $carpeta.'/'.$imagen4;
                empty($_FILES["usu_imagen"]["tmp_name"])?  "":copy($_FILES["usu_imagen"]["tmp_name"],$destino);
            }
            $rpta = ($result == 1)? "ok" : "error";
            $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
            $result ? $this->bitacora->guardar('Se Actualizo el logo de la Empresa con ID 1', 'editar') : $this->bitacora->guardar('Error al actualizar el logo de la empresa con ID 1', 'error');
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje, "imagen" => $imagen4));
    }
}