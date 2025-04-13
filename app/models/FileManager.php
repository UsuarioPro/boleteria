<?php

//use Exception;
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class FileManager
{
    private $pdo;
    private $log;
    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }
    public function obtener_carpetas_lazy_load($parent, $condicion) //funcion para listar los datos
    {
        $result = [];
        try 
        {
            if($_SESSION['rol_id'] == 1)
            {
                $parent = ($parent == '#') ? ($condicion == 0 ? 'root' : '') : $parent;
                $where = ($condicion == 1)? 'and f.fol_id_user = '. $_SESSION['usu_id'] : null; 
                $sql = "SELECT f.fol_id, f.fol_tipo, f.fol_fld, f.fol_url, f.fol_nombre, f.fol_extension, f.fol_id_user, f.fol_cid, 
                s.sha_id, s.fol_id as fol_id_s, s.usu_id, (SELECT COUNT(*) FROM folders_and_files as sub_f LEFT JOIN 
                share_folders_and_files as sub_s ON sub_f.fol_id = sub_s.fol_id WHERE sub_f.fol_fld = f.fol_cid and sub_f.fol_tipo = 0) as children
                FROM folders_and_files as f LEFT JOIN share_folders_and_files as s ON f.fol_id = s.fol_id
                WHERE f.fol_tipo = 0 and f.fol_fld = ? $where ORDER BY f.fol_tipo, f.fol_nombre ASC";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$parent]);
                $result = $stm->fetchAll();
            }
            else
            {
                $parent = ($parent == '#') ? 'root' : $parent;
                $sql = "SELECT f.fol_id, f.fol_tipo, f.fol_fld, f.fol_url, f.fol_nombre, f.fol_extension, f.fol_id_user, f.fol_cid, 
                s.sha_id, s.fol_id as fol_id_s, s.usu_id, (SELECT COUNT(*) FROM folders_and_files as sub_f LEFT JOIN 
                share_folders_and_files as sub_s ON sub_f.fol_id = sub_s.fol_id WHERE sub_f.fol_fld = f.fol_cid and sub_f.fol_tipo = 0) as children
                FROM folders_and_files as f LEFT JOIN share_folders_and_files as s ON f.fol_id = s.fol_id
                WHERE f.fol_tipo = 0 and f.fol_fld = ? and f.fol_id_user = ? ORDER BY f.fol_tipo, f.fol_nombre ASC";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$parent, $_SESSION['usu_id']]);
                $result = $stm->fetchAll();
            }
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function cantidad_archivos_filtro($usu_id, $fol_fld) //es la misma consulta que seleccionar_producto_cuadricula en caso cambiar consulta cambiar en las dos funciones
    {
        try 
        {
            if($_SESSION['rol_id'] == 1)
            {
                $sql = "SELECT * FROM folders_and_files as f LEFT JOIN share_folders_and_files as s ON f.fol_id = s.fol_id
                WHERE fol_fld = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$fol_fld]);
                $result = $stm->fetchAll();
            }
            else
            {
                $sql = "SELECT * FROM folders_and_files as f LEFT JOIN share_folders_and_files as s ON f.fol_id = s.fol_id
                WHERE (f.fol_id_user = ? OR s.usu_id = ?) AND fol_fld = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$usu_id, $usu_id, $fol_fld]);
                $result = $stm->fetchAll();
            }
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function listar_file_manager($user_id, $fol_fld, $empieza_limite, $limite)//es la misma consulta que cantidad_productos_filtro en caso cambiar consulta cambiar en las dos funciones
    {
        $result = [];
        try 
        {
            if($_SESSION['rol_id'] == 1)
            {
                $sLimit = "LIMIT $empieza_limite, $limite";
                $sql = "SELECT f.fol_id, f.fol_tipo, f.fol_fld, f.fol_url, f.fol_nombre, f.fol_extension, f.fol_id_user, f.fol_cid FROM folders_and_files as f 
                WHERE fol_fld = ? ORDER BY f.fol_tipo, f.fol_nombre ASC $sLimit";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$fol_fld]);
                $result = $stm->fetchAll();
            }
            else
            {
                $sLimit = "LIMIT $empieza_limite, $limite";
                // $sql = "SELECT * FROM folders_and_files WHERE fol_id_user = 1 AND fol_fld = ? ORDER BY fol_tipo, fol_nombre ASC $sLimit";
                $sql = "SELECT f.fol_id, f.fol_tipo, f.fol_fld, f.fol_url, f.fol_nombre, f.fol_extension, f.fol_id_user, f.fol_cid, 
                s.sha_id, s.fol_id as fol_id_s, s.usu_id FROM folders_and_files as f LEFT JOIN share_folders_and_files as s ON f.fol_id = s.fol_id
                WHERE (f.fol_id_user = ? OR s.usu_id = ?) AND fol_fld = ? ORDER BY f.fol_tipo, f.fol_nombre ASC $sLimit";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$user_id, $user_id, $fol_fld]);
                $result = $stm->fetchAll();
            }
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_carpetas_subcarpertas_especificas($fol_id_antiguo, $url)
    {
        $result = [];
        try 
        {
            $likePattern = $url . '%';
            $sql = 'SELECT * FROM folders_and_files WHERE fol_id != ? AND fol_url LIKE ? ORDER BY fol_tipo, fol_nombre ASC';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fol_id_antiguo, $likePattern]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_fld($url)
    {
        $result = [];
        try 
        {
            $sql = 'SELECT * FROM folders_and_files WHERE fol_url = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$url]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function verificar_carpeta_archivo_compartido($fol_id)
    {
        $result = [];
        try 
        {
            //             SELECT CASE WHEN s.sha_estado = 1  OR EXISTS ( SELECT 1 FROM folders_and_files AS f2 JOIN share_folders_and_files AS s2 ON s2.fol_id = f2.fol_id
                // WHERE s2.sha_estado = 1 AND f.fol_url LIKE CONCAT(f2.fol_url, '%') AND f2.fol_id <> f.fol_id) 
                // THEN 1 ELSE s.sha_estado END AS sha_estado_final FROM folders_and_files AS f LEFT JOIN share_folders_and_files AS s 
                // ON s.fol_id = f.fol_id ORDER BY f.fol_url ASC;
            $sql = "SELECT s.usu_id, s.fol_id, s.sha_estado, CASE WHEN s.sha_estado = 1 OR EXISTS (SELECT 1 FROM folders_and_files AS f2 JOIN share_folders_and_files AS s2 ON s2.fol_id = f2.fol_id
                    WHERE s2.sha_estado = 1 AND f.fol_url LIKE CONCAT(f2.fol_url, '%') AND f2.fol_id <> f.fol_id) THEN 1 ELSE s.sha_estado END AS sha_estado_final FROM 
                    folders_and_files AS f LEFT JOIN share_folders_and_files AS s ON s.fol_id = f.fol_id WHERE f.fol_id = ? ORDER BY s.sha_estado DESC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fol_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function verificar_carpeta_archivo_compartido_usuario($fol_id, $usu_id)
    {
        $result = [];
        try 
        {
            $sql = "SELECT s.usu_id, s.fol_id, s.sha_estado, CASE WHEN s.sha_estado = 1 OR EXISTS (SELECT 1 FROM folders_and_files AS f2 JOIN share_folders_and_files AS s2 ON s2.fol_id = f2.fol_id
                    WHERE s2.sha_estado = 1 AND f.fol_url LIKE CONCAT(f2.fol_url, '%') AND f2.fol_id <> f.fol_id) THEN 1 ELSE s.sha_estado END AS sha_estado_final FROM 
                    folders_and_files AS f LEFT JOIN share_folders_and_files AS s ON s.fol_id = f.fol_id WHERE f.fol_id = ? and s.usu_id = ? ORDER BY s.sha_estado DESC";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fol_id, $usu_id]);
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
    public function guardar_carpeta_archivo($model)
    {
        $result = 0;
        try 
        {
            $sql = 'INSERT INTO folders_and_files(fol_tipo, fol_fld, fol_url, fol_nombre, fol_extension, fol_id_user, fol_cid) 
                VALUES (?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->fol_tipo,
                $model->fol_fld,
                $model->fol_url,
                $model->fol_nombre,
                $model->fol_extension,
                $model->fol_id_user,
                $model->fol_cid,
            ]);
            $lastId = $this->pdo->lastInsertId();// Obtener el ID insertado
            if(!empty($model->fol_compartido))
            {
                $users = $this->usuarios_compartidos($model->fol_compartido);
                if (!empty($users)) 
                {
                    foreach($users as $m)
                    {
                        if($m->sha_estado == 1 || $m->sha_estado_final == 1)
                        {
                            $sql_new = 'INSERT INTO share_folders_and_files(fol_id, usu_id) VALUES (?,?)';
                            $stm_new = $this->pdo->prepare($sql_new);
                            $stm_new->execute([$lastId, $m->usu_id]);
                        }
                    }
                }
            }
            if($model->fol_tipo == 0 && $model->option == 'copiar')
            {
                $datos = $this->obtener_carpetas_subcarpertas_especificas($model->mov_fil_seleccionado, $model->fol_url_principal);
                foreach($datos as $m)
                {
                    $cid = $this->generateToken();
                    $new_url = str_replace($model->fol_url_principal, $model->fol_url, $m->fol_url);
                    
                    $fld = $this->obtener_fld($new_url);
                    $fld_new = (empty($fld))?  $model->fol_cid : dirname($fld->fol_fld);

                    $sql_new = 'INSERT INTO folders_and_files(fol_tipo, fol_fld, fol_url, fol_nombre, fol_extension, fol_id_user, fol_cid) 
                    VALUES (?,?,?,?,?,?,?)';
                    $stm_new = $this->pdo->prepare($sql_new);
                    $stm_new->execute([
                        $m->fol_tipo,
                        $fld_new,
                        $new_url,
                        $m->fol_nombre,
                        $m->fol_extension,
                        $model->fol_id_user,
                        $cid,
                    ]);
                }
            }
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function guardar_renombrar_archivo($model)
    {
        $result = 0;
        try 
        {
            $sql_name = 'UPDATE folders_and_files SET fol_nombre = ?, fol_url = ? WHERE fol_id = ?';
            $stm_name = $this->pdo->prepare($sql_name);
            $stm_name->execute([
                $model->fol_name,
                $model->fol_new_url,
                $model->fol_id,
            ]);

            if($model->fol_tipo == 0)
            {
                // $likePattern = $model->fol_old_url . '%';
                // $sql = 'UPDATE folders_and_files SET fol_url = REPLACE(fol_url, ?, ?) WHERE fol_url LIKE ?';
                $sql = 'UPDATE folders_and_files SET fol_url = REPLACE(fol_url, ?, ?) WHERE fol_fld = ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->fol_old_url,
                    $model->fol_new_url,
                    $model->fol_cip
                    // $likePattern,
                ]);
            }
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function eliminar_compartir($fol_id, $usu_id)
    {
        $result = 0;
        try 
        {
            $sql_new = 'DELETE FROM share_folders_and_files WHERE fol_id = ? and usu_id = ?';
            $stm_new = $this->pdo->prepare($sql_new);
            $stm_new->execute([$fol_id, $usu_id]);
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;

    }
    public function guardar_compartir($model)
    {
        $result = 0;
        try 
        {
            $folders_raiz = $this->obtener_folders_raiz_compartidos($model->comp_fol_url);      
            $compartidos = $this->obtener_archivos_compartidos($model->comp_fol_url, $model->fol_id);
            if($model->remover_usuario == 1)
            {
                foreach ($model->usuarios as $usu_id)            
                {
                    $this->eliminar_compartir($model->fol_id, $usu_id);                    
                    foreach ($compartidos as $m)
                    {
                        $this->eliminar_compartir($m->fol_id, $usu_id);
                    }
                    
                    $parts = explode('/', $model->comp_fol_url); // Extraer la carpeta principal (files/imagenes)
                    $carpetaPrincipal = $parts[0] . '/' . $parts[1]; // Tomar los primeros dos segmentos como la carpeta principal (files/imagenes)
                    $verificador = $this->verificar_raiz_principal($carpetaPrincipal, $usu_id);
                    if($verificador->conteo == 1)
                    {
                        $this->eliminar_compartir($verificador->fol_id, $usu_id);
                    }    
                }
            }
            else
            {
                foreach ($model->usuarios as $usu_id)            
                {
                    foreach ($folders_raiz as $m)
                    {
                        $verficar_raiz = $this->verificar_raiz($m->fol_id, $usu_id);
                        if(empty($verficar_raiz))
                        {
                            $estado = ($model->fol_id == $m->fol_id)? 1:0;
                            $sql_new = 'INSERT INTO share_folders_and_files(fol_id, usu_id, sha_estado) VALUES (?,?,?)';
                            $stm_new = $this->pdo->prepare($sql_new);
                            $stm_new->execute([$m->fol_id, $usu_id, $estado]);
                        }
                        else
                        {
                            if($model->fol_id == $m->fol_id)
                            {
                                $sql_new = 'UPDATE share_folders_and_files SET sha_estado = ? WHERE sha_id = ?';
                                $stm_new = $this->pdo->prepare($sql_new);
                                $stm_new->execute([1, $verficar_raiz->sha_id]);
                            }
                        }
                    }
                    foreach ($compartidos as $m)
                    {
                        $verficar_raiz = $this->verificar_raiz($m->fol_id, $usu_id);
                        if(empty($verficar_raiz))
                        {
                            $estado = ($model->fol_id == $m->fol_id)? 1:0;
                            $sql_new = 'INSERT INTO share_folders_and_files(fol_id, usu_id, sha_estado) VALUES (?,?,?)';
                            $stm_new = $this->pdo->prepare($sql_new);
                            $stm_new->execute([$m->fol_id, $usu_id, $estado]);
                        }
                        else
                        {
                            if(($verficar_raiz->fol_id == $m->fol_id) && $usu_id == $verficar_raiz->usu_id && $verficar_raiz->sha_estado == 1)
                            {
                                $sql_new = 'UPDATE share_folders_and_files SET sha_estado = ? WHERE sha_id = ?';
                                $stm_new = $this->pdo->prepare($sql_new);
                                $stm_new->execute(['0', $verficar_raiz->sha_id]);
                            }
                        }
                    }
                }
            }
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function mover_copiar_archivos($model)
    {
        $result = 0;
        try 
        {
            $sql_name = 'UPDATE folders_and_files SET fol_fld = ?, fol_url = ? WHERE fol_id = ?';
            $stm_name = $this->pdo->prepare($sql_name);
            $stm_name->execute([
                $model->fol_cip,
                $model->fol_new_url,
                $model->fol_id,
            ]);

            if($model->fol_tipo == 0)
            {
                $likePattern = $model->fol_old_url . '%';
                // $sql = 'UPDATE folders_and_files SET fol_url = REPLACE(fol_url, ?, ?) WHERE fol_fld = ?';
                $sql = 'UPDATE folders_and_files SET fol_url = REPLACE(fol_url, ?, ?) WHERE fol_url LIKE ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->fol_old_url,
                    $model->fol_new_url,
                    $likePattern,
                    // $model->fol_cip
                ]);
            }
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function eliminar_archivos($fol_id, $tipo, $url)
    {
        $result = 0;
        try 
        {
            if($tipo == 0)
            {
                $likePattern = $url . '%';
                $sql_share = 'DELETE s FROM share_folders_and_files AS s INNER JOIN folders_and_files AS f ON f.fol_id = s.fol_id WHERE f.fol_url LIKE ?';
                $stm_share = $this->pdo->prepare($sql_share);
                $stm_share->execute([$likePattern]);

                $sql = 'DELETE FROM folders_and_files WHERE fol_url LIKE ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([ $likePattern]);
            }
            else
            {
                $sql = 'DELETE FROM share_folders_and_files WHERE fol_id = ?';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([$fol_id]);

                $sql_name = 'DELETE FROM folders_and_files WHERE fol_id = ?';
                $stm_name = $this->pdo->prepare($sql_name);
                $stm_name->execute([$fol_id]);
            }
            $result = 1;
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function seleccionar_usuario_lazy_load($get_page, $get_search, $usu_id, $limite)
    {
        try 
        {
            // Configurar las variables
            $limit = $limite; // Límite de resultados por página
            $page = $get_page ?? 1; // Página actual
            $start = ($page - 1) * $limit; // Calcular el índice de inicio
            $searchTerm = $get_search; // Establecer el término de búsqueda (si no se proporciona, dejar en blanco para obtener todos los resultados)

            $stm = $this->pdo->prepare("SELECT * FROM usuario where rol_id !=1 and usu_id != :usu_id and (usu_nombre_completo LIKE :searchTerm or usu_numero_doc LIKE :searchTermNum) 
            order by usu_id desc LIMIT :start, :limit");

            // Asignar valores a los parámetros
            $stm->bindValue(':usu_id', $usu_id, PDO::PARAM_STR);
            $stm->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $stm->bindValue(':searchTermNum', $searchTerm, PDO::PARAM_STR);
            $stm->bindValue(':start', $start, PDO::PARAM_INT);
            $stm->bindValue(':limit', $limit, PDO::PARAM_INT);

            $stm->execute();

            $result = $stm->fetchAll();            
            // $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function seleccionar_usuario_compartido_lazy_load($get_page, $get_search, $usu_id, $fol_id, $limite)
    {
        try 
        {
            // Configurar las variables
            $limit = $limite; // Límite de resultados por página
            $page = $get_page ?? 1; // Página actual
            $start = ($page - 1) * $limit; // Calcular el índice de inicio
            $searchTerm = $get_search; // Establecer el término de búsqueda (si no se proporciona, dejar en blanco para obtener todos los resultados)

            $stm = $this->pdo->prepare("SELECT * FROM share_folders_and_files as s inner join usuario as u on u.usu_id = s.usu_id 
            WHERE fol_id = :fol_id and u.usu_id != :usu_id and (u.usu_nombre_completo LIKE :searchTerm or u.usu_numero_doc LIKE :searchTermNum) 
            order by u.usu_id desc LIMIT :start, :limit");

            // Asignar valores a los parámetros
            $stm->bindValue(':fol_id', $fol_id, PDO::PARAM_STR);
            $stm->bindValue(':usu_id', $usu_id, PDO::PARAM_STR);
            $stm->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
            $stm->bindValue(':searchTermNum', $searchTerm, PDO::PARAM_STR);
            $stm->bindValue(':start', $start, PDO::PARAM_INT);
            $stm->bindValue(':limit', $limit, PDO::PARAM_INT);

            $stm->execute();

            $result = $stm->fetchAll();            
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function usuarios_compartidos($fol_id)
    {
        $result = [];
        try 
        {
            $sql = "SELECT s.usu_id, s.sha_estado, CASE WHEN s.sha_estado = 1 OR EXISTS (SELECT 1 FROM folders_and_files AS f2 JOIN share_folders_and_files AS s2 ON s2.fol_id = f2.fol_id
                    WHERE s2.sha_estado = 1 AND f.fol_url LIKE CONCAT(f2.fol_url, '%') AND f2.fol_id <> f.fol_id) THEN 1 ELSE s.sha_estado END AS sha_estado_final FROM 
                    folders_and_files AS f LEFT JOIN share_folders_and_files AS s ON s.fol_id = f.fol_id WHERE  f.fol_id = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$fol_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_folders_raiz_compartidos($url)
    {
        $result = [];
        try 
        {
            $parts = explode('/', $url); // Dividir la URL en partes
            $urlsABuscar = [];// Inicializar un array para almacenar las URLs a buscar
            
            for ($i = count($parts); $i > 1; $i--) // Construir las URLs desde la más específica hasta la más general
            {
                $urlPart = implode('/', array_slice($parts, 0, $i));
                $urlsABuscar[] = $urlPart;
            }
            $placeholders = implode(',', array_fill(0, count($urlsABuscar), '?'));// Construir la consulta SQL utilizando IN para buscar múltiples URLs
            $stm = $this->pdo->prepare("SELECT * FROM folders_and_files WHERE fol_url IN ($placeholders)");
            $stm->execute($urlsABuscar); // Ejecutar la consulta con los parámetros
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_archivos_compartidos($url, $fol_id)
    {
        $result = [];
        try 
        {
            // $parts = explode('/', $url); // Extraer la carpeta principal (files/imagenes)
            // $carpetaPrincipal = $parts[0] . '/' . $parts[1]; // Tomar los primeros dos segmentos como la carpeta principal (files/imagenes)
            $likePattern = $url . '%';
            $stm = $this->pdo->prepare('SELECT * FROM folders_and_files WHERE fol_url LIKE ? and fol_id != ?');
            $stm->execute([$likePattern, $fol_id]);
            $result = $stm->fetchAll();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function verificar_raiz($fol_id, $usu_id)
    {
        $result = [];
        try 
        {
            $stm = $this->pdo->prepare('SELECT * FROM share_folders_and_files WHERE fol_id = ? and usu_id = ?');
            $stm->execute([$fol_id, $usu_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function verificar_raiz_principal($url, $usu_id)
    {
        $result = [];
        try 
        {
            $likePattern = $url . '%';
            $stm = $this->pdo->prepare('SELECT COUNT(*) AS conteo, f.fol_id FROM folders_and_files as f
                INNER JOIN share_folders_and_files as s ON s.fol_id = f.fol_id WHERE f.fol_url LIKE ? and usu_id = ?');
            $stm->execute([$likePattern, $usu_id]);
            $result = $stm->fetch();
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
}