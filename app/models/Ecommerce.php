<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Ecommerce
{
    private $pdo;//variable privada que contendra la conexion
    private $log;//variable para registrar los errores del sistema
    public function __construct()
    {
        $this->pdo = Database::getConnection();//llamamos la conexion al iniciar la clase
        $this->log = new Log();
    }
    public function obtener_datos_usuario($usu_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM usuario WHERE usu_id = ? LIMIT 1');
            $stm->execute([$usu_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function editar_usuario($model)
    {
        $result = 2;
        try 
        {            
            $sql = "UPDATE usuario SET usu_login= ?, usu_nombre_completo = ?, usu_tipo_doc= ?, usu_numero_doc = ?, 
            usu_direccion = ?, usu_telefono = ?, usu_correo = ? WHERE usu_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->usu_nombre,
                $model->usu_nombre_completo, 
                $model->usu_tipo_doc, 
                $model->usu_num_doc, 
                $model->usu_direccion, 
                $model->usu_telefono, 
                $model->usu_correo,
                $model->usu_id,
            ]);
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
    public function guardar_cambiar_contrasena($usu_id, $usu_contrasena)
    {
        $result = 0;
        try
        {
            $sql = "UPDATE usuario SET usu_clave= ? WHERE  usu_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $usu_contrasena,
                $usu_id,
            ]);
            $result = 1;            
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 3;
        }
        return $result;
    }
    public function obtener_ultima_venta_id()//funcion para poner en estado ocupado la mesa
    {
        $result = 0;
        try
        {
            $ven_id = $this->pdo->prepare('select ven_id from venta order by ven_id desc LIMIT 1');
            $ven_id->execute();
            $result = $ven_id->fetch();
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    function generarCodigoBoleta($idBoleto) 
    {
        $prefijo = 'BOL'; // Puedes cambiarlo a lo que quieras
        $fecha = date('YmdHis'); // Fecha y hora actual
        $random = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5)); // Cadena aleatoria
        return "{$prefijo}-{$fecha}-{$idBoleto}-{$random}";
    }
    public function guardar_venta_boleta($model)
    {
        $result = 2;
        try 
        {            
            $sql = "INSERT INTO venta(usu_id, tipo_pago, ven_fecha, ven_total, ven_estado) VALUES (?,?,?,?,1)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->usu_id,
                $model->tipo_pago,
                date('Y-m-d H:i:s'),
                $model->total,
            ]);
            $ven_id = $this->obtener_ultima_venta_id();

            for($i = 0; $i < count($model->con_id); $i++)
            {
                $sql = "INSERT INTO detalle_venta(ven_id, zon_id, con_id, cantidad, precio_unitario, total) VALUES (?,?,?,?,?,?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $ven_id->ven_id,
                    $model->zon_id[$i],
                    $model->con_id[$i],
                    $model->cantidad[$i],
                    $model->precio[$i],
                    $model->precio[$i] * $model->cantidad[$i],
                ]);

                // Obtener el último ID insertado
                $ultimo_id = $this->pdo->lastInsertId();
                // Ejemplo de uso
                $idBoleto = strtoupper(uniqid('BOL')); // Esto vendría de tu insert
                $codigo = $this->generarCodigoBoleta($idBoleto);

                // $sql_bol = "INSERT INTO boleto(det_ven_id, con_id, zon_id, codigo_unico, bol_cant_personas, estado) VALUES (?,?,?,?,?,1)";
                $sql_bol = "INSERT INTO boleto(det_ven_id, codigo_unico, bol_cant_personas, estado) VALUES (?,?,?,1)";
                $stm_bol = $this->pdo->prepare($sql_bol);
                $stm_bol->execute([
                    $ultimo_id,
                    // $model->con_id[$i],
                    // $model->zon_id[$i],
                    $codigo,
                    $model->cantidad[$i],
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
    //funcion para listar los datos
    public function obtener_mis_boletos($usu_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT b.bol_id, b.det_ven_id, b.codigo_unico, 
            b.bol_cant_personas, b.estado, d.precio_unitario, 
            d.zon_id, d.con_id, z.zon_nombre, z.zon_detalle, 
            c.con_nombre, c.con_subtitulo,c.con_descripcion, 
            c.con_fecha, c.con_hora FROM boleto AS b
                INNER JOIN detalle_venta as d ON d.det_ven_id = b.det_ven_id
                INNER JOIN venta as v ON d.ven_id = v.ven_id
                INNER JOIN zona_concierto as z ON z.zon_id = d.zon_id
                INNER JOIN concierto as c ON c.con_id = d.con_id WHERE v.usu_id = ?');
            $stm->execute([$usu_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_boleto($bol_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT b.bol_id, b.det_ven_id, b.codigo_unico, 
            b.bol_cant_personas, b.estado, d.precio_unitario, 
            d.zon_id, d.con_id, z.zon_nombre, z.zon_detalle, 
            c.con_nombre, c.con_subtitulo,c.con_descripcion, 
            c.con_fecha, c.con_hora FROM boleto AS b
                INNER JOIN detalle_venta as d ON d.det_ven_id = b.det_ven_id
                INNER JOIN venta as v ON d.ven_id = v.ven_id
                INNER JOIN zona_concierto as z ON z.zon_id = d.zon_id
                INNER JOIN concierto as c ON c.con_id = d.con_id WHERE b.bol_id = ?');
            $stm->execute([$bol_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //funcion para listar los datos
    public function listar_locales()
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM local as l where l.loc_estado = 1');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_categoria()
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM categoria as c where c.cat_estado = 1');
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
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM artista as a WHERE a.art_estado = 1');
            $stm->execute();
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_banners($tipo)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM banners_ecommerce as b WHERE b.ban_tipo = ?');
            $stm->execute([$tipo]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_conciertos($empieza_limite, $limite, $ciudad, $filtro)
    {
        $result = [];
        try 
        {
            $sLimit = "LIMIT $empieza_limite, $limite";
            $filtro = ($filtro== '')? '' : " AND c.cat_id = $filtro ";
            $filtro_ciu = (empty($ciudad))? '' : " AND l.loc_ciudad = $ciudad";
            try 
            {
                $sql = "SELECT c.con_id, c.loc_id, c.cat_id, c.con_nombre, c.con_descripcion , c.con_fecha, c.con_hora, c.con_estado, 
                ca.cat_nombre, l.loc_nombre, l.loc_direccion, l.loc_ciudad, c.con_imagen
                FROM concierto as c
                INNER JOIN local as l ON l.loc_id = c.loc_id
                INNER JOIN categoria as ca ON ca.cat_id = c.cat_id  WHERE c.con_estado = 0 $filtro_ciu $filtro ORDER BY con_fecha, con_hora ASC $sLimit";
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
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function cantidad_conciertos_filtro($ciudad, $filtro)//es la misma consulta que seleccionar_producto_cuadricula en caso cambiar consulta cambiar en las dos funciones
    {
        $filtro = ($filtro== '')? '' : " AND c.cat_id = $filtro ";
        $filtro_ciu = (empty($ciudad))? '' : "AND l.loc_ciudad = $ciudad";
        try 
        {
            $sql = "SELECT c.con_id, c.loc_id, c.cat_id, c.con_nombre, c.con_descripcion , c.con_fecha, c.con_hora, c.con_estado, 
                ca.cat_nombre, l.loc_nombre, l.loc_direccion, l.loc_ciudad
                FROM concierto as c
                INNER JOIN local as l ON l.loc_id = c.loc_id
                INNER JOIN categoria as ca ON ca.cat_id = c.cat_id WHERE c.con_estado = 0 $filtro_ciu $filtro ORDER BY con_fecha, con_hora ASC";

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
    public function obtener_concierto($con_id)
    {
        $result = [];
        try 
        {
            try 
            {
                $sql = "SELECT c.con_id, c.loc_id, c.cat_id, c.con_nombre, c.con_descripcion , c.con_fecha, c.con_hora, c.con_estado, 
                ca.cat_nombre, l.loc_nombre, l.loc_direccion, l.loc_ciudad, c.con_portada, c.con_subtitulo, l.loc_escenario_img, c.con_imagen
                FROM concierto as c
                INNER JOIN local as l ON l.loc_id = c.loc_id
                INNER JOIN categoria as ca ON ca.cat_id = c.cat_id  WHERE c.con_id = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$con_id]);
                $result = $stm->fetch();
            } 
            catch (Exception $e)
            {
                $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            }
            return $result;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_artistas_conciertos($con_id)
    {
        $result = [];
        try 
        {
            try 
            {
                $sql = "SELECT a.art_con_id, a.con_id, a.art_id, a.art_con_horario_presentacion, ar.art_nombre, ar.art_descripcion, ar.art_imagen_logo, 
                ar.art_genero FROM artista_concierto as a INNER JOIN artista AS ar ON ar.art_id = a.art_id WHERE a.con_id = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$con_id]);
                $result = $stm->fetchAll();
            } 
            catch (Exception $e)
            {
                $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            }
            return $result;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function zonas_precios($con_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM zona_concierto as z WHERE z.con_id = ? and z.zon_estado = 1');
            $stm->execute([$con_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
}