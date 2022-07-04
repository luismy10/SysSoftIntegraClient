<?php
use SysSoftIntegra\Model\CotizacionADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "all") {
        print json_encode(CotizacionADO::ListarCotizacion($_GET["opcion"], $_GET["buscar"], $_GET["fechaInicial"], $_GET["fechaFinal"], $_GET["posicionPagina"], $_GET["filasPorPagina"]));
        exit();
    } else if ($_GET["type"] == "cotizacionventa") {
        print json_encode(CotizacionADO::CargarCotizacionVenta($_GET["idCotizacion"]));
        exit();
    } else if ($_GET["type"] == "cotizaciondetalle") {
        print json_encode(CotizacionADO::Sp_Obtener_Cotizacion_ById($_GET["idCotizacion"]));
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    if ($body["type"] == "crud") {
        print json_encode(CotizacionADO::CrudCotizacion($body));
        exit();
    } else if ($body["type"] == "delete") {
        print json_encode(CotizacionADO::DeleteCotizacionById($body));
        exit();
    }
}
