
    <!-- Brand-Slider -->
    <div class="brand-slider u-s-p-b-80 pt-0 pb-2">
        <div class="container">
            <div class="brand-slider-content-local owl-carousel" data-item="10">
                <div class="brand-pic brand-sm">
                    <a href="#"><img src="<?= _SERVER_?>media/locales/1.jpg" alt="Hoy" title="Eventos de Hoy"></a>
                </div>
                <div class="brand-pic brand-sm">
                    <a href="#"><img src="<?= _SERVER_?>media/locales/2.jpg" alt="Eventos de Fin de Semana" title="Eventos de Fin de Semana"></a>
                </div>
                <div class="brand-pic brand-sm">
                    <a href="#"><img src="<?= _SERVER_?>media/locales/3.jpg" alt="Populares" alt="Más Populares"></a>
                </div>
                <?php
                    foreach($locales as $l)
                    {
                        $ruta_img = _SERVER_ .'media/locales/';
                        $imagen = empty($l->loc_imagen_logo)? $ruta_img.'default.jpg' : $ruta_img.$l->loc_imagen_logo;
                        echo '
                        <div class="brand-pic brand-sm">
                            <a href="#"><img src="'.$imagen.'" alt="'.$imagen.'" title="'.$imagen.'"></a>
                        </div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Brand-Slider /- -->
    <!-- Main-Slider -->
    <div class="default-height ph-item">
        <div class="slider-main owl-carousel">
            <?php
                if(empty($banners))
                {
                    echo '<div class="bg-image"  style="background-image: url('._SERVER_.'media/banners/defaulf.jpg);"></div>';
                }
                else
                {
                    foreach($banners as $b)
                    {
                        $ruta_img = _SERVER_ .'media/banners/';
                        $imagen = empty($b->ban_nombre)? $ruta_img.'default.jpg' : $ruta_img.$b->ban_nombre;
                        echo '<div class="bg-image"  style="background-image: url('.$imagen.'"></div>';
                    }
                }
            ?>
        </div>
    </div>
    <!-- Main-Slider /- -->
    <!-- Brand-Slider -->
    <div class="brand-slider u-s-p-b-40 pt-4">
        <div class="container">
            <div class="brand-slider-content owl-carousel" data-item="7">
                <?php
                    foreach($artistas as $a)
                    {
                        $ruta_img = _SERVER_ .'media/artistas_logo/';
                        $imagen = empty($a->art_imagen_logo)? $ruta_img.'default.jpg' : $ruta_img.$a->art_imagen_logo;
                        echo '
                            <div class="brand-pic">
                                <a href="#"><img src="'.$imagen.'" alt="'.$a->art_nombre.'" title="'.$a->art_nombre.'"></a>
                                <div><small class="truncate">'.$a->art_nombre.'</small></div>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- Brand-Slider /- -->
    <!-- Banner-Layer -->
    <div class="banner-layer p-0 mb-5">
        <div class="container">
            <div class="image-banner">
                <a href="shop-v1-root-category.html" class="mx-auto banner-hover effect-dark-opacity">
                    <?php 
                        if(empty($banner_top))
                        {
                            echo '<img class="img-fluid" src="'._SERVER_.'media/banners/defaulf.jpg" alt="Sin Imagen">';
                        }
                        else
                        {
                            foreach($banner_top as $b)
                            {
                                $ruta_img = _SERVER_ .'media/banners/';
                                $imagen = empty($b->ban_nombre)? $ruta_img.'default.jpg' : $ruta_img.$b->ban_nombre;
                                echo '<img class="img-fluid" src="'.$imagen.'" alt="'.$b->ban_nombre.'">';
                            }
                        }
                    ?>
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
            <div class="page-bar clearfix mb-4">
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
                            <option selected="selected" value="" disabled>Seleccione una Categoria</option>
                            <?php
                                foreach($categorias as $c)
                                {
                                    echo '<option value="'.$c->cat_id.'">'.$c->cat_nombre.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <!-- //end Toolbar Sorter 1  -->
                <!-- Toolbar Sorter 2  -->
                <div class="toolbar-sorter-2">
                    <div class="select-box-wrapper">
                        <label class="sr-only" for="show-records">Mostrar registros por página</label>
                        <select class="select-box" id="show-records">
                            <option selected="selected" value="12">Mostrar: 12</option>
                            <option value="16">Mostrar: 16</option>
                            <option value="20">Mostrar: 20</option>
                            <option value="24">Mostrar: 24</option>
                            <option value="28">Mostrar: 28</option>
                        </select>
                    </div>
                </div>
                <!-- //end Toolbar Sorter 2  -->
            </div>
            <!-- Page-Bar /- -->
            <!-- Row-of-Product-Container -->
            <div class="row product-container grid-style" id="div_conciertos"></div>
            <!-- Row-of-Product-Container /- -->
            <!-- Shop-Pagination -->
            <div class="pagination-area m-0" style="margin-top: -25px !important;">
                <div class="pagination-number" id="div_paginacion"></div>
            </div>
            <!-- Shop-Pagination /- -->
        </div>
    </div>
    <!-- Custom-Deal-Page -->
    <!-- Banner-Image & View-more -->
    <div class="banner-image-view-more pb-4">
        <div class="container">
            <div class="image-banner">
                <a href="shop-v1-root-category.html" class="mx-auto banner-hover effect-dark-opacity">
                    <?php 
                        if(empty($banner_bottom))
                        {
                            echo '<img class="img-fluid" src="'._SERVER_.'media/banners/defaulf_2.png" alt="Sin Imagen">';
                        }
                        else
                        {
                            foreach($banner_bottom as $b)
                            {
                                $ruta_img = _SERVER_ .'media/banners/';
                                $imagen = empty($b->ban_nombre)? $ruta_img.'defaulf_2.png' : $ruta_img.$b->ban_nombre;
                                echo '<img class="img-fluid" src="'.$imagen.'" alt="'.$b->ban_nombre.'">';
                            }
                        }
                    ?>
                </a>
            </div>
        </div>
    </div>
    <!-- Outer-Footer -->
    <div class="outer-footer-wrapper u-s-p-y-20" hidden>
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
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/views/home.js" type="text/javascript" charset="utf-8" async defer></script>
