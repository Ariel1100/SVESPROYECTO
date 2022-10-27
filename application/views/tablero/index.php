<!-- <?php
        //if ($this->session->userdata('usuario')) {
        ?> -->

<?php

//print_r($totalVentasMes);
//print_r($totalVentasDia);

if (isset($totalVentasDia)) {
    $t=$totalVentasDia[0];
    $totalVentaDia=$t->totalVentaDia;
}else{
    $totalVentaDia=0;
}

if (isset($totalVentasMes)) {
    $t=$totalVentasMes[0];
    $totalmes=$t->totalmes;
}else{
    $totalmes=0;
}



// if (isset($capitalTarjetas)) {
//     $c=$capitalTarjetas[0];
//     $capitalTarjetas=$c->capitalTarjetas;
// }else{
//     $capitalTarjetas=0;
// }


// if (isset($capitalPrincipal)) {
//     $cp=$capitalPrincipal[0];
//     $capitalPrincipal=$cp->montoCapital;
// }else{
//     $capitalPrincipal=0;
// }

// if (isset($totalCredito)) {
//     $tc=$totalCredito[0];
//     $totalCredito=$tc->montoCredito;
// }else{
//     $totalCredito=0;
// }

// $efectivoCaja=$capitalPrincipal-$capitalTarjetas-$totalCredito;

?>

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


