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
            $stm = $this->pdo->prepare('SELECT * FROM cliente as c WHERE c.cli_estado = 1 ');
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
            // $sql = "SELECT v.ven_id, v.cli_id, v.tipo_pago, v.ven_fecha, v.ven_total, v.ven_estado, 
            // c.cli_nombre, c.cli_num_doc, c.tip_ide_id, ti.tip_ide_abrev
            // FROM venta as v
            // INNER JOIN cliente as c ON c.cli_id = v.cli_id
            // INNER JOIN tipo_identificacion_documento as ti ON ti.tip_ide_id = c.tip_ide_id
            // WHERE $filtro";
            $sql = "SELECT v.ven_id, v.cli_id, v.tipo_pago, v.ven_fecha, v.ven_total, v.ven_estado, 
                c.cli_nombre, c.cli_num_doc, c.tip_ide_id, ti.tip_ide_abrev, d.con_id, co.cli_id as organizador
                FROM venta as v
                INNER JOIN cliente as c ON c.cli_id = v.cli_id
                INNER JOIN tipo_identificacion_documento as ti ON ti.tip_ide_id = c.tip_ide_id
                INNER JOIN detalle_venta as d ON d.ven_id = v.ven_id
                INNER JOIN concierto as co ON co.con_id = d.con_id 
                WHERE $filtro GROUP BY v.ven_id";

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