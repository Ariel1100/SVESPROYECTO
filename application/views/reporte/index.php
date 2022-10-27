<!-- <?php
        //if ($this->session->userdata('usuario')) {
        ?> -->

<!---script de confirmacion para delete-->
<script type="text/javascript">


</script>



<?php
//print_r($marcas->result());

?>


<!-- content-->
<div class="row">

<div class="card-content">
    <div class="row ">
        <div class="col-md-2">
            <div class="input-field">
                <input type="date" class="form-control" id="dtpFechaInicio" name="dtpFechaInicio" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
                <label for="email1">Fecha Inicio</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="input-field">
                <input type="date" class="form-control" id="dtpFechaFinal" name="dtpFechaFinal" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
                <label for="email1">Fecha Final</label>
            </div>
        </div>

        <div class="col-md-2">
            <div class="input-field">
                <select class="bootstrap-select" id="cbxTipoReporte" name="cbxTipoReporte">
                    <option value="1">Reporte General de venta</option>
                    <option value="2">Reporte Por Productos</option>
                    <option value="3">Reporte Ventas Anuladas</option>
                </select> 
                <label for="email1"><b>Tipo de Reporte</b></label>
            </div>
        </div>

        <div class="col-md-2">
            <div class="input-field">
                <button class="btn btn-success" id="btnMostrar"  name="btnMostrar"> <i class="fa fa-eye"></i> Mostrar</button>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="input-field">
                <a class="btn btn-primary" id="btnGenerar"  name="btnGenerar"> <i class="fa fa-print"></i> Generar</a>
            </div>
        </div>
    </div>
</div>    

    <div class="col-lg-12">



     <!-- Basic datatable -->
     <div class="panel panel-flat">

        <table class="table datatable-basic" id="file_export">
            
        </table>
        </div>
<!-- /basic datatable -->

    </div>


</div>
<!-- /content -->



<!-- <?php
        //}else{
        //  redirect('login','refresh');
        //}
        ?> -->

<script type="text/javascript">
  var baseurl="<?php echo base_url(); ?>";
</script>