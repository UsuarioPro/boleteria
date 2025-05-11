<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Cliente
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
            $stm = $this->pdo->prepare('select c.cli_id, c.cli_nombre, c.tip_ide_id, c.cli_num_doc, c.cli_direccion, c.cli_telefono, c.cli_correo, c.cli_estado,
            t.tip_ide_cod, t.tip_ide_abrev from cliente as c 
            INNER JOIN tipo_identificacion_documento as t ON c.tip_ide_id = t.tip_ide_id');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //funcion para devolber un dato especifico
    public function obtener($cli_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select c.cli_id, c.cli_nombre, c.tip_ide_id, c.cli_num_doc, c.cli_direccion, c.cli_telefono, c.cli_correo, c.cli_estado,
            t.tip_ide_cod, t.tip_ide_abrev from cliente as c 
            INNER JOIN tipo_identificacion_documento as t ON c.tip_ide_id = t.tip_ide_id where cli_id = ? LIMIT 1');
            $stm->execute([$cli_id]);
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
        $result = 2; $cliente_id = '';
        try 
        {
            if(empty($model->cli_id))
            {//si no existe id es un dato nuevo
                $sql = 'insert into cliente(cli_nombre, tip_ide_id, cli_num_doc, cli_direccion, 
                cli_telefono, cli_correo, cli_estado) values(?,?,?,?,?,?,1)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->cli_nombre,
                    $model->cli_tipo,
                    $model->cli_num_doc,
                    $model->cli_direccion,
                    $model->cli_telefono,
                    $model->cli_correo
                ]);
                $result = 1;
                $cliente_id =  $this->pdo->lastInsertId();
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = " update cliente set cli_nombre = ?, tip_ide_id = ?, cli_num_doc = ?, 
                cli_direccion = ?, cli_telefono = ?, cli_correo = ? where cli_id = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->cli_nombre,
                    $model->cli_tipo,
                    $model->cli_num_doc,
                    $model->cli_direccion,
                    $model->cli_telefono,
                    $model->cli_correo,
                    $model->cli_id
                ]);
                $result = 1;
                $cliente_id = $model->cli_id;
            }
        } catch (Exception $e)
        {
            // Codigo 23000 Violación de la restricción de integridad: entrada duplicada
            if($e->getCode() == "23000")
            {
                $result = 3;
            }
            else
            {
                $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            }
        }
        return array('rpta' => $result, 'cli_id' => $cliente_id);
    }
    //metodo para activar o desactivar
    public function activar_desactivar($cli_estado,$cli_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update cliente set cli_estado = ? where cli_id = ? LIMIT 1');
            $stm->execute([$cli_estado,$cli_id]);
            if($cli_estado==1)
            {
                $result = 1;
            }
            else if($cli_estado==0)
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
    //funcion para listar los datos
    public function seleccionar_tipo_documento()
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM tipo_identificacion_documento as t WHERE  t.tip_ide_estado = 1');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
}