<?php
require_once 'core/Database.php';

class Bitacora{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }
    public function listar(){
        $result = [];
        try {
            $stm = $this->pdo->prepare('select s.sucursal_nombre,concat(t.trabajador_nombre," ",t.trabajador_apellido) as usuario,
                b.bitacora_tipo,b.bitacora_accion,b.bitacora_ip,b.bitacora_fecha from bitacora b inner join usuario u on 
                        b.usuario_id = u.usuario_id inner join trabajador t on t.trabajador_id = u.trabajador_id
                        inner join sucursal s on s.sucursal_id = u.sucursal_id');
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }

    public function guardar($accion, $tipo){
        $fecha = date("Y") . '-' . date("m") . '-' . date('d');
        $hora = date("H") . ':' . date("i") . ':' . date('s');
        $fecha_actual = $fecha . " " . $hora;
        $result = 3;
        $id_user = (isset($_SESSION['usu_id']))??'0';
        $id_suc = (isset($_SESSION['suc_id']))??'0';
        $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : 0;
        try {
            $sql = 'insert into bitacora(
                    usu_id,
                    suc_id,
                    bit_fecha,
                    bit_accion,
                    bit_ip,
                    bit_tipo
                    ) values(?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_user,
                $id_suc,
                $fecha_actual,
                $accion,
                $ip,
                $tipo
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
}