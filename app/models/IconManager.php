<?php
class IconManager
{
    private $iconos;

    public function __construct()
    {
        $this->iconos = [
            'folder' => _SERVER_.'styles/img/icon_archivos/carpeta.png',
            'share' => _SERVER_.'styles/img/icon_archivos/carpeta.png',
            'pdf' => _SERVER_.'styles/img/icon_archivos/pdf.png',
            'xls' => _SERVER_.'styles/img/icon_archivos/xls.png',
            'xlsx' => _SERVER_.'styles/img/icon_archivos/xlsx.png',
            'png' => _SERVER_.'styles/img/icon_archivos/png.png',
            'txt' => _SERVER_.'styles/img/icon_archivos/txt.png',
            'docx' => _SERVER_.'styles/img/icon_archivos/docx.png',
            'doc' => _SERVER_.'styles/img/icon_archivos/doc.png',
            'zip' => _SERVER_.'styles/img/icon_archivos/zip.png',
            'tiff' => _SERVER_.'styles/img/icon_archivos/tiff.png',
            'swf' => _SERVER_.'styles/img/icon_archivos/swf.png',
            'svg' => _SERVER_.'styles/img/icon_archivos/svg.png',
            'sys' => _SERVER_.'styles/img/icon_archivos/sys.png',
            'rtf' => _SERVER_.'styles/img/icon_archivos/rtf.png',
            'rss' => _SERVER_.'styles/img/icon_archivos/rss.png',
            'rar' => _SERVER_.'styles/img/icon_archivos/rar.png',
        ];
    }

    public function getIcon($extension)
    {
        return isset($this->iconos[$extension]) ? $this->iconos[$extension] : _SERVER_.'styles/img/icon_archivos/not_fount.png';
    }
}
?>