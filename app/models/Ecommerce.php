<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Ecommerce
{
    private $pdo;//variable privada que contendra la conexion
    private $log;//variable para registrar los errores del sistema
    public function __construct()
    {
        $this->pdo = Database::getConnection();//llamamos la conexion al iniciar la clase
        $this->log = new Log();
    }
    //funcion para listar los datos
    public function listar_locales()
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM local as l where l.loc_estado = 1');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_categoria()
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM categoria as c where c.cat_estado = 1');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_artistas()
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM artista as a WHERE a.art_estado = 1');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_banners($tipo)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM banners_ecommerce as b WHERE b.ban_tipo = ?');
            $stm->execute([$tipo]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
}