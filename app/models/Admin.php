<?php

//use Exception;
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Admin
{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }
    public function loguear($usuario)
    {
        $result = new Admin;
        try 
        {
            $sql = 'SELECT u.usu_id, u.rol_id, u.usu_login, u.usu_clave, u.usu_imagen, u.usu_estado, u.usu_nombre_completo,
            r.rol_nombre FROM usuario as u INNER JOIN rol as r ON r.rol_id = u.rol_id WHERE u.usu_login = ?';

            $stm = $this->pdo->prepare($sql);
            $stm->execute([$usuario]);
            $fecht = $stm->fetch();
            if($fecht)
            {
                $result->usu_id = $fecht->usu_id; 
                $result->rol_id = $fecht->rol_id; 
                $result->tra_nombre = $fecht->usu_nombre_completo; 
                $result->usu_login = $fecht->usu_login; 
                $result->usu_clave = $fecht->usu_clave; 
                $result->usu_imagen = $fecht->usu_imagen; 
                $result->usu_estado = $fecht->usu_estado; 
                $result->rol_nombre = $fecht->rol_nombre; 
            }
            else
            {
                $result = 0;
            }
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function ultimo_logueo($usu_id)
    {
        $result = 2;
        try 
        {
            {
                $sql = "UPDATE usuario SET usu_ultimo_login = ? where usu_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    date('Y-m-d H:i:s'),
                    $usu_id
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
    public function registrarse($model)
    {
        $result = 2;
        try 
        {
            if(empty($model->usu_id))
            {//si no existe id es un dato nuevo
                $sql = 'INSERT INTO usuario(rol_id, usu_login, usu_clave, usu_fecha_creacion, usu_correo, usu_estado) VALUES (?,?,?,?,?,1)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->rol_id,
                    $model->usu_nombre,
                    $model->usu_contrasena,
                    date('Y-m-d H:i:s'),
                    $model->usu_correo
                ]);
            } 
            $result = 1;
        } 
        catch (Exception $e)
        {
            if($e->getCode() == "23000")// Codigo 23000 Violación de la restricción de integridad: entrada duplicada
            {
                $result = 3;
            }
            else
            {
                $result = 2;
                $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            }
        }
        return $result;
    }
}