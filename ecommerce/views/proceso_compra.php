    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Proceso de Pago</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="home.html">Tienda</a>
                    </li>
                    <li class="is-marked">
                        <a href="checkout.html">Proceso de Pago</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Checkout-Page -->
    <div class="page-checkout u-s-p-t-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form id="formulario" name="formulario" method="POST" accept-charset="utf-8">
                        <div class="row">
                            <!-- Billing-&-Shipping-Details -->
                            <div class="col-lg-4">
                                <h4 class="section-h4">Detalle de Facturacion </h4>
                                <!-- Form-Fields -->
                                <div class="group-inline u-s-m-b-10">
                                    <label for="first-name">Nombre Completo
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="nombre" name="nombre" class="text-field" placeholder="Ingrese el Nombre" value="<?= $usuario->cli_nombre?>">
                                </div>
                                <div class="group-inline u-s-m-b-10">
                                    <label for="tra_tipo_doc">Tipo de Documento
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="hidden" id="usu_id" name="usu_id" value="<?= $usuario->usu_id ?>">
                                    <input type="hidden" id="total" name="total">
                                    <input type="hidden" id="value_select" value="<?= $usuario->tip_ide_id ?>">
                                    <select type="text" id="tra_tipo_doc" name="tra_tipo_doc" class="text-field" placeholder="Tipo de Documento">
                                        <option value="" disabled selected>Seleccione el Tipo de Documento</option>
                                        <?php 
                                        foreach($tipos_documento as $m)
                                        {
                                            echo '<option value="'.$m->tip_ide_id.'">'.$m->tip_ide_abrev.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="group-inline u-s-m-b-10">
                                    <label for="first-name">Numero de Documento
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="num_documento" name="num_documento" class="text-field" value="<?= $usuario->cli_num_doc ?>" placeholder="Ingrese el Numero de documento">
                                </div>
                                <div class="group-inline u-s-m-b-10">
                                    <label for="first-name">Correo
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="correo" name="correo" class="text-field" value="<?= $usuario->cli_correo?>">
                                </div>
                                <div class="group-inline u-s-m-b-10">
                                    <label for="first-name">Telefono
                                        <span class="astk">*</span>
                                    </label>
                                    <input type="text" id="telefono" name="telefono" value="<?= $usuario->cli_telefono?>" class="text-field">
                                </div> 
                            </div>
                            <!-- Billing-&-Shipping-Details /- -->
                            <!-- Checkout -->
                            <div class="col-lg-8">
                                <h4 class="section-h4">Tu Orden</h4>
                                <div class="order-table pt-2">
                                    <table id="tbl_carro" class="u-s-m-b-13">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th class="text-center">Cant</th>
                                                <th class="text-center">Precio</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot class="calculation">
                                            <tr>
                                                <th colspan="4">Detalle de Compra</th>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <h3 class="calc-h3 u-s-m-b-0" style="float: right;margin-right: 15px;">Subtotal</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text" id="lbt_subtotal"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <h3 class="calc-h3 u-s-m-b-0" style="float: right;margin-right: 15px;" id="tax-heading">Cupon</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text">S/. 0.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <h3 class="calc-h3 u-s-m-b-0" style="float: right;margin-right: 15px;">Total</h3>
                                                </td>
                                                <td>
                                                    <span class="calc-text" id="lbl_total"></span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <input type="hidden" id="tipo_pago" name="tipo_pago" value="">
                                    <div class="u-s-m-b-10">
                                        <input type="radio" data_valor="YAPE" class="radio-box payment-method" name="payment_method" id="cash-on-delivery">
                                        <label class="label-text" for="cash-on-delivery">Yape</label>
                                    </div>
                                    <div class="u-s-m-b-10">
                                        <input type="radio" data_valor="PLIN" class="radio-box payment-method" name="payment_method" id="credit-card-stripe">
                                        <label class="label-text" for="credit-card-stripe">Plin</label>
                                    </div>
                                    <div class="u-s-m-b-10">
                                        <input type="radio" data_valor="TARJETA CREDITO / DEBITO" class="radio-box payment-method" name="payment_method" id="paypal">
                                        <label class="label-text" for="paypal">Tarjeta de Credito / Debito</label>
                                    </div>
                                    <button type="submit" class="button button-outline-secondary">Pagar Ahora</button>
                                </div>
                            </div>
                            <!-- Checkout /- -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?= _SERVER_?>ecommerce/views/proceso_compra.js" type="text/javascript" charset="utf-8" async defer></script>