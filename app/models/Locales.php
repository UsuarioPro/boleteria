<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php'; 
class Locales 
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
            $stm = $this->pdo->prepare('select * from local');
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
    public function obtener($loc_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from local where loc_id = ? LIMIT 1');
            $stm->execute([$loc_id]);
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
            if(empty($model->loc_id))
            {//si no existe id es un dato nuevo
                $sql = "INSERT INTO local(loc_nombre, loc_direccion, loc_imagen_logo, loc_ciudad, loc_escenario_img, loc_estado) VALUES (?,?,?,?,?,1)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->loc_nombre,
                    $model->loc_direccion,
                    $model->loc_imagen_logo,
                    $model->loc_ciudad,
                    $model->loc_escenario_img,
                ]);
                $result = 1;
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = "update local set loc_nombre = ?, loc_direccion = ?, loc_imagen_logo = ?, loc_ciudad = ?, loc_escenario_img = ?
                where loc_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->loc_nombre,
                    $model->loc_direccion,
                    $model->loc_imagen_logo,
                    $model->loc_ciudad,
                    $model->loc_escenario_img,
                    $model->loc_id
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
    public function activar_desactivar($loc_estado,$loc_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update local set loc_estado = ? where loc_id = ? LIMIT 1');
            $stm->execute([$loc_estado,$loc_id]);
            if($loc_estado==1)
            {
                $result = 1;
            }
            else if($loc_estado==0)
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
    public function eliminar($loc_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM producto as p WHERE p.loc_id = ?');
            $stm->execute([$loc_id]);
            $result = $stm->fetch();    
            if(empty($result))
            {
                $stm_pro = $this->pdo->prepare('DELETE FROM local WHERE loc_id = ?');
                $stm_pro->execute([$loc_id]);    
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