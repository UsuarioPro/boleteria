<?php
require_once 'app/models/Ecommerce.php';
require_once 'app/models/Log.php';

class TiendaController
{
    private $ecommerce;
    private $log;
    
    public function __construct()
    {
        $this->ecommerce = new Ecommerce();
        $this->log = new Log();
    }
    public function home()
    {
        $locales = $this->ecommerce->listar_locales();
        $categorias = $this->ecommerce->listar_categoria();
        $artistas = $this->ecommerce->listar_artistas();
        $banner_top = $this->ecommerce->listar_banners(1);
        $banners = $this->ecommerce->listar_banners(2);
        $banner_bottom = $this->ecommerce->listar_banners(3);
    
        require _VIEW_PATH_ECOMMERCE_ .'header.php';
        require _VIEW_PATH_ECOMMERCE_ .'home.php';
        require _VIEW_PATH_ECOMMERCE_ .'footer.php';
    }
    public function mis_boletos()
    {    
        if(!isset($_SESSION['usu_id']))
        {
            require _VIEW_PATH_ECOMMERCE_ .'mensaje_iniciar_sesion.php';
        }
        else
        {
            $id_valor = $_GET['v'] ?? ''; // Ej: productos, login, pedidos
            $mis_boletos = $this->ecommerce->obtener_mis_boletos($id_valor);
    
            require _VIEW_PATH_ECOMMERCE_ .'header.php';
            require _VIEW_PATH_ECOMMERCE_ .'mis_boletos.php';
            require _VIEW_PATH_ECOMMERCE_ .'footer.php';
        }
    }
    public function cart_full()
    {    
        if(!isset($_SESSION['usu_id']))
        {
            require _VIEW_PATH_ECOMMERCE_ .'mensaje_iniciar_sesion.php';
        }
        else
        {
            if (isset($_COOKIE['products_card'])) 
            {
                $productos = json_decode($_COOKIE['products_card'], true);
                if (is_array($productos) && count($productos) === 0) 
                {
                    require _VIEW_PATH_ECOMMERCE_ .'carro_vacio.php';
                } 
                else 
                {
                    require _VIEW_PATH_ECOMMERCE_ .'header.php';
                    require _VIEW_PATH_ECOMMERCE_ .'mi_carro.php';
                    require _VIEW_PATH_ECOMMERCE_ .'footer.php';
                }
            }
            else
            {
                require _VIEW_PATH_ECOMMERCE_ .'carro_vacio.php';
            }
        }
    }
    public function exito()
    {    
        require _VIEW_PATH_ECOMMERCE_ .'exito_compra.php';
    }
    public function editar_perfil()
    {
        $id_valor = $_GET['v'] ?? ''; // Ej: productos, login, pedidos
        $editar_usuario = $this->ecommerce->obtener_datos_usuario($id_valor);
        require _VIEW_PATH_ECOMMERCE_ .'header.php';
        require _VIEW_PATH_ECOMMERCE_ .'editar_usuario.php';
        require _VIEW_PATH_ECOMMERCE_ .'footer.php';
    }
    public function editar_pass()
    {
        $id_valor = $_GET['v'] ?? ''; // Ej: productos, login, pedidos
        $editar_usuario = $this->ecommerce->obtener_datos_usuario($id_valor);
        require _VIEW_PATH_ECOMMERCE_ .'header.php';
        require _VIEW_PATH_ECOMMERCE_ .'editar_pass.php';
        require _VIEW_PATH_ECOMMERCE_ .'footer.php';
    }
    public function proceder_pago()
    {
        if (isset($_COOKIE['products_card'])) 
        {
            $productos = json_decode($_COOKIE['products_card'], true);
            if (is_array($productos) && count($productos) === 0) 
            {
                require _VIEW_PATH_ECOMMERCE_ .'carro_vacio.php';
            } 
            else 
            {
                $id_valor = $_GET['v'] ?? ''; // Ej: productos, login, pedidos
                $usuario = $this->ecommerce->obtener_datos_usuario($id_valor);
                require _VIEW_PATH_ECOMMERCE_ .'header.php';
                require _VIEW_PATH_ECOMMERCE_ .'proceso_compra.php';
                require _VIEW_PATH_ECOMMERCE_ .'footer.php';
            }
        }
        else
        {
            require _VIEW_PATH_ECOMMERCE_ .'carro_vacio.php';
        }
    }
    public function login()
    {
        require _VIEW_PATH_ . 'admin/login.php';
    }
    public function registrate()
    {
        require _VIEW_PATH_ . 'admin/registrate.php';
    }
    public function bienvenida()
    {
        require _VIEW_PATH_ECOMMERCE_ .'bienvenida.php';
    }
    public function conciertos()
    {
        $id_valor = $_GET['v'] ?? ''; // Ej: productos, login, pedidos
        if($id_valor)
        {
            $categorias = $this->ecommerce->listar_categoria();
            $concierto = $this->ecommerce->obtener_concierto($id_valor);
            $artistas_conciertos = $this->ecommerce->obtener_artistas_conciertos($id_valor);
            $zonas_precios = $this->ecommerce->zonas_precios($id_valor);
            $img_portada = empty($concierto->con_portada)? _SERVER_.'ecommerce/media/conciertos-banners/default.png' : _SERVER_.'ecommerce/media/conciertos-banners/'.$concierto->con_portada;
            $img_escenario = empty($concierto->con_portada)? _SERVER_.'ecommerce/media/escenarios/default.jpg' : _SERVER_.'ecommerce/media/escenarios/'.$concierto->loc_escenario_img;
            // Arrays de días y meses
            $dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio','Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

            $timestamp = strtotime($concierto->con_fecha);
            // Obtener partes de la fecha
            $dia_semana = $dias[date('w', $timestamp)];
            $dia = date('d', $timestamp);
            $mes = $meses[date('n', $timestamp) - 1];
            $anio = date('Y', $timestamp);
            $texto_fecha = "$dia_semana $dia de $mes de $anio";
            
            require _VIEW_PATH_ECOMMERCE_ .'header.php';
            require _VIEW_PATH_ECOMMERCE_ .'detalle_producto.php';
            require _VIEW_PATH_ECOMMERCE_ .'footer.php';
        }
        else
        {

        }
    }
    public function formatear_fecha_hora($fecha)
    {
        $dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
        $meses = ['ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic'];
        $timestamp = strtotime($fecha);// Convertir la fecha a timestamp
        // Obtener el número del día de la semana (0 = domingo, 1 = lunes, ...)
        $diaSemana = date('w', $timestamp);  // 'w' devuelve el número de día de la semana (0-6)
        $numeroDia = date('d', $timestamp);  // Día del mes (1-31)
        $mesNumero = date('m', $timestamp) - 1;  // Obtener índice del mes (0-11)
        $hora = date('h:iA', $timestamp);  // Hora en formato 12h con AM/PM
        // Convertir el número del día de la semana a su nombre en español
        $diaSemanaEspañol = $dias[$diaSemana];
        // Convertir la primera letra a mayúscula
        $diaSemanaEspañol = ucfirst($diaSemanaEspañol);
        $mesAbreviado = ucfirst($meses[$mesNumero]);  // Obtener el mes abreviado

        // Formatear la fecha
        $fechaFormateada = "{$diaSemanaEspañol} {$numeroDia} {$mesAbreviado}. - {$hora}";
        return $fechaFormateada;
    }
    public function mostrar_conciertos()
    {
        $ciudad = $_POST["ciudad"];
        $filtro = empty($_POST['filtro'])? '' : $_POST['filtro'];
        $numeracion = empty($_POST['numeracion'])? 1 : $_POST['numeracion'];
        // $almacen = $this->global->obtener_almacen_defaulf($suc_id);

        $limite = $_POST['limite'];
        $empieza_limite = ($numeracion -1) * $limite;
        $cantidad_conciertos = $this->ecommerce->cantidad_conciertos_filtro($ciudad, $filtro);
        $paginas = ceil(count($cantidad_conciertos) / $limite);
        $active_pag_inicio = ($numeracion == 1)? 'active' : '';
        $ocultar_inicio = '';
        $active_pag_final = ($numeracion == $paginas)? 'active' : '';
        $pag_anterior = ($numeracion == 1)? $paginas : ($numeracion - 1);  
        $act_pagina_anterior = ($numeracion == 1)? 'disabledDiv' : '';  

        $pag_siguiente = ($numeracion == $paginas)? $paginas : ($numeracion + 1);  
        $act_pagina_siguiente = ($numeracion == $paginas)? 'disabledDiv' : ''; 
        $inicio = 0;
        $paginacion = '';
        $eventos = '';
        // if(empty($cantidad_conciertos))
        // {
        //     echo'
        //         <div id="producto_vacio" class="p-0 pt-2 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-0 text-center div_producto_cuadricula_vacio">
        //             <div class="form-group interno col-lg-12 col-sm-12 col-md-12 col-xs-12">
        //                 <img style="border-radius: 0%; border:none" src="../styles/img/ups.png" width="55px" alt=""><br>
        //                 <span class="text-bold">¡No se encontro ningun producto!</span>
        //             </div>
        //         </div>
        //         <nav aria-label="Page navigation example" class="footer_filtro_producto_cuadricula">
        //             <ul class="pagination justify-content-center m-0">
        //                 <li class="page-item disabled"><a class="page-link rounded-0"  href="#">Anterior</a></li>
        //                 <li class="page-item disabled"><a class="page-link rounded-0" href="#">Siguiente</a></li>
        //             </ul>
        //         </nav>';
        // } 
        // else
        {
            if($paginas == 1)
            {
                $ocultar_inicio = 'hidden';
                $ocultar_final = 'hidden';
                $ocultar_pag_final = 'hidden';
            }
            else
            {
                $ocultar_pag_final = '';
                if(($numeracion <= 4) >= $paginas)
                {
                    $ocultar_inicio = 'hidden';
                    $ocultar_final = ($paginas <= 7)? 'hidden' : '';
                    $inicio = 2;
                    $final = ($paginas == 7)? 6: 5;
                    $pag_active = $numeracion;
                }
                else if(($numeracion + 3) >= $paginas)
                {
                    $ocultar_inicio = ($paginas == 7)? 'hidden' : '';
                    $ocultar_final = 'hidden';
                    $inicio = $paginas - 4;
                    $final = $paginas; 
                    $pag_active = $numeracion;
                }
                else
                {
                    $ocultar_final = '';
                    $inicio = abs($numeracion - 1);
                    $fin = $inicio + 2;
                    $final = ($fin == $numeracion)? $fin + 1 : $fin; 
                    $pag_active = ($numeracion == 0 || $numeracion == 1)? '': $final - 1;
                }
            }
            $model = $this->ecommerce->listar_conciertos($empieza_limite, $limite, $ciudad, $filtro);
            $i=1;
            foreach ($model as $m)
            {
                $ruta_img = _SERVER_ .'ecommerce/media/productos/';
                $imagen = empty($m->con_imagen)? $ruta_img.'defaulf.jpg' : $ruta_img.$m->con_imagen;
                $eventos .='<div class="product-item col-lg-3 col-md-6 col-sm-6" onclick="mostrar_detalle_concierto('.$m->con_id.')">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="#">
                                <img class="img-fluid" src="'.$imagen.'" alt="Product">
                            </a>
                        </div>
                        <div class="item-content" style="cursor: pointer;">
                            <div class="what-product-is">
                                <ul class="bread-crumb truncate" style="max-width: 100%;">
                                    <li class="has-separator">
                                        <a href="#">'.$m->cat_nombre.'</a>
                                    </li>
                                    <li class="">
                                        <a href="#" class="text-danger" style="font-weight: bold">'.$m->loc_ciudad.'</a>
                                    </li>
                                </ul>
                                <h6 class="item-title" style="max-width: 100%;">
                                    <a href="single-product.html" title="'.$m->con_nombre.'" class="truncate" style="max-width: 100%;">'.$m->con_nombre.'</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" title="'.$m->loc_direccion.'" style="max-width: 100%;">'.$m->loc_direccion.'</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    '.$this->formatear_fecha_hora($m->con_fecha.' '.$m->con_hora).'
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                $i++;
            }            
            $paginacion .='
            <ul>
                <li class="'.$act_pagina_anterior.'">
                    <a class="my_pagination" href="#" title="Anterior" onclick="pagina_anterior_siguiente_producto('.$pag_anterior.')">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
                <li class="'.$active_pag_inicio.'">
                    <a class="my_pagination" href="#" onclick="pagina_anterior_siguiente_producto(1)">
                        1
                    </a>
                </li>
                <li class="disabledDiv" '.$ocultar_inicio.'>
                    <a class="my_pagination" href="#">
                        ...
                    </a>
                </li>';
                for ($i = $inicio; $i < $paginas; $i ++) 
                {
                    if($i !=0 && $i !=1)
                    {
                        if($i <= $final)
                        {
                            $active = ($i == $pag_active)? 'active':'';
                            $paginacion .= '<li class="'.$active.'">
                                    <a href="#" class="my_pagination" onclick="pagina_anterior_siguiente_producto('.$i.')">'.$i.'</a>
                                </li>';
                        }
                    }
                }
            $paginacion .='
                <li class="disabledDiv" '.$ocultar_final.'>
                    <a class="my_pagination" href="#">...</a>
                </li>
                <li class="'.$active_pag_final.'" '.$ocultar_pag_final.'>
                    <a class="my_pagination" href="#" type="button" onclick="pagina_anterior_siguiente_producto('.$paginas.')">
                        '.$paginas.'
                    </a>
                </li>
                <li class="'.$act_pagina_siguiente.'">
                    <a class="my_pagination" href="#" title="Anterior" onclick="pagina_anterior_siguiente_producto('.$pag_siguiente.')">
                        <i class="fa fa-angle-right"></i>
                    </a>

                </li>
            </ul>';
        }

        echo json_encode(array('eventos' => $eventos, 'paginacion' => $paginacion));
    }
    public function registrarse()
    {
        try
        {
            $model = new Ecommerce();
            $model->rol_id = 2;
            $model->usu_nombre = $_POST['logina'];
            $model->usu_contrasena = password_hash($_POST['clavea'],PASSWORD_DEFAULT);
            $model->usu_correo = $_POST['correo'];
            $result = $this->ecommerce->registrarse($model);

            $rpta = ($result == 1)? "ok" : $rpta = ($result == 3)? 'unico': "error";
            $mensaje = ($result == 1)? "Registro Guardado Correctamente" : $mensaje = ($result == 3)? 'Este Nombre de Usuario o el Correo ya se encuentra registrado, intente con otro Nombre de Usuario' : "No se pudo guardar el registro, Intente contactar con el administrador del sistema";
        }
        catch (Throwable $e)
        {
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $rpta = 'error';
            $mensaje = 'Hubo un error Critico, Intente contactar con el administrador del sistema';
        }
        echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
    }
    public function loguearse()
    {
        $usuario = isset($_POST['logina'])?$_POST['logina']: null;
        $pass = isset($_POST['clavea'])?$_POST['clavea']: null;
        if(!empty($usuario) && !empty($pass))
        {
            $model = $this->ecommerce->loguear($usuario);
            if(isset($model->usu_id) && $model->usu_estado == 1)
            {
                if(password_verify($pass,$model->usu_clave))
                {
                    $_SESSION['usu_id'] = $model->usu_id; 
                    $_SESSION['rol_id'] = $model->rol_id; 
                    $_SESSION['tra_nombre'] = $model->tra_nombre; 
                    $_SESSION['usu_login'] = $model->usu_login; 
                    $_SESSION['usu_clave'] = $model->usu_clave; 
                    $_SESSION['usu_imagen'] = $model->usu_imagen; 
                    $_SESSION['usu_estado'] = $model->usu_estado; 
                    $_SESSION['rol_nombre'] = $model->rol_nombre; 

                    $this->ecommerce->ultimo_logueo($model->usu_id);
                    // $this->bitacora->guardar('Inicio Sesion ' . $_SESSION['usu_login'],'Inicio Sesion');
                    $rpta = 0;
                    $mensaje = 'Ingreso Exitoso';
                }
                else
                {
                    $rpta = 1;
                    $mensaje = 'Contraseña Incorrecta, por favor introduzca nuevamente su contraseña';    
                    // $this->bitacora->guardar('Inicio de Sesión Fallido, error en Contraseña a Usuario: ' . $usuario,'Prohibido');
                }
                
            }
            else if(isset($model->usu_id) && $model->usu_estado == 0)
            {
                $rpta = 2;
                $mensaje = 'Este Usuario se encuentra suspendido, Intente Contactar con el Administrador del Sistema';
                // $this->bitacora->guardar('Inicio de Sesión Fallido Usuario Suspendido: ' . $usuario,'Prohibido');
            }
            else if(!isset($model->usu_id))
            {
                $rpta = 3;
                $mensaje = 'Usuario y Contraseña Incorrectas, Estas credenciales no coinciden con nuestros registros.';    
                // $this->bitacora->guardar('Inicio de Sesión Fallido Usuario y Contraseña Incorrectas: ','Prohibido');
            }
            echo json_encode(array("rpta"=>$rpta, "mensaje" => $mensaje));
        }
        else 
        {
            $this->login();
        }
    }
    //funcion para guardar y editar los datos
    public function editar_usuario()
    {
        try
        {
            $model = new Ecommerce();
            $model->usu_id = $_POST['usu_id'];
            $model->usu_nombre = $_POST['usu_nombre'];
            $model->usu_tipo_doc = $_POST['tra_tipo_doc'];
            $model->usu_num_doc = $_POST['tra_num_doc'];
            $model->usu_nombre_completo = $_POST['tra_nombre_completo'];
            $model->usu_direccion = $_POST['tra_direccion'];
            $model->usu_correo = $_POST['tra_correo'];
            $model->usu_telefono = $_POST['tra_telefono'];    
            $result = $this->ecommerce->editar_usuario($model);

            $rpta = ($result == 1)? "ok" : $rpta = ($result == 3)? 'unico': "error";
            $mensaje = ($result == 1)? "Registro Actualizado Correctamente" : $mensaje = ($result == 3)? 'Este Nombre de Usuario o el numero de documento ya se encuentra registrado, intente con otro Nombre de Usuario' : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
            // $result ? $this->bitacora->guardar('Editó Usuario con ID:'.$model->usu_id, 'ok') : $this->bitacora->guardar('Error en editar Usuario con ID:'.$model->usu_id, 'error');
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
    public function guardar_cambiar_contrasena()
    {
        try
        {
            $usu_id = $_POST['usu_id'];
            $usu_contrasena = password_hash($_POST['usu_contrasena'],PASSWORD_DEFAULT);

            $result = $this->ecommerce->guardar_cambiar_contrasena($usu_id, $usu_contrasena);
            if($result == 1)
            {
                // $this->bitacora->guardar('Cambio de Contraseña de Usuario con ID: ' . $usu_id, 'Cambio');
                $rpta = 'ok';
                $mensaje = 'La Contraseña del Usuario fue cambiado correctamente';
            }
            else
            {
                // $this->bitacora->guardar('Fallo Al cambiar la Contraseña de Usuario con ID: ' . $usu_id, 'Falla Sistema');
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
    public function guardar_editar_comprar_entradas()
    {
        try
        {
            $model = new Ecommerce();
            $model->usu_id = $_POST['usu_id'];
            $model->total = $_POST['total'];
            $model->tipo_pago = $_POST['tipo_pago'];
            $model->con_id = $_POST['con_id'];
            $model->zon_id = $_POST['zon_id'];
            $model->precio = $_POST['precio'];
            $model->cantidad = $_POST['cantidad'];

            $result = $this->ecommerce->guardar_venta_boleta($model);

            $rpta = ($result == 1)? "ok" : "error";
            $mensaje = ($result == 1)? "La Compra se Realizo con Exito"  : "No se pudo actualizar el registro, Intente contactar con el administrador del sistema";
            // $result ? $this->bitacora->guardar('Editó Usuario con ID:'.$model->usu_id, 'ok') : $this->bitacora->guardar('Error en editar Usuario con ID:'.$model->usu_id, 'error');
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
