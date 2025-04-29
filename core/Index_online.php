<?php
require_once 'app/models/Bitacora.php'; //Importamos el modelo de la bitacora
require_once 'app/models/Rol.php'; //Importamos el modelo del Rol para obtener los permisos
require_once 'app/controllers/ErrorController.php'; //importamos el controlador del error
require_once 'app/controllers/SunatController.php'; //importamos el controlador del error
$bitacora = new Bitacora();
$rol = new Rol();
//Para manejo de caracteres
header("Content-Type: text/html;charset=utf-8");
//Especificar el manejo de errores personalizados
set_error_handler("exception_error_handler");
// si intentan cambiar los parametros por url entrara en el if
if (!isset($_GET['c']) && !isset($_GET['a']))
{
    if(!isset($_SESSION['usu_id']))
    {
        // Router
        $c = sprintf(
            '%sController',
            'Error'
        );
        $a = 'error';
        $c = trim(ucfirst($c));
        $a = trim(strtolower($a));
        $controller = new $c;
        $controller->$a();
    }
    else 
    {
        header('Location: ' ._SERVER_. 'Admin/dashboard');        
    }
}
else
{
    $controlador = $_GET['c'];
    $accion = $_GET['a'];
    //declaramos variable para acceder a los archivos controller dinamicamente
    $archivo = APP_C.ucfirst($controlador)."Controller.php";
    //verificamos que exista la sesion del rol
    if(isset($_SESSION['rol_id']))
    {
        $acceso = $rol->verificar_permiso_usuario($_SESSION['rol_id'],$controlador);
    }
    else
    {
        $acceso = '';
    }
    if(is_file($archivo))//se invoca si solo existe el archivo
    {
        if(!empty($acceso))//si la consulta no es vacio entonces existe el rol con el permiso
        {
            require_once $archivo;//importamos el archivo
        }
    }
    // Router
    $c = sprintf(
        '%sController',
        $controlador ?? 'Admin'
    );
    $cv = $controlador ?? 'Admin';
    $a = $accion ?? 'login';
    $c = trim(ucfirst($c));
    $a = trim(strtolower($a));
    try
    {
        if(isset($c) && isset($a))
        {
            $controller = new $c;
            $controller->$a();
            if($a!=='salir')
            {
                $bitacora->guardar('Acceso a ' . $cv . ' / ' . $a,'Acceso Vista');
            }
        }
        else
        {
            $c = sprintf(
                '%sController',
                'Error'
            );
            $a = 'error';
            $c = trim(ucfirst($c));
            $a = trim(strtolower($a));
            $controller = new $c;
            $controller->$a();
        }
    }
    catch(\Throwable $e)
    {
        // Router
        $c = sprintf(
            '%sController',
            'Error'
        );
        $a = 'error';
        $c = trim(ucfirst($c));
        $a = trim(strtolower($a));
        $controller = new $c;
        $controller->$a();
    }
}   