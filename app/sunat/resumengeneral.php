<?php

define('_MPDF_PATH', '/lib');
require('./lib/mpdf/vendor/autoload.php');
include('../src/GenerateCoinToLetters.php');
require_once("./lib/phpqrcode/qrlib.php");
require  './../src/autoload.php';

use SysSoftIntegra\Model\VentasADO;

$title = "RESUMEN GENERAL";
$fechaIngreso = date("d-m-Y", strtotime($_GET["fechaInicial"])) . " al " . date("d-m-Y", strtotime($_GET["fechaFinal"]));

$result = VentasADO::ResumenGeneral($_GET["fechaInicial"], $_GET["fechaFinal"]);
if (!is_array($result)) {
    echo $result;
} else {

    $empresa = $result[0];

    $photo = $empresa->Image == "" ?  "<img src=\"./../../view/image/logo.png\" width=\"80\" />" : "<img src=\"data:image/jpg;base64, " . $empresa->Image . "\" width=\"80\" />";

    $html = '
<html>
<head>
<style>
    body {
        font-family: Arial;
        font-size: 10pt;
    }
    p {	
        font-family: Arial;
    }
    table.items {
        border: 0.1mm solid #000000;
    }
    td { 
        vertical-align: middle; 
    }
    table thead th {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
        border-top: 0.1mm solid #000000;
        border-bottom: 0.1mm solid #000000;
    }
    table tbody td {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
        border-top: 0.1mm solid #000000;
        border-bottom: 0.1mm solid #000000;
    }
    table tfoot td {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
        border-top: 0.1mm solid #000000;
        border-bottom: 0.1mm solid #000000;
    }
    table thead td { 
        background-color: #EEEEEE;
        text-align: center;
        border: 0.1mm solid #000000;
        font-variant: small-caps;
    }
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
    <table width="100%">
        <tr>
            <td width="50%" style="color:#969696; ">
                <span style="font-weight: bold; font-size: 9pt;">
                    ' . $empresa->NombreComercial . '
                </span>
            </td>
            <td width="50%" style="color:#969696;text-align: right;">
                <span style="font-weight: bold; font-size: 9pt;">
                    SysSoft Integra
                </span>
            </td>
        </tr>
    </table>
</htmlpageheader>
<htmlpagefooter name="myfooter">
    <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Pagin {PAGENO} de {nb}
    </div>
</htmlpagefooter>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->

<table width="100%" style="font-family: serif;" cellpadding="10">
    <tr>
        <td width="15%" style="border: 0mm solid #888888;text-align: center;">
            ' . $photo . '
            <div>
                <p>' . $empresa->NombreComercial . '</p>
            </div>
        </td>
        <td width="85%" style="border: 0mm solid #888888;text-align: center;vertical-align: middle;">
            <span style="font-size: 14pt; color: black; font-family: sans;">
                <b>' . $title . ' </b>
            </span>
            <br>
            <span style="font-size: 10pt; color: black; font-family: sans;">
                FECHA: ' . $fechaIngreso . ' 
        </span>
        </td>
    </tr>
</table>

</body>
</html>
';


    $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_top' => 18,
        'margin_bottom' => 25,
        'margin_header' => 10,
        'margin_footer' => 10,
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'L'
    ]);

    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Resumen Global");
    $mpdf->SetAuthor("Syssoft Integra");
    $mpdf->SetWatermarkText((""));   // anulada
    $mpdf->showWatermarkText = true;
    $mpdf->watermark_font = 'DejaVuSansCondensed';
    $mpdf->watermarkTextAlpha = 0.1;
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);

    // Output a PDF file directly to the browser
    $mpdf->Output("Resumen Global.pdf", 'I');
}
