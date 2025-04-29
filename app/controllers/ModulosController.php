<?php
//importamos los archivos del model
require_once 'app/models/Configuracion.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php';

class ModulosController
{
    private $navbar;
    private $configuracion;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->navbar = new Navbar();
        $this->configuracion = new Configuracion();
        $this->bitacora = new Bitacora();
        $this->log = new Log();
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
        require_once _VIEW_PATH_ . 'modulo_configuracion/modulos_opciones/modulos.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function mostrar_modulos()
    {
        $modulos = $this->configuracion->obtener_modulos();
        $i=1;
        $orden = count($modulos) - 1; 
        echo '<input type="hidden" name="orden" id="orden" value="'.$orden.'">';
        foreach($modulos as $mod)
        {
            $estado = ($mod->mod_estado == 1)? '<button type="button" title="Desactivar Modulo" style="margin-top: -5px;" class=" btn btn-danger btn-circle btn-sm btn-flat float-right ml-1" onclick="desactivar_modulo(0,'.$mod->mod_id.')"><i class="fas fa-toggle-on"></i></button>' :
            '<button type="button" title="Activar Modulo" style="margin-top: -5px;" class=" btn btn-success btn-circle btn-sm btn-flat float-right ml-1" onclick="activar_modulo(1,'.$mod->mod_id.')"><i class="fas fa-toggle-on"></i></button>';
            $estado_mod = ($mod->mod_estado == 1)? 'Activo' : 'Inactivo';
            $color_est = ($mod->mod_estado == 1)? 'bg-gradient-success' : 'bg-gradient-danger';

            $multiple = ($mod->mod_multiple == 1)? 'Multiple' : 'No Multiple';
            $color_mul = ($mod->mod_multiple == 1)? 'bg-gradient-success' : 'bg-gradient-danger';
            if($mod->mod_id != 1 && $mod->mod_id != 2)
            {
                echo '
                <li>
                    <span class="handle text">
                        <i class="'.$mod->mod_icono.' nav-icon"></i>
                    </span>
                    <span class="handle text">'.$mod->mod_nombre.'</span>
                    <small class="handle badge '.$color_est.'">'.$estado_mod.'</small>
                    <small class="handle badge '.$color_mul.'">'.$multiple.'</small>
                    <input type="hidden" value="'.$mod->mod_id.'" id="mod_id[]" name="mod_id[]">
                    <button type="button" title="Eliminar Modulo" style="margin-top: -5px;" class="btn btn-danger btn-sm btn-flat float-right ml-1" onclick="eliminar_modulo('.$mod->mod_id.',\''.$mod->mod_nombre.'\')"><i class="fas fa-trash"></i></button>
                    <button type="button" title="Editar Modulo" style="margin-top: -5px;" class="btn btn-warning btn-sm btn-flat float-right ml-1" onclick="editar_modulo('.$mod->mod_id.',\''.$mod->mod_nombre.'\',\''.$mod->mod_icono.'\',\''.$mod->mod_multiple.'\')"><i class="fas fa-edit"></i></button>
                    '.$estado.'
                    <button type="button" title="Ver Opciones del Modulo" style="margin-top: -5px;" class="btn btn-primary btn-sm btn-flat float-right" onclick="mostrar_opciones_modulo('.$mod->mod_id.', '.$mod->mod_multiple.',\''.$mod->mod_nombre.'\')"><i class="fas fa-eye"></i></button>
                </li>';
                $i++;
            }
        }
    }
    public function mostrar_opciones_x_modulos()
    {
        $mod_id = $_POST['mod_id'];
        $opciones = $this->configuracion->obtener_opciones_modulos($mod_id);
        $i=1;
        $orden = count($opciones) + 1; 
        echo '<input type="hidden" name="orden_opc" id="orden_opc" value="'.$orden.'">';
        foreach($opciones as $opc)
        {
            $multiple = ($opc->opc_estado == 1)? 'Activo' : 'Inactivo';
            $color_mul = ($opc->opc_estado == 1)? 'bg-gradient-success' : 'bg-gradient-danger';

            $estado = ($opc->opc_estado == 1)? '<button type="button" title="Desactivar Opcion" style="margin-top: -5px;" class=" btn btn-danger btn-circle btn-sm btn-flat float-right ml-1" onclick="desactivar(0,'.$opc->opc_id.')"><i class="fas fa-toggle-on"></i></button>' :
                '<button type="button" title="Activar Opcion" style="margin-top: -5px;" class=" btn btn-success btn-circle btn-sm btn-flat float-right ml-1" onclick="activar(1,'.$opc->opc_id.')"><i class="fas fa-toggle-on"></i></button>';
            $per = $this->configuracion->obtener_controlador($opc->opc_id);
            echo '
            <li>
                <span class="handle text">
                    <i class="far fa-circle nav-icon"></i>
                </span>
                <span class="handle text">'.$opc->opc_nombre.'</span>
                <small class="handle badge '.$color_mul.'">'.$multiple.'</small>
                <input type="hidden" value="'.$opc->opc_id.'" id="opc_id[]" name="opc_id[]">
                <button type="button" title="Eliminar Opcion" style="margin-top: -5px;" class="btn btn-danger btn-sm btn-flat float-right ml-1" onclick="eliminar_opcion('.$opc->opc_id.','.$per->per_id.',\''.$opc->opc_nombre.'\')"><i class="fas fa-trash"></i></button>
                <button type="button" title="Editar Modulo" style="margin-top: -5px;" class="btn btn-warning btn-sm btn-flat float-right ml-1" onclick="editar_opcion('.$opc->opc_id.','.$per->per_id.',\''.$opc->opc_nombre.'\',\''.$opc->opc_nombre_abrev.'\',\''.$opc->opc_funcion.'\',\''.$per->per_controlador.'\')"><i class="fas fa-edit"></i></button>
                '.$estado.'
            </li>';
            $i++;
        }
    }
    public function cambiar_orden_modulos()
    {
        try
        {
            $mod_id = $_POST['mod_id'];
            $result = $this->configuracion->cambiar_orden_modulos($mod_id);
            if($result !== 1 && $result !== 2) 
            {
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Cambio orden Modulos', 'ok');
                $rpta = 'ok';
                $mensaje = 'Se Cambio el Orden de los Modulos Correctamente';
            }
            else 
            {
                $this->bitacora->guardar('Fallo Al cambiar Orden Modulos ', 'error');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
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
    public function cambiar_orden_opciones()
    {
        try
        {
            $opc_id = $_POST['opc_id'];
            $result = $this->configuracion->cambiar_orden_opciones($opc_id);
            if($result !== 1 && $result !== 2) 
            {
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Cambio orden Opciones', 'ok');
                $rpta = 'ok';
                $mensaje = 'Se Cambio el Orden de las Opciones Correctamente';
            }
            else 
            {
                $this->bitacora->guardar('Fallo Al cambiar Orden de Opciones ', 'error');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
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
    public function guardar_editar_modulo()
    {
        try
        {
            $model = new Configuracion();
            $model->mod_id = $_POST['reg_mod_id'];
            $model->mod_nombre = $_POST['reg_mod_nombre'];
            $model->mod_icono = $_POST['reg_mod_ico'];
            $model->mod_multiple = $_POST['reg_mod_multiple'];
            $model->mod_orden = $_POST['reg_mod_orden'];

            $result = $this->configuracion->guardar_editar_modulo($model);
    
            if($model->mod_id)
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result==1 ? $this->bitacora->guardar('Editó Modulo con ID:'.$model->mod_id, 'ok') : $this->bitacora->guardar('Error en editar Modulo con ID:'.$model->mod_id, 'error');
            } 
            else 
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Guardado Correctamente" : "No se pudo guardar el registro, Intente contactar con el administrador del sistema"; 
                $result==1 ? $this->bitacora->guardar('Insertó Modulo con', 'ok') : $this->bitacora->guardar('Error en registrar Modulo', 'error');
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
    public function eliminar_modulos()
    {
        $mod_id = $_POST['mod_id'];
        $mensaje = '';
        $rpta = '';
        $rp = $this->configuracion->eliminar_modulos($mod_id);
        if($rp == 1)
        {
            $rpta = 'ok';
            $mensaje = 'Se elimino correctamente el modulo';
        }
        else 
        {
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    } 
    public function guardar_editar_opcion()
    {
        try
        {
            $model = new Configuracion();
            $model->opc_id = $_POST['reg_opc_id'];
            $model->mod_id = $_POST['reg_opc_mod_id'];
            $model->opc_nombre = $_POST['reg_opc_nombre'];
            $model->opc_nombre_abrev = $_POST['reg_opc_nombre_abrev'];
            $model->opc_funcion = $_POST['reg_opc_funcion'];
            $model->opc_orden = $_POST['reg_opc_orden'];            
            $model->per_id = $_POST['reg_per_id'];            
            $model->controlador = $_POST['reg_opc_controlador'];

            $result = $this->configuracion->guardar_editar_opcion($model);
    
            if($model->opc_id)
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result==1 ? $this->bitacora->guardar('Editó Opcion con ID:'.$model->opc_id, 'ok') : $this->bitacora->guardar('Error en editar Opcion con ID:'.$model->opc_id, 'error');
            } 
            else 
            {
                $rpta = ($result == 1)? "ok" : "error";
                $mensaje = ($result == 1)? "Registro Guardado Correctamente" : "No se pudo guardar el registro, Intente contactar con el administrador del sistema"; 
                $result==1 ? $this->bitacora->guardar('Insertó Opcion con', 'error') : $this->bitacora->guardar('Error en registrar Opcion', 'error');
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
    public function eliminar_opcion()
    {
        $opc_id = $_POST['opc_id'];
        $per_id = $_POST['per_id'];
        $mensaje = '';
        $rpta = '';
        $rp = $this->configuracion->eliminar_opcion($opc_id, $per_id);
        if($rp == 1)
        {
            $rpta = 'ok';
            $mensaje = 'Se elimino correctamente la Opcion';
        }
        else 
        {
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
    //funcion para activar o desactivar
    public function activar_desactivar()
    {
        try
        {
            $opc_id = $_POST['opc_id']; 
            $estado = $_POST['estado'];
            
            $result = $this->configuracion->activar_desactivar($estado,$opc_id);
            if($result !== 1 && $result !== 2) 
            {
                $this->bitacora->guardar('Fallo Al cambiar estado de la opcion con ID: ' . $opc_id, 'error');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Opcion activada con ID: ' . $opc_id, 'ok');
                $rpta = 'ok';
                $mensaje = 'La opcion fue activada correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Opcion desactivada con ID: ' . $opc_id, 'ok');
                $rpta = 'ok';
                $mensaje = 'La opcion fue desactivada correctamente';
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
    //funcion para activar o desactivar
    public function activar_desactivar_modulo()
    {
        try
        {
            $mod_id = $_POST['mod_id']; 
            $estado = $_POST['estado'];
            
            $result = $this->configuracion->activar_desactivar_modulo($estado,$mod_id);
            if($result !== 1 && $result !== 2) 
            {
                $this->bitacora->guardar('Fallo Al cambiar estado del Modulo con ID: ' . $mod_id, 'error');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Modulo activado con ID: ' . $mod_id, 'ok');
                $rpta = 'ok';
                $mensaje = 'El modulo fue activado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Modulo desactivado con ID: ' . $mod_id, 'ok');
                $rpta = 'ok';
                $mensaje = 'El modulo fue desactivado correctamente';
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
