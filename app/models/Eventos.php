<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php'; 
class Eventos 
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
            $stm = $this->pdo->prepare('SELECT c.con_id, c.loc_id, c.cat_id, c.con_nombre, c.con_subtitulo, c.con_imagen, c.con_portada, c.con_descripcion, c.con_fecha, c.con_hora, c.con_estado,
            l.loc_nombre, l.loc_direccion, l.loc_ciudad, ca.cat_nombre, cl.cli_id, cl.cli_nombre FROM concierto as c
            INNER JOIN local as l ON l.loc_id = c.loc_id
            INNER JOIN categoria as ca ON ca.cat_id = c.cat_id
            INNER JOIN cliente as cl ON cl.cli_id = c.cli_id and c.con_estado != 0');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_pendientes()
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT c.con_id, c.loc_id, c.cat_id, c.con_nombre, c.con_subtitulo, c.con_imagen, c.con_portada, c.con_descripcion, c.con_fecha, c.con_hora, c.con_estado,
            l.loc_nombre, l.loc_direccion, l.loc_ciudad, ca.cat_nombre, cl.cli_id, cl.cli_nombre FROM concierto as c
            INNER JOIN local as l ON l.loc_id = c.loc_id
            INNER JOIN categoria as ca ON ca.cat_id = c.cat_id
            INNER JOIN cliente as cl ON cl.cli_id = c.cli_id and c.con_estado = 0');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_por_cliente($cli_id)
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT c.con_id, c.loc_id, c.cat_id, c.con_nombre, c.con_subtitulo, c.con_imagen, c.con_portada, c.con_descripcion, c.con_fecha, c.con_hora, c.con_estado,
            l.loc_nombre, l.loc_direccion, l.loc_ciudad, ca.cat_nombre, cl.cli_id, cl.cli_nombre FROM concierto as c
            INNER JOIN local as l ON l.loc_id = c.loc_id
            INNER JOIN categoria as ca ON ca.cat_id = c.cat_id
            INNER JOIN cliente as cl ON cl.cli_id = c.cli_id where cl.cli_id = ? and c.con_estado = 0 order by c.con_fecha ASC');
            $stm->execute([$cli_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_locales()
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM local as l WHERE l.loc_estado = 1 ');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_clientes()
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
    public function listar_categorias()
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM categoria as c WHERE c.cat_estado = 1 ');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_artistas()
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM artista as a WHERE a.art_estado = 1 ');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }

    public function obtener_artistas_conciertos($con_id)
    {
        try 
        {
            $stm = $this->pdo->prepare('SELECT a.art_con_id, a.con_id, a.art_id, a.art_con_horario_presentacion, ar.art_nombre FROM artista_concierto as a 
            INNER JOIN artista as ar ON ar.art_id = a.art_id WHERE a.con_id = ?');
            $stm->execute([$con_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener($con_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from concierto where con_id = ? LIMIT 1');
            $stm->execute([$con_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_artistas_concierto($con_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from artista_concierto as c 
            INNER JOIN artista as a ON a.art_id = c.art_id
            where c.con_id = ?');
            $stm->execute([$con_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_zonas_concierto($con_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from zona_concierto where con_id = ?');
            $stm->execute([$con_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_ultima_venta_id()//funcion para poner en estado ocupado la mesa
    {
        $result = 0;
        try
        {
            $ven_id = $this->pdo->prepare('select con_id from concierto order by con_id desc LIMIT 1');
            $ven_id->execute();
            $result = $ven_id->fetch();
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function guardar_editar($model)
    {
        $result = 2;
        try 
        {
            if(empty($model->con_id))
            {//si no existe id es un dato nuevo
                $sql = 'INSERT INTO concierto(loc_id, cat_id, cli_id, con_nombre, con_subtitulo, con_imagen, con_portada, con_descripcion, con_fecha, con_hora, con_estado) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->loc_id,
                    $model->cat_id,
                    $model->cli_id,
                    $model->con_nombre,
                    $model->con_subtitulo,
                    $model->con_imagen,
                    $model->con_portada,
                    $model->con_descripcion,
                    $model->con_fecha,
                    $model->con_hora,
                    $model->con_estado,
                ]);
                $con = $this->obtener_ultima_venta_id();
                for($i = 0; $i < count($model->art_id); $i++)
                {
                    $sql_pago = 'INSERT INTO artista_concierto(con_id, art_id, art_con_horario_presentacion) VALUES (?,?,?)';
                    $stm_pago = $this->pdo->prepare($sql_pago);
                    $stm_pago->execute([
                        $con->con_id,
                        $model->art_id[$i],
                        $model->art_fecha_hora[$i],
                    ]);
                }
                for($j = 0; $j < count($model->zon_nombre); $j++)
                {
                    $sql_pago = 'INSERT INTO zona_concierto(con_id, zon_nombre, zon_precio, zon_detalle, zon_stock, zon_estado) VALUES (?,?,?,?,?,1)';
                    $stm_pago = $this->pdo->prepare($sql_pago);
                    $stm_pago->execute([
                        $con->con_id,
                        $model->zon_nombre[$j],
                        $model->zon_precio[$j],
                        $model->zon_detalle[$j],
                        $model->zon_stock[$j],
                    ]);
                }
                $result = 1;
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = 'UPDATE concierto SET loc_id= ?, cat_id = ?, cli_id = ?, con_nombre = ?, con_subtitulo = ?, con_imagen = ?, con_portada = ?, con_descripcion = ?, 
                    con_fecha = ?, con_hora = ? where con_id = ? LIMIT 1';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->loc_id,
                    $model->cat_id,
                    $model->cli_id,
                    $model->con_nombre,
                    $model->con_subtitulo,
                    $model->con_imagen,
                    $model->con_portada,
                    $model->con_descripcion,
                    $model->con_fecha,
                    $model->con_hora,
                    $model->con_id
                ]);
                $stm_pro = $this->pdo->prepare('DELETE FROM artista_concierto WHERE con_id = ?');
                $stm_pro->execute([$model->con_id]);    
                for($i = 0; $i < count($model->art_id); $i++)
                {
                    $sql_pago = 'INSERT INTO artista_concierto(con_id, art_id, art_con_horario_presentacion) VALUES (?,?,?)';
                    $stm_pago = $this->pdo->prepare($sql_pago);
                    $stm_pago->execute([
                        $model->con_id,
                        $model->art_id[$i],
                        $model->art_fecha_hora[$i],
                    ]);
                }
                $stm_pro = $this->pdo->prepare('DELETE FROM zona_concierto WHERE con_id = ?');
                $stm_pro->execute([$model->con_id]);    
                for($j = 0; $j < count($model->zon_nombre); $j++)
                {
                    $sql_pago = 'INSERT INTO zona_concierto(con_id, zon_nombre, zon_precio, zon_detalle, zon_stock, zon_estado) VALUES (?,?,?,?,?,1)';
                    $stm_pago = $this->pdo->prepare($sql_pago);
                    $stm_pago->execute([
                        $model->con_id,
                        $model->zon_nombre[$j],
                        $model->zon_precio[$j],
                        $model->zon_detalle[$j],
                        $model->zon_stock[$j],
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
    // //metodo para activar o desactivar
    public function activar_desactivar($con_estado,$con_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update concierto set con_estado = ? where con_id = ? LIMIT 1');
            $stm->execute([$con_estado, $con_id]);
            if($con_estado==1)
            {
                $result = 1;
            }
            else if($con_estado==2)
            {
                $result = 2;
            }
            else 
            {
                $result = 3;
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
    public function eliminar($con_id)
    {
        $result = 0;
        try 
        {
            $stm_pro = $this->pdo->prepare('DELETE FROM artista_concierto WHERE con_id = ?');
            $stm_pro->execute([$con_id]);    

            $stm_pro = $this->pdo->prepare('DELETE FROM zona_concierto WHERE con_id = ?');
            $stm_pro->execute([$con_id]);
            
            $stm_pro = $this->pdo->prepare('DELETE FROM concierto WHERE con_id = ?');
            $stm_pro->execute([$con_id]);    

            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }              
}