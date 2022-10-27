$(document).ready(function()
{

$('#btnMostrar').click(function(){
    var tipoRepor = $('#cbxTipoReporte').val();
	//var fechaInicio = $('#dtpFechaInicio').val();
 	//var fechaFinal = $('#dtpFechaFinal').val();
//alert(fechaInicio);
		if (tipoRepor==1)
          {
            // aqui reporte global
          	$.post(
            	baseurl+"reportep/reporfechas",
            	function(data)
            	{;
                    //var montoTotal=0;
                    alert(data);
            		var cont=0;

            		var da=JSON.parse(data);
            		$('#file_export').empty();

                        var thead="<thead>"+
                                    "<tr>"+
                                        "<th>"+'Nro'+"</th>"+
                                        "<th>"+'Producto'+"</th>"+
                                        "<th>"+'Cantidad'+"</th>"+
                                        "<th>"+'Precio Venta'+"</th>"+
                                        "<th>"+'Categoria'+"</th>"+
                                        "<th>"+'Marca'+"</th>"+
                                    "</tr>"+
                                  "</thead>"+
                                    "<tbody>"+
                                                         
                                                        
                                    "</tbody>";

                    $('#file_export').append(thead);

            		$.each(da,function(i,item){
            			cont++;
            		var row = "<tr>" +
				                "<td >" + cont + "</td>" +
                                "<td >" + item.nombreProducto + "</td>" +
				                "<td >" + item.stock + "</td>" +
                                "<td >" + item.precioNormal + "</td>" +
				                "<td >" + item.nombreCategoria + "</td>" +
				                "<td >" + item.nombreMarca + "</td>" +
				               "</tr>";
            		$('#file_export > tbody').append(row);
            		// id en index example1 para que aparesca funciones de jquery de la
            		})
                    //$('#total').val(montoTotal);
            	}

            	)

          }else if(tipoRepor==2){
            // aqui reporte por articulos
            $.post(
                baseurl+"reporte/reporXproductos",
                {
                    "fechaInicio":fechaInicio,
                    "fechaFinal":fechaFinal
                },
                function(data)
                {;
                    //alert(data);
                    var cont=0;
                    var da=JSON.parse(data);
                    $('#file_export').empty();

                        var thead="<thead>"+
                                    "<tr>"+
                                        "<th>"+'Nro'+"</th>"+
                                        "<th>"+'Producto'+"</th>"+
                                        "<th>"+'Cantidad Vendida'+"</th>"+
                                        "<th>"+'Sub Total '+"</th>"+
                                        
                                    "</tr>"+
                                  "</thead>"+
                                    "<tbody>"+
                                                         
                                                        
                                    "</tbody>";

                    $('#file_export').append(thead);

                    $.each(da,function(i,item){
                        cont++;
                    var row = "<tr>" +
                                "<td >" + cont + "</td>" +
                                "<td >" + item.producto + "</td>" +
                                "<td >" + item.cantidad + "</td>" +
                                "<td >" + item.subTotal + "</td>" +
                         
                               "</tr>";
                    $('#file_export > tbody').append(row);
                    // id en index example1 para que aparesca funciones de jquery de la
                    })
                    //$('#total').val(montoTotal);
                }

                )
          }else{
                // aqui reporte por articulos
                $.post(
                    baseurl+"reporte/reporteAnulados",
                    {
                        "fechaInicio":fechaInicio,
                        "fechaFinal":fechaFinal
                    },
                    function(data)
                    {;
                        //alert(data);
                        var cont=0;
                        var da=JSON.parse(data);
                        $('#file_export').empty();
    
                            var thead="<thead>"+
                                        "<tr>"+
                                            "<th>"+'Nro'+"</th>"+
                                            "<th>"+'Producto'+"</th>"+
                                            "<th>"+'Cantidad Vendida'+"</th>"+
                                            "<th>"+'Sub Total '+"</th>"+
                                            
                                        "</tr>"+
                                      "</thead>"+
                                        "<tbody>"+
                                                             
                                                            
                                        "</tbody>";
    
                        $('#file_export').append(thead);
    
                        $.each(da,function(i,item){
                            cont++;
                        var row = "<tr>" +
                                    "<td >" + cont + "</td>" +
                                    "<td >" + item.producto + "</td>" +
                                    "<td >" + item.cantidad + "</td>" +
                                    "<td >" + item.subTotal + "</td>" +
                             
                                   "</tr>";
                        $('#file_export > tbody').append(row);
                        // id en index example1 para que aparesca funciones de jquery de la
                        })
                        //$('#total').val(montoTotal);
                    }
    
                    )
          }


	});

// generar reporte

$('#btnGenerar').click(function(){
    var tipoRepor = $('#cbxTipoReporte').val();
	//var fechaInicio = $('#dtpFechaInicio').val();
 	//var fechaFinal = $('#dtpFechaFinal').val();

    //alert(tipoRepor+fechaInicio+fechaFinal);

    if (tipoRepor==1) {
        window.open(
                'reportep/reporteGlobalPDF',
                '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
              );
        //window.location.href = "reportes/reporteGlobalPDF"+"/"+fechaInicio+"/"+fechaFinal;
    }else if(tipoRepor==2){
        window.open(
                'reporte/reporteXarticulosPDF'+'/'+fechaInicio+'/'+fechaFinal,
                '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
              );
        //window.location.href = "reportes/reporteXarticulosPDF"+"/"+fechaInicio+"/"+fechaFinal;
    }else{
        window.open(
            'reporte/reporteAnuladasPDF'+'/'+fechaInicio+'/'+fechaFinal,
            '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
          );
    }

    
    


});




});