<!-- <?php
        //if ($this->session->userdata('usuario')) {
        ?> -->

<!---script de confirmacion para anular la venta-->
<script type="text/javascript">
function deleteConfirm(id) {
    if (confirm('¿Esta realmente segur@ de Anular la venta?')) {
        window.location.href = "venta/delete" + "/" + id;

    }
}
</script>


<?php
//print_r($listaVentas->result());

?>
<!-- content-->

<div class="row">

    <div class="col-lg-12">

        <!-- Tabs -->
        <ul class="nav nav-lg nav-tabs nav-left no-margin no-border-radius   border-top border-top-indigo-100">
            <li class="active">
                <a href="#messages-tue" class="text--smallsize text-uppercase bg-gray-100 text-black" data-toggle="tab">
                    lista
                </a>
            </li>

            <li>

                <button type="button" class="btn bg-gray-100 text-uppercase text-black" data-toggle="modal"
                    data-target="#exampleModal">
                    Agregar Venta
                </button>
                <!-- <a href="#messages-mon" class="text-size-small text-uppercase bg-gray-100" data-toggle="tab">
                    agregar
                </a> -->
            </li>

        </ul>
        <!-- /tabs -->
        <!-- Tabs content -->
        <div class="tab-content">
            <div class="tab-pane active " id="messages-tue">
                <!-- Basic datatable -->
                <div class="panel panel-flat">

                    <table class="table datatable-basic">
                        <thead>
                            <tr>
                                <th>Nº</th>
                                <th>Nombre Cliente</th>
                                <th>Usuario</th>
                                <th>Total</th>
                                <th>Fecha de Venta</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $indice = 1;
                            foreach ($listaVentas->result() as $row) {
                            ?>
                            <tr>
                                <td><?php echo $indice; ?></td>
                                <td><?php echo $row->cNombre.' '.$row->cPA.' '.$row->cSA; ?></td>
                                <td><?php echo $row->eNombre.' '.$row->ePA.' '.$row->eSA; ?></td>
                                <td><?php echo $row->precioTotal; ?></td>
                                <td><?php echo $row->fr; ?></td>

                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a
                                                        href="<?php echo base_url('venta/imprimir') . "/" . $row->idV; ?>"><i
                                                            class="icon-file-pdf"></i> Recibo</a></li>
                                                <li><a href="#" onclick="deleteConfirm(<?php echo $row->idV; ?>)"><i
                                                            class="icon-file-excel"></i> Anular Venta</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <?php
                                $indice++;
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /basic datatable -->
            </div>

            <div class="tab-pane" id="messages-mon">
                <!-- Form horizontal -->
                <div class="panel panel-flat">

                    <div class="panel-body">

                        <form class="form-horizontal" action="" name="FormDatos" id="FormDatos" method="POST">



                            <div class="text-right">
                                <a class="btn btn-primary" id="btnCancelarE" href="<?php echo base_url(); ?>usuario"
                                    type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar
                                    <i class="icon-arrow-right14 position-right"></i></button>

                        </form>
                    </div>
                </div>
                <!-- /form horizontal -->

            </div>



        </div>
        <!-- /tabs content -->

    </div>


</div>
<!-- /content -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:95% !important;height:90% !important; ">
        <div class="modal-content" style="height:95% !important; ">
            <div class="modal-header " style="background-color: #263238;height:90px">
                <h2 class="modal-title text-center text-white " id="exampleModalLabel"
                    style="font-size:50px !important">Generar Venta</h2>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height:100% !important;height:80% !important;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-5 " style="margin-top:50px !important">
                            <div class="row">
                                <div class="col-md-9">

                                    <div class="form-group has-feedback has-feedback-left ">
                                        <input type="text" class="form-control input-lg" placeholder="Cliente"
                                            id="cliente" name="txtFoto" onkeyup="btn_buscar_cliente();"
                                            autocomplete="off">
                                        <div class="form-control-feedback">
                                            <i class="icon-make-group"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <!-- <a href="#"  class="btn btn-primary">Cliente Nuevo</a> -->
                                    <button type="button" class="btn btn-primary mx-auto text-uppercase text-black"
                                        data-toggle="modal" data-target="#modal_form_vertical">
                                        Cliente nuevo
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" class="form-control input-lg" placeholder="liente" id="idCliente"
                                name="txtFoto">
                            <div id="seleccionarCliente"
                                style="padding:10px;text-align:right;position:absolute;background-color:white;z-index:9;top:40px">
                            </div>
                            <div class="container-busqueda"></div>
                            <div class="form-group has-feedback has-feedback-left ">
                                <input type="text" class="form-control input-lg" placeholder="Producto" id="producto"
                                    name="txtFoto" onkeyup="btn_buscar_producto();" autocomplete="off">
                                <div class="form-control-feedback">
                                    <i class="icon-make-group"></i>
                                </div>
                            </div>
                            <div id="seleccionarProducto"
                                style="padding:10px;text-align:right;position:absolute;background-color:white;z-index:9;top:100px">
                            </div>

                            <div class="form-group has-feedback has-feedback-left col-md-3">
                                <p id='txtCantidadProducto' style="margin-bottom:0px">Cantidad</p>
                                <input type="text" class="form-control input-lg" placeholder="Cantidad" id="cantidad"
                                    name="txtFoto" onkeyup="btn_calcular_total();">
                                <div class="form-control-feedback">

                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left col-md-3">
                                Descuento
                                <input type="text" class="form-control input-lg" placeholder="Precio" id="precio"
                                    name="txtFoto" onkeyup="btn_calcular_total();">
                                <div class="form-control-feedback">

                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left col-md-3">
                                Precio Establecido
                                <input type="text" class="form-control input-lg" placeholder="Precio" id="precioNormal"
                                    name="txtFoto" disabled>
                                <div class="form-control-feedback">

                                </div>
                            </div>
                            <div class="form-group has-feedback has-feedback-left col-md-3">
                                Total
                                <input type="text" class="form-control input-lg  " placeholder="Total" id="total"
                                    name="txtFoto" disabled>
                                <div class="form-control-feedback">

                                </div>
                            </div>
                            <input type="hidden" id="idProducto">
                            <div class="col-md-12 mx-auto text-center">
                                <button type="button" onclick="agregarProducto();"
                                    style="margin-top:15px; width:150px; height:50px"
                                    class="btn btn-success mx-auto">Agregar</button>
                            </div>
                        </div>

                        <div class="col-md-6 " style="margin-left:100px !important">
                            <h2 class="text-center ">Lista De Productos</h2>
                            <div id="carritoB" style="height:300px;overflow-y:scroll">

                                <table class="table datatable-basic" id="listaCarrito">
                                    <thead>
                                        <tr>
                                            <th>Nº</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Total</th>

                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- <tr>
                                            <td>dwa</td>
                                            <td>dwa</td>
                                            <td>dwa</td>
                                            <td>wda</td>

                                            <td class="text-center">
                                                <a class="text-white" style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#">X</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>dwa</td>
                                            <td>dwa</td>
                                            <td>dwa</td>
                                            <td>wda</td>

                                            <td class="text-center">
                                                <a class="text-white" style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#">X</a>
                                            </td>
                                        </tr> -->


                                    </tbody>
                                </table>
                            </div>
                            <!-- <input type="text" style="margin-top:10px;"> -->
                            <div class="form-group has-feedback has-feedback-left col-md-3">
                                Total Venta
                                <input type="text" class="form-control input-lg  " placeholder="Total" id="ventasTotal"
                                    name="txtFoto" disabled>
                                <div class="form-control-feedback">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer bg-secondary text-center p-1" style="background-color: #263238; height:100px">
                <button type="button" class="btn btn-info mt-auto" style="margin-top:15px; width:150px; height:50px"
                    data-dismiss="modal" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar Venta</button>
                <button class="btn btn-success" onclick="envioCarrito()"
                    style="margin-top:15px; width:150px; height:50px">Generar Venta <i
                        class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
</div>


<!-- Vertical form modal -->
<div id="modal_form_vertical" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Ingrese los Datos del Cliente</h5>
            </div>

            <div class="card-body md-5">


                <fieldset class="content-group">
                    <div class="form-group">
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group has-feedback has-feedback-left">
                                        <input type="text" class="form-control input-xlg" placeholder="nombres"
                                            id="txtNombres" name="txtNombres">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-lock"></i>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback has-feedback-left">
                                        <input type="text" class="form-control input-lg" placeholder="Apellido Paterno"
                                            id="txtPrimerApellido" name="txtPrimerApellido">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check"></i>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback has-feedback-left">
                                        <input type="text" class="form-control input-lg" placeholder="Apellido Materno"
                                            id="txtSegundoApellido" name="txtSegundoApellido">
                                        <div class="form-control-feedback">
                                            <i class="icon-user-check"></i>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback has-feedback-left">
                                        <input type="alpha-numeric" class="form-control" placeholder="Numero de carnet"
                                            id="txtCarnetIdentidad" name="txtCarnetIdentidad">
                                        <div class="form-control-feedback">
                                            <i class="icon-grid52"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback has-feedback-left">
                                        <input type="date" class="form-control input-lg" placeholder="Fecha Nacimiento"
                                            id="txtFechaNacimiento" name="txtFechaNacimiento">
                                        <div class="form-control-feedback">
                                            <i class="icon-calendar52"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback has-feedback-left">
                                        <input type="text" class="form-control input-lg" placeholder="Sexo" id="txtSexo"
                                            name="txtSexo">
                                        <div class="form-control-feedback">
                                            <i class="icon-spam"></i>
                                        </div>
                                    </div>

                                    <div class="form-group has-feedback has-feedback-left">
                                        <input type="number" class="form-control" placeholder="Numero de telefono"
                                            id="txtTelefono" name="txtTelefono">
                                        <div class="form-control-feedback">
                                            <i class="icon-phone-plus"></i>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback has-feedback-left">
                                        <input type="number" class="form-control" placeholder="Nro. nit del cliente"
                                            id="txtNit" name="txtNit">
                                        <div class="form-control-feedback">
                                            <i class="icon-calculator4"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </fieldset>

                <div class="text-right">
                    <a class="btn btn-danger" type="button" class="close" data-dismiss="modal" name="action"><i
                            class="fa fa-arrow-circle-left"></i> Cancelar</a>
                    <!-- <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar
                        <i class="icon-arrow-right14 position-right"></i></button> -->
                    <button class="btn btn-primary" onclick="registrarCliente()" name="action">Generar Cliente <i
                            class="icon-arrow-right14 position-right"></i></button>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- /vertical form modal -->


<!-- <?php
        //}else{
        //  redirect('login','refresh');
        //}
        ?> -->