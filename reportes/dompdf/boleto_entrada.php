<?php 
    include_once "asset/dompdf/vendor/autoload.php";

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
        <title><?= $data->codigo_unico ?></title> 
    </head>
    <?php 
        require_once 'style_documento_80mm.php';
    ?>
    <body>
        <header class="clearfix">
        </header>
        <main>
            <div class="detalles clearfix" style="margin-top:-18px;">
                <div style="width: 75px !important;">
                    <span>CODIGO</span><br>
                    <span>CONCIERTO</span><br>
                    <span>ZONA</span><br>
                    <span>CANTIDAD</span><br>
                    <span>FECHA Y HORA</span><br>
                </div>
                <div style="width: 5px !important; margin-left: 77px; margin-top: -100px;">
                    <span>:</span><br>
                    <span>:</span><br>
                    <span>:</span><br>
                    <span>:</span><br>
                    <span>:</span><br>
                </div>
                <div style="width: 206px !important; margin-left: 82px; margin-top: -100px;">
                    <span><?= $data->codigo_unico ?></span><br>
                    <span><?= $data->con_nombre ?></span><br>
                    <span><?= $data->zon_nombre .' - '. $data->zon_detalle ?></span><br>
                    <span><?= $data->bol_cant_personas.' Persona(s)' ?></span><br>
                    <span><?= date("d/m/Y h:i:s A", strtotime($data->con_fecha .' '. $data->con_hora)) ?></span><br>
                </div>
            </div>
        </main>
        <div class="clearfix">
            <div class="header_doc">
                <img src="media/codigosQr/<?=$data->codigo_unico?>.png" style="height: 300px !important; width: 300px !important;" >
            </div>
        </div>
        <div class="detalles clearfix" style="margin-top:-5px;">
            <div class="text-center" style="margin-top: 2px;">
                <span>SI REQUIERE ESTE SOFTWARE LLAME AL 912380970<br> FACT-CLOUD - DESARROLLANDO SISTEMAS INFORMATICOS</span>
            </div>
        </div>      
    </body>
</html>
<?php
        $html = ob_get_clean();
        $dompdf->loadHtml($html);
        $paper_size = array(0,0,226.50,650);
        $dompdf->setPaper($paper_size);
        $dompdf->render(); // Render the HTML as PDF
        $contenido = $dompdf->output();
        $nombre_pdf = $data->codigo_unico.'.pdf';

        // $ruta_completa = $path_ruta.$nombre_pdf;

        ob_start();//esto pongo para generar el pdf en base64
        // $bytes = file_put_contents($ruta_completa, $contenido); //Si queremos guardar en el servidor
        $bytes = file_put_contents('php://output', $contenido);

        $xlsData = ob_get_contents();
        ob_end_clean();
        $rpta = true;
        $mensaje = 'Documento creado correctamente';
        unlink('media/codigosQr/'.$data->codigo_unico.'.png');
    }
    catch(Throwable $e)
    {
        // $e->getMessage();
        $rpta = false;
        $mensaje = 'Hubo un error critico al tratar de crear el PDF. <br> Por favor, intente Nuevamente.<br>Si el problema persiste comunicarse con el Desarrollador del Sistema';
    }
?>