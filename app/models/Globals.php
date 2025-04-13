<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php';

class Config
{
    private $pdo;//variable privada que contendra la conexion
    private $log;//variable para registrar los errores del sistema

    public function __construct()
    {
        $this->pdo = Database::getConnection();//llamamos la conexion al iniciar la clase
        $this->log = new Log();
    }
    public function com_internet() //funcion para comprobar el internet
    {
        $url = "https://github.com"; // URL de un sitio web al que intentaremos conectarnos
        $response = @file_get_contents($url); // Intentamos obtener el contenido de la URL
    
        // Si se obtiene una respuesta válida, se asume que hay conexión a Internet
        if ($response !== false) 
        {
            return true; // Hay conexión a Internet
        } 
        else 
        {
            return false; // No hay conexión a Internet
        }
    }
}