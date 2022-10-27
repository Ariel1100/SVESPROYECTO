<!-- <?php
        //if ($this->session->userdata('usuario')) {
        ?> -->

<!---script de confirmacion para delete-->
<script type="text/javascript">
function deleteConfirm(id) {
    if (confirm('¿Esta realmente segur@ de Eliminar?')) {
        window.location.href = "producto/delete" + "/" + id;

    }
}

function verMas(id) {
    //alert(id);


    //var idDiamante = selectObject.value;
    // var idDiamante = $("#cbxDiamante").val();
    // var cantidad = $("#cbxCantidad").val();
    //alert(cantidad);

    $.ajax({
        url: 'producto/getProducto',
        type: 'POST',
        data: {
            id: id
        }
    }).done(function(data) {
        //alert(data);
        $("#modal_form_vertical").modal('show');
        var reg = eval(data);

        for (var i = 0; i < reg.length; i++) {

            var ruta = '<?php echo base_url();?>' + reg[i]['foto'];
            var img = document.createElement('img');
            img.setAttribute("src", ruta);
            img.setAttribute("width", "120");
            img.setAttribute("height", "150");
            $("#ContenedorImg").empty();
            document.getElementById("ContenedorImg").appendChild(img);

            $('#lblNombreProducto').html(reg[i]['nombreProducto']);
            // aqui ingresar demas datos
            $('#lblCodigo').html(reg[i]['codigo']);
            $('#lblDescripcion').html(reg[i]['descripcion']);
        }

    });
    return false;



}
</script>



<?php
//print_r($marcas->result());

?>


<!-- Vertical form modal -->
<div id="modal_form_vertical" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Datos del Producto</h5>
            </div>

            <form action="#">
                <div class="modal-body">
                    <div class="card">
                        <div id="ContenedorImg" name="ContenedorImg"></div>
                        <h1 id="lblNombreProducto" name="lblNombreProducto"></h1>
                        <h3 id="lblCodigo" name="lblCodigo"></h3>
                        <h3 id="lblDescripcion" name="lblDescripcion"></h3>
                        <p class="title">Sistemas Informaticos</p>
                        <p>INCOS Nocturno</p>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /vertical form modal -->

