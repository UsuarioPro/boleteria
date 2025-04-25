<?php
    //database datos
    define('_SERVER_DB_', 'localhost');
    define('_DB_', 'tienda_ticket');
    define('_USER_DB_', 'root');
    define('_PASSWORD_DB_', '');
    // --------------------------------------------------
    //name project
    define('_NAME_PROJECT_', '');
    //Servidor
    define('_SERVER_', 'http://localhost:8081/boleteria/');
    //Servidor Socket
    define('_SERVER_SOCKET_', 'ws://localhost:8303'); //Apuntar a la IP/Puerto configurado en el contructor del WebServerSocket, que es donde está escuchando el socket.
    // ruta para acceder a las vistas
    define('_VIEW_PATH_', 'app/views/');
    // ruta para acceder a la carpeta de la libreria facturacion electronica
    define('_LIBFE_PATH_', 'lib_elc/');
    //definimos una ruta para acceder a los controladores
    define("APP_C",'app/controllers/');
    // ruta para acceder a las vistas
    define('_VIEW_PATH_ECOMMERCE_', 'ecommerce/views/');

    //definimos la variable de la version del proyecto
    define("version_proyecto",'1.2.0');
    //DEFINIMOS EL TIEMPO DE LA COOKE
    define('_TIEMPO_COOKIE_', 365 * 24 * 60 * 60); //dias / horas / min / seg
?>