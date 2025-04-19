<?php
$controllerName = $_GET['c'] ?? ''; // Ej: Tienda, Cliente, Admin
$action = $_GET['a'] ?? ''; // Ej: productos, login, pedidos

$controllerClass = ucfirst($controllerName) . 'Controller';
$actionMethod = strtolower($action);
if($controllerName == '' || $action == '')
{
    require_once 'app/controllers/TiendaController.php';
    $controller = new TiendaController;
    $controller->home();
}
else
{
    if (file_exists("app/controllers/{$controllerClass}.php")) 
    {
        require_once "app/controllers/{$controllerClass}.php";
        $controller = new $controllerClass;
        // Ejecuta acción
        if (method_exists($controller, $actionMethod)) 
        {
            $controller->$actionMethod();
        } 
        else 
        {
            $c = sprintf(
                '%sController',
                'Error'
            );
            $a = 'error_404';
            $c = trim(ucfirst($c));
            $a = trim(strtolower($a));
            require_once "app/controllers/{$c}.php";
            $controller = new $c;
            $controller->$a();
        }
    }
    else
    {
        $c = sprintf(
            '%sController',
            'Error'
        );
        $a = 'error_404';
        $c = trim(ucfirst($c));
        $a = trim(strtolower($a));
        require_once "app/controllers/{$c}.php";
        $controller = new $c;
        $controller->$a();
    }
    // try
    // {
    // }
    // catch(\Throwable $e)
    // {
    //     echo 'dasddsdaasdasd';
    //     exit();
    //     // $c = sprintf(
    //     //     '%sController',
    //     //     'Admin'
    //     // );
    //     // $a = 'login';
    //     // $c = trim(ucfirst($c));
    //     // $a = trim(strtolower($a));
    //     // $controller = new Admin;
    //     // $controller->login;
    // }   
}

// $controller = new $controllerClass;

// // Rutas protegidas
// $rutasProtegidas = [
//     'ClienteController' => ['perfil', 'pedidos', 'checkout'],
//     'AdminController' => ['dashboard', 'productos', 'usuarios']
// ];

// if (isset($rutasProtegidas[$controllerClass]) && in_array($actionMethod, $rutasProtegidas[$controllerClass])) 
// {
//     if (!isset($_SESSION['usuario_id'])) 
//     {
//         header('Location: index.php?c=Admin&a=login');
//         exit;
//     }

//     // Si es admin, pero el rol no coincide
//     if ($controllerClass === 'AdminController' && $_SESSION['rol'] !== 'admin') {
//         echo "Acceso denegado.";
//         exit;
//     }

//     // Si es cliente y el rol no es cliente
//     if ($controllerClass === 'ClienteController' && $_SESSION['rol'] !== 'cliente') {
//         echo "Acceso denegado.";
//         exit;
//     }
// }





// // si la accion(metodo existe) se almacena sino se asigna vacio
// $accion = $_GET['a'] ?? '';
// // si la accion es loguearse entra al if
// if ($accion == 'loguearse')
// {
//     // se usa este metodo para pasar variables en %s que espera un string
//     $c = sprintf(
//         '%sController',
//         'Admin'
//     );
//     $a = 'loguearse';
//     $c = trim(ucfirst($c));
//     $a = trim(strtolower($a));
//     try
//     {
//         $controller = new $c;
//         $controller->$a();
//     }
//     catch(\Throwable $e)
//     {
//         $c = sprintf(
//             '%sController',
//             'Admin'
//         );
//         $a = 'login';
//         $c = trim(ucfirst($c));
//         $a = trim(strtolower($a));
//         $controller = new $c;
//         $controller->$a();
//     }      
// }
// else
// {
//     $c = sprintf( '%sController', 'Admin');
//     $a = 'login';
//     $c = trim(ucfirst($c));
//     $a = trim(strtolower($a));
//     $controller = new $c;
//     $controller->$a();
// }