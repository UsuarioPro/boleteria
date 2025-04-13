<?php
require_once 'app/models/Bitacora.php';
class ErrorController
{
    private $bitacora;

    public function __construct()
    {
        $this->bitacora = new Bitacora();
    }

    public function error()
    {
        $this->bitacora->guardar('Se Produjo Un Error en los Controladores del Sistema','Falla Sistema');
        require _VIEW_PATH_ . 'error/error_404.php';
    }
    public function error_404()
    {
        require _VIEW_PATH_ . 'error/error_404.php';
    }
    public function error_403()
    {
        require _VIEW_PATH_ . 'error/error_403.php';
    }
}