<?php
session_start();
if (!isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "login.php";</script>';
} else {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include './layout/head.php'; ?>
    </head>

    <body class="app sidebar-mini">
        <!-- Navbar-->
        <?php include "./layout/header.php"; ?>
        <!-- Sidebar menu-->
        <?php include "./layout/menu.php"; ?>

        <!-- modal proceso venta -->
        <?php include('./layout/puntoventa/modalProcesoVenta.php'); ?>
        <!-- modal productos -->
        <?php include('./layout/puntoventa/modalProductos.php'); ?>
        <!-- modal movimiento caja -->
        <?php include('./layout/puntoventa/modalMovimientoCaja.php'); ?>
        <!-- modal movimiento caja -->
        <?php include('./layout/puntoventa/modalVentaEchas.php'); ?>
        <!-- modal movimiento caja -->
        <?php include('./layout/puntoventa/modalCotizacion.php'); ?>

        <main class="app-content">

            <div class="tile">

                <div class="overlay p-5" id="divOverlayPuntoVenta">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayPuntoVenta">Cargando información...</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h4 class="mr-3"> Punto de Venta</h4>
                    </div>
                </div>

                <div class="row">
                    <!-- columna 1 -->
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="card">

                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="bs-component" style="margin-bottom: 15px;">
                                            <div class="btn-group" role="group">
                                                <button id="btnProductos" class="btn btn-secondary" type="button" title="Productos">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/producto.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Productos(F2)
                                                        </div>
                                                    </div>
                                                </button>

                                                <button id="btnMovimientoCaja" class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/cash_movement.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Mov. Caja(F3)
                                                        </div>
                                                    </div>
                                                </button>

                                                <button id="btnLimpiar" class="btn btn-secondary" type="button" title="Limpiar Vista">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/escoba.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Limpiar(F4)
                                                        </div>
                                                    </div>
                                                </button>

                                                <button id="btnVentas" class="btn btn-secondary" type="button" title="Ventas Echas">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/view.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Ventas(F6)
                                                        </div>
                                                    </div>
                                                </button>

                                                <button id="btnCotizacion" class="btn btn-secondary" type="button" title="Cotización">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/cotizacion.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Cotización(F7)
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="form-control" id="btnCodigo" title="Codigo de Barras">
                                                    <i class="fa fa-barcode"></i> CTRL+D
                                                </span>
                                            </div>
                                            <input id="txtCodigoBarra" type="search" class="form-control" placeholder="Código de barras">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="form-control" id="btnCodigo" title="Codigo de Barras">
                                                    <image src="./images/moneda.png" width="22" />
                                                </span>
                                            </div>
                                            <select class="form-control" id="cbMoneda">
                                                <option value="">Moneda</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="table-header-background">
                                                    <tr role="row">
                                                        <th width="5%">Quitar</th>
                                                        <th width="15%">Cantidad</th>
                                                        <th width="30%">Descripción</th>
                                                        <th width="15%">Impuesto</th>
                                                        <th width="15%">Precio</th>
                                                        <!-- <th width="15%">Descuento</th> -->
                                                        <th width="20%">Importe</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbList">
                                                    <tr>
                                                        <td colspan="6" align="center">!No hay datos para mostrar¡</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- columna 2 -->
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="card">

                            <div class="card-header p-0">
                                <button id="btnCobrar" class="btn btn-success btn-block">
                                    <div class="row justify-content-center align-items-center p-2">
                                        <div class="col-md-6 col-sm-6 col-6 text-left">
                                            <span class="text-white h5">COBRAR (F1)</span>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6 text-right">
                                            <span class="text-white h3" id="lblTotal">M 0.00</span>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="form-control">
                                                    <image src="./images/recibo.png" width="22" />
                                                </span>
                                            </div>
                                            <select id="cbComprobante" class="form-control" title="Comprobante de venta">
                                                <option>Tipo de comprobante</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 pt-2">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <h5>Serie: <span id="lblSerie">-</span></h5>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <h5> N°: <span id="lblNumeracion">-</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tile border-0 p-0">

                                    <div class="overlay d-none p-5" id="divOverlayCliente">
                                        <div class="m-loader mr-4">
                                            <svg class="m-circular" viewBox="25 25 50 50">
                                                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                                            </svg>
                                        </div>
                                        <h4 class="l-text text-center text-white p-10" id="lblTextOverlayCliente">Cargando información...</h4>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="form-control">
                                                            <image src="./images/options.png" width="22" />
                                                        </span>
                                                    </div>
                                                    <select id="cbTipoDocumento" class="form-control" title="Comprobante de venta">
                                                        <option>Tipo de documento</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="form-control">
                                                            <image src="./images/search.png" width="22" />
                                                        </span>
                                                    </div>
                                                    <input id="txtNumero" type="text" class="form-control" placeholder="00000000" title="Número de documento">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-secondary" type="button" id="btnCliente">
                                                            <image src="./images/search_caja.png" width="18" height="18" />
                                                        </button>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-secondary" type="button" id="btnSunat">
                                                            <image src="./images/sunat_logo.png" width="18" height="18" />
                                                        </button>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-secondary" type="button" id="btnReniec">
                                                            <image src="./images/reniec.png" width="18" height="18" />
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="form-control">
                                                            <image src="./images/client.png" width="22" />
                                                        </span>
                                                    </div>
                                                    <input id="txtCliente" type="text" class="form-control" placeholder="Cliente" title="Información del cliente">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="form-control">
                                                            <image src="./images/phone.png" width="22" />
                                                        </span>
                                                    </div>
                                                    <input id="txtCelular" type="text" class="form-control" placeholder="N° de Celular" title="Número de celular">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="form-control">
                                                            <image src="./images/email.png" width="22" />
                                                        </span>
                                                    </div>
                                                    <input id="txtEmail" type="text" class="form-control" placeholder="Correo Electrónico" title="Correo Electrónico">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="form-control">
                                                            <image src="./images/directory.png" width="22" />
                                                        </span>
                                                    </div>
                                                    <input id="txtDireccion" type="text" class="form-control" placeholder="Dirección de Vivienda o Local" title="Dirección de Vivienda">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <table class="table border-0">
                                            <tbody>
                                                <tr>
                                                    <td width="50%" style="border:none;padding:5px 0;">IMPORTE BRUTO:</td>
                                                    <td width="50%" style="border:none;padding:0;text-align:right;" id="lblImporteBruto">M 0.00</td>
                                                </tr>
                                                <tr>
                                                    <td width="50%" style="border:none;padding:5px 0;">DESCUESTO TOTAL:</td>
                                                    <td width="50%" style="border:none;padding:0;text-align:right;" id="lblDescuentoBruto">M 0.00</td>
                                                </tr>
                                                <tr>
                                                    <td width="50%" style="border:none;padding:5px 0;">SUB IMPORTE:</td>
                                                    <td width="50%" style="border:none;padding:0;text-align:right;" id="lblSubImporteNeto">M 0.00</td>
                                                </tr>
                                                <tr>
                                                    <td width="50%" style="border:none;padding:5px 0;">IMPUESTO:</td>
                                                    <td width="50%" style="border:none;padding:0;text-align:right;" id="lblImpuestoNeto">M 0.00</td>
                                                </tr>
                                                <tr>
                                                    <td width="50%" style="border:none;padding:5px 0;">IMPORTE NETO:</td>
                                                    <td width="50%" style="border:none;padding:0;text-align:right;" id="lblImporteNeto">M 0.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </main>

        <?php include "./layout/footer.php"; ?>
        <script src="js/puntoventa/modalProcesoVenta.js"></script>
        <script src="js/puntoventa/modalProductos.js"></script>
        <script src="js/puntoventa/modalMovimientoCaja.js"></script>
        <script src="js/puntoventa/modalVentaEchas.js"></script>
        <script src="js/puntoventa/modalCotizacion.js"></script>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let modalProductos = new ModalProductos();
            let modalProcesoVenta = new ModalProcesoVenta();
            let modalMovimientoCaja = new ModalMovimientoCaja();
            let modalVentaEchas = new ModalVentaEchas();
            let modalCotizacion = new ModalCotizacion();

            let monedaSimbolo = "M";
            let importeBrutoTotal = 0;
            let descuentoBrutoTotal = 0;
            let subImporteNetoTotal = 0;
            let impuestoNetoTotal = 0;
            let importeNetoTotal = 0;

            let idCotizacion = "";

            let listaComprobantes = [];
            let listaProductos = [];

            let vueltoContado = 0;
            let estadoCobroContado = false;

            let vueltoAdelantado = 0;
            let estadoCobroAdelantado = false;

            let total_venta = 0;
            let state_view_pago = 0;

            let idEmpleado = "<?= $_SESSION['IdEmpleado'] ?>";

            window.addEventListener('keydown', function(event) {

                if (event.ctrlKey && event.key === 'd' || event.ctrlKey && event.key === 'D') {
                    $("#txtCodigoBarra").focus();
                    event.preventDefault();
                }
                if (event.key === 'F1' || event.key === 'f1') {
                    modalVenta();
                    event.preventDefault();
                }
                if (event.key === 'F2' || event.key === 'f2') {
                    modalProductos.openModalInit();
                    event.preventDefault();
                }
                if (event.key === 'F3' || event.key === 'f3') {
                    modalMovimientoCaja.openModalInit();
                    event.preventDefault();
                }
                if (event.key === 'F4' || event.key === 'f4') {
                    resetVenta();
                    event.preventDefault();
                }
                if (event.key === 'F6' || event.key === 'f6') {
                    modalVentaEchas.openModalInit();
                    event.preventDefault();
                }
                if (event.key === 'F7' || event.key === 'f7') {
                    modalCotizacion.openModalInit();
                    event.preventDefault();
                }
            });

            $(window).ready(function() {
                modalProductos.init();
                modalProcesoVenta.init();
                modalMovimientoCaja.init();
                modalVentaEchas.init();
                modalCotizacion.init();

                $("#txtNumero").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#txtCodigoBarra").keyup(function(event) {
                    if (event.keyCode == 13) {
                        if ($("#txtCodigoBarra").val().trim().length != 0) {
                            filterSuministro($("#txtCodigoBarra").val().trim());
                        }
                        event.preventDefault();
                    }
                });

                $("#cbComprobante").change(async function() {
                    if ($('#cbComprobante').children('option').length > 0 && $("#cbComprobante").val() != "") {
                        $("#divOverlayPuntoVenta").removeClass("d-none");
                        let serieNumeracion = await getSerieNumeracionEspecifico($('#cbComprobante').val());
                        if (serieNumeracion.estado == 1) {
                            $("#lblSerie").html(serieNumeracion.data[0]);
                            $("#lblNumeracion").html(serieNumeracion.data[1]);
                        }
                        $("#divOverlayPuntoVenta").addClass("d-none");
                    }
                });

                $("#txtNumero").keydown(function(event) {
                    if (event.keyCode === 13) {
                        if ($("#txtNumero").val().trim().length != 0) {
                            searchCliente($("#txtNumero").val().trim());
                        }
                        event.preventDefault();
                    }
                });

                $("#btnCliente").click(function() {
                    if ($("#txtNumero").val().trim().length != 0) {
                        searchCliente($("#txtNumero").val().trim());
                    }
                });

                $("#btnCliente").keypress(function(event) {
                    if (event.keyCode == 13) {
                        searchCliente($("#txtNumero").val().trim());
                        event.preventDefault();
                    }
                });

                $("#btnSunat").click(function() {
                    if ($("#txtNumero").val().trim().length == 11) {
                        searchSunat($("#txtNumero").val().trim());
                    }
                });

                $("#btnSunat").keypress(function(event) {
                    if (event.keyCode == 13) {
                        if ($("#txtNumero").val().trim().length == 11) {
                            searchSunat($("#txtNumero").val().trim());
                        }
                        event.preventDefault();
                    }
                });

                $("#btnReniec").click(function() {
                    if ($("#txtNumero").val().trim().length == 8) {
                        searchReniec($("#txtNumero").val().trim());
                    }
                });

                $("#btnReniec").keypress(function(event) {
                    if (event.keyCode == 13) {
                        if ($("#txtNumero").val().trim().length == 8) {
                            searchReniec($("#txtNumero").val().trim());
                        }
                        event.preventDefault();
                    }
                });

                $("#btnLimpiar").click(function(event) {
                    resetVenta();
                });

                $("#btnLimpiar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        resetVenta();
                        event.preventDefault();
                    }
                });
                resetVenta();
            });

            async function loadInit() {
                try {
                    $("#lblTextOverlayPuntoVenta").html("Cargando información...");
                    $("#cbMoneda").empty();
                    $("#cbComprobante").empty();
                    $("#cbTipoDocumento").empty();
                    $("#lblSerie").empty();
                    $("#lblNumeracion").empty();

                    let promiseFetchMoneda = tools.promiseFetchGet("../app/controller/MonedaController.php", {
                        "type": "getmonedacombobox"
                    });

                    let promiseFetchComprobante = tools.promiseFetchGet("../app/controller/TipoDocumentoController.php", {
                        "type": "getdocumentocomboboxventas"
                    });

                    let promiseFetchDocumento = tools.promiseFetchGet("../app/controller/DetalleController.php", {
                        "type": "detailid",
                        "value": "0003"
                    });

                    let promiseFetchCliente = tools.promiseFetchGet("../app/controller/EmpleadoController.php", {
                        "type": "predeterminate"
                    });

                    let promise = await Promise.all([promiseFetchMoneda, promiseFetchComprobante, promiseFetchDocumento, promiseFetchCliente]);
                    let result = await promise;

                    let moneda = result[0];

                    $("#cbMoneda").append('<option value="">- Seleccione -</option>')
                    for (let value of moneda) {
                        $("#cbMoneda").append('<option value="' + value.IdMoneda + '">' + value.Nombre + '</option>');
                    }

                    for (let value of moneda) {
                        if (value.Predeterminado == "1") {
                            $("#cbMoneda").val(value.IdMoneda);
                            monedaSimbolo = value.Simbolo;
                            break;
                        }
                    }

                    listaComprobantes = result[1];

                    for (let value of listaComprobantes) {
                        $("#cbComprobante").append('<option value="' + value.IdTipoDocumento + '">' + value.Nombre + '</option>');
                    }
                    for (let value of listaComprobantes) {
                        if (value.Predeterminado == "1") {
                            $("#cbComprobante").val(value.IdTipoDocumento);
                            break;
                        }
                    }
                    if ($('#cbComprobante').children('option').length > 0 && $("#cbComprobante").val() != "") {
                        let serieNumeracion = await getSerieNumeracionEspecifico($('#cbComprobante').val());
                        if (serieNumeracion.estado == 1) {
                            $("#lblSerie").html(serieNumeracion.data[0]);
                            $("#lblNumeracion").html(serieNumeracion.data[1]);
                        }
                    }

                    let documento = result[2];
                    for (let value of documento) {
                        $("#cbTipoDocumento").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                    }

                    let cliente = result[3];
                    if (cliente != null) {
                        $("#txtNumero").val(cliente.NumeroDocumento);
                        $("#txtCliente").val(cliente.Informacion);
                        $("#txtCelular").val(cliente.Celular);
                        $("#txtEmail").val(cliente.Email);
                        $("#txtDireccion").val(cliente.Direccion);

                        for (let value of documento) {
                            if (value.IdDetalle == cliente.TipoDocumento) {
                                $("#cbTipoDocumento").val(value.IdDetalle);
                                break;
                            }
                        }
                    }

                    $("#lblTotal").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));

                    $("#lblImporteBruto").html(monedaSimbolo + " " + tools.formatMoney(importeBruto));
                    $("#lblDescuentoBruto").html(monedaSimbolo + " " + tools.formatMoney(descuentoBruto));
                    $("#lblSubImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(subImporteNeto));
                    $("#lblImpuestoNeto").html(monedaSimbolo + " " + tools.formatMoney(impuestoNeto));
                    $("#lblImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));

                    $("#divOverlayPuntoVenta").addClass("d-none");
                } catch (error) {
                    $("#lblTextOverlayPuntoVenta").html(error.message);
                }
            }

            function validateDatelleVenta(idSuministro) {
                let ret = false;
                for (let i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i].idSuministro == idSuministro) {
                        ret = true;
                        break;
                    }
                }
                return ret;
            }

            function removeDetalleProducto(idSuministro) {
                for (let i = 0; i < listaProductos.length; i++) {
                    if (listaProductos[i].idSuministro == idSuministro) {
                        listaProductos.splice(i, 1);
                        i--;
                        break;
                    }
                }
                renderTableProductos();
            }

            function renderTableProductos() {
                $("#tbList").empty();
                importeBrutoTotal = 0;
                descuentoBrutoTotal = 0;
                subImporteNetoTotal = 0;
                impuestoNetoTotal = 0;
                importeNetoTotal = 0;

                if (listaProductos.length == 0) {
                    $("#tbList").append(`<tr> 
                        <td colspan = "6" align = "center"> !No hay datos para mostrar¡ </td> 
                    </tr>`);
                } else {
                    for (let value of listaProductos) {
                        $("#tbList").append('<tr role="row" class="odd">' +
                            '<td class="text-center"><button class="btn btn-danger" onclick="removeDetalleProducto(\'' + value.idSuministro + '\')"><i class="fa fa-trash"></i></button></td>' +
                            '<td><input readonly id="c-' + value.idSuministro + '" type="text" class="form-control" placeholder="0" onkeypress="onKeyPressTable(this)" onkeydown="onKeyDownTableCantidad(this,\'' + value.idSuministro + '\')" value="' + tools.formatMoney(value.cantidad) + '" onfocusout="onFocusOutTable()" ondblclick="onClickTable(\'' + "c-" + value.idSuministro + '\')" autocomplete="off" /></td>' +
                            '<td>' + value.clave + '<br>' + value.nombreMarca + '</td>' +
                            '<td class="text-center">' + value.impuestoNombre + '</td>' +
                            '<td><input readonly id="p-' + value.idSuministro + '" type="text" class="form-control" placeholder="0" onkeypress="onKeyPressTable(this)"  onkeydown="onKeyDownTablePrecio(this,\'' + value.idSuministro + '\')" value="' + tools.formatMoney(value.precioVentaGeneral) + '" onfocusout="onFocusOutTable()" ondblclick="onClickTable(\'' + "p-" + value.idSuministro + '\')" autocomplete="off" /></td>' +
                            '<td class="text-center"><b class="h4">' + monedaSimbolo + " " + tools.formatMoney(value.cantidad * (value.precioVentaGeneral - value.descuento)) + '</b></td>' +
                            '</tr>');

                        let importeBruto = value.precioVentaGeneral * value.cantidad;
                        let descuento = value.descuento;
                        let subImporteBruto = importeBruto - descuento;
                        let subImporteNeto = tools.calculateTaxBruto(value.impuestoValor, subImporteBruto);
                        let impuesto = tools.calculateTax(value.impuestoValor, subImporteNeto);
                        let importeNeto = subImporteNeto + impuesto;

                        importeBrutoTotal += importeBruto;
                        descuentoBrutoTotal += descuento;
                        subImporteNetoTotal += subImporteNeto;
                        impuestoNetoTotal += impuesto;
                        importeNetoTotal += importeNeto;
                    }
                }

                $("#lblTotal").html(monedaSimbolo + " " + tools.formatMoney(importeNetoTotal));
                $("#lblImporteBruto").html(monedaSimbolo + " " + tools.formatMoney(importeBrutoTotal));
                $("#lblDescuentoBruto").html(monedaSimbolo + " " + tools.formatMoney(descuentoBrutoTotal));
                $("#lblSubImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(subImporteNetoTotal));
                $("#lblImpuestoNeto").html(monedaSimbolo + " " + tools.formatMoney(impuestoNetoTotal));
                $("#lblImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(importeNetoTotal));
            }

            onKeyPressTable = function(value) {
                var key = window.Event ? event.which : event.keyCode;
                var c = String.fromCharCode(key);
                if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                    event.preventDefault();
                }
                if (c === '.' && value.value.includes(".")) {
                    event.preventDefault();
                }
            }

            onKeyDownTableCantidad = function(value, idSuministro) {
                if (event.keyCode == 13) {
                    for (let i = 0; i < listaProductos.length; i++) {
                        if (listaProductos[i].idSuministro == idSuministro) {
                            let suministro = listaProductos[i];
                            suministro.cantidad = tools.isNumeric(value.value) ? value.value <= 0 ? 1 : parseFloat(value.value) : 1;
                            break;
                        }
                    }
                    renderTableProductos();
                }
            }

            onKeyDownTablePrecio = function(value, idSuministro) {
                if (event.keyCode == 13) {
                    for (let i = 0; i < listaProductos.length; i++) {
                        if (listaProductos[i].idSuministro == idSuministro) {
                            let suministro = listaProductos[i];

                            let monto =
                                tools.isNumeric(value.value) ?
                                parseFloat(value.value) <= 0 ?
                                1 :
                                parseFloat(value.value) :
                                1;

                            suministro.precioVentaGeneral = monto;
                            break;
                        }
                    }
                    renderTableProductos();
                }
            }

            onFocusOutTable = function() {
                renderTableProductos();
            }

            onClickTable = function(idSuministro) {
                $("#" + idSuministro).removeAttr("readonly");
            }

            function getSerieNumeracionEspecifico(idTipoDocumento) {
                return tools.promiseFetchGet("../app/controller/ComprobanteController.php", {
                    "type": "getserienumeracion",
                    "idTipoDocumento": idTipoDocumento
                });
            }

            function searchCliente(numero) {
                tools.promiseFetchGet("../app/controller/ClienteController.php", {
                    "type": "GetSearchClienteNumeroDocumento",
                    "opcion": "2",
                    "search": numero
                }, function() {
                    $("#divOverlayCliente").removeClass("d-none");
                }).then(function(result) {
                    if (result.estado == 1) {
                        $("#txtCliente").val(result.cliente.Informacion);
                        $("#txtCelular").val(result.cliente.Celular);
                        $("#txtEmail").val(result.cliente.Email);
                        $("#txtDireccion").val(result.cliente.Direccion);
                    }
                    $("#divOverlayCliente").addClass("d-none");
                }).catch(function(error) {
                    $("#divOverlayCliente").addClass("d-none");
                });
            }

            function searchReniec(numero) {
                tools.promiseFetchGet("https://dniruc.apisperu.com/api/v1/dni/" + numero + "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFsZXhhbmRlcl9keF8xMEBob3RtYWlsLmNvbSJ9.6TLycBwcRyW1d-f_hhCoWK1yOWG_HJvXo8b-EoS5MhE", {}, function() {
                    $("#divOverlayCliente").removeClass("d-none");
                }).then(function(result) {
                    $("#txtCliente").val(result.apellidoPaterno + " " + result.apellidoMaterno + " " + result.nombres);
                    $("#txtCelular").val('');
                    $("#txtEmail").val('');
                    $("#txtDireccion").val('');
                    $("#divOverlayCliente").addClass("d-none");
                }).catch(function(error) {
                    $("#divOverlayCliente").addClass("d-none");
                });
            }

            function searchSunat(numero) {
                tools.promiseFetchGet("https://dniruc.apisperu.com/api/v1/ruc/" + numero + "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImFsZXhhbmRlcl9keF8xMEBob3RtYWlsLmNvbSJ9.6TLycBwcRyW1d-f_hhCoWK1yOWG_HJvXo8b-EoS5MhE", {}, function() {
                    $("#divOverlayCliente").removeClass("d-none");
                }).then(function(result) {
                    $("#txtCliente").val(result.razonSocial);
                    $("#txtCelular").val('');
                    $("#txtEmail").val('');
                    $("#txtDireccion").val(result.direccion == null ? '' : result.direccion);
                    $("#divOverlayCliente").addClass("d-none");
                }).catch(function(error) {
                    $("#divOverlayCliente").addClass("d-none");
                });
            }

            async function filterSuministro(search) {
                try {
                    let result = await tools.promiseFetchGet("../app/controller/SuministroController.php", {
                        "type": "fillSuministro",
                        "search": search
                    }, function() {
                        $("#divOverlayPuntoVenta").removeClass("d-none");
                    });

                    if (result == false) {
                        $("#divOverlayPuntoVenta").addClass("d-none");
                        $("#txtCodigoBarra").val('');
                        $("#txtCodigoBarra").focus();
                    } else {
                        if (!validateDatelleVenta(result.IdSuministro)) {
                            let suministro = result;
                            let cantidad = 1;
                            let precio = parseFloat(suministro.PrecioVentaGeneral);

                            listaProductos.push({
                                "idSuministro": suministro.IdSuministro,
                                "clave": suministro.Clave,
                                "nombreMarca": suministro.NombreMarca,
                                "cantidad": cantidad,
                                "costoCompra": suministro.PrecioCompra,
                                "bonificacion": 0,
                                "unidadCompra": suministro.UnidadCompra,
                                "unidadCompraName": suministro.UnidadCompraName,

                                "descuento": 0,
                                "descuentoCalculado": 0,
                                "descuentoSumado": 0,

                                "precioVentaGeneral": precio,
                                "precioVentaGeneralUnico": precio,
                                "precioVentaGeneralReal": precio,

                                "impuestoOperacion": suministro.Operacion,
                                "idImpuesto": suministro.Impuesto,
                                "impuestoNombre": suministro.ImpuestoNombre,
                                "impuestoValor": parseFloat(suministro.Valor),

                                "inventario": suministro.Inventario,
                                "unidadVenta": suministro.UnidadVenta,
                                "valorInventario": suministro.ValorInventario
                            });
                        } else {
                            for (let i = 0; i < listaProductos.length; i++) {
                                if (listaProductos[i].idSuministro == result.IdSuministro) {
                                    let currenteObject = listaProductos[i];

                                    currenteObject.cantidad = parseFloat(currenteObject.cantidad) + 1;
                                    break;
                                }
                            }
                        }
                        renderTableProductos();
                        $("#divOverlayPuntoVenta").addClass("d-none");
                        $("#txtCodigoBarra").val('');
                        $("#txtCodigoBarra").focus();
                    }

                } catch (error) {
                    $("#divOverlayPuntoVenta").addClass("d-none");
                    $("#txtCodigoBarra").val('');
                    $("#txtCodigoBarra").focus();
                }
            }

            function validateNumeroCampo() {
                let valid = {
                    isCampo: false,
                    numero: 0
                };
                for (let value of listaComprobantes) {
                    if ($('#cbComprobante').val() == value.IdTipoDocumento) {
                        if (value.Campo == "1" && $("#txtNumero").val().trim().length != value.NumeroCampo) {
                            valid.isCampo = true;
                            valid.numero = value.NumeroCampo;
                        }
                        break;
                    }
                }
                return valid;
            }

            function modalVenta() {
                if (tools.validateComboBox($('#cbMoneda'))) {
                    tools.AlertWarning("", "Seleccione la moneda ha usar.");
                    $("#cbMoneda").focus();
                } else if (tools.validateComboBox($('#cbComprobante'))) {
                    tools.AlertWarning("", "Seleccione el tipo de comprobante.");
                    $("#cbComprobante").focus();
                } else if (tools.validateComboBox($('#cbTipoDocumento'))) {
                    tools.AlertWarning("", "Seleccione el tipo de documento del cliente.");
                    $("#cbTipoDocumento").focus();
                } else if (!tools.isNumeric($('#txtNumero').val().trim())) {
                    tools.AlertWarning("", "Ingrese el número del documento del cliente.");
                    $("#txtNumero").focus();
                } else if (validateNumeroCampo().isCampo) {
                    tools.AlertWarning("", "El número de documento tiene que tener " + validateNumeroCampo().numero + " caracteres.");
                    $("#txtNumero").focus();
                } else if ($("#txtCliente").val().trim().length == 0) {
                    tools.AlertWarning("", "Ingrese los datos del cliente.");
                    $("#txtCliente").focus();
                } else if (listaProductos.length !== 0) {
                    $("#modalProcesoVenta").modal("show");
                    $("#lblTotalModal").html(monedaSimbolo + " " + tools.formatMoney(importeNetoTotal));

                    $("#lblVueltoNombre").html('Su cambio:');
                    $("#lblVuelto").html(monedaSimbolo + ' 0.00');

                    $("#lblVueltoAdelantoNombre").html('Su cambio:');
                    $("#lblVueltoAdelanto").html(monedaSimbolo + ' 0.00');

                    total_venta = parseFloat(tools.formatMoney(importeNetoTotal));
                    $("#txtDeposito").val(tools.formatMoney(total_venta));
                    $("#txtDepositoAdelantado").val(tools.formatMoney(total_venta));
                } else {
                    tools.AlertWarning("", "No hay productos en la lista para continuar.");
                }
            }

            function crudVenta() {
                switch (state_view_pago) {
                    case 0:
                        if (!estadoCobroContado && !$("#cbDeposito").is(":checked")) {
                            $("#txtEfectivo").focus();
                            tools.AlertWarning("", "El monto es menor que el total.");
                        } else {
                            let tipo = 1;
                            let estado = 1;
                            let vuelto = vueltoContado;

                            let efectivo = 0;
                            let tarjeta = 0;
                            let deposito = 0;
                            let numeroOperacion = "";

                            if ($("#cbDeposito").is(":checked")) {
                                if (!tools.isNumeric($("#txtDeposito").val())) {
                                    tools.AlertWarning("", "El monto del deposito tiene que ser numérico.");
                                    $("#txtDeposito").focus();
                                    return;
                                } else if ($("#txtNumOperacion").val().trim() === "") {
                                    tools.AlertWarning("", "Ingrese el número de Operación");
                                    $("#txtNumOperacion").requestFocus();
                                    return;
                                } else {
                                    deposito = parseFloat($("#txtDeposito").val());
                                    numeroOperacion = $("#txtNumOperacion").val().trim();
                                }
                            } else {
                                if (tools.isNumeric($("#txtEfectivo").val()) && parseFloat($("#txtEfectivo").val()) > 0) {
                                    efectivo = parseFloat($("#txtEfectivo").val());
                                }

                                if (tools.isNumeric($("#txtTarjeta").val()) && parseFloat($("#txtTarjeta").val()) > 0) {
                                    tarjeta = parseFloat($("#txtTarjeta").val());
                                }

                                if (tools.isNumeric($("#txtEfectivo").val()) && tools.isNumeric($("#txtTarjeta").val())) {
                                    if ((parseFloat($("#txtEfectivo").val())) >= total_venta) {
                                        tools.AlertWarning("", "Los valores ingresados no son correctos!!");
                                        return;
                                    }
                                    let efectivo = parseFloat($("#txtEfectivo").val());
                                    let tarjeta = parseFloat($("#txtTarjeta").val());
                                    if ((efectivo + tarjeta) != total_venta) {
                                        tools.AlertWarning("", "El monto a pagar no debe ser mayor al total!!");
                                        return;
                                    }
                                }

                                if (!tools.isNumeric($("#txtEfectivo").val()) && tools.isNumeric($("#txtTarjeta").val())) {
                                    if ((parseFloat($("#txtTarjeta").val())) > total_venta) {
                                        tools.AlertWarning("", "El pago con tarjeta no debe ser mayor al total!!");
                                        return;
                                    }
                                }
                            }

                            completeVenta(tipo, estado, efectivo, vuelto, tarjeta, deposito, numeroOperacion);
                        }
                        break;

                    case 1:
                        if (!tools.validateDate($("#txtFechaVencimiento").val())) {
                            tools.AlertWarning("", "Ingrese la fecha de vencimiento.");
                            $("#txtFechaVencimiento").focus();
                        } else {
                            let tipo = 2;
                            let estado = 2;
                            let vuelto = 0;

                            let efectivo = 0;
                            let tarjeta = 0;
                            let deposito = 0;
                            let numeroOperacion = "";

                            completeVenta(tipo, estado, efectivo, vuelto, tarjeta, deposito, numeroOperacion);
                        }
                        break;

                    case 2:
                        if (!estadoCobroAdelantado && !$("#cbDepositoAdelantado").is(":checked")) {
                            tools.AlertWarning("", "El monto es menor que el total.");
                            $("#txtEfectivoAdelanto").focus();
                        } else {
                            let tipo = 1;
                            let estado = 4;
                            let vuelto = vueltoAdelantado;

                            let efectivo = 0;
                            let tarjeta = 0;
                            let deposito = 0;
                            let numeroOperacion = "";

                            if ($("#cbDepositoAdelantado").is(":checked")) {
                                if (!tools.isNumeric($("#txtDepositoAdelantado").val())) {
                                    tools.AlertWarning("", "El monto del deposito tiene que ser numérico.");
                                    $("#txtDepositoAdelantado").focus();
                                    return;
                                } else if ($("#txtNumOperacionAdelantado").val().trim() === "") {
                                    tools.AlertWarning("", "Ingrese el número de Operación");
                                    $("#txtNumOperacionAdelantado").requestFocus();
                                    return;
                                } else {
                                    deposito = parseFloat($("#txtDepositoAdelantado").val());
                                    numeroOperacion = $("#txtNumOperacionAdelantado").val().trim();
                                }
                            } else {
                                if (tools.isNumeric($("#txtEfectivoAdelanto").val()) && parseFloat($("#txtEfectivoAdelanto").val()) > 0) {
                                    efectivo = parseFloat($("#txtEfectivoAdelanto").val());
                                }

                                if (tools.isNumeric($("#txtTarjetaAdelanto").val()) && parseFloat($("#txtTarjetaAdelanto").val()) > 0) {
                                    tarjeta = parseFloat($("#txtTarjetaAdelanto").val());
                                }

                                if (tools.isNumeric($("#txtEfectivoAdelanto").val()) && tools.isNumeric($("#txtTarjetaAdelanto").val())) {
                                    if ((parseFloat($("#txtEfectivoAdelanto").val())) >= total_venta) {
                                        tools.AlertWarning("", "Los valores ingresados no son correctos!!");
                                        return;
                                    }
                                    let efectivo = parseFloat($("#txtEfectivoAdelanto").val());
                                    let tarjeta = parseFloat($("#txtTarjetaAdelanto").val());
                                    if ((efectivo + tarjeta) != total_venta) {
                                        tools.AlertWarning("", "El monto a pagar no debe ser mayor al total!!");
                                        return;
                                    }
                                }

                                if (!tools.isNumeric($("#txtEfectivoAdelanto").val()) && tools.isNumeric($("#txtTarjetaAdelanto").val())) {
                                    if ((parseFloat($("#txtTarjetaAdelanto").val())) > total_venta) {
                                        tools.AlertWarning("", "El pago con tarjeta no debe ser mayor al total!!");
                                        return;
                                    }
                                }
                            }

                            completeVenta(tipo, estado, efectivo, vuelto, tarjeta, deposito, numeroOperacion);
                        }
                        break;
                }
            }

            function completeVenta(tipo, estado, efectivo, vuelto, tarjeta, deposito, numeroOperacion) {
                tools.ModalDialog("Venta", '¿Está seguro de continuar?', async function(value) {
                    if (value == true) {
                        try {
                            let result = await tools.promiseFetchPost("../app/controller/VentaController.php", {
                                "type": "crudventa",
                                "TipoDocumento": $("#cbTipoDocumento").val(),
                                "NumeroDocumento": $("#txtNumero").val().trim(),
                                "Informacion": $("#txtCliente").val().trim(),
                                "Telefono": "",
                                "Celular": $("#txtCelular").val().trim(),
                                "Email": $("#txtEmail").val().trim(),
                                "Direccion": $("#txtDireccion").val().trim(),
                                "Representante": "",
                                "Estado": 1,
                                "Predeterminado": false,
                                "Sistema": false,
                                "IdComprobante": $("#cbComprobante").val(),
                                "IdEmpleado": idEmpleado,
                                "IdMoneda": $("#cbMoneda").val(),
                                "IdCotizacion": idCotizacion,
                                "FechaVencimiento": tipo == 1 ? tools.getCurrentDate() : $("#txtFechaVencimiento").val(),
                                "HoraVencimiento": tools.getCurrentTime(),
                                "Total": importeNetoTotal,
                                "Tipo": tipo,
                                "Estado": estado,
                                "Efectivo": efectivo,
                                "Vuelto": vuelto,
                                "Tarjeta": tarjeta,
                                "Deposito": deposito,
                                "NumeroOperacion": numeroOperacion,
                                "Lista": listaProductos
                            }, function() {
                                modalProcesoVenta.resetProcesoVenta();
                                resetVenta();
                                tools.ModalAlertInfo("Venta", "Se está procesando la información.");
                            });
                            tools.ModalAlertSuccess("Venta", result);
                        } catch (error) {
                            tools.ErrorMessageServer("Venta", error);
                        }
                    }
                });
            }

            function resetVenta() {
                $("#divOverlayPuntoVenta").removeClass("d-none");
                $("#txtCodigoBarra").focus();

                importeBruto = 0;
                descuentoBruto = 0;
                subImporteNeto = 0;
                impuestoNeto = 0;
                importeNeto = 0;

                idCotizacion = "";

                listaComprobantes = [];
                listaProductos = [];
                renderTableProductos();
                state_view_pago = 0;
                vueltoContado = 0;
                total_venta = 0;
                estadoCobroContado = false;

                loadInit();
            }
        </script>
    </body>

    </html>

<?php

}
