<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php'; 
class ReporteVenta 
{
    private $pdo;//variable privada que contendra la conexion
    private $log;//variable para registrar los errores del sistema
    public function __construct()
    {
        $this->pdo = Database::getConnection();//llamamos la conexion al iniciar la clase
        $this->log = new Log();
    }
    //funcion para listar los datos
    public function listar_clientes()
    {
        try 
        {
            $stm = $this->pdo->prepare('select * from usuario where usu_estado = 1');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function reporte_venta($filtro) //para listar los clientes
    {
        $result = [];
        try
        {
            $sql = "SELECT v.ven_id, v.usu_id, v.tipo_pago, v.ven_fecha, v.ven_total, v.ven_estado, 
            u.usu_nombre_completo, u.usu_tipo_doc, u.usu_numero_doc 
            FROM venta as v INNER JOIN usuario as u ON u.usu_id = v.usu_id WHERE $filtro";
            $stm = $this->pdo->prepare($sql);
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