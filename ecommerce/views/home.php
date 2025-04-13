<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Groover - Online Shopping for Electronics, Apparel, Computers, Books, DVDs & more</title>
    <!-- Standard Favicon -->
    <link href="<?= _SERVER_?>ecommerce/favicon.ico" rel="shortcut icon">
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
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
</head>

<body>
<!-- app -->
<div id="app">
    <!-- Header -->
    <header>
        <!-- Top-Header -->
        <div class="full-layer-outer-header my_sticky-top">
            <div class="container clearfix">
                <nav>
                    <ul class="primary-nav g-nav">
                        <li>
                            <a href="#">
                                <i class="fas fa-list u-c-brand u-s-m-r-9"></i>
                                Categorias
                                <i class="fas fa-chevron-down u-s-m-l-9"></i>
                            </a>
                            <ul class="g-dropdown" style="width:200px">
                                <li>
                                    <a href="#">
                                        <i class="fas fa-music u-s-m-r-9"></i>
                                        Conciertos</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-football-ball u-s-m-r-9"></i>
                                        Deporte</a>
                                </li>
                                <li>
                                    <a href="checkout.html">
                                        <i class="fas fa-ticket-alt u-s-m-r-9"></i>
                                        Teatro</a>
                                </li>
                                <li>
                                    <a href="account.html">
                                        <i class="fas fa-film u-s-m-r-9"></i>
                                        Entretenimiento</a>
                                </li>
                                <li>
                                    <a href="account.html">
                                        <i class="fas fa-ellipsis-h u-s-m-r-9"></i>
                                        Otros</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <nav>
                    <ul class="secondary-nav g-nav">
                        <li hidden>
                            <a>My Account
                                <i class="fas fa-chevron-down u-s-m-l-9"></i>
                            </a>
                            <ul class="g-dropdown" style="width:200px">
                                <li>
                                    <a href="cart.html">
                                        <i class="fas fa-cog u-s-m-r-9"></i>
                                        My Cart</a>
                                </li>
                                <li>
                                    <a href="wishlist.html">
                                        <i class="far fa-heart u-s-m-r-9"></i>
                                        My Wishlist</a>
                                </li>
                                <li>
                                    <a href="checkout.html">
                                        <i class="far fa-check-circle u-s-m-r-9"></i>
                                        Checkout</a>
                                </li>
                                <li>
                                    <a href="account.html">
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Login / Signup</a>
                                </li>
                            </ul>
                        </li>
                        <li style="margin-right: -10px;">
                            <a><i class="fas fa-user u-s-m-l-9 u-c-brand mr-1"></i> INICIAR SESION</a>
                        </li>
                        <li>
                            <a>REGISTRATE</a>
                        </li>
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
                            <a href="home.html">
                                <img src="<?= _SERVER_?>ecommerce/images/main-logo/groover-branding-1.png" alt="Groover Brand Logo" class="app-brand-logo">
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
                                    <a href="home.html">
                                        <i class="ion ion-md-home u-c-brand"></i>
                                    </a>
                                </li>
                                <li class="u-d-none-lg">
                                    <a href="wishlist.html">
                                        <i class="far fa-heart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a id="mini-cart-trigger">
                                        <i class="ion ion-md-basket"></i>
                                        <span class="item-counter">4</span>
                                        <span class="item-price">$220.00</span>
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
                    YOUR CART
                    <button type="button" class="button ion ion-md-close" id="mini-cart-close"></button>
                </div>
                <ul class="mini-cart-list">
                    <li class="clearfix">
                        <a href="single-product.html">
                            <img src="<?= _SERVER_?>ecommerce/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Casual Hoodie Full Cotton</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="single-product.html">
                            <img src="<?= _SERVER_?>ecommerce/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Black Rock Dress with High Jewelery Necklace</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="single-product.html">
                            <img src="<?= _SERVER_?>ecommerce/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Xiaomi Note 2 Black Color</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                    <li class="clearfix">
                        <a href="single-product.html">
                            <img src="<?= _SERVER_?>ecommerce/images/product/product@1x.jpg" alt="Product">
                            <span class="mini-item-name">Dell Inspiron 15</span>
                            <span class="mini-item-price">$55.00</span>
                            <span class="mini-item-quantity"> x 1 </span>
                        </a>
                    </li>
                </ul>
                <div class="mini-shop-total clearfix">
                    <span class="mini-total-heading float-left">Total:</span>
                    <span class="mini-total-price float-right">$220.00</span>
                </div>
                <div class="mini-action-anchors">
                    <a href="cart.html" class="cart-anchor">View Cart</a>
                    <a href="checkout.html" class="checkout-anchor">Checkout</a>
                </div>
            </div>
        </div>
        <!-- Mini Cart /- -->
        <!-- Brand-Slider -->
        <div class="brand-slider u-s-p-b-80 pt-0 pb-2">
            <div class="container">
                <div class="brand-slider-content-local owl-carousel" data-item="10">
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/1.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/2.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/3.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/4.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/5.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/6.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/7.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/8.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/9.jpg" alt="Brand Logo 1"></a>
                    </div>
                    <div class="brand-pic brand-sm">
                        <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-locales/10.jpg" alt="Brand Logo 1"></a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Brand-Slider /- -->
    </header>
    <!-- Header /- -->
    <!-- Main-Slider -->
    <div class="default-height ph-item">
        <div class="slider-main owl-carousel">
            <div class="bg-image"  style="background-image: url(<?= _SERVER_?>ecommerce/media/main-slider/2.jpg);"></div>
            <div class="bg-image"  style="background-image: url(<?= _SERVER_?>ecommerce/media/main-slider/3.jpg);"></div>
            <div class="bg-image"  style="background-image: url(<?= _SERVER_?>ecommerce/media/main-slider/4.jpg);"></div>
            <div class="bg-image"  style="background-image: url(<?= _SERVER_?>ecommerce/media/main-slider/5.jpg);"></div>
            <div class="bg-image"  style="background-image: url(<?= _SERVER_?>ecommerce/media/main-slider/6.jpg);"></div>
            <div class="bg-image"  style="background-image: url(<?= _SERVER_?>ecommerce/media/main-slider/7.jpg);"></div>
            <div class="bg-image"  style="background-image: url(<?= _SERVER_?>ecommerce/media/main-slider/8.jpg);"></div>
        </div>
    </div>
    <!-- Main-Slider /- -->
    <!-- Brand-Slider -->
    <div class="brand-slider u-s-p-b-40 pt-4">
        <div class="container">
            <div class="brand-slider-content owl-carousel" data-item="7">
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/1.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Corazon Serrano</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/2.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Son del Duke</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/3.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">La Unica Tropical</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/4.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Armonia 10</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/5.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Son del Duke</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/6.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Son del Duke</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/7.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Surandina</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/8.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Marisol y la Magia del Norte</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/9.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Papilon</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/10.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Agua Marina</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/11.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Rosita</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/12.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Max Castro</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/13.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Son del Duke</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/14.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Son del Duke</small></div>
                </div>
                <div class="brand-pic">
                    <a href="#"><img src="<?= _SERVER_?>ecommerce/media/brand-logos/15.png" alt="Brand Logo 1"></a>
                    <div><small class="truncate">Son del Duke</small></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Brand-Slider /- -->
    <!-- Banner-Layer -->
    <div class="banner-layer p-0 mb-5">
        <div class="container">
            <div class="image-banner">
                <a href="shop-v1-root-category.html" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/banners/1.webp" alt="Winter Season Banner">
                </a>
            </div>
        </div>
    </div>
    <!-- Banner-Layer /- -->
    <!-- Custom-Deal-Page -->
    <div class="page-deal">
        <div class="container">
            <div class="deal-page-wrapper mb-2">
                <h1 class="deal-heading" style="font-size: 30px;">Próximos eventos</h1>
                <h6 class="deal-has-total-items" style="font-size: 15px;">Te recomendamos estos Eventos</h6>
            </div>
            <!-- Page-Bar -->
            <div class="page-bar clearfix">
                <div class="shop-settings">
                    <a id="list-anchor">
                        <i class="fas fa-th-list"></i>
                    </a>
                    <a id="grid-anchor" class="active">
                        <i class="fas fa-th"></i>
                    </a>
                </div>
                <!-- Toolbar Sorter 1  -->
                <div class="toolbar-sorter">
                    <div class="select-box-wrapper">
                        <label class="sr-only" for="sort-by">Sort By</label>
                        <select class="select-box" id="sort-by">
                            <option selected="selected" value="">Sort By: Best Selling</option>
                            <option value="">Sort By: Latest</option>
                            <option value="">Sort By: Lowest Price</option>
                            <option value="">Sort By: Highest Price</option>
                            <option value="">Sort By: Best Rating</option>
                        </select>
                    </div>
                </div>
                <!-- //end Toolbar Sorter 1  -->
                <!-- Toolbar Sorter 2  -->
                <div class="toolbar-sorter-2">
                    <div class="select-box-wrapper">
                        <label class="sr-only" for="show-records">Show Records Per Page</label>
                        <select class="select-box" id="show-records">
                            <option selected="selected" value="">Show: 8</option>
                            <option value="">Show: 16</option>
                            <option value="">Show: 28</option>
                        </select>
                    </div>
                </div>
                <!-- //end Toolbar Sorter 2  -->
            </div>
            <!-- Page-Bar /- -->
            <!-- Row-of-Product-Container -->
            <div class="row product-container grid-style">
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/productos/1.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Categoria: Concierto</a>
                                    </li>
                                    <li class="">
                                        <a href="shop-v1-root-category.html">Ciudad: Iquitos</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html" class="truncate" style="max-width: 95%;">La Única Tropical en Utaja Club Piura</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" style="max-width: 100%;">Utaja Club, Caserío Miraflores KM2 - CASTILLA - PIURA</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    SÁB 12 ABR - 06:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/productos/2.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Categoria: Concierto</a>
                                    </li>
                                    <li class="">
                                        <a href="shop-v1-root-category.html">Ciudad: Iquitos</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html" class="truncate" style="max-width: 95%;">La Única Tropical en Utaja Club Piura</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" style="max-width: 100%;">Utaja Club, Caserío Miraflores KM2 - CASTILLA - PIURA</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    SÁB 12 ABR - 06:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/productos/3.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Categoria: Concierto</a>
                                    </li>
                                    <li class="">
                                        <a href="shop-v1-root-category.html">Ciudad: Iquitos</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html" class="truncate" style="max-width: 95%;">La Única Tropical en Utaja Club Piura</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" style="max-width: 100%;">Utaja Club, Caserío Miraflores KM2 - CASTILLA - PIURA</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    SÁB 12 ABR - 06:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/productos/4.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Categoria: Concierto</a>
                                    </li>
                                    <li class="">
                                        <a href="shop-v1-root-category.html">Ciudad: Iquitos</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html" class="truncate" style="max-width: 95%;">La Única Tropical en Utaja Club Piura</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" style="max-width: 100%;">Utaja Club, Caserío Miraflores KM2 - CASTILLA - PIURA</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    SÁB 12 ABR - 06:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/productos/5.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Categoria: Concierto</a>
                                    </li>
                                    <li class="">
                                        <a href="shop-v1-root-category.html">Ciudad: Iquitos</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html" class="truncate" style="max-width: 95%;">La Única Tropical en Utaja Club Piura</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" style="max-width: 100%;">Utaja Club, Caserío Miraflores KM2 - CASTILLA - PIURA</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    SÁB 12 ABR - 06:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/productos/6.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Categoria: Concierto</a>
                                    </li>
                                    <li class="">
                                        <a href="shop-v1-root-category.html">Ciudad: Iquitos</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html" class="truncate" style="max-width: 95%;">La Única Tropical en Utaja Club Piura</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" style="max-width: 100%;">Utaja Club, Caserío Miraflores KM2 - CASTILLA - PIURA</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    SÁB 12 ABR - 06:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/productos/7.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Categoria: Concierto</a>
                                    </li>
                                    <li class="">
                                        <a href="shop-v1-root-category.html">Ciudad: Iquitos</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html" class="truncate" style="max-width: 95%;">La Única Tropical en Utaja Club Piura</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" style="max-width: 100%;">Utaja Club, Caserío Miraflores KM2 - CASTILLA - PIURA</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    SÁB 12 ABR - 06:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/productos/8.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Categoria: Concierto</a>
                                    </li>
                                    <li class="">
                                        <a href="shop-v1-root-category.html">Ciudad: Iquitos</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html" class="truncate" style="max-width: 95%;">La Única Tropical en Utaja Club Piura</a>
                                </h6>
                                <div class="item-stars">
                                    <span class="truncate" style="max-width: 100%;">Utaja Club, Caserío Miraflores KM2 - CASTILLA - PIURA</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price p-0 m-0" style="font-size: 15px;">
                                    SÁB 12 ABR - 06:00 PM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row-of-Product-Container /- -->
            <!-- Shop-Pagination -->
            <div class="pagination-area m-0" style="margin-top: -25px !important;">
                <div class="pagination-number">
                    <ul>
                        <li style="display: none">
                            <a href="shop-v1-root-category.html" title="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="active">
                            <a href="shop-v1-root-category.html">1</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">2</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">3</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">...</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html">10</a>
                        </li>
                        <li>
                            <a href="shop-v1-root-category.html" title="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Shop-Pagination /- -->
        </div>
    </div>
    <!-- Custom-Deal-Page -->
    <!-- Banner-Image & View-more -->
    <div class="banner-image-view-more">
        <div class="container">
            <div class="image-banner">
                <a href="shop-v1-root-category.html" class="mx-auto banner-hover effect-dark-opacity">
                    <img class="img-fluid" src="<?= _SERVER_?>ecommerce/media/banners/2.jpg" alt="Banner Image">
                </a>
            </div>
        </div>
    </div>
    <!-- Banner-Image & View-more /- -->    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <!-- Outer-Footer -->
            <div class="outer-footer-wrapper u-s-p-y-40">
                <h6>
                    Para ofertas especiales y otra información sobre descuentos
                </h6>
                <h1>
                    ¡Suscríbete a próximos eventos!
                </h1>
                <p>
                    Ingresa tu correo electrónico y WhastApp para recibir nuevas ofertas y cupones directamente en tu buzón de entrada.
                </p>
                <form class="newsletter-form">
                    <label class="sr-only" for="newsletter-field">Ingresa tu Correo</label>
                    <input type="text" id="newsletter-field" placeholder="Ingresa tu Numero de Celular" class="mb-2">
                    <input type="text" id="newsletter-field" placeholder="Ingresa tu Correo">
                    <!-- <button type="submit" class="button">Suscríbete</button> -->
                </form>
                <button type="submit" class="button button-primary mt-2" style="padding: 20px 80px; font-weight: 700 !important;text-transform: uppercase !important;">Suscríbete</button>
            </div>
            <!-- Outer-Footer /- -->
            <!-- Mid-Footer -->
            <div class="mid-footer-wrapper u-s-p-b-40">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>CENTRO DE AYUDA</h6>
                            <!-- <ul>
                                <li>
                                    <a href="faq.html">FAQs</a>
                                </li>
                                <li>
                                    <a href="track-order.html">Track Order</a>
                                </li>
                                <li>
                                    <a href="terms-and-conditions.html">Terms & Conditions</a>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>COMPANY</h6>
                            <ul>
                                <li>
                                    <a href="home.html">Home</a>
                                </li>
                                <li>
                                    <a href="about.html">About</a>
                                </li>
                                <li>
                                    <a href="contact.html">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>INFORMATION</h6>
                            <ul>
                                <li>
                                    <a href="store-directory.html">Categories Directory</a>
                                </li>
                                <li>
                                    <a href="wishlist.html">My Wishlist</a>
                                </li>
                                <li>
                                    <a href="cart.html">My Cart</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer-list">
                            <h6>Address</h6>
                            <ul>
                                <li>
                                    <i class="fas fa-location-arrow u-s-m-r-9"></i>
                                    <span>819 Sugar Camp Road, West Concord, MN 55985</span>
                                </li>
                                <li>
                                    <a href="tel:+923086561801">
                                        <i class="fas fa-phone u-s-m-r-9"></i>
                                        <span>+111-444-989</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:contact@domain.com">
                                        <i class="fas fa-envelope u-s-m-r-9"></i>
                                        <span>
                                            contact@domain.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mid-Footer /- -->
            <!-- Bottom-Footer -->
            <div class="bottom-footer-wrapper">
                <p class="copyright-text">Copyright &copy; 2025 <a href="home.html">Fact-Cloud</a> Todos los derechos reservados</p>
            </div>
        </div>
        <!-- Bottom-Footer /- -->
    </footer>
    <!-- Footer /- -->
    <!-- Dummy Selectbox -->
    <div class="select-dummy-wrapper">
        <select id="compute-select">
            <option id="compute-option">All</option>
        </select>
    </div>
    <!-- Dummy Selectbox /- -->
    <!-- Responsive-Search -->
    <div class="responsive-search-wrapper">
        <button type="button" class="button ion ion-md-close" id="responsive-search-close-button"></button>
        <div class="responsive-search-container">
            <div class="container">
                <p>Start typing and press Enter to search</p>
                <form class="responsive-search-form">
                    <label class="sr-only" for="search-text">Search</label>
                    <input id="search-text" type="text" class="responsive-search-field" placeholder="PLEASE SEARCH">
                    <i class="fas fa-search"></i>
                </form>
            </div>
        </div>
    </div>
    <!-- Responsive-Search /- -->
    <!-- Newsletter-Modal -->
    <div id="newsletter-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="button dismiss-button ion ion-ios-close" data-dismiss="modal"></button>
                <div class="modal-body u-s-p-x-0">
                    <div class="row align-items-center u-s-m-x-0">
                        <div class="col-lg-6 col-md-6 col-sm-12 u-s-p-x-0">
                            <div class="newsletter-image">
                                <a href="shop-v1-root-category.html" class="banner-hover effect-dark-opacity">
                                    <img class="img-fluid" src="<?= _SERVER_?>ecommerce/images/banners/newsletter-1.jpg" alt="Newsletter Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="newsletter-wrapper">
                                <h1>New to
                                    <span>Groover</span> ?
                                    <br>Subscribe Newsletter</h1>
                                <h5>Get latest product update...</h5>
                                <form>
                                    <div class="u-s-m-b-35">
                                        <input type="text" class="newsletter-textfield" placeholder="Enter Your Email">
                                    </div>
                                    <div class="u-s-m-b-35">
                                        <button class="button button-primary d-block w-100">Subscribe</button>
                                    </div>
                                </form>
                                <h6>Be the first for getting special deals and offers, Send directly to your inbox.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter-Modal /- -->
    <!-- Quick-view-Modal -->
    <div id="quick-view" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="button dismiss-button ion ion-ios-close" data-dismiss="modal"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- Product-zoom-area -->
                            <div class="zoom-area">
                                <img id="zoom-pro-quick-view" class="img-fluid" src="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg" data-zoom-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg" alt="Zoom Image">
                                <div id="gallery-quick-view" class="u-s-m-t-10">
                                    <a class="active" data-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg" data-zoom-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg">
                                        <img src="<?= _SERVER_?>ecommerce/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg" data-zoom-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg">
                                        <img src="<?= _SERVER_?>ecommerce/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg" data-zoom-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg">
                                        <img src="<?= _SERVER_?>ecommerce/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg" data-zoom-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg">
                                        <img src="<?= _SERVER_?>ecommerce/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg" data-zoom-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg">
                                        <img src="<?= _SERVER_?>ecommerce/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                    <a data-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg" data-zoom-image="<?= _SERVER_?>ecommerce/images/product/product@4x.jpg">
                                        <img src="<?= _SERVER_?>ecommerce/images/product/product@2x.jpg" alt="Product">
                                    </a>
                                </div>
                            </div>
                            <!-- Product-zoom-area /- -->
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- Product-details -->
                            <div class="all-information-wrapper">
                                <div class="section-1-title-breadcrumb-rating">
                                    <div class="product-title">
                                        <h1>
                                            <a href="single-product.html">Casual Hoodie Full Cotton</a>
                                        </h1>
                                    </div>
                                    <ul class="bread-crumb">
                                        <li class="has-separator">
                                            <a href="home.html">Home</a>
                                        </li>
                                        <li class="has-separator">
                                            <a href="shop-v1-root-category.html">Men's Clothing</a>
                                        </li>
                                        <li class="has-separator">
                                            <a href="shop-v2-sub-category.html">Tops</a>
                                        </li>
                                        <li class="is-marked">
                                            <a href="shop-v3-sub-sub-category.html">Hoodies</a>
                                        </li>
                                    </ul>
                                    <div class="product-rating">
                                        <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                            <span style='width:67px'></span>
                                        </div>
                                        <span>(23)</span>
                                    </div>
                                </div>
                                <div class="section-2-short-description u-s-p-y-14">
                                    <h6 class="information-heading u-s-m-b-8">Description:</h6>
                                    <p>This hoodie is full cotton. It includes a muff sewn onto the lower front, and (usually) a drawstring to adjust the hood opening. Throughout the U.S., it is common for middle-school, high-school, and college students to wear this sweatshirts—with or without hoods—that display their respective school names or mascots across the chest, either as part of a uniform or personal preference.
                                    </p>
                                </div>
                                <div class="section-3-price-original-discount u-s-p-y-14">
                                    <div class="price">
                                        <h4>$55.00</h4>
                                    </div>
                                    <div class="original-price">
                                        <span>Original Price:</span>
                                        <span>$60.00</span>
                                    </div>
                                    <div class="discount-price">
                                        <span>Discount:</span>
                                        <span>8%</span>
                                    </div>
                                    <div class="total-save">
                                        <span>Save:</span>
                                        <span>$5</span>
                                    </div>
                                </div>
                                <div class="section-4-sku-information u-s-p-y-14">
                                    <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                                    <div class="availability">
                                        <span>Availability:</span>
                                        <span>In Stock</span>
                                    </div>
                                    <div class="left">
                                        <span>Only:</span>
                                        <span>50 left</span>
                                    </div>
                                </div>
                                <div class="section-5-product-variants u-s-p-y-14">
                                    <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                                    <div class="color u-s-m-b-11">
                                        <span>Available Color:</span>
                                        <div class="color-variant select-box-wrapper">
                                            <select class="select-box product-color">
                                                <option value="1">Heather Grey</option>
                                                <option value="3">Black</option>
                                                <option value="5">White</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="sizes u-s-m-b-11">
                                        <span>Available Size:</span>
                                        <div class="size-variant select-box-wrapper">
                                            <select class="select-box product-size">
                                                <option value="">Male 2XL</option>
                                                <option value="">Male 3XL</option>
                                                <option value="">Kids 4</option>
                                                <option value="">Kids 6</option>
                                                <option value="">Kids 8</option>
                                                <option value="">Kids 10</option>
                                                <option value="">Kids 12</option>
                                                <option value="">Female Small</option>
                                                <option value="">Male Small</option>
                                                <option value="">Female Medium</option>
                                                <option value="">Male Medium</option>
                                                <option value="">Female Large</option>
                                                <option value="">Male Large</option>
                                                <option value="">Female XL</option>
                                                <option value="">Male XL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                    <form action="#" class="post-form">
                                        <div class="quick-social-media-wrapper u-s-m-b-22">
                                            <span>Share:</span>
                                            <ul class="social-media-list">
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-rss"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fab fa-pinterest"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="quantity-wrapper u-s-m-b-22">
                                            <span>Quantity:</span>
                                            <div class="quantity">
                                                <input type="text" class="quantity-text-field" value="1">
                                                <a class="plus-a" data-max="1000">&#43;</a>
                                                <a class="minus-a" data-min="1">&#45;</a>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="button button-outline-secondary" type="submit">Add to cart</button>
                                            <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                            <button class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Product-details /- -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick-view-Modal /- -->
</div>

<script>
window.ga = function() {
    ga.q.push(arguments)
};
ga.q = [];
ga.l = +new Date;
ga('create', 'UA-XXXXX-Y', 'auto');
ga('send', 'pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
<!-- Modernizr-JS -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/vendor/modernizr-custom.min.js"></script>
<!-- NProgress -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/nprogress.min.js"></script>
<!-- jQuery -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/bootstrap.min.js"></script>
<!-- Popper -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/popper.min.js"></script>
<!-- ScrollUp -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/jquery.scrollUp.min.js"></script>
<!-- Elevate Zoom -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/jquery.elevatezoom.min.js"></script>
<!-- jquery-ui-range-slider -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/jquery-ui.range-slider.min.js"></script>
<!-- jQuery Slim-Scroll -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/jquery.slimscroll.min.js"></script>
<!-- jQuery Resize-Select -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/jquery.resize-select.min.js"></script>
<!-- jQuery Custom Mega Menu -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/jquery.custom-megamenu.min.js"></script>
<!-- jQuery Countdown -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/jquery.custom-countdown.min.js"></script>
<!-- Owl Carousel -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/owl.carousel.min.js"></script>
<!-- Main -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/js/app.js"></script>
</body>
</html>
