<?php
//importamos los archivos del model
require_once 'app/models/Cliente.php';
require_once 'app/models/Navbar.php';
require_once 'app/models/Bitacora.php';
require_once 'app/models/Log.php';
require_once 'app/models/Globals.php';

class ClienteController
{
    private $global;
    private $navbar;
    private $cliente;
    private $bitacora;
    private $log;
    public function __construct()
    {
        $this->global = new Config();
        $this->navbar = new Navbar();
        $this->cliente = new Cliente();
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

        if($_SESSION['rol_id'] == 4)
        {
            $estado_ape = (object) array('ape_estado' => '0');
            require_once _VIEW_PATH_ . 'admin/cajero/header-caja.php';
        }
        else
        {
            require_once _VIEW_PATH_ . 'header-admin.php';
            require_once _VIEW_PATH_ . 'navbar-admin.php';
        }
        require_once _VIEW_PATH_ . 'cliente/cliente.php';
        require_once _VIEW_PATH_ . 'footer-admin.php';
    }
    public function verificar_permiso()
    {
        echo 'ok';
    }
    //funcion para listar los datos
    public function listar()
    {
        $model = $this->cliente->listar();
        $data = array();
        $i=1;
        foreach ($model as $m)
        {
            $is_hidden = ($m->cli_id == 1)? 'hidden' : null; 
            $data[]=array(
                "0"=>$i,
                "1"=>'<span style="white-space: normal; word-wrap: break-word; text-align : justify !important;">'.$m->cli_nombre.'</span>',
                "2"=>$m->tip_ide_abrev,
                "3"=>$m->cli_num_doc,
                "4"=>$m->cli_direccion,
                "5"=>$m->cli_telefono,
                "6"=>$m->cli_correo,
                "7"=>($m->cli_estado)?'<span class="badge bg-gradient-success"> Activo</span>':'<span class="badge bg-gradient-danger">Inactivo</span>',
                "8"=>($m->cli_estado)?'<button '.$is_hidden.' data-tippy-content="<small>Editar cliente</small>" class="tooltip_tippy btn btn-warning btn-circle btn-sm btn-flat" onclick="editar('.$m->cli_id.')"><i class="fas fa-edit"></i></button></a>'.
                    ' <button '.$is_hidden.' data-tippy-content="<small>Desactivar Cliente</small>"  class="tooltip_tippy btn btn-danger btn-circle btn-sm btn-flat" onclick="desactivar('."0".','.$m->cli_id.')"><i class="fas fa-toggle-on"></i></button>':
                    ' <button data-tippy-content="<small>Activar Cliente</small>" class="tooltip_tippy btn btn-success btn-circle btn-sm btn-flat" onclick="activar('."1".','.$m->cli_id.')"><i class="fas fa-toggle-off"></i></button>'
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
    //funcion para guardar y editar los datos
    public function guardar_editar()  
    {        
        try
        {
            $model = new Cliente();
            $model->cli_id = $_POST['cli_id'];
            $model->cli_nombre = $_POST['cli_nombre'];
            $model->cli_tipo = $_POST['cli_tipo'];
            $model->cli_num_doc = $_POST['cli_num_doc'];
            $model->cli_direccion = $_POST['cli_direccion'];
            $model->cli_telefono = $_POST['cli_telefono'];
            $model->cli_correo = $_POST['cli_correo'];

            $result = $this->cliente->guardar_editar($model);

            if($model->cli_id)
            {
                $rpta = ($result['rpta'] == 1)? "ok" : $rpta = ($result['rpta'] == 3)? 'unico': "error";
                $mensaje = ($result['rpta'] == 1)? "Registro Actualizado Correctamente" : $mensaje = ($result['rpta'] == 3)? 'Este Cliente ya se encuentra registrado, intente con otro Numero de Documento' : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
                $result['rpta'] ? $this->bitacora->guardar('Editó Cliente con ID:'.$model->cli_id, 'editar') : $this->bitacora->guardar('Error en editar Cliente con ID:'.$model->cli_id, 'error');
            }
            else
            {
                $rpta = ($result['rpta'] == 1)? "ok" : $rpta = ($result['rpta'] == 3)? 'unico': "error";
                $mensaje = ($result['rpta'] == 1)? "Registro Guardado Correctamente" : $mensaje = ($result['rpta'] == 3)? 'Este Cliente ya se encuentra registrado, intente con otro Numero de Documento' : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
                $result['rpta'] ? $this->bitacora->guardar('Inserto Cliente', 'guardar') : $this->bitacora->guardar('Error en Insertar Cliente', 'error');
            }
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__); 
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje, "cli_id" => $result['cli_id']));
    }
    //funcion para obtener un dato especifico
    public function obtener()
    {
        $cli_id = $_POST['cli_id'];
        $model = $this->cliente->obtener($cli_id);
        echo json_encode($model);
    }
    //funcion para activar o desactivar
    public function activar_desactivar()
    {
        try
        {
            $cli_id = $_POST['cli_id'];
            $cli_estado = $_POST['cli_estado']; 
            
            $result = $this->cliente->activar_desactivar($cli_estado,$cli_id);
            if($result !== 1 && $result !== 2) 
            {
                $this->bitacora->guardar('Fallo Al cambiar estado de Cliente con ID: ' . $cli_id, 'Falla Sistema');
                $rpta = 'error';
                $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
            } 
            else if($result==1)
            {
                $this->bitacora->guardar('Cliente activado con ID: ' . $cli_id, 'Activado');
                $rpta = 'ok';
                $mensaje = 'El Cliente fue Activado correctamente';
            }
            else if($result==2)
            {
                $this->bitacora->guardar('Cliente Desactivado con ID: ' . $cli_id, 'Desactivado');
                $rpta = 'ok';
                $mensaje = 'El Cliente fue Desactivado correctamente';
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
    //funcion para cargar los sucursales en el select
    public function seleccionar_tipo_documento()
    {
        $rpta = $this->cliente->seleccionar_tipo_documento();
        if($rpta)
        {
            echo '<option value="" disabled selected>--Seleccione--</option>';
            foreach ($rpta as $reg) 
            {
                echo '<option value='.$reg->tip_ide_id.' title="'.$reg->tip_ide_nombre.'">'.$reg->tip_ide_abrev.'</option>';
            }
        }
    }
}