<!-- content-->
<div class="row">

    <div class="col-lg-12">

        <!-- Tabs -->
        <ul class="nav nav-lg nav-tabs nav-left no-margin no-border-radius   border-top border-top-indigo-100">
            <li class="active">
                <a href="#messages-tue" class="text-size-small text-uppercase text-black bg-gray-100" data-toggle="tab">
                    lista productos
                </a>
            </li>

            <li>
                <a href="#messages-mon" class="text-size-small text-uppercase text-black bg-gray-100" data-toggle="tab">
                    agregar producto
                </a>
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
                                <th>Codigo</th>
                                <th>Foto</th>
                                <th>Nombre Producto</th>
                                <th>Precio Normal</th>
                                <th>Stock</th>
                                <th>Categoria</th>
                                <th>Marca</th>
                                <th>Descripción</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $indice=1;
                            foreach($producto->result() as $row){
                             ?>
                            <tr>
                                <td><?php echo $indice;?></td>
                                <td><?php echo $row->codigo;?></td>
                                <td>
                                    <div class="u-img"><img src="<?php echo base_url();?><?php echo $row->foto;?>"
                                            width="75" height="75" alt="user"></div>
                                </td>
                                <td><?php echo $row->nombreProducto;?></td>
                                <td><?php echo $row->precioNormal;?></td>
                                <td><?php echo $row->stock;?></td>
                                <td><?php echo $row->nombreCategoria;?></td>
                                <td><?php echo $row->nombreMarca;?></td>
                                <td><?php echo $row->descripcion;?></td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a
                                                        href="<?php echo base_url('producto/edit')."/".$row->idProducto; ?>"><i
                                                            class="icon-file-text2"></i> Modificar</a></li>
                                                <?php if($this->session->userdata('tipo')=='1'){?>
                                                            <li><a href="#"
                                                        onclick="deleteConfirm(<?php echo $row->idProducto; ?>)"><i
                                                            class="icon-file-excel"></i> Eliminar</a></li> <?php } ?>
                                                <li><a href="#" onclick="verMas(<?php echo $row->idProducto; ?>)"><i
                                                            class="icon-eye"></i> Ver Mas...</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <?php 
                            $indice++;
                        }?>
                        
                        </tbody>

                    </table>
                </div>
                <!-- /basic datatable -->
            </div>

            <div class="tab-pane" id="messages-mon">
                <!-- Form horizontal -->
                <div class="panel panel-flat">

                    <div class="panel-body">

                        <form class="form-horizontal" action="producto/insert" name="FormDatos" id="FormDatos"
                            method="POST" enctype="multipart/form-data">

                            <fieldset class="content-group">
                                <div class="form-group">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback has-feedback-left">
                                                    <input type="text" class="form-control input-xlg"
                                                        placeholder="Código" id="txtCodigo" name="txtCodigo" required>
                                                    <div class="form-control-feedback">
                                                        <i class="icon-code"></i> 
                                                    </div>
                                                </div>

                                                <div class="form-group has-feedback has-feedback-left">
                                                    <input type="text" class="form-control input-lg"
                                                        placeholder="Nombre del producto" id="txtNombreProducto"
                                                        name="txtNombreProducto" required>
                                                    <div class="form-control-feedback">
                                                        <i class="icon-cube4"></i>
                                                    </div>
                                                </div>

                                                <div class="form-group has-feedback has-feedback-left">
                                                    <input type="number" class="form-control"
                                                        placeholder="Precio Normal" id="txtPrecioNormal"
                                                        name="txtPrecioNormal" required>
                                                    <div class="form-control-feedback">
                                                        <i class="icon-coin-dollar"></i>
                                                    </div>
                                                </div>

                                                <div class="form-group has-feedback has-feedback-left">
                                                    <input type="text" class="form-control input-xs" placeholder="Stock"
                                                        id="txtStock" name="txtStock" required>
                                                    <div class="form-control-feedback">
                                                        <i class="icon-flip-vertical3"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <!-- Default select -->

                                                <div class="form-group">
                                                    <label>Categoria</label>
                                                    <select class="bootstrap-select" data-width="100%" id="cbxCategoria"
                                                        name="cbxCategoria">
                                                        <?php 
                                                        foreach($categorias->result() as $row){
                                                        ?>
                                                        <option value="<?php echo $row->idCategoria;?>">
                                                            <?php echo $row->nombreCategoria;?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- /default select -->


                                                <!-- Default select -->

                                                <div class="form-group">
                                                    <label>Marca</label>
                                                    <select class="bootstrap-select" data-width="100%" id="cbxMarca"
                                                        name="cbxMarca">
                                                        <?php 
                                                        foreach($marcas->result() as $row){
                                                        ?>
                                                        <option value="<?php echo $row->idMarca;?>">
                                                            <?php echo $row->nombreMarca;?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <!-- /default select -->


                                                <div class="form-group has-feedback">
                                                    <input type="text" class="form-control input-xs"
                                                        placeholder="Descripcion" id="txtDescripcion"
                                                        name="txtDescripcion">
                                                    <div class="form-control-feedback">
                                                        <i class="icon-file-openoffice"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback has-feedback-left">
                                            <div class="bootstrap-select">
                                                <span>Foto</span>
                                                <input type="file" id="imagen" name="imagen">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" name="txtImagen"
                                                    id="txtImagen">
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </fieldset>

                            <div class="text-right">
                                <a class="btn btn-info" id="btnCancelarE" href="<?php echo base_url();?>producto"
                                    type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar</a>
                                <button type="submit" class="btn btn-success" id="btnGuardar" name="btnGuardar">Guardar
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



<!-- <?php
        //}else{
        //  redirect('login','refresh');
        //}
        ?> -->