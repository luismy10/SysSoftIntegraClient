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

        <!-- modal lista cliente -->
        <?php include('./layout/puntoventa/modalListaCliente.php'); ?>

        <!-- modal proceso venta -->
        <?php include('./layout/puntoventa/modalProcesoVenta.php'); ?>
        <!-- modal productos -->
        <?php include('./layout/puntoventa/modalProductos.php'); ?>
        <!-- modal lista precio -->
        <?php include('./layout/puntoventa/modalListaPrecios.php'); ?>
        <!-- modal cantidad -->
        <?php include('./layout/puntoventa/modalCantidad.php'); ?>
        <!-- modal precio -->
        <?php include('./layout/puntoventa/modalPrecio.php'); ?>
        <!-- modal movimiento caja -->
        <?php include('./layout/puntoventa/modalMovimientoCaja.php'); ?>


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
                        <!-- <div class="form-group d-flex"> -->
                        <h4 class="mr-3"> Punto de Venta</h4>
                        <!-- <button type="button" class="btn btn-warning rounded"><i class="fa fa-plus"></i> Agregar Venta</button> -->
                        <!-- </div> -->
                    </div>
                </div>

                <!-- <div class="bs-component"> -->
                <!-- <ul class="nav nav-tabs" id="ulNavTabs">
                        <li class="nav-item" id="liVenta1"><a class="nav-link active" data-toggle="tab" href="#Venta1">Venta 1 <i class="fa fa-close" onclick="closeTab('Venta1')"></i></a></li>
                    </ul> -->
                <!-- <div class="tab-content" id="divTabContent"> -->

                <!-- <div class="tab-pane fade active show pt-1" id="Venta1"> -->

                <div class="row">
                    <!-- columna 1 -->
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                        <div class="card">

                            <div class="card-header">
                                <div class="row mb-2">
                                    <div class="col-md-12">

                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <button id="btnProductos" class="btn btn-secondary" type="button" title="Lista de Productos">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/producto.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Productos
                                                        </div>
                                                    </div>
                                                </button>

                                                <button id="btnListaPrecios" class="btn btn-secondary" type="button" title="Lista de Precios">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/prices.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Precios
                                                        </div>
                                                    </div>
                                                </button>

                                                <button id="btnCantidad" class="btn btn-secondary" type="button" title="Cambiar cantidades">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/plus.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Cantidad
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
                                                            Mov. Caja
                                                        </div>
                                                    </div>
                                                </button>

                                                <button class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/escoba.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Limpiar
                                                        </div>
                                                    </div>
                                                </button>

                                                <button class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/view.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Ventas
                                                        </div>
                                                    </div>
                                                </button>

                                                <button class="btn btn-secondary" type="button" title="Movimiento de caja">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <image src="./images/cotizacion.png" width="22" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            Cotización
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
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6 text-left">
                                            <h5 class="text-white">COBRAR</h5>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6 text-right">
                                            <h5 class="text-white" id="lblTotal">M 0.00</h5>
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

                                    <div class="col-md-12 col-sm-12 col-12 pt-2">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <h6>Serie: <span id="lblSerie">-</span></h6>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <h6> N°: <span id="lblNumeracion">-</span></h6>
                                            </div>
                                        </div>
                                    </div>

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
                                                    <button class="btn btn-secondary" type="button" title="Cliente">
                                                        <image src="./images/search_caja.png" width="18" height="18" />
                                                    </button>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="button" title="Reniec">
                                                        <image src="./images/sunat_logo.png" width="18" height="18" />
                                                    </button>
                                                </div>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary" type="button" title="Sunat">
                                                        <image src="./images/reniec.png" width="18" height="18" />
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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

                <!-- </div> -->
                <!-- </div> -->
                <!-- </div> -->
            </div>
            </div>
        </main>

        <?php include "./layout/footer.php"; ?>
        <script src="js/puntoventa/modalListaCliente.js"></script>
        <script src="js/puntoventa/modalProcesoVenta.js"></script>

        <script src="js/puntoventa/modalProductos.js"></script>
        <script src="js/puntoventa/modalListaPrecios.js"></script>
        <script src="js/puntoventa/modalCantidad.js"></script>
        <script src="js/puntoventa/modalPrecio.js"></script>
        <script src="js/puntoventa/modalMovimientoCaja.js"></script>

        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let modalProductos = new ModalProductos();
            let modalListaCliente = new ModalListaCliente();
            let modalProcesoVenta = new ModalProcesoVenta();
            let modalCantidad = new ModalCantidad();
            let modalPrecio = new ModalPrecio();
            let modalMovimientoCaja = new ModalMovimientoCaja();
            let modalListaPrecios = new ModalListaPrecios();

            let monedaSimbolo = "M";
            let importeBruto = 0;
            let descuentoBruto = 0;
            let subImporteNeto = 0;
            let impuestoNeto = 0;
            let importeNeto = 0;

            let idCliente = "";

            let listaProductos = [];

            $(document).ready(function() {

                modalProductos.init();
                modalListaCliente.init();
                modalProcesoVenta.init();
                modalCantidad.init();
                modalPrecio.init();
                modalMovimientoCaja.init();
                modalListaPrecios.init();

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

                    let promiseFetchMoneda = new Promise(function(resolve, reject) {
                        $.ajax({
                            url: "../app/controller/MonedaController.php",
                            method: "GET",
                            data: {
                                "type": "getmonedacombobox"
                            },
                            success: function(result) {
                                resolve(result);
                            },
                            error: function(error) {
                                reject(error);
                            }
                        });
                    });

                    let promiseFetchComprobante = new Promise(function(resolve, reject) {
                        $.ajax({
                            url: "../app/controller/TipoDocumentoController.php",
                            method: "GET",
                            data: {
                                "type": "getdocumentocomboboxventas"
                            },
                            success: function(result) {
                                resolve(result);
                            },
                            error: function(error) {
                                reject(error);
                            }
                        });
                    });

                    let promiseFetchDocumento = new Promise(function(resolve, reject) {
                        $.ajax({
                            url: "../app/controller/DetalleController.php",
                            method: "GET",
                            data: {
                                "type": "detailid",
                                "value": "0003"
                            },
                            success: function(result) {
                                resolve(result);
                            },
                            error: function(error) {
                                reject(error);
                            }
                        });
                    });

                    let promiseFetchCliente = new Promise(function(resolve, reject) {
                        $.ajax({
                            url: "../app/controller/EmpleadoController.php",
                            method: "GET",
                            data: {
                                "type": "predeterminate"
                            },
                            success: function(result) {
                                resolve(result);
                            },
                            error: function(error) {
                                reject(error);
                            }
                        });
                    });

                    let promise = await Promise.all([promiseFetchMoneda, promiseFetchComprobante, promiseFetchDocumento, promiseFetchCliente]);
                    let result = await promise;

                    let moneda = result[0];
                    if (moneda.estado === 1) {
                        for (let value of moneda.data) {
                            $("#cbMoneda").append('<option value="' + value.IdMoneda + '">' + value.Nombre + '</option>');
                        }
                        for (let value of moneda.data) {
                            if (value.Predeterminado == "1") {
                                $("#cbMoneda").val(value.IdMoneda);
                                monedaSimbolo = value.Simbolo;
                                break;
                            }
                        }
                    } else {
                        throw new Error("Error en obtener los datos de moneda, intentar nuevamente. Recargue la pantalla.");
                    }

                    let comprobante = result[1];
                    if (comprobante.estado === 1) {
                        for (let value of comprobante.data) {
                            $("#cbComprobante").append('<option value="' + value.IdTipoDocumento + '">' + value.Nombre + '</option>');
                        }
                        for (let value of comprobante.data) {
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
                    } else {
                        throw new Error("Error en obtener los datos del comprobante, intentar nuevamente. Recargue la pantalla.");
                    }

                    let documento = result[2];
                    if (documento.estado === 1) {
                        for (let value of documento.data) {
                            $("#cbTipoDocumento").append('<option value="' + value.IdDetalle + '">' + value.Nombre + '</option>');
                        }
                    } else {
                        throw new Error("Error en obtener los datos del documento, intentar nuevamente. Recargue la pantalla.");
                    }

                    let cliente = result[3];
                    if (cliente.estado === 1) {
                        idCliente = cliente.cliente.IdCliente;
                        $("#txtNumero").val(cliente.cliente.NumeroDocumento);
                        $("#txtCliente").val(cliente.cliente.Informacion);
                        $("#txtCelular").val(cliente.cliente.Celular);
                        $("#txtEmail").val(cliente.cliente.Email);
                        $("#txtDireccion").val(cliente.cliente.Direccion);

                        for (let value of documento.data) {
                            if (value.IdDetalle == cliente.cliente.TipoDocumento) {
                                $("#cbTipoDocumento").val(value.IdDetalle);
                                break;
                            }
                        }
                    }

                    $("#lblTotal").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));
                    $("#lblImporteBruto").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));
                    $("#lblDescuentoBruto").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));
                    $("#lblSubImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));
                    $("#lblImpuestoNeto").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));
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
                importeBruto = 0;
                descuentoBruto = 0;
                subImporteNeto = 0;
                impuestoNeto = 0;
                importeNeto = 0;

                for (let value of listaProductos) {
                    $("#tbList").append('<tr role="row" class="odd">' +
                        '<td class="text-center"><button class="btn btn-danger" onclick="removeDetalleProducto(\'' + value.idSuministro + '\')"><i class="fa fa-trash"></i></button></td>' +
                        '<td><input readonly id="c-' + value.idSuministro + '" type="text" class="form-control" placeholder="0" onkeypress="onKeyPressTable(this)" onkeydown="onKeyDownTableCantidad(this,\'' + value.idSuministro + '\')" value="' + tools.formatMoney(value.cantidad) + '" onfocusout="onFocusOutTable()" ondblclick="onClickTable(\'' + "c-" + value.idSuministro + '\')" autocomplete="off" /></td>' +
                        '<td>' + value.clave + '<br>' + value.nombreMarca + '</td>' +
                        '<td class="text-center">' + value.impuestoNombre + '</td>' +
                        '<td><input readonly id="p-' + value.idSuministro + '" type="text" class="form-control" placeholder="0" onkeypress="onKeyPressTable(this)"  onkeydown="onKeyDownTablePrecio(this,\'' + value.idSuministro + '\')" value="' + tools.formatMoney(value.precioVentaGeneral) + '" onfocusout="onFocusOutTable()" ondblclick="onClickTable(\'' + "p-" + value.idSuministro + '\')" autocomplete="off" /></td>' +
                        '<td class="text-center">' + tools.formatMoney(value.cantidad * value.precioVentaGeneral) + '</td>' +
                        '</tr>');

                    importeBruto += value.importeBruto;
                    descuentoBruto += value.descuentoSumado;
                    subImporteNeto += value.subImporteNeto;
                    impuestoNeto += value.impuestoSumado;
                }
                importeNeto = subImporteNeto + impuestoNeto;

                $("#lblTotal").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));
                $("#lblImporteBruto").html(monedaSimbolo + " " + tools.formatMoney(importeBruto));
                $("#lblDescuentoBruto").html(monedaSimbolo + " " + tools.formatMoney(descuentoBruto));
                $("#lblSubImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(subImporteNeto));
                $("#lblImpuestoNeto").html(monedaSimbolo + " " + tools.formatMoney(impuestoNeto));
                $("#lblImporteNeto").html(monedaSimbolo + " " + tools.formatMoney(importeNeto));
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
                            suministro.cantidad = tools.isNumeric(value.value) ? value.value <= 0 ? 1 : value.value : 1;

                            let porcentajeRestante = suministro.precioVentaGeneralUnico * (suministro.descuento / 100.00);
                            suministro.descuentoCalculado = porcentajeRestante;
                            suministro.descuentoSumado = porcentajeRestante * suministro.cantidad;

                            let impuesto = tools.calculateTax(suministro.impuestoValor, suministro.precioVentaGeneralReal);
                            suministro.impuestoSumado = suministro.cantidad * impuesto;

                            suministro.importeBruto = suministro.cantidad * suministro.precioVentaGeneralUnico;
                            suministro.subImporteNeto = suministro.cantidad * suministro.precioVentaGeneralReal;
                            suministro.importeNeto = suministro.cantidad * suministro.precioVentaGeneralReal;
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

                            let monto = tools.isNumeric(value.value) ? value.value <= 0 ? 1 : value.value : 1;

                            let valor_sin_impuesto = monto / ((suministro.impuestoValor / 100.00) + 1);
                            let descuento = suministro.descuento;
                            let porcentajeRestante = valor_sin_impuesto * (descuento / 100.00);
                            let preciocalculado = valor_sin_impuesto - porcentajeRestante;

                            suministro.descuento = descuento;
                            suministro.descuentoCalculado = porcentajeRestante;
                            suministro.descuentoSumado = porcentajeRestante * suministro.cantidad;

                            suministro.precioVentaGeneralUnico = valor_sin_impuesto;
                            suministro.precioVentaGeneralReal = preciocalculado;

                            let impuesto = tools.calculateTax(suministro.impuestoValor, suministro.precioVentaGeneralReal);
                            suministro.impuestoSumado = suministro.cantidad * impuesto;
                            suministro.precioVentaGeneral = suministro.precioVentaGeneralReal + impuesto;

                            suministro.importeBruto = suministro.cantidad * suministro.precioVentaGeneralUnico;
                            suministro.subImporteNeto = suministro.cantidad * suministro.precioVentaGeneralReal;
                            suministro.importeNeto = suministro.cantidad * suministro.precioVentaGeneralReal;

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

            function closeTab(idTab) {
                if ($("#ulNavTabs li").length > 1) {
                    let isSelected = $($("#li" + idTab + " a")[0]).hasClass("active");
                    $("#li" + idTab).remove();
                    $("#" + idTab).remove();
                    if (isSelected) {
                        $("#ulNavTabs li").each(function() {
                            $("#" + $(this)[0].id + " a").removeClass("active")
                        });

                        $("#divTabContent > div").each(function() {
                            $("#" + $(this)[0].id + "").removeClass("active show");
                        });

                        $("#" + $("#ulNavTabs li")[0].id + " a").addClass("active");
                        $("#" + $("#divTabContent > div")[0].id + "").addClass("active show");
                    } else {

                    }
                } else {
                    // $("#ulNavTabs li a i")[0].remove();
                }
            }

            function getSerieNumeracionEspecifico(idTipoDocumento) {
                return new Promise(function(resolve, reject) {
                    fetch("../app/controller/ComprobanteController.php?type=getserienumeracion&idTipoDocumento=" + idTipoDocumento).then(response => {
                        return response.json()
                    }).then(result => {
                        resolve(result);
                    }).catch(error => {
                        reject(error);
                    });
                });
            }

            async function resetVenta() {
                $("#divOverlayPuntoVenta").removeClass("d-none");
                $("#txtCodigoBarra").focus();
                loadInit();
            }
        </script>
    </body>

    </html>

<?php

}
