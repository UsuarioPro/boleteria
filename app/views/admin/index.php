<div class="content-wrapper pb-0 mb-0">
    <!-- <section class="content bloqueo_apertura"> -->
    <section class="content bienvenido">
        <div class="container-fluid">
            <div class="row my_font">
                <div class="col-md-12 text-center d-flex align-items-center justify-content-center">
                    <div class="p-4 bg-light" style="opacity: 0.9">
                        <img src="../styles/img/bienvenido.png" alt="imagen_apertura" style="width: calc(40% + 200px);" >
                        <h1 style="font-size: calc(1.5em + 2vw) !important; margin-bottom: 0px;"><?= $_SESSION['tra_nombre'] ?></h1>
                        <p class="lead mb-0 pb-0 mt-0" id="info_apertura" style="font-size: calc(1em + 0.5vw);">
                            <span>NOS DA GUSTO TENERTE DE NUEVO POR AQUI</span> <br>
                        </p>
                        <div id="clock" class="light d-none d-sm-inline-block">
                            <div class="display">
                                <div class="weekdays"></div>
                                <div class="ampm"></div>
                                <div class="alarm"><i class="fa-solid fa-clock"></i></div>
                                <div class="digits" style="width: auto;"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- cierre col -->
            </div><!-- cierre row -->
        </div><!-- cierre fluid -->        
    </section>
</div> <!-- /.content-Wrapper -->
<!-- FIN DE CONTENIDO -->
<script src="<?= _SERVER_ ?>app/views/admin/index.js" type="text/javascript" charset="utf-8"  defer></script>