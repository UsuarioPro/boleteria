<?php 
    include_once "asset/dompdf/vendor/autoload.php";
    // reference the Dompdf namespace
    use Dompdf\Dompdf;
    try
    {
        $dompdf = new Dompdf();
        ob_start();
?>
<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>REPORTE DE COMPROBANTES DE VENTA</title> 
    </head>
    <?php require_once 'style_documento_A4.php'?>
    <body>
        <main>
            <div class="detalles clearfix">
                <div class="rectangulo">
                    <div style="width: 80px !important;">
                        <span>TIPO REPORTE</span><br>
                        <span>PERIODO</span><br>
                    </div>
                    <div style="width: 5px !important; margin-left: 80px; margin-top: -100px;">
                        <span>:</span><br>
                        <span>:</span><br>
                    </div>
                    <div style="width: 650px !important; margin-left: 85px; margin-top: -100px;">
                        <span>REPORTE DE VENTAS</span><br>
                        <span><?= $name_filtro?></span><br>
                    </div>
                </div>
            </div>
            <h4 class="titulo">REPORTE DE VENTAS </h4>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="numeral">#</th>
                        <th class="_130">Cliente</th>
                        <th class="totales">Tipo Pago</th>
                        <th class="totales">Fecha</th>
                        <th class="totales">Total</th>
                        <th class="totales">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(empty($registros))
                        {
                            $display ='none';
                            echo '<tr style="text-align: center;"><th colspan="7">NO SE ENCONTRARON REGISTROS</th></tr>';
                        }
                        else
                        {
                            $display ='normal'; 
                            $cont = 1;
                            foreach($registros as $m)
                            {
                                echo'<tr>
                                    <td class="numeral">'.$cont.'</td>
                                    <td class="_150"><span>'.$m->cli_nombre.'<br><small>'.$m->tip_ide_abrev.' : '.$m->cli_num_doc.'</small></span></td>
                                    <td class="totales">'.$m->tipo_pago.'</td>
                                    <td class="totales">'.date("d/m/Y h:i A", strtotime($m->ven_fecha)).'</td>
                                    <td class="totales">'.$m->ven_total.'</td>';
                                    
                                    if($m->ven_estado == 1)
                                    {
                                        echo '<td class="totales"><span class="badge bg-gradient-success"> Activo</span></td>';
                                    }
                                    else
                                    {
                                        echo '<td class="totales"><span class="badge bg-gradient-danger">Inactivo</span></td>';
                                    }
                                echo '</tr>';
                                $cont++;
                            }
                        }                    
                    ?>
                </tbody>
            </table>
        </main>
    </body>
</html>
<?php
        $html = ob_get_clean();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait'); // (Optional) Setup the paper size and orientation
        $dompdf->render(); // Render the HTML as PDF
        $contenido = $dompdf->output();
        $nombre_pdf = 'Reporte ventas('.$name_filtro.').pdf';
        // $ruta_completa = $path_ruta.$nombre_pdf;

        ob_start();//esto pongo para generar el pdf en base64
        // $bytes = file_put_contents($ruta_completa, $contenido); //Si queremos guardar en el servidor
        $bytes = file_put_contents('php://output', $contenido);

        $xlsData = ob_get_contents();
        ob_end_clean();
        $rpta = true;
        $mensaje = 'Documento descargado correctamente';
    }
    catch(Throwable $e)
    {
        // $e->getMessage();
        $rpta = false;
        $mensaje = 'Hubo un error critico al tratar de crear el PDF. <br> Por favor, intente Nuevamente.<br>Si el problema persiste comunicarse con el Desarrollador del Sistema';
    }
?>