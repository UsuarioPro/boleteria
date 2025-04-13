<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Navbar
{
    private $pdo;//variable privada que contendra la conexion
    private $log;//variable para registrar los errores del sistema
    public function __construct()
    {
        $this->pdo = Database::getConnection();//llamamos la conexion al iniciar la clase
        $this->log = new Log();
    }
    public function cantidad_sucursales($emp_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT COUNT(suc_id) as cantidad FROM sucursal WHERE suc_estado = 1');
            $stm->execute([$emp_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //funcion para listar los datos
    public function obtener_modulos()
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM modulos as m where m.mod_estado = 1 ORDER BY m.mod_orden asc');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_modulos_rol($rol_id)
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT o.mod_id FROM detalle_permisos_rol as d
            INNER JOIN permisos as p ON p.per_id = d.per_id
            INNER JOIN opciones as o ON o.opc_id = p.opc_id
            WHERE d.rol_id = ? GROUP BY o.mod_id');
            $stm->execute([$rol_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_opciones_modulos($mod_id)
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM opciones as o where o.opc_estado = 1 and o.mod_id = ? order by opc_orden asc');
            $stm->execute([$mod_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_opciones_modulos_uni($mod_id)
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM opciones as o where o.opc_estado = 1 and o.mod_id = ? limit 1');
            $stm->execute([$mod_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_permisos_rol($rol_id)
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT d.rol_id, d.per_id, p.opc_id, p.per_controlador FROM detalle_permisos_rol as d
            INNER JOIN permisos as p ON p.per_id = d.per_id
            WHERE d.rol_id = ?');
            $stm->execute([$rol_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_opcion_modulo($controlador)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT m.mod_nombre, m.mod_icono, p.per_controlador, o.opc_nombre FROM modulos as m 
            INNER JOIN opciones as o ON m.mod_id = o.mod_id
            INNER JOIN permisos as p ON p.opc_id = o.opc_id
            WHERE p.per_controlador = ? LIMIT 1');
            $stm->execute([$controlador]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
}