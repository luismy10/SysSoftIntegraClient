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
        <!-- modal start -->
        <div class="row">
            <div class="modal fade" id="idOpciones" tabindex="-1" role="dialog" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="idModalTitle">
                                <i class="fa fa-plus">
                                </i> Agregar unidad de medida
                            </h4>
                            <button id="btnCloseModal" type="button" class="close">
                                <i class="fa fa-close"></i>
                            </button>

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="search" class="form-control" placeholder="Buscar..." id="txtBuscar" autocomplete="off" />
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" id="btnRecargarProductos">
                                                    <img src="./images/plus.png" width="18" />
                                                </button>
                                            </div>
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" id="btnRecargarProductos">
                                                    <img src="./images/edit.png" width="18" />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="overflow:auto; height:320px" id="divTable">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <table class="table table-hover table-bordered">
                                        <tbody id="tbLista" tabindex="0">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <label class="text-center">Seleccione un elemento de la lista con doble click</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal end -->

        <main class="app-content">

            <div class="app-title">
                <h1><i class="fa fa-folder"></i> Actualizar <small>Producto</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="overlay p-5" id="divOverlayProducto">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text text-center p-10" id="lblTextOverlayProducto">Cargando información...</h4>
                </div>


                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <button class="btn btn-warning" id="btnRegistrar">
                                <img src="./images/edit.png" width="18" /> Actualizar
                            </button>

                            <button class="btn btn-secondary" id="btnCancelar">
                                <img src="./images/error.svg" width="18" /> Cancelar
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row  mb-3">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title">Información General</h4>
                            </div>
                            <div class="card-body">
                                <!-- body -->
                                <div class="row">
                                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Clave <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Clave del producto" id="txtClave" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 padding-vertical-5">
                                                <label>Clave Alterna</label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Clave alterna del producto" id="txtClaveAlterna" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center m-2">
                                                <img src="./images/noimage.jpg" style="object-fit: cover;" width="160" height="160" id="lblImagen">
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center m-2">
                                                <input type="file" id="fileImage" accept="image/png, image/jpeg, image/gif, image/svg" style="display: none" />
                                                <label for="fileImage" class="btn btn-outline-secondary m-0">
                                                    <div class="content-button">
                                                        <img src="./images/photo.png" width="22" />
                                                        <span></span>
                                                    </div>
                                                </label>
                                                <button class="btn btn-outline-secondary" id="btnRemove">
                                                    <img src="./images/remove-gray.png" width="22" />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Descripción <i class="text-danger fa fa-info-circle"></i></label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Clave del producto" id="txtDescripcion" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>Unidad de Medida(Precione espacio o doble click) <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Clave del producto" id="txtUnidadMedida" autocomplete="off" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>Categoría(Precione espacio o doble click) <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Clave del producto" id="txtCategoria" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>
                                            Se Vende <i class="text-danger fa fa-info-circle"></i>
                                        </label>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbUnidad" name="tbSeVende" checked />
                                                    <label for="rbUnidad">
                                                        &nbsp;Por Unidad/Pza o Por Precio Base
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbMoneda" name="tbSeVende" />
                                                    <label for="rbMoneda">
                                                        &nbsp; Por Valor Monetario
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbGranel" name="tbSeVende" />
                                                    <label for="rbGranel">
                                                        &nbsp;A granel(Km,Ml,Mc, etc.)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- body -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  mb-3">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title">Información de Almacen</h4>
                            </div>
                            <div class="card-body">
                                <!--  -->
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="form-group border-bottom mt-3">
                                            <label for="cbCosto">El producto utiliza inventario&nbsp;&nbsp;</label>
                                            <input type="checkbox" id="cbCosto">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="divCosto">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label>Costo <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Costo de compra" id="txtCosto" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <label>Stock mínimo </label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Stock mínimo" id="txtStockMinimo" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <label>Stock máximo </label>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Stock máximo" id="txtStockMaximo" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Valor de salida del producto</label>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbUnidadSalida" name="tbValorSalida" checked />
                                                    <label for="rbUnidadSalida">
                                                        &nbsp; Por Unidades(cantidades)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbMonedaSalida" name="tbValorSalida" />
                                                    <label for="rbMonedaSalida">
                                                        &nbsp; Por valor monetario(S/, $, U, etc.)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbGranelSalida" name="tbValorSalida" />
                                                    <label for="rbGranelSalida">
                                                        &nbsp; Por medidas(kg, cm, falón, etc.)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Impuesto <i class="text-danger fa fa-info-circle"></i></label>
                                        <div class="form-group">
                                            <select class="form-control" id="cbImpuesto">
                                                <option value="">- Seleccione -</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="radio" id="rbPrecioNormal" name="tbTipoPrecio" checked />
                                            <label for="rbPrecioNormal">
                                                &nbsp;Lista de Precio Normal
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" id="divPrecioNormal">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <label>Precio General <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Precio General" id="txtPrecioGeneral" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <label>Precio 2 </label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Precio 2" id="txtPrecio2" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <label>Precio 3 </label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Precio 3" id="txtPrecio3" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="radio" id="rbPrecioPersonalizado" name="tbTipoPrecio" />
                                            <label for="rbPrecioPersonalizado">
                                                &nbsp; Lista de Precios Personalizados
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" id="divPrecioPersonalizado" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <label>Precio General <i class="text-danger fa fa-info-circle"></i></label>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Clave del producto" id="txtPrecioGeneralPersonalizado" />
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <label>Opción </label>
                                                <div class="form-group">
                                                    <button class="btn btn-success" id="btnAgregar">
                                                        <i class="fa fa-plus"></i> Agregar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:30%">Nombre</th>
                                                            <th style="width:30%">Precio del Monto</th>
                                                            <th style="width:30%">Cantidad</th>
                                                            <th style="width:10%">Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbPrecios">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h4 class="card-title">Información Adicional</h4>
                            </div>
                            <div class="card-body">
                                <!--  -->
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label>Descripción alterna </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Descripción alterna " id="txtDescripcionAlterna" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label>Estado </label>
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbActivo" name="tbEstado" checked />
                                                    <label for="rbActivo">
                                                        Activo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="tbDesactivo" name="tbEstado" />
                                                    <label for="tbDesactivo" class="radio-custom-label">
                                                        Inactivo
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label>Marca(Precione espacio o doble click) </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Marca" id="txtMarca" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <label>Presentación(Precione espacio o doble click) </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Presentación" id="txtPresentacion" autocomplete="false" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Clave única del producto </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Clave única del producto" id="txtClaveUnica" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="cbLote">
                                            <label for="cbLote"> Lote(Indica si manejara un control de lotes y caducidades para este artículo)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Usar en </label>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbTodoModulos" name="tbPara" checked />
                                                    <label for="rbTodoModulos">
                                                        Todos los módulos
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbModuloVentas" name="tbPara" />
                                                    <label for="rbModuloVentas" class="radio-custom-label">
                                                        Solo ventas
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <input type="radio" id="rbModuloProduccion" name="tbPara" />
                                                    <label for="rbModuloProduccion" class="radio-custom-label">
                                                        Solo producción
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let tbPrecios = $("#tbPrecios");

            let idSuministro = "<?php echo $_GET["idSuministro"]; ?>";
            let mantenimiento = "";
            let idUnidadMedida = 0;
            let idCategoria = 0;
            let idMarca = 0;
            let idPresentacion = 0;

            let imageByte = null;

            let index = -1;

            $(document).ready(function() {

                $(document).keydown(function(event) {
                    if (event.keyCode === 27) {
                        $("#idOpciones").modal("hide");
                        event.preventDefault();
                    }
                });

                $("#fileImage").on('change', function(event) {
                    $("#lblImagen").attr("src", URL.createObjectURL(event.target.files[0]));
                });

                $("#btnRemove").click(function() {
                    $("#lblImagen").attr("src", "./images/noimage.jpg");
                    $("#fileImage").val(null);
                });

                $("#btnRemove").keypress(function(event) {
                    if (event.keyCode === 13) {
                        $("#lblImagen").attr("src", "./images/noimage.jpg");
                        $("#fileImage").val(null);
                        event.preventDefault();
                    }
                });

                // $("#txtClave").keypress(function(event) {
                //     var key = window.Event ? event.which : event.keyCode;
                //     var c = String.fromCharCode(key);
                //     if ((c < '0' || c > '9') && (c != '\b') && (c < 'a' || c > 'z') && (c < 'A' || c > 'Z')) {
                //         event.preventDefault();
                //     }
                // });

                // $("#txtClaveAlterna").keypress(function(event) {
                //     var key = window.Event ? event.which : event.keyCode;
                //     var c = String.fromCharCode(key);
                //     if ((c < '0' || c > '9') && (c != '\b') && (c < 'a' || c > 'z') && (c < 'A' || c > 'Z')) {
                //         event.preventDefault();
                //     }
                // });

                $("#cbCosto").change(function() {
                    if ($("#cbCosto").is(":checked")) {
                        $("#divCosto").removeClass("disabled");
                    } else {
                        $("#divCosto").addClass("disabled");
                    }
                });

                $("#txtCosto").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtCosto").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtStockMinimo").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtCosto").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtStockMaximo").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtCosto").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtUnidadMedida").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#txtCategoria").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#txtMarca").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#txtPresentacion").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c != '\b')) {
                        event.preventDefault();
                    }
                });

                $("#txtPrecioGeneral").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtPrecioGeneral").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtPrecio2").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtPrecio2").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtPrecio3").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtPrecio3").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#txtPrecioGeneralPersonalizado").keypress(function(event) {
                    var key = window.Event ? event.which : event.keyCode;
                    var c = String.fromCharCode(key);
                    if ((c < '0' || c > '9') && (c != '\b') && (c != '.')) {
                        event.preventDefault();
                    }
                    if (c == '.' && $("#txtPrecioGeneralPersonalizado").val().includes(".")) {
                        event.preventDefault();
                    }
                });

                $("#rbPrecioNormal").change(function() {
                    $("#divPrecioPersonalizado").css("display", "none");
                    $("#divPrecioNormal").css("display", "block");
                });

                $("#rbPrecioPersonalizado").change(function() {
                    $("#divPrecioNormal").css("display", "none");
                    $("#divPrecioPersonalizado").css("display", "block");
                });

                $("#btnAgregar").click(function() {
                    tbPrecios.append('<tr id="' + $("#tbPrecios tr").length + '">' +
                        '   <td><input type="text" class="form-control" value="Precio ' + ($("#tbPrecios tr").length == 0 ? 1 : $("#tbPrecios tr").length + 1) + '"></td>' +
                        '   <td><input type="number" class="form-control"  value="0.00"></td>' +
                        '   <td><input type="number" class="form-control"  value="0"></td>' +
                        '   <td class="td-center">' +
                        '    <button class="btn btn-secondary" onclick="removePrecio(\'' + $("#tbPrecios tr").length + '\')"><img src="./images/remove.png" width="18" /></button>' +
                        '   </td>' +
                        ' </tr>');
                });

                $("#btnAgregar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        tbPrecios.append('<tr id="' + $("#tbPrecios tr").length + '">' +
                            '   <td><input type="text" class="form-control" value="Precio ' + ($("#tbPrecios tr").length == 0 ? 1 : $("#tbPrecios tr").length + 1) + '"></td>' +
                            '   <td><input type="number" class="form-control" value="0.00"></td>' +
                            '   <td><input type="number" class="form-control" value="0"></td>' +
                            '   <td class="td-center">' +
                            '    <button class="btn btn-outline-secondary" onclick="removePrecio(\'' + $("#tbPrecios tr").length + '\')"><img src="./images/remove.png" width="18" /></button>' +
                            '   </td>' +
                            ' </tr>');
                        event.preventDefault();
                    }
                });

                $("#txtUnidadMedida").keyup(function(event) {
                    if (event.keyCode == 32) {
                        openModalDetalle("0013", " Agregar unidad de medida");
                        event.preventDefault();
                    }
                });

                $("#txtUnidadMedida").dblclick(function(event) {
                    openModalDetalle("0013", " Agregar unidad de medida");
                });

                $("#txtCategoria").keyup(function(event) {
                    if (event.keyCode == 32) {
                        openModalDetalle("0006", "Agregar categoría");
                        event.preventDefault();
                    }
                });

                $("#txtCategoria").dblclick(function(event) {
                    openModalDetalle("0006", "Agregar categoría");
                });

                $("#txtMarca").keyup(function(event) {
                    if (event.keyCode == 32) {
                        openModalDetalle("0007", "Agregar marca");
                        event.preventDefault();
                    }
                });

                $("#txtMarca").dblclick(function(event) {
                    openModalDetalle("0007", "Agregar marca'");
                });

                $("#txtPresentacion").keyup(function(event) {
                    if (event.keyCode == 32) {
                        openModalDetalle("0008", "Agregar presentación");
                        event.preventDefault();
                    }
                });

                $("#txtPresentacion").dblclick(function(event) {
                    openModalDetalle("0008", "Agregar presentación");
                });

                /* registrar formularios */

                $("#txtClave").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtDescripcion").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtUnidadMedida").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtCategoria").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtCosto").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtStockMinimo").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtStockMaximo").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtPrecioGeneral").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtPrecio2").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtPrecio3").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtPrecioGeneralPersonalizado").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtDescripcionAlterna").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtMarca").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                    }
                });

                $("#txtPresentacion").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#txtClaveUnica").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }
                });

                $("#btnRegistrar").click(function() {
                    registrarProducto();
                });

                $("#btnRegistrar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        registrarProducto();
                        event.preventDefault();
                    }

                });

                $("#btnCancelar").click(function(event) {
                    location.href = "productos.php";
                });

                $("#btnCancelar").keypress(function(event) {
                    if (event.keyCode === 13) {
                        location.href = "productos.php";
                        event.preventDefault();
                    }
                });
                /* registrar formularios */

                modalDetalle();
                loadInit();
            });

            async function loadInit() {
                try {
                    $("#cbImpuesto").empty();
                    let promiseFetchImpuesto = new Promise(function(resolve, reject) {
                        $.ajax({
                            url: "../app/controller/SuministroController.php",
                            method: "GET",
                            data: {
                                "type": "impuestos"
                            },
                            success: function(result) {
                                resolve(result);
                            },
                            error: function(error) {
                                reject(error);
                            }
                        });
                    });

                    let promiseFetchProducto = new Promise(function(resolve, reject) {
                        $.ajax({
                            url: "../app/controller/SuministroController.php",
                            method: 'GET',
                            data: {
                                "type": "getproducto",
                                "idSuministro": idSuministro
                            },
                            success: function(result) {
                                resolve(result);
                            },
                            error: function(error) {
                                reject(error);
                            }
                        });
                    });

                    let promise = await Promise.all([promiseFetchImpuesto, promiseFetchProducto]);
                    let result = await promise;

                    let impuestos = result[0];

                    if (impuestos.estado === 1) {
                        $("#cbImpuesto").append('<option value="">--TODOS--</option>');
                        for (let impuesto of impuestos.data) {
                            $("#cbImpuesto").append('<option value="' + impuesto.IdImpuesto + '">' + impuesto.Nombre + '</option>');
                        }
                    }

                    let producto = result[1];
                    if (producto.estado == 1) {
                        let suministro = producto.suministro;
                        $("#txtClave").val(suministro.Clave);
                        $("#txtClaveAlterna").val(suministro.ClaveAlterna);
                        $("#txtDescripcion").val(suministro.NombreMarca);

                        if (suministro.NuevaImagen == "") {
                            $("#lblImagen").attr("src", "./images/noimage.jpg");
                            imageByte = null;
                        } else {
                            $("#lblImagen").attr("src", "data:image/png;base64," + suministro.NuevaImagen);
                            imageByte = suministro.NuevaImagen;
                        }

                        idUnidadMedida = suministro.UnidadCompra;
                        $("#txtUnidadMedida").val(suministro.UnidadCompraNombre);

                        idCategoria = suministro.Categoria;
                        $("#txtCategoria").val(suministro.CategoriaNombre);

                        if (suministro.UnidadVenta == 3) {
                            $("#rbGranel").prop("checked", true);
                        } else if (suministro.UnidadVenta == 2) {
                            $("#rbMoneda").prop("checked", true);
                        } else {
                            $("#rbUnidad").prop("checked", true);
                        }

                        $("#txtCosto").val(suministro.PrecioCompra);
                        $("#txtStockMinimo").val(suministro.StockMinimo);
                        $("#txtStockMaximo").val(suministro.StockMaximo);

                        if (suministro.ValorInventario == 3) {
                            $("#rbGranelSalida").prop("checked", true);
                        } else if (suministro.ValorInventario == 2) {
                            $("#rbMonedaSalida").prop("checked", true);
                        } else {
                            $("#rbUnidadSalida").prop("checked", true);
                        }

                        $("#cbImpuesto").val(suministro.Impuesto);

                        if (suministro.TipoPrecio == 1) {
                            $("#rbPrecioNormal").prop("checked", true);
                            $("#txtPrecioGeneral").val(suministro.PrecioVentaGeneral);
                            if (producto.precios.length != 0) {
                                let precio2 = producto.precios[0].Valor != null || producto.precios[0].Valor != undefined ? producto.precios[0].Valor : 0;
                                let precio3 = producto.precios[1].Valor != null || producto.precios[1].Valor != undefined ? producto.precios[1].Valor : 0;
                                $("#txtPrecio2").val(precio2);
                                $("#txtPrecio3").val(precio3);
                                $("#divPrecioPersonalizado").css("display", "none");
                                $("#divPrecioNormal").css("display", "block");
                            }
                        } else {
                            $("#rbPrecioPersonalizado").prop("checked", true);
                            $("#txtPrecioGeneralPersonalizado").val(suministro.PrecioVentaGeneral);
                            $("#divPrecioNormal").css("display", "none");
                            $("#divPrecioPersonalizado").css("display", "block");
                            tbPrecios.empty();
                            for (let precio of producto.precios) {
                                tbPrecios.append('<tr id="' + $("#tbPrecios tr").length + '">' +
                                    '   <td><input type="text" class="form-control" value="' + precio.Nombre + '"></td>' +
                                    '   <td><input type="number" class="form-control" value="' + precio.Valor + '"></td>' +
                                    '   <td><input type="number" class="form-control" value="' + precio.Factor + '"></td>' +
                                    '   <td class="td-center">' +
                                    '    <button class="btn btn-default" onclick="removePrecio(\'' + $("#tbPrecios tr").length + '\')"><img src="./image/remove.png" width="18" /></button>' +
                                    '   </td>' +
                                    ' </tr>');
                            }
                        }

                        $("#txtDescripcionAlterna").val(suministro.NombreGenerico);
                        if (suministro.Estado == 1) {
                            $("#rbActivo").prop("checked", true);
                        } else {
                            $("#tbDesactivo").prop("checked", true);
                        }

                        idMarca = suministro.Marca;
                        $("#txtMarca").val(suministro.MarcaNombre);
                        idPresentacion = suministro.Presentacion;
                        $("#txtPresentacion").val(suministro.PresentacionNombre);
                        $("#txtClaveUnica").val(suministro.ClaveSat);
                        $("#cbLote").prop("checked", suministro.Lote == 0 ? false : true);
                        $("#cbCosto").prop("checked", suministro.Inventario == 0 ? false : true);
                        if ($("#cbCosto").is(":checked")) {
                            $("#divCosto").removeClass("disabled");
                        } else {
                            $("#divCosto").addClass("disabled");
                        }

                        if (suministro.Origen == "1") {
                            $("#rbTodoModulos").prop("checked", true);
                        } else if (suministro.Origen == "2") {
                            $("#rbModuloVentas").prop("checked", true);
                        } else {
                            $("#rbModuloProduccion").prop("checked", true);
                        }

                        $("#divOverlayProducto").addClass("d-none");
                    } else {
                        $("#lblTextOverlayProducto").html(producto.message);
                    }
                } catch (error) {
                    $("#lblTextOverlayProducto").html("Se producto un problema en:" + error.message);
                }
            }

            function openModalDetalle(id, title) {
                $("#idOpciones").modal("show");
                $("#idModalTitle").html('<i class="fa fa-plus"> </i> ' + title);
                $("#txtBuscar").val("");
                mantenimiento = id;
                loadModalId(mantenimiento, "");
            }

            function loadModalId(idMantenimiento, nombre) {
                $("#tbLista").empty();
                $.get("../app/controller/SuministroController.php", {
                    "type": "detalles",
                    "mantenimiento": idMantenimiento,
                    "nombre": nombre
                }, function(data, status) {
                    if (status === "success") {
                        for (let value of data.data) {
                            $("#tbLista").append('<tr id="' + value.IdDetalle + '" name="' + value.Nombre + '" ondblclick="selectModal(\'' + idMantenimiento + '\',\'' + value.IdDetalle + '\',\'' + value.Nombre + '\')">' +
                                '    <td tabindex="-1">' + value.Nombre + '</td>' +
                                '</tr>');
                        }
                    }
                });
            }

            function modalDetalle() {
                $("#txtBuscar").keyup(function(event) {
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if ($("#txtBuscar").val().trim() != "") {
                            index = -1;
                            loadModalId(mantenimiento, $("#txtBuscar").val().trim());
                        }
                    }
                });

                $("#txtBuscar").keydown(function(event) {
                    if (event.which == 13) {
                        let rows = document.getElementById("tbLista").rows;
                        if (rows.length > 0) {
                            if (index !== -1) {
                                rows[index].classList.toggle("selected-table");
                            }
                            index = 0;
                            let parent = rows[index];
                            index = parent.rowIndex;
                            parent.classList.toggle("selected-table");
                            document.getElementById('tbLista').focus();
                            $('#divTable').animate({
                                scrollTop: 0
                            }, 'slow');
                        }
                        event.preventDefault();
                    }
                });

                $("#btnCloseModal").click(function(event) {
                    $("#idOpciones").modal("hide");
                    $("#tbLista").empty();
                    index = -1;
                });

                $("#btnCloseModal").keypress(function(event) {
                    if (event.keyCode === 13) {
                        $("#idOpciones").modal("hide");
                        $("#tbLista").empty();
                        index = -1;
                    }
                });

                $('#idOpciones').on('shown.bs.modal', function() {
                    $('#txtBuscar').trigger('focus')
                    // document.getElementById('tbLista').scrollIntoView(false);
                });

                $("#tbLista").keydown(function(event) {
                    if (event.which == 13) {
                        var rows = document.getElementById("tbLista").rows;
                        if (rows.length > 0) {
                            let parent = rows[index];
                            selectModal(mantenimiento, parent.getAttribute("id"), parent.getAttribute("name"));
                        }
                        event.preventDefault();
                    }

                    if (event.keyCode === 38) {
                        var rows = document.getElementById("tbLista").rows;
                        if (index !== 0) {
                            if (index !== -1) {
                                rows[index].classList.toggle("selected-table");
                            }
                            if (index > 0) {
                                index--;
                                let parent = rows[index];
                                index = parent.rowIndex;
                                parent.classList.toggle("selected-table");
                            }
                        }
                    } else if (event.keyCode === 40) {
                        var rows = document.getElementById("tbLista").rows;
                        if (index !== rows.length - 1) {
                            if (index !== -1) {
                                rows[index].classList.toggle("selected-table");
                            }
                            if (index < rows.length - 1) {
                                index++;
                                let parent = rows[index];
                                index = parent.rowIndex;
                                parent.classList.toggle("selected-table");
                            }
                        }
                    }
                });

                $("#tbLista").mousedown(function() {
                    let table = document.getElementById("tbLista");
                    let rows = table.rows;
                    if (rows.length > 0) {
                        for (let i = 0; i < rows.length; i++) {
                            rows[i].onclick = function() {
                                if (index !== -1) {
                                    rows[index].classList.toggle("selected-table");
                                }
                                index = this.rowIndex;
                                this.classList.toggle("selected-table");
                                table.focus();
                            };
                        }
                    }
                });
            }

            function registrarProducto() {
                if ($("#txtClave").val().trim().length == 0) {
                    $("#txtClave").focus();
                } else if ($("#txtDescripcion").val().trim().length == 0) {
                    $("#txtDescripcion").focus();
                } else if ($("#txtUnidadMedida").val().trim().length == 0) {
                    $("#txtUnidadMedida").focus();
                } else if ($("#txtCategoria").val().trim().length == 0) {
                    $("#txtCategoria").focus();
                } else if (!tools.isNumeric($("#txtCosto").val())) {
                    $("#txtCosto").focus();
                } else if ($("#cbImpuesto").val() == '') {
                    $("#cbImpuesto").focus();
                } else if ($("#rbPrecioNormal").is(":checked") && !tools.isNumeric($("#txtPrecioGeneral").val())) {
                    $("#txtPrecioGeneral").focus();
                } else if ($("#rbPrecioPersonalizado").is(":checked") && !tools.isNumeric($("#txtPrecioGeneralPersonalizado").val())) {
                    $("#txtPrecioGeneralPersonalizado").focus();
                } else {

                    let listaPrecios = [];

                    if ($("#rbPrecioNormal").is(":checked")) {
                        listaPrecios.push({
                            "nombre": "Precio de Venta 1",
                            "valor": !tools.isNumeric($("#txtPrecio2").val()) ? 0 : $("#txtPrecio2").val().trim(),
                            "factor": 1
                        });
                        listaPrecios.push({
                            "nombre": "Precio de Venta 2",
                            "valor": !tools.isNumeric($("#txtPrecio3").val()) ? 0 : $("#txtPrecio3").val().trim(),
                            "factor": 1
                        });
                    } else {
                        $("#tbPrecios tr").each(function(row, tr) {
                            listaPrecios.push({
                                "nombre": $(tr).find("td:eq(0)").find("input").val(),
                                "valor": !tools.isNumeric($(tr).find("td:eq(1)").find("input").val()) ? 0 : $(tr).find("td:eq(1)").find("input").val().trim(),
                                "factor": !tools.isNumeric($(tr).find("td:eq(2)").find("input").val()) ? 0 : $(tr).find("td:eq(2)").find("input").val().trim()
                            });
                        });
                    }

                    if (imageByte != null) {
                        enviarRegistro(imageByte, listaPrecios);
                    } else {
                        let files = document.getElementById('fileImage').files;
                        if (files.length == 0) {
                            enviarRegistro(null, listaPrecios);
                        } else {
                            let file = files[0];
                            let blob = file.slice();
                            let reader = new FileReader();

                            reader.onloadend = function(evt) {
                                if (evt.target.readyState == FileReader.DONE) {
                                    let base64String = evt.target.result.replace(/^data:.+;base64,/, '');
                                    enviarRegistro(base64String, listaPrecios);
                                }
                            };
                            reader.readAsDataURL(blob);
                        }
                    }
                }
            }

            function enviarRegistro(image, listaPrecios) {
                tools.ModalDialog("Producto", "¿Está seguro de continuar?", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/controller/SuministroController.php",
                            type: 'POST',
                            accepts: "application/json",
                            contentType: "application/json; charset=utf-8",
                            data: JSON.stringify({
                                "type": "updatesuministro",
                                "IdSuministro": idSuministro,
                                "Origen": $("#rbTodoModulos").is(":checked") ? 1 : $("#rbModuloVentas").is(":checked") ? 2 : 3,
                                "Clave": $("#txtClave").val().trim(),
                                "ClaveAlterna": $("#txtClaveAlterna").val().trim(),
                                "NombreMarca": $("#txtDescripcion").val().trim(),
                                "NombreGenerico": $("#txtDescripcionAlterna").val().trim(),

                                "Categoria": idCategoria,
                                "Marca": idMarca,
                                "Presentacion": idPresentacion,
                                "UnidadCompra": idUnidadMedida,
                                "UnidadVenta": $("#rbGranel").is(":checked") ? 3 : $("#rbMoneda").is(":checked") ? 2 : 1,

                                "Estado": $("#rbActivo").is(":checked") ? 1 : 2,
                                "StockMinimo": !tools.isNumeric($("#txtStockMinimo").val().trim()) ? 0 : $("#txtStockMinimo").val().trim(),
                                "StockMaximo": !tools.isNumeric($("#txtStockMaximo").val().trim()) ? 0 : $("#txtStockMaximo").val().trim(),

                                "Impuesto": $("#cbImpuesto").val(),
                                "TipoPrecio": $("#rbPrecioNormal").is(":checked") ? 1 : 0,
                                "PrecioCompra": !tools.isNumeric($("#txtCosto").val()) ? 0 : $("#txtCosto").val().trim(),
                                "PrecioVentaGeneral": $("#rbPrecioNormal").is(":checked") ? !tools.isNumeric($("#txtPrecioGeneral").val().trim()) ? 0 : $("#txtPrecioGeneral").val().trim() : !tools.isNumeric($("#txtPrecioGeneralPersonalizado").val().trim()) ? 0 : $("#txtPrecioGeneralPersonalizado").val().trim(),
                                "Lote": $("#cbLote").is(":checked") ? 1 : 0,
                                "Inventario": $("#cbCosto").is(":checked") ? 1 : 0,

                                "ValorInventario": $("#rbGranelSalida").is(":checked") ? 3 : $("#rbMonedaSalida").is(":checked") ? 2 : 1,
                                "ClaveUnica": $("#txtClaveUnica").val(),
                                "Imagen": image,
                                "ListaPrecios": listaPrecios,
                            }),
                            beforeSend: function() {
                                tools.ModalAlertInfo("Producto", "Se está procesando la información.");
                            },
                            success: function(result) {
                                if (result.estado == 1) {
                                    tools.ModalAlertSuccess("Producto", result.message);
                                    setTimeout(function() {
                                        location.href = "productos.php";
                                    }, 1000);
                                } else if (result.estado == 2) {
                                    tools.ModalAlertWarning("Producto", result.message);
                                } else if (result.estado == 3) {
                                    tools.ModalAlertWarning("Producto", result.message);
                                } else if (result.estado == 4) {
                                    tools.ModalAlertWarning("Producto", result.message);
                                } else {
                                    tools.ModalAlertWarning("Producto", result.message);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Producto", "Se produjo un error: " + error.responseText);
                            }
                        });
                    }
                });
            }

            function removePrecio(idSuministro) {
                $("#" + idSuministro).remove();
            }

            function selectModal(idMantenimiento, IdDetalle, Nombre) {
                if (idMantenimiento == "0013") {
                    $("#idOpciones").modal("hide");
                    $("#tbLista").empty();
                    index = -1;
                    idUnidadMedida = IdDetalle;
                    $("#txtUnidadMedida").val(Nombre);
                    $("#txtUnidadMedida").focus();
                } else if (idMantenimiento == "0006") {
                    $("#idOpciones").modal("hide");
                    $("#tbLista").empty();
                    index = -1;
                    idCategoria = IdDetalle;
                    $("#txtCategoria").val(Nombre);
                    $("#txtCategoria").focus();
                } else if (idMantenimiento == "0007") {
                    $("#idOpciones").modal("hide");
                    $("#tbLista").empty();
                    index = -1;
                    idMarca = IdDetalle;
                    $("#txtMarca").val(Nombre);
                    $("#txtMarca").focus();
                } else if (idMantenimiento == "0008") {
                    $("#idOpciones").modal("hide");
                    $("#tbLista").empty();
                    index = -1;
                    idPresentacion = IdDetalle;
                    $("#txtPresentacion").val(Nombre);
                    $("#txtPresentacion").focus();
                }
            }

            function clearComponents() {
                mantenimiento = "";
                idUnidadMedida = 0;
                idCategoria = 0;
                idMarca = 0;
                idPresentacion = 0;

                imageByte = null;

                $("#txtClave").val("");
                $("#txtClaveAlterna").val("");
                $("#txtDescripcion").val("");
                $("#txtUnidadMedida").val("");
                $("#txtCategoria").val("");
                $("#rbUnidad").prop("checked", true);
                $("#txtCosto").val("");
                $("#txtStockMinimo").val("");
                $("#txtStockMaximo").val("");
                $("#rbUnidadSalida").prop("checked", true);
                $("#cbImpuesto").val("");
                $("#txtPrecioGeneral").val("");
                $("#txtPrecio2").val("");
                $("#txtPrecio3").val("");

                $("#txtDescripcionAlterna").val("");
                $("#txtEstado").val("");
                $("#txtMarca").val("");
                $("#txtPresentacion").val("");
                $("#txtClaveUnica").val("");
                $("#cbLote").prop("checked", false);
                tbPrecios.empty();
            }
        </script>
    </body>

    </html>

<?php

}
