<?php
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Usuario{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }
    //funcion para listar los datos en el datatable
    public function listar()
    {
        $result = [];
        try {
            $stm = $this->pdo->prepare('SELECT * FROM usuario as u INNER JOIN rol as r ON r.rol_id = u.rol_id');
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    //funcion para devolver un dato especifico
    public function obtener($usu_id)
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
    function generateToken() 
    {
        $token = md5(uniqid(mt_rand(), false));
        return $token;
    }
    public function guardar_editar($model)
    {
        $result = 2;
        try 
        {
            if(empty($model->usu_id))
            {//si no existe id es un dato nuevo
                $sql = 'INSERT INTO usuario(rol_id, usu_login, usu_clave, usu_imagen, usu_fecha_creacion, usu_nombre_completo, usu_tipo_doc, 
                usu_numero_doc, usu_direccion, usu_telefono, usu_correo, usu_estado) VALUES (?,?,?,?,?,?,?,?,?,?,?,1)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->rol_id,
                    $model->usu_nombre,
                    $model->usu_contrasena,
                    $model->usu_imagen,
                    date('Y-m-d H:i:s'),
                    $model->usu_nombre_completo, 
                    $model->usu_tipo_doc, 
                    $model->usu_num_doc, 
                    $model->usu_direccion, 
                    $model->usu_telefono, 
                    $model->usu_correo
                ]);
                if($model->rol_id != 1)
                {
                    $cid = $this->generateToken();    
                    $lastId = $this->pdo->lastInsertId();// Obtener el ID insertado
                    $targetDirCreate = 'files/.'.$lastId.'-'.substr($cid, 0, 8);

                    $sql_up = "UPDATE usuario SET usu_token= ? WHERE usu_id = ?";
                    $stm_up = $this->pdo->prepare($sql_up);
                    $stm_up->execute([$cid, $lastId]);
	
                    $sql = 'INSERT INTO folders_and_files(fol_tipo, fol_fld, fol_url, fol_nombre, fol_extension, fol_id_user, fol_cid) VALUES (?,?,?,?,?,?,?)';
                    $stm = $this->pdo->prepare($sql);
                    $stm->execute([
                        0,
                        'root',
                        $targetDirCreate,
                        '.'.$model->usu_nombre_completo, 
                        'share',
                        $lastId,
                        $cid,
                    ]);
                    mkdir($targetDirCreate);
                }
            } 
            //si existe entonces el dato se actualiza
            else 
            {
                $sql = "UPDATE usuario SET rol_id= ?, usu_login= ?, usu_imagen= ?, usu_nombre_completo = ?, usu_tipo_doc= ?, usu_numero_doc = ?, 
                usu_direccion = ?, usu_telefono = ?, usu_correo = ? WHERE usu_id = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->rol_id,
                    $model->usu_nombre,
                    $model->usu_imagen,
                    $model->usu_nombre_completo, 
                    $model->usu_tipo_doc, 
                    $model->usu_num_doc, 
                    $model->usu_direccion, 
                    $model->usu_telefono, 
                    $model->usu_correo,
                    $model->usu_id,
                ]);
                $sql = "UPDATE folders_and_files SET fol_nombre= ? WHERE fol_id_user = ? and fol_cid = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    '.'.$model->usu_nombre_completo, 
                    $model->usu_id,
                    $model->usu_token,
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
    //metodo para activar o desactivar
    public function activar_desactivar($usu_estado,$usu_id)
    {
        $result = 0;
        try
        {
            $stm = $this->pdo->prepare('update usuario set usu_estado = ? where usu_id = ? LIMIT 1');
            $stm->execute([$usu_estado,$usu_id]);
            if($usu_estado == 1)
            {
                $result = 1;
            }
            else if($usu_estado == 0)
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
    //metodo para activar o desactivar
    public function eliminar_usuario($usu_id)
    {
        $result = 0;
        try
        {
            $stm = $this->pdo->prepare('DELETE FROM usuario WHERE usu_id = ? LIMIT 1');
            $stm->execute([$usu_id]);
            $result = 1;
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 3;
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
    //funcion para cargar la sucursal en el select
    public function seleccionar_rol()
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('select * from rol where rol_estado = 1');
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