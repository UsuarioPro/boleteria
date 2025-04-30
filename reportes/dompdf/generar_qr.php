<?php
    try
    {
        include_once "asset/phpqrcode/qrlib.php";
        // cómo guardar códigos PNG en el servidor
        $tempDir = 'media/codigosQr/';
        if (!file_exists($tempDir)) //verificamos exite la carpeta
        {
            mkdir($tempDir, 0777, true); //si no existe se crea la carpeta
        }
        $codeContents = $datos_qr;
    
        // necesitamos generar el nombre del archivo de alguna manera,
        $fileName = $data->codigo_unico.'.png';
        
        $pngAbsoluteFilePath = $tempDir.$fileName;    
        // generating
        if (!file_exists($pngAbsoluteFilePath)) 
        {
            QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_H);
        } 
        $respuesta_qr = true;
    }
    catch(Throwable $e)
    {
        $respuesta_qr = false;
    }
?>