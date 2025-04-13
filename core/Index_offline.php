<?php
//importamos el controlador admin
require_once 'app/controllers/AdminController.php';
// si la accion(metodo existe) se almacena sino se asigna vacio
$accion = $_GET['a'] ?? '';
// si la accion es loguearse entra al if
if ($accion == 'loguearse')
{
    // se usa este metodo para pasar variables en %s que espera un string
    $c = sprintf(
        '%sController',
        'Admin'
    );
    $a = 'loguearse';
    $c = trim(ucfirst($c));
    $a = trim(strtolower($a));
    try
    {
        $controller = new $c;
        $controller->$a();
    }
    catch(\Throwable $e)
    {
        $c = sprintf(
            '%sController',
            'Admin'
        );
        $a = 'login';
        $c = trim(ucfirst($c));
        $a = trim(strtolower($a));
        $controller = new $c;
        $controller->$a();
    }      
}
else
{
    $c = sprintf( '%sController', 'Admin');
    $a = 'login';
    $c = trim(ucfirst($c));
    $a = trim(strtolower($a));
    $controller = new $c;
    $controller->$a();
}