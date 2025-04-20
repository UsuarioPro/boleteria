    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Carro de Compras</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="#">Tienda</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Carro de Compras</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Products-List-Wrapper -->
                    <div class="table-wrapper u-s-m-b-60">
                        <table id="tbl_carro">
                            <thead>
                                <tr>
                                    <th>Concierto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- Products-List-Wrapper /- -->
                    <!-- Coupon -->
                    <div class="coupon-continue-checkout u-s-m-b-60">
                        <div class="coupon-area">
                            <h6>Introduzca su código de cupón si tiene uno.</h6>
                            <div class="coupon-field">
                                <label class="sr-only" for="coupon-code">Aplicar Cupon</label>
                                <input id="coupon-code" type="text" class="text-field" placeholder="Ingrese el codigo del cupon">
                                <button type="button" class="button" id="btn_cupon">Aplicar Cupon</button>
                            </div>
                        </div>
                        <div class="button-area">
                            <a href="<?= _SERVER_?>" class="continue">Continuar Comprando</a>
                            <a href="<?= _SERVER_?>Tienda/proceder_pago/<?= $_SESSION['usu_id'] ?>" class="checkout">Proceder a Pagar</a>
                        </div>
                    </div>
                        <!-- Coupon /- -->
                    <!-- Billing -->
                    <div class="calculation u-s-m-b-60">
                        <div class="table-wrapper-2">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2">Detalle de Compra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Subtotal</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text" id="lbt_subtotal"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Cupon</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text">S/. 0.00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                        </td>
                                        <td>
                                            <span class="calc-text" id="lbl_total"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Billing /- -->
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/views/mi_carro.js" type="text/javascript" charset="utf-8" async defer></script>
