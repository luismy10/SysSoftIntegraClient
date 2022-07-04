<?php

use SysSoftIntegra\Model\ComprasADO;
use SysSoftIntegra\Src\ConfigHeader;

require __DIR__ . './../src/autoload.php';

new ConfigHeader();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($_GET["type"] == "all") {
        print json_encode(ComprasADO::Listar_Compras(
            $_GET["opcion"],
            $_GET["buscar"],
            $_GET["fechaInicio"],
            $_GET["fechaFinal"],
            $_GET["comprobante"],
            $_GET["estado"],
            $_GET["posicionPagina"],
            $_GET["filasPorPagina"]
        ));
        exit();
    } else if ($_GET["type"] == "getid") {
        print json_encode(ComprasADO::Obtener_Compra_ById($_GET["idBanco"]));
        exit();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
}
