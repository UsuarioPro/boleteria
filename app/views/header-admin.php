<!DOCTYPE html>
<html lang="es" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TUBOLETA</title>
    <!-- Icono -->
    <link rel="apple-touch-icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
    <link rel="shortcut icon" href="<?= _SERVER_?>styles/img/iconos_sistema/faviconEmpresa.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro Es el tipo de letra-->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/fonts/source-sans-pro.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/fontawesome-free/css/all.css"> --> 
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/fontawesome-pro/css/all.min.css"> <!-- pro -->
    <!-- fuente -->
    <link href="<?= _SERVER_?>styles/fonts/montserrat.css" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/select2/css/select2.min.css">    
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- easy-select -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/easy-select/easySelectStyle.css">
    <!-- filter-multi-select -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/filter-multi-select/dist/filter_multi_select.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/datatables/table_style/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/datatables/buttons-2.3.6/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/datatables/responsive-2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/datatables/fixedColumns-4.2.2/css/fixedColumns.bootstrap5.min.css">
    <!-- menu contextual -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/context-menu/context-menu.min.css">
    <!-- daterangepicker -->    
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/daterangepicker/daterangepicker.css">
    <!-- highcharts -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/highcharts/highcharts.css">
    <!-- datetime -->    
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/datetimepicker/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/datetimepicker/css/bootstrap4-datepicker.css">
    <!-- mdtimepicker -->    
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/mdtimepicker/mdtimepicker.css">
    <!-- flatpickr -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/flatpickr/css/flatpickr.min.css">
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/flatpickr/css/material_blue.css">    
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/flatpickr/monthSelect/style.min.css">    
    <!-- icheck-bootstrap -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/icheck-bootstrap/icheck-bootstrap.min.css">    
    <!-- fancybox -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/fancybox/fancybox.css">    
    <!-- kioskboard -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/kioskboard/kioskboard.css">
    <!-- jstree -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/jstree/default/style.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/dist/css/adminlte.min.css">
    <!-- animaciones -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/animate/animate.min.css">
    <!-- pace-progress -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/pace-progress/themes/black/pace-theme-flat-top.css">
    <!-- filepond -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/filepond/dist/filepond.css">    
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/filepond/plugins/filepond-plugin-image-preview.css">    
    <!-- bootstrap-switch -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">
    <!-- toast -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/toastr/toastr.css">
    <!-- izi-toast -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/plugins/izi-toast/dist/css/iziToast.min.css">
    <!-- TODOS MIS CSS CREADOS -->
    <link rel="stylesheet" href="<?= _SERVER_?>styles/css/plantilla.css">
    <link rel="stylesheet" href="<?= _SERVER_?>styles/css/reloj.css">
  </head>
  <?php  $thema_body = (isset($_COOKIE['dark_mode']))? 'dark-mode' : ''; ?>
  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm pace-primary <?= $thema_body?>">
    <div class="overlay-wrapper">
        <div class="overlay" id="overlay_general" style="z-index: 2000;">
            <div class="text-center">
                <i class="fa-duotone fa-spinner fa-spin-pulse fa-4x text-primary "></i> <br>
                <small class="text-bold text-primary">Espere un momento, Estamos cargando la información</small>
            </div>
        </div>
    </div>
    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
          <img class="animation__shake" src="<?= _SERVER_?>styles/img/iconos_sistema/logo.png" alt="Fact Cloud" width="150">
      </div>