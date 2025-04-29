<!-- Navbar -->
<?php  $thema_nav = (isset($_COOKIE['dark_mode']))? 'navbar-dark' : 'navbar-white navbar-light'; ?>
<nav class="main-header navbar navbar-expand <?= $thema_nav?>">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" onclick="redimencionar_datatable()" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="font-size: 20px;"></i></a>
        </li>
    </ul>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
            <!-- Notificaciones Dropdown Menu -->
            <?php  
                $check_dark = (isset($_COOKIE['dark_mode']))? 'checked' : ''; 
                $value_tema = (isset($_COOKIE['dark_mode']))? 'dark' : 'light'; 
            ?>
            <li class="nav-item bg-danger" id="nav_socket" style="margin-right: 13px; display: none;">
                <a class="nav-link" title="Socket conectado"  href="#" role="button" id="socket_funciona" name="socket_funciona">
                    <i class="fa-duotone fa-router"></i>
                </a>
            </li>
            <li class="nav-item" style="margin-right: -2px;">
                <div class="container_tema">
                    <label id="switch" class="switch_tema">
                        <input type="checkbox" onchange="toggleTheme()" data-value="<?= $value_tema?>" id="toogle_tema" <?= $check_dark?>>
                        <span class="slider_tema round"></span>
                    </label>
                </div>
            </li>
            <li class="nav-item" style="margin-right: -10px;">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt" style="font-size: 20px;"></i>
                </a>
            </li>
            <li class="nav-item" style="margin-right: -6px; margin-left: -4px;">
                <a class="nav-link" href="javascript:location.reload()" href="#" role="button">
                    <i class="fa-solid fa-rotate-right" style="font-size: 20px;"></i>
                </a>
            </li>
            <li class="nav-item dropdown user-menu" style="margin-left: -10px;">
                <a href="#" class="nav-link dropdown-toggle mis_notificaciones" data-toggle="dropdown">
                    <img src=<?php echo ($_SESSION['usu_imagen'] != "")?  _SERVER_."media/usuarios/".$_SESSION['usu_imagen']: _SERVER_.'styles/img/default_photo.png' ?> class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline"><?= $_SESSION['tra_nombre']?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown_notificaciones">
                    <!-- User image -->
                    <li class="user-header" style="margin-bottom: -15px !important;">
                        <img src=<?php echo ($_SESSION['usu_imagen'] != "")?  _SERVER_."media/usuarios/".$_SESSION['usu_imagen']: _SERVER_.'styles/img/default_photo.png' ?> class="img-circle elevation-2" alt="User Image">
                        <p>
                        <?php echo $_SESSION['rol_nombre']?>                    
                        <small><span class="text-red text-bold">TU</span>BOLETO</small>
                        </p>
                    </li>           
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a id="btn_salir_app" href="<?= _SERVER_ ;?>Admin/salir"  class="btn btn-default btn-flat float-right">Cerrar Sesion</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
    <a href="<?= _SERVER_;?>Admin/dashboard" class="brand-link">
        <img src="<?= _SERVER_;?>styles/img/iconos_sistema/logo-128.png" alt="Fact Cloud" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><span class="font-bold text-bold text-danger">TU</span>BOLETO</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="true" id="nv-admin">
                <?php
                    foreach($modulos as $mod)
                    {
                        // $is_activate = ($mod->mod_id == 3)? 'active': null; 
                        foreach($modulos_rol as $mod_rol)
                        {
                            if($mod->mod_id == $mod_rol->mod_id)
                            {
                                if($mod->mod_multiple == 0)
                                {
                                    $opciones_modulos = $this->navbar->obtener_opciones_modulos_uni($mod->mod_id);
                                    $controlador =''; $funcion =''; $nombre ='';
                                    foreach($opciones_modulos as $opc)
                                    {
                                        foreach($permisos_usuario as $per)
                                        {
                                            if($opc->opc_id == $per->opc_id)
                                            {
                                                $nombre = $opc->opc_nombre;
                                                $controlador = $per->per_controlador;
                                                $funcion = $opc->opc_funcion;
                                            }
                                        }
                                    }
                                    $is_activate = ($_GET['c'] == $controlador)? 'active': null;
                                    echo '<li class="nav-item has-treeview">
                                    <a href="'. _SERVER_. $controlador.'/'.$funcion.'" class="nav-link is_activado '.$is_activate.'">
                                            <i class="nav-icon '.$mod->mod_icono.'"></i>
                                            <p>'.$mod->mod_nombre.'</p>
                                        </a>
                                    </li>';
                                }
                                else
                                {
                                    $is_open = ($mod->mod_nombre == $modulo)? 'menu-is-opening menu-open': null;
                                    echo '<li class="nav-item has-treeview '.$is_open.'">
                                        <a href="#" class="nav-link is_activado">
                                            <i class="nav-icon '.$mod->mod_icono.'"></i>
                                            <p>'.$mod->mod_nombre.' <i class="fas fa-angle-left right"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">';
                                            $opciones_modulos = $this->navbar->obtener_opciones_modulos($mod->mod_id);
                                            foreach($opciones_modulos as $opc)
                                            {
                                                foreach($permisos_usuario as $per)
                                                {
                                                    if($opc->opc_id == $per->opc_id)
                                                    {
                                                        $is_activate = ($_GET['c'] == $per->per_controlador)? 'active': null;
                                                        $is_estilo = (strlen($opc->opc_nombre_abrev) > 30)? 'style="display: flex; align-items: center;"': null;
                                                        echo '<li class="nav-item">
                                                            <a href="'. _SERVER_. $per->per_controlador.'/'.$opc->opc_funcion.'" class="nav-link is_activado '.$is_activate.'" '.$is_estilo.'>
                                                                <i class="far fa-circle nav-icon"></i>
                                                                <p>'.$opc->opc_nombre_abrev.'</p>
                                                            </a>
                                                        </li>';
                                                    }
                                                }
                                            }
                                        echo'</ul>
                                    </li>';
                                }
                            }
                        }
                    }
                ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>