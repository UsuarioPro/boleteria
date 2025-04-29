<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php'; 
class Banners 
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
            $stm = $this->pdo->prepare('select * from banners_ecommerce');
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
    public function obtener($ban_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from banners_ecommerce where ban_id = ? LIMIT 1');
            $stm->execute([$ban_id]);
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
            if(empty($model->ban_id))
            {//si no existe id es un dato nuevo
                $sql = "INSERT INTO banners_ecommerce(ban_nombre, ban_tipo, ban_estado) values(?,2,1)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->ban_nombre,
                ]);
                $result = 1;
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = "update banners_ecommerce set ban_nombre = ?, ban_tipo = ?
                where ban_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->ban_nombre,
                    $model->bat_tipo,
                    $model->ban_id
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
    public function activar_desactivar($ban_estado,$ban_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update banners_ecommerce set ban_estado = ? where ban_id = ? LIMIT 1');
            $stm->execute([$ban_estado,$ban_id]);
            if($ban_estado==1)
            {
                $result = 1;
            }
            else if($ban_estado==0)
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
    public function eliminar($ban_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM producto as p WHERE p.ban_id = ?');
            $stm->execute([$ban_id]);
            $result = $stm->fetch();    
            if(empty($result))
            {
                $stm_pro = $this->pdo->prepare('DELETE FROM banners_ecommerce WHERE ban_id = ?');
                $stm_pro->execute([$ban_id]);    
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