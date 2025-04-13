<?php
//Levantamiento del Log para registro de errores
require 'core/Globals.php';
require 'app/models/Log.php';
require_once 'app/controllers/AdminController.php';

date_default_timezone_set('America/Lima'); //Establecer zona horaria

if(strlen(session_id()) < 1) //iniciamos la sesion
{
    ini_set('session.gc_maxlifetime', _TIEMPO_COOKIE_); //el tiempo siempre debe ser en segundo
    ini_set("session.cookie_lifetime", _TIEMPO_COOKIE_);
    ini_set("session.cookie_path", '/'._NAME_PROJECT_);
    session_set_cookie_params(_TIEMPO_COOKIE_);
    session_start();
}

// Manejo de Errores Personalizado de PHP a Try/Catch
function exception_error_handler($severidad, $mensaje, $fichero, $linea)
{
    $cadena =  '[LEVEL]: ' . $severidad . ' EN ' . $fichero . ' - Linea: ' . $linea . '[MESSAGGE]' . $mensaje . "\n";
    $guardar = new Log();
    $guardar->insert($cadena, "Excepcion No Manejada");
}

//validamos si existe una session y filtramos de acuerdo a los permisos
if(!isset($_SESSION['usu_id']))
{
    //importamos el archivo que validara la accion a ejecutar 
    require_once 'core/Index_offline.php';
}
else 
{
    //importamos el archivo que validara la accion a ejecutar
    require_once 'core/Index_online.php';
}
?>