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
        <!-- Header -->
        <header>
            <!-- Top-Header -->
            <div class="full-layer-outer-header my_sticky-top">
                <input type="hidden" id="urlweb" name="urlweb" value="<?= _SERVER_?>">
                <div class="container clearfix">
                    <nav>
                        <ul class="secondary-nav g-nav">
                            <?php 
                                if(isset($_SESSION['usu_id']))
                                {
                                    echo '
                                    <li>
                                        <a> '.$_SESSION['usu_login'].'
                                            <i class="fas fa-chevron-down u-s-m-l-9"></i>
                                        </a>
                                        <ul class="g-dropdown" style="width:200px">
                                            <li>
                                                <a href="'._SERVER_.'Tienda/cart_full">
                                                    <i class="ion ion-md-basket u-s-m-r-9"></i>
                                                    Mi Carro</a>
                                            </li>
                                            <li>
                                                <a href="'._SERVER_.'Tienda/editar_perfil/'.$_SESSION['usu_id'].'">
                                                    <i class="far fa-user u-s-m-r-9"></i>
                                                    Editar Perfil</a>
                                            </li>
                                            <li>
                                                <a href="'._SERVER_.'Tienda/editar_pass/'.$_SESSION['usu_id'].'">
                                                    <i class="fas fa-lock u-s-m-r-9"></i>
                                                    Cambiar Contraseña</a>
                                            </li>
                                            <li>
                                                <a href="'._SERVER_.'Admin/salir">
                                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                                    Cerrar Sesion</a>
                                            </li>
                                        </ul>
                                    </li>
                                    ';
                                }
                                else
                                {
                                    echo'
                                        <li style="margin-right: -10px;">
                                            <a href="'._SERVER_.'Tienda/Login"><i class="fas fa-user u-s-m-l-9 u-c-brand mr-1"></i> INICIAR SESION</a>
                                        </li>
                                        <li>
                                            <a href="'._SERVER_.'Tienda/Registrate">REGISTRATE</a>
                                        </li>';
                                }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Top-Header /- -->
            <!-- Mid-Header -->
            <div class="full-layer-mid-header" style="padding-top: 70px;">
                <div class="container">
                    <div class="row clearfix align-items-center">
                        <div class="col-lg-3 col-md-9 col-sm-6">
                            <div class="brand-logo text-lg-center">
                                <a href="<?= _SERVER_?>">
                                    <img src="<?= _SERVER_?>ecommerce/media/main-logo/logo.png" alt="Groover Brand Logo" class="app-brand-logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 u-d-none-lg">
                            <form class="form-searchbox">
                                <label class="sr-only" for="search-landscape">Search</label>
                                <input id="search-landscape" type="text" class="text-field" placeholder="Buscar por Artista, Ciudad o Local">
                                <button id="btn-search" type="submit" class="button button-primary fas fa-search"></button>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <nav>
                                <ul class="mid-nav g-nav">
                                    <li class="u-d-none-lg">
                                        <a href="<?= _SERVER_?>">
                                            <i class="ion ion-md-home u-c-brand"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a id="mini-cart-trigger">
                                            <i class="ion ion-md-basket"></i>
                                            <span class="item-counter" id="lbl_info_cant"></span>
                                            <span class="item-price" id="lbl_info_total"></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mid-Header /- -->
            <!-- Responsive-Buttons -->
            <div class="fixed-responsive-container">
                <div class="fixed-responsive-wrapper">
                    <button type="button" class="button fas fa-search" id="responsive-search"></button>
                </div>
                <div class="fixed-responsive-wrapper">
                    <a href="wishlist.html">
                        <i class="far fa-heart"></i>
                        <span class="fixed-item-counter">4</span>
                    </a>
                </div>
            </div>
            <!-- Responsive-Buttons /- -->
            <!-- Mini Cart -->
            <div class="mini-cart-wrapper">
                <div class="mini-cart">
                    <div class="mini-cart-header">
                        TU CARRO
                        <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
                    </div>
                    <ul class="mini-cart-list pb-0" id="mini_car"></ul>
                    <div class="mini-shop-total clearfix">
                        <span class="mini-total-heading float-left">Total</span>
                        <span class="mini-total-price float-right" id="lbl_info_total_card">0.00</span>
                    </div>
                    <div class="mini-action-anchors">
                        <a href="<?= _SERVER_?>Tienda/cart_full" class="cart-anchor">Ver Carro</a>
                        <!-- <a href="checkout.html" class="checkout-anchor">Checkout</a> -->
                    </div>
                </div>
            </div>
            <!-- Mini Cart /- -->
        </header>
        <!-- Header /- -->