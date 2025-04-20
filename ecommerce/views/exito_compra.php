<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>TuBoleto</title>
        <!-- Standard Favicon -->
        <link href="<?= _SERVER_?>ecommerce/favicon.ico" rel="shortcut icon">
        <!-- Base Google Font for Web-app -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> -->
        <!-- Google Fonts for Banners only -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet"> -->
        <!-- Bootstrap 4 -->
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/bootstrap.min.css">
        <!-- Font Awesome 5 -->
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/fontawesome.min.css">
        <!-- Ion-Icons 4 -->
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/ionicons.min.css">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/animate.min.css">
        <!-- Owl-Carousel -->
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/owl.carousel.min.css">
        <!-- Jquery-Ui-Range-Slider -->
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/jquery-ui-range-slider.min.css">
        <!-- Utility -->
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/utility.css">
        <!-- Main -->
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/bundle.css">
        <link rel="stylesheet" href="<?= _SERVER_?>ecommerce/css/plantilla.css">
    </head>
    <body>
    <!-- app -->
    <div id="app">
        <div class="page-404">
                <div class="vertical-center">
                    <div class="text-center">
                        <h1 style="font-size: 120px; line-height: 100px;">🎉 ¡Gracias por tu <br> compra!</h1>
                        <h5 style="margin-top: 50px;">Tu compra se ha realizado con éxito. <br>
                            Puedes ver tus boletos en la sección "Mis Boletos" de la tienda, donde también podrás descargarlos. <br>
                            Además, te hemos enviado un correo electrónico con los detalles de tu compra. <br>
                            ¡No olvides revisarlo, incluso en tu bandeja de spam!</h5>
                        <div class="redirect-link-wrapper u-s-p-t-25">
                            <a class="redirect-link" href="<?= _SERVER_ ?>Tienda/mis_boletos/<?= $_SESSION['usu_id'] ?>">
                                <span>Ir a Tienda / Mis Boletos</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>