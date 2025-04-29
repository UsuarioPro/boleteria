<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Configuracion
{
    private $pdo;//variable privada que contendra la conexion
    private $log;//variable para registrar los errores del sistema
    public function __construct()
    {
        $this->pdo = Database::getConnection();//llamamos la conexion al iniciar la clase
        $this->log = new Log();
    }
    //funcion para devolver un dato especifico
    public function obtener()
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM configuraciones WHERE conf_id = 1');
            $stm->execute();
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function cambiar_configuracion($columna, $valor)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare("UPDATE configuraciones set $columna = ? where conf_id = 1 LIMIT 1");
            $stm->execute([$valor]);
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_modulos()
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM modulos as m ORDER BY m.mod_orden asc');
            $stm->execute();
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
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM opciones as o where o.mod_id = ? order by opc_orden asc');
            $stm->execute([$mod_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }

    public function cambiar_orden_modulos($mod_id)
    {
        $result = 0;
        try 
        {
            $orden = 1;
            for($i = 0; $i < count($mod_id); $i++)
            {
                $stm = $this->pdo->prepare('update modulos set mod_orden = ? where mod_id = ? LIMIT 1');
                $stm->execute([$orden, $mod_id[$i]]);
                $orden++;
            }
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 3;
        }
        return $result;
    }    
    public function cambiar_orden_opciones($opc_id)
    {
        $result = 0;
        try 
        {
            $orden = 1;
            for($i = 0; $i < count($opc_id); $i++)
            {
                $stm = $this->pdo->prepare('update opciones set opc_orden = ? where opc_id = ? LIMIT 1');
                $stm->execute([$orden, $opc_id[$i]]);
                $orden++;
            }
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 3;
        }
        return $result;
    }    
    //funcion para guardar y/o editar los datos
    public function guardar_editar_modulo($model)
    {
        $result = 2;
        try 
        {
            if(empty($model->mod_id))
            {//si no existe id es un dato nuevo
                $sql = 'INSERT INTO modulos(mod_nombre, mod_icono, mod_multiple, mod_orden, mod_estado) 
                VALUES (?,?,?,?,1)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->mod_nombre,
                    $model->mod_icono,
                    $model->mod_multiple,
                    $model->mod_orden,
                ]);
                $result = 1;
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = "UPDATE modulos SET mod_nombre = ? , mod_icono = ? , mod_multiple = ? WHERE mod_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->mod_nombre,
                    $model->mod_icono,
                    $model->mod_multiple,
                    $model->mod_id
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
    public function obtener_ultima_opcion_id()//funcion para poner en estado ocupado la mesa
    {
        $result = 0;
        try
        {
            $ven_id = $this->pdo->prepare('select opc_id from opciones order by opc_id desc LIMIT 1');
            $ven_id->execute();
            $result = $ven_id->fetch();
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_controlador($opc_id)//funcion para poner en estado ocupado la mesa
    {
        $result = 0;
        try
        {
            $per = $this->pdo->prepare('select * from permisos where opc_id = ?');
            $per->execute([$opc_id]);
            $result = $per->fetch();
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //funcion para guardar y/o editar los datos
    public function guardar_editar_opcion($model)
    {
        $result = 2;
        try 
        {
            if(empty($model->opc_id))
            {//si no existe id es un dato nuevo
                $sql = 'INSERT INTO opciones(mod_id, opc_nombre, opc_nombre_abrev, opc_funcion, opc_orden, opc_estado) VALUES (?,?,?,?,?,1)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->mod_id,
                    $model->opc_nombre,
                    $model->opc_nombre_abrev,
                    $model->opc_funcion,
                    $model->opc_orden            
                ]);
                $opc = $this->obtener_ultima_opcion_id();
                $sql = 'INSERT INTO permisos(opc_id, per_controlador, per_estado) VALUES (?,?,1)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $opc->opc_id,
                    $model->controlador,
                ]);
                $result = 1;
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = "UPDATE opciones SET opc_nombre = ?, opc_nombre_abrev = ?, opc_funcion = ? WHERE opc_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->opc_nombre,
                    $model->opc_nombre_abrev,
                    $model->opc_funcion,
                    $model->opc_id,
                ]);

                $sql = "UPDATE permisos SET per_controlador= ? WHERE per_id = ? LIMIT 1";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->controlador,
                    $model->per_id,
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
    public function eliminar_modulos($mod_id)
    {
        $result = 0;
        try 
        {
            $stm_opc = $this->pdo->prepare('SELECT * FROM opciones WHERE mod_id = ?');
            $stm_opc->execute([$mod_id]);
            $result_opc = $stm_opc->fetchAll();

            if(!empty($result_opc))
            {
                foreach ($result_opc as $m)
                {
                    $stm_per = $this->pdo->prepare('SELECT * FROM permisos WHERE opc_id = ?');
                    $stm_per->execute([$m->opc_id]);
                    $result_per = $stm_per->fetch();
    
                    $del_det_per = $this->pdo->prepare('DELETE FROM detalle_permisos_rol WHERE per_id= ?');
                    $del_det_per->execute([$result_per->per_id]);
    
                    $del_per = $this->pdo->prepare('DELETE FROM permisos WHERE per_id = ?');
                    $del_per->execute([$result_per->per_id]);
                }
                $del_opc = $this->pdo->prepare('DELETE FROM opciones WHERE mod_id = ?');
                $del_opc->execute([$mod_id]);
            }
            $del_mod = $this->pdo->prepare('DELETE FROM modulos WHERE mod_id = ?');
            $del_mod->execute([$mod_id]);
            $result = 1;
        }  
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }    
    public function eliminar_opcion($opc_id, $per_id)
    {
        $result = 0;
        try 
        {
            $del_det_per = $this->pdo->prepare('DELETE FROM detalle_permisos_rol WHERE per_id = ?');
            $del_det_per->execute([$per_id]);
            
            $del_per = $this->pdo->prepare('DELETE FROM permisos WHERE per_id = ?');
            $del_per->execute([$per_id]);
            
            $del_opc = $this->pdo->prepare('DELETE FROM opciones WHERE opc_id = ?');
            $del_opc->execute([$opc_id]);
            
            $result = 1;
        }  
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }    
    //metodo para activar o desactivar
    public function activar_desactivar($estado,$opc_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update opciones set opc_estado = ? where opc_id = ? LIMIT 1');
            $stm->execute([$estado,$opc_id]);
            if($estado==1)
            {
                $result = 1;
            }
            else if($estado==0)
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
    public function activar_desactivar_modulo($estado,$mod_id)
    {
        $result = 0;
        try 
        {
            $stm = $this->pdo->prepare('update modulos set mod_estado = ? where mod_id = ? LIMIT 1');
            $stm->execute([$estado,$mod_id]);
            if($estado==1)
            {
                $result = 1;
            }
            else if($estado==0)
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

}