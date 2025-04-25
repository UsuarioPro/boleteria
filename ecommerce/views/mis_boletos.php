    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Mis Boletos</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="#">Tienda</a>
                    </li>
                    <li class="is-marked">
                        <a href="#">Mis Boletos</a>
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
                        <table id="">
                            <thead>
                                <tr>
                                    <th>boleto</th>
                                    <th>Concierto</th>
                                    <th>Zona</th>
                                    <th>Cantidad</th>
                                    <th>Fecha y Hora</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                foreach($mis_boletos as $m)
                                {
                                    echo '<tr>
                                        <td>'.$m->codigo_unico.'</td>
                                        <td>'.$m->con_nombre.'<br> <small>'.$m->con_subtitulo.' - '.$m->con_descripcion.'</small> </td>
                                        <td>'.$m->zon_nombre.' <br> <small>'.$m->zon_detalle.'</small> </td>
                                        <td>Valido para: '.$m->bol_cant_personas.' Persona(s)</td>
                                        <td>'.date("d/m/Y h:i:s A", strtotime($m->con_fecha .' '. $m->con_hora)).'</td>
                                        <td> <button class="btn buttom-primary"><i class="fas fa-file-pdf"></i></button> </td>
                                    </tr>';
                                }
                            ?>    
                            </tbody>
                        </table>
                    </div>
                    <!-- Products-List-Wrapper /- -->
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
<script type="text/javascript" src="<?= _SERVER_?>ecommerce/views/mi_boleto.js" type="text/javascript" charset="utf-8" async defer></script>