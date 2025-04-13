<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Rol
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
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from rol');
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
    public function obtener($rol_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from rol where rol_id = ? LIMIT 1');
            $stm->execute([$rol_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //funcion para devolver un dato especifico
    public function obtener_modulos()
    {
        $result = [];
        try 
        {
            // $stm = $this->pdo->prepare('select * from modulos where mod_estado = 1 order by mod_orden asc');
            $stm = $this->pdo->prepare('SELECT m.mod_id, m.mod_nombre, m.mod_icono, m.mod_multiple, m.mod_orden, m.mod_estado, p.per_id, o.opc_nombre FROM modulos as m 
            INNER JOIN opciones as o ON m.mod_id = o.mod_id
            INNER JOIN permisos as p ON p.opc_id = o.opc_id
            WHERE m.mod_estado = 1 GROUP BY m.mod_id ORDER BY m.mod_orden ASC');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_opciones_navbar($nav_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT p.per_id, p.opc_id, p.per_controlador, p.per_estado, o.mod_id, o.opc_nombre, o.opc_funcion FROM permisos as p 
            INNER JOIN opciones as o ON p.opc_id = o.opc_id 
            where mod_id = ? and opc_estado = 1');
            $stm->execute([$nav_id]);
            $result = $stm->fetchAll();
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
            if(empty($model->rol_id))
            {//si no existe id es un dato nuevo
                $sql = 'insert into rol(rol_nombre, rol_descripcion, rol_estado) values(?,?,1)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->rol_nombre,
                    $model->rol_descripcion
                ]);
                $rol_id = $this->pdo->prepare('select rol_id from rol order by rol_id desc LIMIT 1');
                $rol_id->execute();
                $rpta_id = $rol_id->fetch();
                $stm_mo_sunat = $this->pdo->prepare('INSERT INTO detalle_permisos_rol(rol_id, per_id) VALUES (?,?)');
                $stm_mo_sunat->execute([
                    $rpta_id->rol_id,
                    2,
                ]);
                for($i = 0; $i < count($model->per_id); $i++)
                {
                    $stm_mo = $this->pdo->prepare('INSERT INTO detalle_permisos_rol(rol_id, per_id) VALUES (?,?)');
                    $stm_mo->execute([
                        $rpta_id->rol_id,
                        $model->per_id[$i],
                    ]);
                }
                $result = 1;
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = "update rol set rol_nombre = ?, rol_descripcion = ?
                where rol_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->rol_nombre,
                    $model->rol_descripcion,
                    $model->rol_id
                ]);
                $sql_del = "DELETE FROM detalle_permisos_rol WHERE rol_id = ?";
                $stm_del = $this->pdo->prepare($sql_del);
                $stm_del->execute([$model->rol_id]);
                $stm_mo = $this->pdo->prepare('INSERT INTO detalle_permisos_rol(rol_id, per_id) VALUES (?,?)');
                    $stm_mo->execute([
                        $model->rol_id,
                        2,
                    ]);
                for($i = 0; $i < count($model->per_id); $i++)
                {
                    $stm_mo = $this->pdo->prepare('INSERT INTO detalle_permisos_rol(rol_id, per_id) VALUES (?,?)');
                    $stm_mo->execute([
                        $model->rol_id,
                        $model->per_id[$i],
                    ]);
                }
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
    public function activar_desactivar($rol_estado,$rol_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update rol set rol_estado = ? where rol_id = ? LIMIT 1');
            $stm->execute([$rol_estado, $rol_id]);
            if($rol_estado==1)
            {
                $result = 1;
            }
            else if($rol_estado ==0)
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
    //obtener el permiso asignado de acuerdo al rol
    public function verificar_permiso_usuario($rol_id,$permiso)
    {
        $result = [];
        try
        {
            $stm = $this->pdo->prepare('SELECT r.rol_id,p.per_controlador FROM detalle_permisos_rol dp 
                        INNER JOIN permisos p ON p.per_id=dp.per_id 
                        INNER JOIN rol r ON r.rol_id=dp.rol_id WHERE r.rol_id=? AND p.per_controlador=? limit 1');
            $stm->execute([$rol_id,$permiso]);
            $result = $stm->fetch();
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
}