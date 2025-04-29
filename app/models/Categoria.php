<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php'; 
class Categoria 
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
            $stm = $this->pdo->prepare('select * from categoria');
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
    public function obtener($cat_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from categoria where cat_id = ? LIMIT 1');
            $stm->execute([$cat_id]);
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
            if(empty($model->cat_id))
            {//si no existe id es un dato nuevo
                $sql = "INSERT INTO categoria(cat_nombre,cat_descripcion, cat_imagen, cat_estado) values(?,?,?,1)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->cat_nombre,
                    $model->cat_descripcion,
                    $model->cat_imagen,
                ]);
                $result = 1;
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = "update categoria set cat_nombre = ?, cat_descripcion = ?, cat_imagen = ?
                where cat_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->cat_nombre,
                    $model->cat_descripcion,
                    $model->cat_imagen,
                    $model->cat_id
                ]);
                $result = 1;
                $categoria_id = $model->cat_id;
            }
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return array('rpta' => $result);
    }
    //metodo para activar o desactivar
    public function activar_desactivar($cat_estado,$cat_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update categoria set cat_estado = ? where cat_id = ? LIMIT 1');
            $stm->execute([$cat_estado,$cat_id]);
            if($cat_estado==1)
            {
                $result = 1;
            }
            else if($cat_estado==0)
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
    public function eliminar($cat_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM producto as p WHERE p.cat_id = ?');
            $stm->execute([$cat_id]);
            $result = $stm->fetch();    
            if(empty($result))
            {
                $stm_pro = $this->pdo->prepare('DELETE FROM categoria WHERE cat_id = ?');
                $stm_pro->execute([$cat_id]);    
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