<!-- content-->
<div class="row">

    <div class="col-lg-12">

        <!-- Quick stats boxes -->
        <div class="row">
            <div class="col-lg-4">

                <!-- Members online -->
                <div class="panel bg-teal-400">
                    <div class="panel-body">
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>

                        <h3 class="no-margin"><?php echo $producto->num_rows(); ?></h3>
                        Productos disponibles
                        <div class="text-muted text-size-small">Todos los productos disponibles en galeria</div>
                    </div>

                    <div class="container-fluid">
                        <div id="members-online"></div>
                    </div>
                </div>
                <!-- /members online -->

            </div>

            <div class="col-lg-4">

                <!-- Current server load -->
                <div class="panel bg-pink-400">
                    <div class="panel-body">
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <!-- <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="#"><i class="icon-sync"></i> Update data</a></li>
                                        <li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
                                        <li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
                                        <li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
                                    </ul>
                                </li> -->
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>

                        <h3 class="no-margin"><?php echo $totalVentaDia ?></h3>
                        Total ventas dìa
                        <div class="text-muted text-size-small">.</div>
                    </div>

                    <div id="server-load"></div>
                </div>
                <!-- /current server load -->

            </div>

            <div class="col-lg-4">

                <!-- Today's revenue -->
                <div class="panel bg-blue-400">
                    <div class="panel-body">
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>

                        <h3 class="no-margin"><?php echo $totalmes ?></h3>
                        Total ventas mensuales
                        <div class="text-muted text-size-small">Solo los administradores</div>
                    </div>

                    <div id="today-revenue"></div>
                </div>
                <!-- /today's revenue -->

            </div>
        </div>
        <!-- /quick stats boxes -->

        <div class="row">
            <div class="col-lg-8">

                <!-- Traffic sources -->
                <div class="panel panel-flat">
                    <div class="container-fluid">
                        <br>
                        <div class="text-center">
                            <h6 class="no-margin text-semibold">SELECTRONIK-SEGURIDAD</h6>
                            <p class="mb-15 text-muted">Empresa distribuidora de venta de sistemas de seguridad</p>
                        </div>
                    </div>
                    <div class="text-center">

                        <img class="img-fluid rounded w-30" src="<?php echo base_url()?>img/logo2.jpeg">

                    </div>
                    <br>
                </div>
                <!-- /traffic sources -->
            </div>

            <div class="col-lg-4">

                <!-- Traffic sources -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Fuentes de Tráfico</h6>
                        <div class="heading-elements">
                            <form class="heading-form" action="#">
                                <div class="form-group">
                                    <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs">
                                        <input type="checkbox" class="switch" checked="checked">
                                        en Linea:
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                <ul class="list-inline text-center">
                                    <li>
                                        <a href="#"
                                            class="btn border-teal text-teal btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"
                                            data-toggle="modal" data-target="#exampleModal"><i
                                                class="icon-plus3"></i></a>
                                    </li>
                                    <li class="text-left">
                                        <div class="text-semibold">Generar Venta</div>
                                        <div class="text-muted">...</div>
                                    </li>
                                </ul>

                                <div class="col-lg-10 col-lg-offset-1">
                                    <div class="content-group" id="new-visitors"></div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <ul class="list-inline text-center">
                                    <li>
                                        <a href="#"
                                            class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                                class="icon-watch2"></i></a>
                                    </li>
                                    <li class="text-left">
                                        <div class="text-semibold">Rep. por fecha</div>
                                        <div class="text-muted">08:20 avg</div>
                                    </li>
                                </ul>

                                <div class="col-lg-10 col-lg-offset-1">
                                    <div class="content-group" id="new-sessions"></div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <ul class="list-inline text-center">
                                    <li>
                                        <a href="#"
                                            class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                                class="icon-people"></i></a>
                                    </li>
                                    <li class="text-left">
                                        <div class="text-semibold">Total ventas</div>
                                        <div class="text-muted"><span
                                                class="status-mark border-success position-left"></span> 5,378 avg</div>
                                    </li>
                                </ul>

                                <div class="col-lg-10 col-lg-offset-1">
                                    <div class="content-group" id="total-online"></div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <!-- <thead>
											<tr>
												<th>Campaign</th>
												<th class="col-md-2">Client</th>
												<th class="col-md-2">Changes</th>
												<th class="col-md-2">Budget</th>
												<th class="col-md-2">Status</th>
												<th class="text-center" style="width: 20px;"><i class="icon-arrow-down12"></i></th>
											</tr>
										</thead> -->
                            <tbody>
                                <tr class="active border-double text-black">
                                    <td colspan="5">Redes Sociales</td>
                                    <td class="text-right">
                                        <span class="progress-meter" id="today-progress" data-progress="30"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="media-left media-middle">
                                            <a href="#"><img src="<?php echo base_url()?>img/facebook.png"
                                                    class="img-circle img-xs" alt=""></a>
                                        </div>
                                        <div class="media-left">
                                            <div class=""><a href="#" class="text-default text-semibold">Facebook</a>
                                            </div>
                                            <div class="text-muted text-size-small">
                                                <span class="status-mark border-blue position-left"></span>
                                                24Hrs.
                                            </div>
                                        </div>
                                    </td>

                                    <td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i>
                                            2.43%</span></td>

                                    <td><span class="label bg-blue">Activado</span></td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="#"><i class="icon-file-text2"></i> Editar correo</a>
                                                    </li>
                                                    <li><a href="#"><i class="icon-file-locked"></i> Deshabilitar</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><i class="icon-gear"></i> Ajustes</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="media-left media-middle">
                                            <a href="#"><img src="<?php echo base_url()?>img/youtube.png"
                                                    class="img-circle img-xs" alt=""></a>
                                        </div>
                                        <div class="media-left">
                                            <div class=""><a href="#" class="text-default text-semibold">Videos en
                                                    Youtube</a></div>
                                            <div class="text-muted text-size-small">
                                                <span class="status-mark border-danger position-left"></span>
                                                13:00 - 17:00
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i>
                                            3.12%</span></td>

                                    <td><span class="label bg-danger">Inactivo</span></td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="#"><i class="icon-file-text2"></i> Editar correo</a>
                                                    </li>
                                                    <li><a href="#"><i class="icon-file-locked"></i> Deshabilitar</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><i class="icon-gear"></i> Ajustes</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="media-left media-middle">
                                            <a href="#"><img src="<?php echo base_url()?>img/twitter.png"
                                                    class="img-circle img-xs" alt=""></a>
                                        </div>
                                        <div class="media-left">
                                            <div class=""><a href="#" class="text-default text-semibold">Anuncios en
                                                    Twitter</a>
                                            </div>
                                            <div class="text-muted text-size-small">
                                                <span class="status-mark border-grey-400 position-left"></span>
                                                08:00 - 12:00
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="text-success-600"><i class="icon-stats-growth2 position-left"></i>
                                            2.78%</span></td>
                                    <td><span class="label bg-blue">Activado</span></td>
                                    <td class="text-center">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                                        class="icon-menu7"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="#"><i class="icon-file-text2"></i> Editar Cuenta</a>
                                                    </li>
                                                    <li><a href="#"><i class="icon-file-locked"></i> Deshabilitar</a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><i class="icon-gear"></i> Ajustes</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>


                            </tbody>
                        </table>
                    </div>

                </div>


                <!-- /today's revenue -->

            </div>
        </div>

    </div>

</div>

<!-- /content -->





<!-- <?php
        //}else{
        //  redirect('login','refresh');
        //}
        ?> -->