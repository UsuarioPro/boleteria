<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php'; 
class Artistas 
{
    private $pdo;//variable privada que contendra la conexion
    private $log;//variable para registrar los errores del sistema
    public function __construct()
    {
        $this->pdo = Database::getConnection();//llamamos la conexion al iniciar la clase
        $this->log = new Log();
    }
    //funcion para listar los datos
    public function listar()
    {
        try 
        {
            $stm = $this->pdo->prepare('select * from artista');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //funcion para devolver un dato especifico
    public function obtener($art_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from artista where art_id = ? LIMIT 1');
            $stm->execute([$art_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //funcion para guardar y/o editar los datos
    public function guardar_editar($model)
    {
        $result = 2;
        try 
        {
            if(empty($model->art_id))
            {//si no existe id es un dato nuevo
                $sql = "INSERT INTO artista(art_nombre, art_descripcion, art_imagen_logo, art_genero, art_imagen_portada, art_estado) VALUES (?,?,?,?,?,1)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->art_nombre,
                    $model->art_descripcion,
                    $model->art_imagen_logo,
                    $model->art_genero,
                    $model->art_imagen_portada,
                ]);
                $result = 1;
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = "update artista set art_nombre = ?, art_descripcion = ?, art_imagen_logo = ?, art_genero = ?, art_imagen_portada = ?
                where art_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->art_nombre,
                    $model->art_descripcion,
                    $model->art_imagen_logo,
                    $model->art_genero,
                    $model->art_imagen_portada,
                    $model->art_id
                ]);
                $result = 1;
            }
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //metodo para activar o desactivar
    public function activar_desactivar($art_estado,$art_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update artista set art_estado = ? where art_id = ? LIMIT 1');
            $stm->execute([$art_estado,$art_id]);
            if($art_estado==1)
            {
                $result = 1;
            }
            else if($art_estado==0)
            {
                $result = 2;
            }
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 3;
        }
        return $result;
    }  
    //funcion para eliminar una apertura
    public function eliminar($art_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM producto as p WHERE p.art_id = ?');
            $stm->execute([$art_id]);
            $result = $stm->fetch();    
            if(empty($result))
            {
                $stm_pro = $this->pdo->prepare('DELETE FROM artista WHERE art_id = ?');
                $stm_pro->execute([$art_id]);    
                $result = 1;
            }
            else
            {
                $result = 2;
            }
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }              
}