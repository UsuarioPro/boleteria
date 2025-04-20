
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a page-style-portada" style="background: url(<?= $img_portada?>);"></div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Single-Product-Full-Width-Page -->
    <div class="page-detail u-s-p-t-40">
        <div class="container">
            <!-- Product-Detail -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-details -->
                    <div class="all-information-wrapper">
                        <div class="section-1-title-breadcrumb-rating">
                            <div class="product-title">
                                <h1>
                                    <a href="#"><?= $concierto->con_nombre ?></a>
                                </h1>
                            </div>
                            <ul class="bread-crumb">
                                <li class="">
                                    <a href="#"><?= $concierto->con_subtitulo ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="section-2-short-description u-s-p-y-8">
                            <h2 class="information-heading u-s-m-b-4" style="font-size: 16px;">DETALLES DEL EVENTO</h2>
                            <div style="max-width: 100%; font-size: 14px;">
                                <div style="display: flex; margin-bottom: 5px;">
                                    <div style="width: 100px; font-weight: bold;">Fecha:</div>
                                    <div><?= $texto_fecha ?></div>
                                </div>
                                <div style="display: flex; margin-bottom: 5px;">
                                    <div style="width: 100px; font-weight: bold;">Hora:</div>
                                    <div><?= date('h:i A', strtotime($concierto->con_hora)) ?></div>
                                </div>
                                <div style="display: flex; margin-bottom:5px">
                                    <div style="width: 100px; font-weight: bold;">Lugar:</div>
                                    <div><?= $concierto->loc_nombre ?></div>
                                </div>
                                <div style="display: flex; margin-bottom:5px">
                                    <div style="width: 100px; font-weight: bold;">Dirección:</div>
                                    <div><?= $concierto->loc_direccion ?></div>
                                </div>
                                <div style="display: flex;">
                                    <div style="width: 100px; font-weight: bold;">Ciudad:</div>
                                    <div><?= $concierto->loc_ciudad ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="section-3-price-original-discount u-s-p-y-0" style="font-style: italic;font-size: 14px;">
                            <p><?= $concierto->con_descripcion ?></p>
                        </div>
                    </div>
                    <!-- Product-details /- -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <!-- Product-zoom-area -->
                    <div class="zoom-area">
                        <img id="zoom-pro" class="img-fluid" src="<?= $img_escenario?>" data-zoom-image="<?= $img_escenario?>" alt="Zoom Image">
                    </div>
                    <!-- Product-zoom-area /- -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="section-1-title-breadcrumb-rating">
                        <div class="product-title">
                            <h1>
                                <a href="#">Elige el tipo de entrada</a>
                            </h1>
                        </div>
                        <ul class="bread-crumb">
                            <li class="">
                                <p><strong>ENTRADAS</strong> - DISFRUTA MÁS QUE NUNCA</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
                    $i=0;
                    foreach($zonas_precios as $z)
                    {
                        echo '
                        <div class="col-md-6 mb-4">
                            <div class="card card-equal-height border-purple p-3">
                                <div class="card-header-row mb-2">
                                    <div>
                                        <h5 class="text-danger font-weight-bold mb-1">'.$z->zon_nombre.'</h5>
                                        <h4 class="text-danger font-weight-bold mb-0">S/ '.$z->zon_precio.'</h4>
                                        <small class="text-muted"><i class="fa fa-ticket-alt"></i> '.$z->zon_detalle.'</small>
                                    </div>
                                    <!-- Área de acciones -->
                                    <div class="action-area">
                                        <button class="btn button-primary btn-comprar" style="border-radius: 0px;">Comprar</button>
                                    </div>
                                    <!-- Contenedor que se muestra después de hacer clic -->
                                    <div class="buy-container mt-2">
                                        <div class="d-flex flex-wrap justify-content-end align-items-center">
                                            <div class="qty-box mr-3 mb-2 mb-sm-0">
                                                <button class="btn btn-secondary btn-restar" style="border-radius: 0px;">-</button>
                                                <input type="text" class="qty form-control mx-2" value="1" readonly id="cantidad'.$i.'" name="vip_qty">
                                                <button class="btn btn-secondary btn-sumar" style="border-radius: 0px;">+</button>
                                            </div>
                                            <button class="btn btn-buy mr-2 btn_carro_comprar" data_id="'.$z->zon_id.'" data_nombre="'.$z->zon_nombre.'" data_precio="'.$z->zon_precio.'" data_imagen="'.$concierto->con_imagen.'" 
                                                data_indice="'.$i.'" data_con_id="'.$concierto->con_id.'" data_concierto_nombre="'.$concierto->con_nombre.'" data_detalle="'.$z->zon_detalle.'" data_stock="'.$z->zon_stock.'">Comprar <span class="cantidad-texto">1</span></button>
                                            <button class="btn btn-cart mr-2 btn_carro" data_id="'.$z->zon_id.'" data_nombre="'.$z->zon_nombre.'" data_precio="'.$z->zon_precio.'" data_imagen="'.$concierto->con_imagen.'" 
                                                data_indice="'.$i.'" data_con_id="'.$concierto->con_id.'" data_concierto_nombre="'.$concierto->con_nombre.'" data_detalle="'.$z->zon_detalle.'" data_stock="'.$z->zon_stock.'"><i class="fas fa-shopping-cart"></i></button>
                                            <button class="btn btn-danger btn-cerrar"><i class="far fa-window-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        $i++;
                    }
                ?>
            </div>
            <!-- Product-Detail /- -->
            <!-- Detail-Tabs -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="detail-tabs-wrapper u-s-p-t-10">
                        <div class="detail-nav-wrapper u-s-m-b-0">
                            <ul class="nav single-product-nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#description">Quienes se presentan</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <!-- Description-Tab -->
                            <div class="tab-pane fade active show" id="description">
                                <div class="row product-container list-style">
                                    <?php
                                        foreach($artistas_conciertos as $a)
                                        {
                                            $ruta_img = _SERVER_ .'ecommerce/media/brand-logos/';
                                            $imagen = empty($a->art_imagen_logo)? $ruta_img.'default.jpg' : $ruta_img.$a->art_imagen_logo;
                                            echo '
                                            <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                                <div class="item">
                                                    <div class="image-container">
                                                        <a class="item-img-wrapper-link" href="#">
                                                            <img class="img-fluid" src="'.$imagen.'" alt="Product">
                                                        </a>
                                                    </div>
                                                    <div class="item-content">
                                                        <div class="what-product-is">
                                                            <ul class="bread-crumb">
                                                                <li class="">
                                                                    <a href="shop-v1-root-category.html">'.$a->art_genero.'</a>
                                                                </li>
                                                            </ul>
                                                            <h6 class="item-title">
                                                                <a href="#">'.$a->art_nombre.'</a>
                                                            </h6>
                                                            <div class="item-description">
                                                                <p>'.$a->art_descripcion.'</p>
                                                            </div>
                                                        </div>
                                                        <div class="price-template">
                                                            <div class="item-new-price">
                                                                Hora Presentacion
                                                            </div>
                                                            <div class="item-old-price" style="text-decoration: none">
                                                                '.$hora_formateada = date('d/m/Y h:i A', strtotime($a->art_con_horario_presentacion)).'
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                            <!-- Description-Tab /- -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Detail-Tabs /- -->
        </div>
    </div>
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/views/detalle_producto.js" type="text/javascript" charset="utf-8" async defer></script>