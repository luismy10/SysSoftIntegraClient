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

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Productos <small>Lista</small></h1>
            </div>

            <div class="tile">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <button class="btn btn-success" id="btnAgregar">
                                <i class="fa fa-plus"></i>
                                Agregar
                            </button>
                            <button class="btn btn-danger" id="btnReload">
                                <i class="fa fa-refresh"></i>
                                Recargar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Buscar: </label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Clave o clave alterna" class="input-primary " id="txtClaveProducto">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                        <label>Buscar:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Descripción del producto" class="input-primary" id="txtDescripcionProducto">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <label>Paginación:</label>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnAnterior">
                                <i class="fa fa-arrow-circle-left"></i>
                            </button>
                            <span class="m-2" id="lblPaginaActual">0</span>
                            <span class="m-2">de</span>
                            <span class="m-2" id="lblPaginaSiguiente">0</span>
                            <button class="btn btn-primary" id="btnSiguiente">
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-responsive">
                            <table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead class="table-header-background">
                                    <tr>
                                        <th style="width:5%">N°</th>
                                        <th style="width:20%">Descripción</th>
                                        <th style="width:10%">Categoría/Marca</th>
                                        <th style="width:10%">Costo</th>
                                        <th style="width:10%">Precio</th>
                                        <th style="width:10%">Impuesto</th>
                                        <th style="width:10%">Cantidad</th>
                                        <th style="width:10%">Imagen</th>
                                        <th colspan="2" style="width:10%">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">

                                </tbody>
                            </table>
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
            let filasPorPagina = 20;
            let tbList = $("#tbList");
            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            $(document).ready(function() {
                loadInitProductos();
                $("#tbList").on("click", "tr", function(event) {
                    $(".selected-table-tr").removeClass("selected-table-tr");
                    $(this).addClass("selected-table-tr");
                });
                $("#btnAnterior").click(function() {
                    if (!state) {
                        if (paginacion > 1) {
                            paginacion--;
                            onEventPaginacion();
                        }
                    }
                });
                $("#btnSiguiente").click(function() {
                    if (!state) {
                        if (paginacion < totalPaginacion) {
                            paginacion++;
                            onEventPaginacion();
                        }
                    }
                });
                $("#txtClaveProducto").keyup(function(event) {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if ($("#txtClaveProducto").val().trim() != "") {
                            if (!state) {
                                paginacion = 1;
                                loadListaProductos(1, $("#txtClaveProducto").val().trim(), "");
                                opcion = 1;
                            }
                        }
                    }
                });
                $("#txtDescripcionProducto").keyup(function(event) {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if ($("#txtDescripcionProducto").val().trim() != "") {
                            if (!state) {
                                paginacion = 1;
                                loadListaProductos(2, "", $("#txtDescripcionProducto").val().trim());
                                opcion = 2;
                            }
                        }
                    }
                });
                $("#btnAgregar").click(function() {
                    window.location.href = "registrarproducto.php";
                });
                $("#btnAgregar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        window.location.href = "registrarproducto.php";
                    }
                    event.preventDefault();
                });
                $("#btnReload").click(function() {
                    loadInitProductos();
                });
                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadInitProductos();
                    }
                    event.preventDefault();
                });
                $("#btnReporte").click(function() {

                });
                $("#btnReporte").keypress(function(event) {
                    if (event.keyCode === 13) {

                    }
                    event.preventDefault();
                });

            });

            function onEventPaginacion() {
                switch (opcion) {
                    case 0:
                        loadListaProductos(0, "", "");
                        break;
                    case 1:
                        loadListaProductos(1, $("#txtClaveProducto").val().trim(), "");
                        break;
                    case 2:
                        loadListaProductos(2, "", $("#txtDescripcionProducto").val().trim());
                        break;
                }
            }


            function loadInitProductos() {
                if (!state) {
                    paginacion = 1;
                    loadListaProductos(0, "", "");
                    opcion = 0;
                }
            }

            function loadListaProductos(opcion, clave, nombre) {
                $.ajax({
                    url: "../app/controller/SuministroController.php",
                    method: "GET",
                    data: {
                        "type": "listaproductos",
                        "opcion": opcion,
                        "clave": clave,
                        "nombre": nombre,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    },
                    beforeSend: function() {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="10"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                        totalPaginacion = 0;
                    },
                    success: function(result) {
                        let object = result;
                        if (object.estado === 1) {
                            tbList.empty();

                            if (object.data.length == 0) {
                                tbList.append('<tr><td class="text-center" colspan="10"><p>No hay datos para mostrar.</p></td></tr>');
                                lblPaginaActual.html(0);
                                lblPaginaSiguiente.html(0);
                                state = false;
                            } else {

                                for (let suministro of object.data) {
                                    let image = "./images/noimage.jpg";
                                    if (suministro.NuevaImagen != '') {
                                        image = ("data:image/png;base64," + suministro.NuevaImagen);
                                    }

                                    let clave = suministro.Clave + " " + (suministro.ClaveAlterna == "" ? "" : " - " + suministro.ClaveAlterna);
                                    let cantidad = parseFloat(suministro.Cantidad) <= 0 ? '<span class="text-xs-bold text-danger">' + tools.formatMoney(suministro.Cantidad) + '(' + suministro.UnidadCompraNombre + ')' + '</span>' : '<span class="text-xs-bold text-primary">' + tools.formatMoney(suministro.Cantidad) + '(' + suministro.UnidadCompraNombre + ')' + '</span>';
                                    tbList.append('<tr>' +
                                        '<td class="text-center">' + suministro.Id + '</td>' +
                                        '<td>' + clave + '<br>' + suministro.NombreMarca + '</td>' +
                                        '<td>' + suministro.Categoria + '<br>' + suministro.Marca + '</td>' +
                                        '<td class="text-right">' + tools.formatMoney(suministro.PrecioCompra) + '</td>' +
                                        '<td class="text-right">' + tools.formatMoney(suministro.PrecioVentaGeneral) + '</td>' +
                                        '<td class="text-right">' + suministro.ImpuestoNombre + '</td>' +
                                        '<td class="text-right">' + cantidad + '</td>' +
                                        '<td class="text-center"><figure><img style="width:70px;height:70px;object-fit:cover;" src="' + image + '" alt="Producto"/></figure></td>' +
                                        '<td class="text-center">' +
                                        '<a href="actualizarproducto.php?idSuministro=' + suministro.IdSuministro + '" class="btn btn-warning"><i class="fa fa-edit"></i></a>' +
                                        '</td>' +
                                        '<td>' +
                                        '<button type="button" class="btn btn-danger" onclick="removeProducto(\'' + suministro.IdSuministro + '\')"><i class="fa fa-trash"></i></button>' +
                                        '</td>' +
                                        '</tr>');
                                }
                                totalPaginacion = parseInt(Math.ceil((parseFloat(object.total) / filasPorPagina)));
                                lblPaginaActual.html(paginacion);
                                lblPaginaSiguiente.html(totalPaginacion);
                                state = false;
                            }
                        } else {
                            tbList.empty();
                            tbList.append('<tr><td class="text-center" colspan="10"><p>' + object.message + '</p></td></tr>');
                            lblPaginaActual.html("0");
                            lblPaginaSiguiente.html("0");
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="10"><p>' + error.responseText + '</p></td></tr>');
                        lblPaginaActual.html("0");
                        lblPaginaSiguiente.html("0");
                        state = false;
                    }
                });
            }

            function removeProducto(IdSuministro) {
                tools.ModalDialog("Producto", '¿Está seguro de eliminar el Producto?', function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/controller/SuministroController.php",
                            method: "POST",
                            accepts: "application/json",
                            contentType: "application/json; charset=utf-8",
                            data: JSON.stringify({
                                "type": "removesuministro",
                                "IdSuministro": IdSuministro
                            }),
                            beforeSend: function() {
                                tools.ModalAlertInfo("Producto", "Se está procesando la petición.");
                            },
                            success: function(data) {
                                if (data.estado == 1) {
                                    tools.ModalAlertSuccess("Producto", data.message);
                                    loadInitProductos();
                                } else if (data.estado == 2) {
                                    tools.ModalAlertWarning("Producto", data.message);
                                } else if (data.estado == 3) {
                                    tools.ModalAlertWarning("Producto", data.message);
                                } else if (data.estado == 4) {
                                    tools.ModalAlertWarning("Producto", data.message);
                                } else {
                                    tools.ModalAlertWarning("Producto", data.message);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Producto", "Se produjo un error: " + error.responseText);
                            }
                        });
                    }
                });
            }
        </script>
    </body>

    </html>

<?php

}
