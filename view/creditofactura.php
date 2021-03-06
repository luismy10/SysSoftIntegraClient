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
        <!-- Modal del detalle de ingreso -->
        <div class="row">
            <div class="modal fade" id="id-modal-productos" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title"><i class="fa fa-indent">
                                </i> Detalle de la nota de crédito</h4>
                            <button type="button" class="close" id="btnCloseModal">
                                <i class="fa fa-close"></i>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table border-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Comprobante</th>
                                                    <th class="text-left border-0 p-1" id="thComprobante">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Cliente</th>
                                                    <th class="text-left border-0 p-1" id="thCliente">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Fecha y Hora:</th>
                                                    <th class="text-left border-0 p-1" id="thFechaHora">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Estado:</th>
                                                    <th id="thEstado">--</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-left border-0 p-1">Total:</th>
                                                    <th class="text-left border-0 p-1" id="thTotal">0.00</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                            <thead style="background-color: #0766cc;color: white;">
                                                <tr>
                                                    <th style="width:5%;">N°</th>
                                                    <th style="width:30%;">Descripción</th>
                                                    <th style="width:15%;">Cantidad</th>
                                                    <th style="width:15%;">Impuesto</th>
                                                    <th style="width:15%;">Precio</th>
                                                    <th style="width:15%;">Descuento</th>
                                                    <th style="width:15%;">Importe</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbIngresosDetalle">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--   Modal del detalle de ingreso -->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Nota de Crédito <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">
                <div class="overlay p-5" id="divOverlayNotaCredito">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text text-center text-white p-10" id="lblTextOverlayNotaCredito">Cargando información...</h4>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <h4> Resumen de documentos emitidos</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/sunat_logo.png" width="28" height="28" />
                            <span class="small">Estados SUNAT:</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/accept.svg" width="28" height="28" />
                            <span class="small">Aceptado</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/unable.svg" width="28" height="28" />
                            <span class="small"> Rechazado</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/reuse.svg" width="28" height="28" />
                            <span class="small"> Pendiente de Envío</span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/error.svg" width="28" height="28" />
                            <span class="small">Comunicación de Baja (Anulado)</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha de Inicio:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaInicial" />
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/calendar.png" width="22" height="22"> Fecha de Fin:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaFinal" />
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/igual.png" width="22" height="22"> Comprobantes:</label>
                        <div class="form-group">
                            <select id="cbComprobante" class="form-control">
                                <option value="0">TODOS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
                        <label><img src="./images/information.png" width="22" height="22"> Estado:</label>
                        <div class="form-group">
                            <select id="cbEstado" class="form-control">
                                <option value="0">TODOS</option>
                                <option value="1">REGISTRADO</option>
                                <option value="2">ANULADO</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-lg-8 col-md-12 col-sm-12 col-12">
                        <label>Buscar:</label>
                        <div class="form-group d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtSearch">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-success" id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Opción:</label>
                        <div class="form-group">
                            <button class="btn btn-secondary" id="btnReload">
                                <i class="fa fa-refresh"></i> Recargar
                            </button>
                        </div>
                    </div>

                    <!-- <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Total de Nota de Crédito:</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">S/</span></div>
                                <div class="input-group-append"><span class="input-group-text" id="lblTotalNotaCredito">0.00</span></div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width:5%;">#</th>
                                        <th style="width:5%;">Pdf</th>
                                        <th style="width:5%;">Detalle</th>
                                        <th style="width:10%;">Fecha</th>
                                        <th style="width:10%;">Comprobante</th>
                                        <th style="width:15%;">Cliente</th>
                                        <th style="width:15%;">Detalle</th>
                                        <th style="width:10%;">Estado</th>
                                        <th style="width:10%;">Total</th>
                                        <th style="width:10%;">Estado SUNAT</th>
                                        <th style="width:20%;">Observación <br> SUNAT</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12 text-center">
                        <label>Paginación</label>
                        <div class="form-group" id="ulPagination">
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let state = false;
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let filasPorPagina = 10;
            let tbList = $("#tbList");

            let ulPagination = $("#ulPagination");
            let lblTotalNotaCredito = $("#lblTotalNotaCredito");

            $(document).ready(function() {

                $("#txtFechaInicial").val(tools.getCurrentDate());
                $("#txtFechaFinal").val(tools.getCurrentDate());

                $("#txtFechaInicial").on("change", function() {
                    var fechaInicial = $("#txtFechaInicial").val();
                    var fechaFinal = $("#txtFechaFinal").val();
                    if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                        if (!state) {
                            paginacion = 1;
                            fillNotaCreditoTable(1, "", fechaInicial, fechaFinal);
                            opcion = 1;
                        }
                    }
                });

                $("#txtFechaFinal").on("change", function() {
                    var fechaInicial = $("#txtFechaInicial").val();
                    var fechaFinal = $("#txtFechaFinal").val();
                    if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                        if (!state) {
                            paginacion = 1;
                            fillNotaCreditoTable(1, "", fechaInicial, fechaFinal);
                            opcion = 1;
                        }
                    }
                });

                $("#txtSearch").on("keyup", function(event) {
                    let value = $("#txtSearch").val();
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillNotaCreditoTable(2, value.trim(), "", "");
                                opcion = 2;
                            }
                        }
                    }
                });

                $("#btnBuscar").click(function() {
                    let value = $("#txtSearch").val();
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillNotaCreditoTable(2, value.trim(), "", "");
                                opcion = 2;
                            }
                        }
                    }
                });

                $("#btnBuscar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        let value = $("#txtSearch").val();
                        if (event.keyCode !== 9 && event.keyCode !== 18) {
                            if (value.trim().length != 0) {
                                if (!state) {
                                    paginacion = 1;
                                    fillNotaCreditoTable(2, value.trim(), "", "");
                                    opcion = 2;
                                }
                            }
                        }
                        event.preventDefault();
                    }
                });


                $("#btnReload").click(function() {
                    loadInitNotaCredito();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadInitNotaCredito();
                    }
                    event.preventDefault();
                });

                loadDataInit();
            });

            async function loadDataInit() {
                try {
                    $("#cbComprobante").empty();
                    let promiseFetchComprobante = tools.promiseFetchGet(
                        "../app/controller/TipoDocumentoController.php", {
                            "type": "GetDocumentoCombBoxNotaCredito"
                        }
                    );

                    let promise = await Promise.all([promiseFetchComprobante]);
                    let result = await promise;

                    let comprobante = result[0];
                    if (comprobante.estado === 1) {
                        $("#cbComprobante").append('<option value="0">TODOS</option>');
                        for (let value of comprobante.data) {
                            $("#cbComprobante").append('<option value="' + value.IdTipoDocumento + '">' + value.Nombre + ' </option>');
                        }
                    } else {
                        $("#cbComprobante").append('<option value="0">TODOS</option>');
                    }
                    $("#divOverlayNotaCredito").addClass('d-none');
                    loadInitNotaCredito();
                } catch (error) {
                    $("#lblTextOverlayNotaCredito").html(error.message);
                }
            }

            function onEventPaginacion() {
                let fechaInicial = $("#txtFechaInicial").val();
                let fechaFinal = $("#txtFechaFinal").val();
                let value = $("#txtSearch").val();
                switch (opcion) {
                    case 1:
                        fillNotaCreditoTable(1, "", fechaInicial, fechaFinal);
                        break;
                    case 2:
                        fillNotaCreditoTable(2, value.trim(), "", "");
                        break;
                }
            }

            function loadInitNotaCredito() {
                let fechaInicial = $("#txtFechaInicial").val();
                let fechaFinal = $("#txtFechaFinal").val();
                if (!state) {
                    paginacion = 1;
                    fillNotaCreditoTable(1, "", fechaInicial, fechaFinal);
                    opcion = 1;
                }
            }

            async function fillNotaCreditoTable(opcion, search, fechaInicial, fechaFinal) {
                try {
                    let result = await tools.promiseFetchGet(
                        "../app/controller/VentaController.php", {
                            "type": "listaNotaCredito",
                            "opcion": opcion,
                            "search": search,
                            "fechaInicial": fechaInicial,
                            "fechaFinal": fechaFinal,
                            "posicionPagina": ((paginacion - 1) * filasPorPagina),
                            "filasPorPagina": filasPorPagina
                        },
                        function() {
                            tbList.empty();
                            tbList.append('<tr><td class="text-center" colspan="11"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                            state = true;
                            totalPaginacion = 0;
                            lblTotalNotaCredito.html('0.00');
                        });

                    tbList.empty();

                    if (result.data.length == 0) {
                        tbList.append('<tr><td class="text-center" colspan="11"><p>No hay datos para mostrar</p></td></tr>');
                        ulPagination.html(`
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>`);
                        state = false;
                    } else {
                        for (let detalle of result.data) {
                            let pdf = '<button class="btn btn-secondary btn-sm"  onclick="openPdf(\'' + detalle.IdNotaCredito + '\')"><img src="./images/pdf.svg" width="26" /> </button>';
                            let ver = '<button class="btn btn-secondary btn-sm" onclick="opeModalDetalleIngreso(\'' + detalle.IdVenta + '\')"><img src="./images/file.svg" width="26" /></button>';

                            let estado = detalle.Estado == "1" ? '<div class="badge badge-success">REGISTRADO</div>' : '<div class="badge badge-danger">ANULADO</div>';

                            let estadosunat = detalle.Xmlsunat === "" ?
                                '<button class="btn btn-secondary btn-sm" onclick="firmarXml(\'' + detalle.IdNotaCredito + '\')"><img src="./images/reuse.svg" width="26"/></button>' :
                                detalle.Xmlsunat === "0" ?
                                '<button class="btn btn-secondary btn-sm"><img src="./images/accept.svg" width="26" /></button>' :
                                '<button class="btn btn-secondary btn-sm" onclick="firmarXml(\'' + detalle.IdNotaCredito + '\')"><img src="./images/unable.svg" width="26" /></button>';

                            let descripcion = '<p class="recortar-texto">' + (detalle.Xmldescripcion === "" ? "Por Generar Xml" : limitar_cadena(detalle.Xmldescripcion, 90, '...')) + '</p>';

                            tbList.append('<tr>' +
                                '<td class="text-center">' + detalle.Id + '</td>' +
                                '<td class="text-center">' + pdf + '</td>' +
                                '<td class="text-center">' + ver + '</td>' +
                                '<td class="text-left">' + tools.getDateForma(detalle.FechaNotaCredito) + '<br>' + tools.getTimeForma24(detalle.HoraNotaCredito) + '</td>' +
                                '<td class="text-left">' + detalle.SerieNotaCredito + '-' + detalle.NumeracionNotaCredito + '</td>' +
                                '<td class="text-left">' + detalle.NumeroDocumento + '<br>' + detalle.Informacion + '</td>' +
                                '<td class="text-left">Comprobante Editado' + '<br>' + detalle.Serie + '-' + detalle.Numeracion + '</td>' +
                                '<td class="text-center">' + estado + '</td>' +
                                '<td class="text-right">' + detalle.Simbolo + " " + tools.formatMoney(detalle.Total) + '</td>' +
                                '<td class="text-center">' + estadosunat + '</td>' +
                                '<td class="text-left">' + descripcion + '</td>' +
                                '</tr>');
                        }
                        lblTotalNotaCredito.html(tools.formatMoney(result.suma));

                        totalPaginacion = parseInt(Math.ceil((parseFloat(result.total) / filasPorPagina)));
                        let i = 1;
                        let range = [];
                        while (i <= totalPaginacion) {
                            range.push(i);
                            i++;
                        }

                        let min = Math.min.apply(null, range);
                        let max = Math.max.apply(null, range);

                        let paginacionHtml = `
                            <button class="btn btn-outline-secondary" onclick="onEventPaginacionInicio(${min})">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary" onclick="onEventAnteriorPaginacion()">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">${paginacion} - ${totalPaginacion}</span>
                            <button class="btn btn-outline-secondary" onclick="onEventSiguientePaginacion()">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary" onclick="onEventPaginacionFinal(${max})">
                                <i class="fa fa-angle-double-right"></i>
                            </button>`;
                        ulPagination.html(paginacionHtml);
                        state = false;
                    }
                } catch (error) {
                    tbList.empty();
                    tbList.append('<tr><td class="text-center" colspan="11"><p>' + error.responseText + '</p></td></tr>');
                    ulPagination.html(`
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-left"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-left"></i>
                            </button>
                            <span class="btn btn-outline-secondary disabled" id="lblPaginacion">0 - 0</span>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-right"></i>
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-angle-double-right"></i>
                            </button>`);
                    state = false;
                }
            }



            async function opeModalDetalleIngreso(idVenta) {
                $("#id-modal-productos").modal("show");
                $("#btnCloseModal").unbind();
                $("#btnCloseModal").bind("click", function(event) {
                    $("#id-modal-productos").modal("hide");
                });

                $("#btnCloseModal").bind("keypress", function(event) {
                    if (event.keyCode === 13) {
                        $("#id-modal-productos").modal("hide");
                        event.preventDefault();
                    }
                });

                let thComprobante = $("#thComprobante");
                let thCliente = $("#thCliente");
                let thFechaHora = $("#thFechaHora");
                let thEstado = $("#thEstado");
                let thTotal = $("#thTotal");
                let tbIngresosDetalle = $("#tbIngresosDetalle");
                try {
                    tbIngresosDetalle.empty();
                    tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');

                    let result = await tools.promiseFetchGet("../app/controller/VentaController.php", {
                        "type": "allventa",
                        "idVenta": idVenta
                    });

                    let object = result;
                    if (object.estado == 1) {
                        tbIngresosDetalle.empty();
                        let venta = object.venta;
                        thComprobante.html(venta.Serie + "-" + venta.Numeracion);
                        thCliente.html(venta.NumeroDocumento + " - " + venta.Informacion);
                        thFechaHora.html(tools.getDateForma(venta.FechaVenta) + " - " + tools.getTimeForma24(venta.HoraVenta));
                        thEstado.html(venta.Estado == 3 ? "ANULADO" : venta.Estado == 2 ? "POR COBRAR" : "COBRADO");
                        thEstado.removeClass();
                        thEstado.addClass(venta.Estado == 3 ? "text-left text-danger border-0 p-1" : "text-left text-success border-0 p-1");
                        let detalleventa = object.ventadetalle;
                        let total = 0;
                        for (let venta of detalleventa) {
                            let num = venta.id;
                            let descripcion = venta.Clave + "<br>" + venta.NombreMarca;
                            let cantidad = venta.Cantidad;
                            let impuesto = venta.NombreImpuesto;
                            let precio = venta.PrecioVenta;
                            let descuento = venta.Descuento;
                            let importe = cantidad * precio;
                            tbIngresosDetalle.append('<tr>' +
                                '<td>' + num + '</td>' +
                                '<td class="td-left">' + descripcion + '</td>' +
                                '<td>' + tools.formatMoney(cantidad) + "<br>" + venta.UnidadCompra + '</td>' +
                                '<td>' + impuesto + '</td>' +
                                '<td>' + tools.formatMoney(precio) + '</td>' +
                                '<td>' + tools.formatMoney(descuento) + '</td>' +
                                '<td>' + tools.formatMoney(importe) + '</td>' +
                                '</tr>');
                            total += parseFloat(importe);
                        }
                        thTotal.html(venta.Simbolo + " " + tools.formatMoney(total));
                    } else {
                        tbIngresosDetalle.empty();
                        tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><p>' + object.message + '</p></td></tr>');
                    }
                } catch (error) {
                    console.log(error);
                    tbIngresosDetalle.empty();
                    tbIngresosDetalle.append('<tr><td class="text-center" colspan="6"><p>' + error.responseText + '</p></td></tr>');
                }
            }

            function limitar_cadena(cadena, limite, sufijo) {
                if (cadena.length > limite) {
                    return cadena.substr(0, limite) + sufijo;
                }
                return cadena;
            }


            function openPdf(idNotaCredito) {
                window.open("../app/sunat/pdfnotacredito.php?idNotaCredito=" + idNotaCredito, "_blank");
            }

            function onEventPaginacionInicio(value) {
                if (!state) {
                    if (value !== paginacion) {
                        paginacion = value;
                        onEventPaginacion();
                    }
                }
            }

            function onEventPaginacionFinal(value) {
                if (!state) {
                    if (value !== paginacion) {
                        paginacion = value;
                        onEventPaginacion();
                    }
                }
            }

            function onEventAnteriorPaginacion() {
                if (!state) {
                    if (paginacion > 1) {
                        paginacion--;
                        onEventPaginacion();
                    }
                }
            }

            function onEventSiguientePaginacion() {
                if (!state) {
                    if (paginacion < totalPaginacion) {
                        paginacion++;
                        onEventPaginacion();
                    }
                }
            }
        </script>
    </body>

    </html>

<?php

}
