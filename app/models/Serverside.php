<?php
//llamamos al archivo que contiene la conexion y al log
require_once 'core/Database.php';
require_once 'app/models/Log.php';
class Serverside
{
    private $pdo;//variable privada que contendra la conexion
    private $log;//variable para registrar los errores del sistema
    public function __construct()
    {
        $this->pdo = Database::getConnection();//llamamos la conexion al iniciar la clase
        $this->log = new Log();
    }
    public function limit()
    {
        $limit = "";
        if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' ) 
        {
            $limit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".intval( $_GET['iDisplayLength'] );
        }
        return $limit;
    }
    public function order($columns)
    {
        // Ordering
        $order ="";
        if ( isset( $_GET['iSortCol_0'] ) ) 
        {
            $order = "ORDER BY  ";
            if ( intval($_GET['iSortingCols']) == 1 ) 
            {
                if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_0']) ] == "true" ) 
                {
                    $sortDir = (strcasecmp($_GET['sSortDir_0'], 'ASC') == 0) ? 'ASC' : 'DESC';
                    $order .= $columns[ intval( $_GET['iSortCol_0'] ) ]." ". $sortDir .", ";
                }
            }
            $order = substr_replace( $order, "", -2 );
            if ( $order == "ORDER BY" ) 
            {
                $order = "";
            }
        }        
        return $order;
    }
    public function where($columnas, $filtro)
    {
        /*Filtrado
        * NOTA: esto no coincide con el filtrado integrado de DataTables que sí lo hace. palabra por palabra en cualquier campo. 
        * Es posible hacerlo aquí, pero preocupado por la eficiencia. en tablas muy grandes, y la funcionalidad de expresiones regulares de MySQL es muy limitada */
        $where = "";
        if ( isset($filtro) && $filtro != "" && $filtro != null) 
        {
            $where = "WHERE $filtro ";
        }        

        if ( isset($_GET['fecha_inicio']) && $_GET['fecha_inicio'] != "" && isset($_GET['fecha_fin']) && $_GET['fecha_fin'] != "" ) 
        {
            if ( $where == "" )  { $where = "WHERE "; } else  { $where .= " AND "; }

            $fecha_inicio = $_GET['fecha_inicio'];
            $fecha_fin = $_GET['fecha_fin'];
            $where .= "( DATE(v.ven_fecha) BETWEEN '$fecha_inicio' AND '$fecha_fin' ) ";
        }        

        if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) 
        {
            if ( $where == "" )  { $where = "WHERE "; } else  { $where .= " AND "; }
            
            $where .= " (";
            for ( $i=0 ; $i<count($columnas) ; $i++ ) 
            {
                if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" ) 
                {
                    $where .= $columnas[$i]." LIKE :search OR ";
                }
            }
            $where = substr_replace( $where, "", -3 );
            $where .= ')';
        }        
        // if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) 
        // {
        //     $where = "WHERE (";
        //     for ( $i=0 ; $i<count($columnas) ; $i++ ) 
        //     {
        //         if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" ) 
        //         {
        //             $where .= $columnas[$i]." LIKE :search OR ";
        //         }
        //     }
        //     $where = substr_replace( $where, "", -3 );
        //     $where .= ')';
        // }
        // Individual column filtering
        for ( $i=0 ; $i<count($columnas) ; $i++ ) 
        {
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ) 
            {
                if ( $where == "" ) 
                {
                    $where = "WHERE ";
                }
                else 
                {
                    $where .= " AND ";
                }
                $where .= $columnas[$i]." LIKE :search".$i." ";
            }
        }
        return $where;
    }
    public function obtener_total($index_tabla, $tabla, $filtro, $agrupar)
    {
        $result = '';
        try 
        {
            $where = "";
            $group_by = "";
            if ( isset($filtro) && $filtro != "" && $filtro != null) 
            {
                $where = "WHERE $filtro ";
            }  
            $group_by = "";
            if ( isset($agrupar) && $agrupar != "" && $agrupar != null) 
            {
                $group_by = "GROUP BY $agrupar ";
            }  
            if($group_by == '')
            {
                $stm = $this->pdo->prepare("SELECT COUNT($index_tabla) as total FROM $tabla $where $group_by");
                $stm->execute();
                $result = current($stm->fetch());
            }
            else
            {
                $stm = $this->pdo->prepare("SELECT $index_tabla as total FROM $tabla $where $group_by");
                $stm->execute();
                $resultado = $stm->fetchAll();
                $result = count($resultado);
            }
        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $result;
    }
    public function obtener_total_filtro()
    {
        $total_fitro = 0;
        try
        {
            $total_fitro = current($this->pdo->query('SELECT FOUND_ROWS()')->fetch());
        }
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return $total_fitro;
    }
    public function listado_serverside($tabla, $index_tabla, $columnas, $filtro, $agrupar) 
    {
        /*
        * Se debe poner primero en el array todas las columnas con las que el order by funcionara, 
        * luego de tener claro ese detalle, poner las columnas con las que el filtro de datatable funcionara
        * (tener en cuenta que las primeras columnas del order by se tomaran en cuenta en el filtro, si no 
        * deseas que se tomen esa columna como filtro, desactivarlo desde el mismo datatable);
        * Si deseas poner todas las columnas con filtro tendras que crear columnas en tu tabla para que funcione
        * de acuerdo al tamaño del array;
        * Ejemplo de como crear tu array para las columnas
        * $columns = array('column_a', 'column_b', 'column_c', ...., 'column_z') 
        * no es necesario poner una clave al valor del array pero para mayor orden ponerlos
        */
        $result = [];
        try 
        {
            $limit = $this->limit();
            $order = $this->order($columnas);
            $where = $this->where($columnas, $filtro);

            $line = str_replace(" , ", " ", implode(", ", $columnas));

            $group_by = "";
            if ( isset($agrupar) && $agrupar != "" && $agrupar != null) 
            {
                $group_by = "GROUP BY $agrupar ";
            }  

            $sql = "SELECT  SQL_CALC_FOUND_ROWS $line FROM $tabla $where $group_by $order $limit";

            $stm = $this->pdo->prepare($sql);

            // Bind parameters
            
            if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) 
            {
                $stm->bindValue(':search', '%'.$_GET['sSearch'].'%', PDO::PARAM_STR);
            }
            for ( $i=0 ; $i<count($columnas) ; $i++ ) 
            {
                if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' ) 
                {
                    $stm->bindValue(':search'.$i, '%'.$_GET['sSearch_'.$i].'%', PDO::PARAM_STR);
                }
            }

            $stm->execute();
            $result = $stm->fetchAll();

            $total_fitro = $this->obtener_total_filtro();
            $total = $this->obtener_total($index_tabla, $tabla, $filtro, $agrupar);

        } 
        catch (Exception $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
        }
        return array("result"=>$result, "iTotalRecords" => $total, "iTotalDisplayRecords" => $total_fitro);
    }
}
?>