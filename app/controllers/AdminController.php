<?php
require_once 'app/models/Globals.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Admin.php';
require_once 'app/models/Rol.php';
require_once 'app/models/Bitacora.php';
class AdminController
{
    private $navbar;
    private $global;
    private $admin;
    private $bitacora;
    private $rol;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->global = new Config();
        $this->admin =  new Admin();
        $this->rol = new Rol();
        $this->bitacora = new Bitacora();
    }
    //funcion que muestra la vista para el admin general al inicar app web
    public function dashboard() 
    {
        if($_SESSION['rol_id'] == 1)
        {
            $opc_modulo = $this->navbar->obtener_opcion_modulo($_GET['c']);
            $modulo = $opc_modulo->mod_nombre;
    
            $modulos = $this->navbar->obtener_modulos();
            $modulos_rol = $this->navbar->obtener_modulos_rol($_SESSION['rol_id']);
            $permisos_usuario = $this->navbar->obtener_permisos_rol($_SESSION['rol_id']);
    
            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
            require_once _VIEW_PATH_ . 'admin/index.php';
            require_once _VIEW_PATH_ . 'footer-admin.php';
        } 
    }
    public function login()
    {
        require _VIEW_PATH_ . 'admin/login.php';
    }
    public function conciertos()
    {
        require _VIEW_PATH_ECOMMERCE_ .'detalle_producto.php';
    }
    public function loguearse()
    {
        $usuario = isset($_POST['logina'])?$_POST['logina']: null;
        $pass = isset($_POST['clavea'])?$_POST['clavea']: null;
        $rol = '';
        if(!empty($usuario) && !empty($pass))
        {
            $model = $this->admin->loguear($usuario);
            if(isset($model->usu_id) && $model->usu_estado == 1)
            {
                if(password_verify($pass,$model->usu_clave))
                {
                    $_SESSION['usu_id'] = $model->usu_id; 
                    $_SESSION['rol_id'] = $model->rol_id; 
                    $_SESSION['tra_nombre'] = $model->tra_nombre; 
                    $_SESSION['usu_login'] = $model->usu_login; 
                    $_SESSION['usu_clave'] = $model->usu_clave; 
                    $_SESSION['usu_imagen'] = $model->usu_imagen; 
                    $_SESSION['usu_estado'] = $model->usu_estado; 
                    $_SESSION['rol_nombre'] = $model->rol_nombre; 

                    $this->admin->ultimo_logueo($model->usu_id);
                    $this->bitacora->guardar('Inicio Sesion ' . $_SESSION['usu_login'],'Inicio Sesion');
                    $rpta = 0;
                    $mensaje = 'Ingreso Exitoso';
                }
                else
                {
                    $rpta = 1;
                    $mensaje = 'Contraseña Incorrecta, por favor introduzca nuevamente su contraseña';    
                    $this->bitacora->guardar('Inicio de Sesión Fallido, error en Contraseña a Usuario: ' . $usuario,'Prohibido');
                }
                
            }
            else if(isset($model->usu_id) && $model->usu_estado == 0)
            {
                $rpta = 2;
                $mensaje = 'Este Usuario se encuentra suspendido, Intente Contactar con el Administrador del Sistema';
                $this->bitacora->guardar('Inicio de Sesión Fallido Usuario Suspendido: ' . $usuario,'Prohibido');
            }
            else if(!isset($model->usu_id))
            {
                $rpta = 3;
                $mensaje = 'Usuario y Contraseña Incorrectas, Estas credenciales no coinciden con nuestros registros.';    
                $this->bitacora->guardar('Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ','Prohibido');
            }
            echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
        }
        else 
        {
            $this->login();
        }
    }
    public function accion_salir()
    {
        $this->bitacora->guardar('LogOut Usuario ' . $_SESSION['usu_login'],'Cierre de Sesion');
        //limpiamos las varibles de sesion
        session_unset();
        setcookie('PHPSESSID','',time() - 1,'/'._NAME_PROJECT_);
        //destruimos la sesion
        session_destroy();
    }
    public function salir()
    {
        if(isset($_SESSION['usu_id']))
        {
            $this->accion_salir();
            header('Location: ' ._SERVER_);
        }
    }
}