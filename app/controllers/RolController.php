<?php
//importamos los archivos del model
require_once 'app/models/Rol.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php';

class RolController
{
    private $navbar;
    private $rol;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->rol = new Rol();
        $this->bitacora = new Bitacora();
        $this->log = new Log();
    }
    public function verificar_permiso()
    {
        echo 'ok';
    }
    //funcion para cargar la vista
    public function mostrar() 
    {
        $opc_modulo = $this->navbar->obtener_opcion_modulo($_GET['c']);
        $modulo = $opc_modulo->mod_nombre;
        $ico_modulo = $opc_modulo->mod_icono;
        $nombre_opcion = $opc_modulo->opc_nombre;

        $modulos = $this->navbar->obtener_modulos();
        $modulos_rol = $this->navbar->obtener_modulos_rol($_SESSION['rol_id']);
        $permisos_usuario = $this->navbar->obtener_permisos_rol($_SESSION['rol_id']);

        require_once _VIEW_PATH_ . 'header-admin.php';
        require_once _VIEW_PATH_ . 'navbar-admin.php';
        require_once _VIEW_PATH_ . 'modulo_acceso/rol/rol.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    //funcion para listar los datos
    public function listar()
    {
        $model = $this->rol->listar();
        $data = array();
        $i=1;
        foreach ($model as $m)
        {
            $data[]=array(
                "0"=>$i,             
                "1"=>$m->rol_nombre,
                "2"=>$m->rol_descripcion,
                "3"=>($m->rol_estado)? '<span class="badge bg-gradient-success"> Activo</span>':'<span class="badge bg-gradient-danger">Inactivo</span>',
                "4"=>$this->isRol = ($m->rol_id >=0 && $m->rol_id <=5)? '<button data-tippy-content="<small>Ver Permisos</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="obtener_permisos_rol('.$m->rol_id.')"><i class="fas fa-eye"></i></button></a>' : 
                    $this->isRol = ($m->rol_estado)? '<button data-tippy-content="<small>Ver Permisos</small>s" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="obtener_permisos_rol('.$m->rol_id.')"><i class="fas fa-eye"></i></button></a>
                    <button data-tippy-content="<small>Editar Rol</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="editar('.$m->rol_id.')"><i class="fas fa-edit"></i></button></a>'.
                    ' <button data-tippy-content="<small>Desactivar Rol</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="desactivar('."0".','.$m->rol_id.')"><i class="fas fa-toggle-on"></i></button>':
                    ' <button data-tippy-content="<small>Activar Rol</small>" class="tooltip_tippy btn btn-success btn-circle btn-sm btn-flat" onclick="activar('."1".','.$m->rol_id.')"><i class="fas fa-toggle-off"></i></button>'
            );
            $i++;
        }
        $result = array(
            "sEcho"=>1,//para numerar el datatable
            "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
            "iTotalDisplayRecords"=>count($data),//enviamos el total de registros  a visualizar al datatable
            "aaData"=>$data);
        echo json_encode($result);
    }
    public function crear_arbol_navbar()
    {
        $model_mod = $this->rol->obtener_modulos();
        foreach($model_mod as $mod) // jstree-open
        {
            $id = ($mod->mod_multiple == 0)? $mod->per_id : 'nav_'.$mod->mod_id;
            $nombre = ($mod->mod_multiple == 0)? $mod->mod_nombre .' - '.$mod->opc_nombre : $mod->mod_nombre;
            $is_disabled = ($mod->mod_id == 3)? 'disabledDiv': null;
            echo '
            <li  data-jstree="{&quot&#105con&quot:&quot '.$mod->mod_icono.' text-primary &quot}" icon="glyphicon glyphicon-leaf" class="jstree-open '.$is_disabled.'" name="per_id_mul[]" id="'.$id.'">'.$nombre.'';
                    $model_opc = $this->rol->obtener_opciones_navbar($mod->mod_id);
                    if($mod->mod_multiple == 1)
                    {
                        foreach($model_opc as $opc)
                        {
                            echo '<ul> <li  data-jstree="{&quot&#105con&quot:&quot fas fa-file text-primary &quot}" name="per_id_mul[]" id="'.$opc->per_id.'">'.$opc->opc_nombre.'</li> </ul>';
                        }
                    }
            echo'</li>';
        }
    }
    public function obtener_permisos_rol()
    {
        $rol_id = $_POST['rol_id'];
        $model = $this->navbar->obtener_permisos_rol($rol_id);

        $data = array();
        foreach ($model as $m)
        {
            $data[]= $m->per_id;
        }
        echo json_encode($data);
    }
    //funcion para guardar y editar los datos
    public function guardar_editar() 
    {        
        try
        {
            $model = new Rol();
            $model->rol_id = $_POST['rol_id'];
            $model->rol_nombre = $_POST['rol_nombre'];
            $model->rol_descripcion = $_POST['rol_descripcion'];
            $model->per_id = $_POST['per_id'];

            $result = $this->rol->guardar_editar($model);
            if($model->rol_id)
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result==1 ? $this->bitacora->guardar('Editó Rol con ID:'.$model->rol_id, 'ok') : $this->bitacora->guardar('Error en editar Cargo con ID:'.$model->rol_id, 'error');
            } 
            else 
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Guardado Correctamente" : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
                $result==1 ? $this->bitacora->guardar('Insertó Rol con ID:'.$model->rol_id, 'ok') : $this->bitacora->guardar('Error en registrar Rol con ID:'.$model->rol_id, 'error');
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
    //funcion para obtener un dato especifico
    public function obtener()
    {
        $rol_id = $_POST['rol_id'];
        $model = $this->rol->obtener($rol_id);

        $model_per = $this->navbar->obtener_permisos_rol($rol_id);

        $data = array();
        foreach ($model_per as $m)
        {
            $data[]= $m->per_id;
        }
        echo json_encode(array('datos'=>$model, 'permisos'=> $data));
    }
    //funcion para activar o desactivar
    public function activar_desactivar()
    {
        try
        {
            $rol_id = $_POST['rol_id']; 
            $rol_estado = $_POST['rol_estado'];
            
            $result = $this->rol->activar_desactivar($rol_estado,$rol_id);
            if($result !== 1 && $result !== 2) 
            {
                $this->bitacora->guardar('Fallo Al cambiar estado del Rol con ID: ' . $rol_id, 'error');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Rol activado con ID: ' . $rol_id, 'ok');
                $rpta = 'ok';
                $mensaje = 'El Rol fue Activado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Rol Desactivado con ID: ' . $rol_id, 'ok');
                $rpta = 'ok';
                $mensaje = 'El Rol fue Desactivado correctamente';
            }
        } 
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';        
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
}
