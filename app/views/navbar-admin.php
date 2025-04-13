<!-- Navbar -->
<?php  $thema_nav = (isset($_COOKIE['dark_mode']))? 'navbar-dark' : 'navbar-white navbar-light'; ?>
<nav class="main-header navbar navbar-expand-md <?= $thema_nav?>">
    <?php
        echo'
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <!-- Left navbar links -->
            <ul class="navbar-nav" style="font-size: 13px;">';
            foreach($modulos as $mod)
            {
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
                            $is_activate = ($_GET['c'] == $controlador)? 'active bg-primary': null;
                            echo '
                            <li class="nav-item d-sm-inline-block">
                                <a href="'. _SERVER_. $controlador.'/'.$funcion.'" class="nav-link is_activado '.$is_activate.'">
                                    <i class="nav-icon '.$mod->mod_icono.'"></i> '.$mod->mod_nombre.'</a>
                            </li>';
                        }
                        else
                        {
                            echo '<li class="nav-item dropdown ">
                                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link dropdown-toggle">
                                    <i class="nav-icon '.$mod->mod_icono.'"></i> '.$mod->mod_nombre.'
                                </a>
                                <ul class="dropdown-menu border-0 shadow " style="left: 0px; right: inherit;">';
                                    $opciones_modulos = $this->navbar->obtener_opciones_modulos($mod->mod_id);
                                    foreach($opciones_modulos as $opc)
                                    {
                                        foreach($permisos_usuario as $per)
                                        {
                                            if($opc->opc_id == $per->opc_id)
                                            {
                                                $is_activate = ($_GET['c'] == $per->per_controlador)? 'active': null;
                                                echo '<li>
                                                    <a href="'. _SERVER_. $per->per_controlador.'/'.$opc->opc_funcion.'" class="dropdown-item is_activado '.$is_activate.'">
                                                        '.$opc->opc_nombre_abrev.'
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
        echo '</ul>
        </div>
        ';
    ?>
    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <?php  
            $check_dark = (isset($_COOKIE['dark_mode']))? 'checked' : ''; 
            $value_tema = (isset($_COOKIE['dark_mode']))? 'dark' : 'light'; 
        ?>
        <li class="nav-item" style="margin-right: 2px;">
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
        <li class="nav-item" style="margin-right: -12px; margin-left: -4px;">
            <a class="nav-link" href="javascript:location.reload()" href="#" role="button">
                <i class="fa-solid fa-rotate-right" style="font-size: 20px;"></i>
            </a>
        </li>
        <li class="nav-item dropdown user-menu">
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
                        <small>Private Server [Fact-Cloud] </small>
                    </p>
                </li>           
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="<?= _SERVER_ ;?>Admin/salir"  class="btn btn-default btn-flat float-right">Cerrar Sesion</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->