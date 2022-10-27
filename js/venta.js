

const listaCarrito = document.querySelector('#listaCarrito tbody');
const carritoB = document.querySelector('#carritoB');
let carrito = [];


carritoB.addEventListener('click',eliminarProducto);
function agregarProducto(){
     const precio = $('#precio').val();
     const producto = $('#producto').val();
     const total = $('#total').val();
     const cantidad = $('#cantidad').val();
     //console.log(cantidad);
     const idProducto = $('#idProducto').val();

     if(cliente.length == 0 || producto.length == 0 || total == 0 || cantidad == 0|| precio == 0 ){
          //console.log("Todos los campos son obligatorios");
          return;
      }
      const carritoObj ={
          idCarrito : idProducto,
          producto,
          cantidad,
          precio,
          total,
      }
     
      carrito = [...carrito, carritoObj];

      const Iprecio = document.querySelector('#precio');
      const Iproducto = document.querySelector('#producto');
      const Itotal = document.querySelector('#total');
      const Icantidad = document.querySelector('#cantidad');
      const prec = document.querySelector('#precioNormal');
      const txtCantidadProducto = document.querySelector('#txtCantidadProducto');
      const IidProducto = document.querySelector('#idProducto');
      const ventasTotal = document.querySelector('#ventasTotal');
      const tt = carrito.reduce((t,producto)=>t+Number(producto.total),0);
      ventasTotal.value= tt;
      txtCantidadProducto.textContent = 'Cantidad';
       Iprecio.value='';
       IidProducto.value='';
       prec.value='';
       Iproducto.value='';
       Itotal.value='';
       Icantidad.value='';
      
          //   $.ajax({
          //      el protocolo
          //      type: "POST",
          //      a donde quiero mandar el objeto
          //      url: 'venta/reducirStock',    
          //      data: carritoObj,

          //      que quieres mostrar como recargable al iniciar
          //      beforeSend: function(objeto){
               
          //      },

          //      al finalizar
          //      success: function(data)
          //      {

               
          //      }
          // });
      crearHTML();
}
function crearHTML(){
     let i=1;
     limpiarHTML();
     if(carrito.length>0){
         carrito.forEach(prod=>{
          const {cantidad,precio,total,producto, idCarrito} = prod;
          const row = document.createElement('tr');
          row.innerHTML = `
               <td>${i}</td>
               <td>${producto}</td>
               <td>${cantidad}</td>
               <td>${precio}</td>
               <td>${total}</td>

               <td class="text-center">
                    <a class="borrar-producto text-white" data-id='${idCarrito}' style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#">X</a>
               </td>
          `;
              listaCarrito.appendChild(row);
              i++;
          })
     }
}
function eliminarProducto(e){
    //console.log('funciona');
     if(e.target.classList.contains('borrar-producto')){
          const id = e.target.getAttribute('data-id');
          //console.log(id);
         const cursos = carrito.filter(c => c.idCarrito != id );
         //console.log(cursos);
         carrito = [...cursos];
         crearHTML();
     }
 
 }

function limpiarHTML(){
     while(listaCarrito.firstChild){
         listaCarrito.removeChild(listaCarrito.firstChild);
     }
}

function btn_buscar_cliente()
{
     // console.log();
     const cerrar = document.querySelector('#seleccionarCliente');
     cerrar.style.display='inline';

    var palabra = $("#cliente").val();
    //console.log(palabra);
    var obj= {palabra};

        $.ajax({
                    //el protocolo
                    type: "POST",
                    //a donde quiero mandar el objeto
                    url: 'venta/buscar_en_bd_cliente',    
                    data: obj,
    
                    //que quieres mostrar como recargable al iniciar
                    beforeSend: function(objeto){
                        
                    },
    
                    //al finalizar
                    success: function(data)
                    {
                        $("#seleccionarCliente").html(data);

                       
                    }
                });
}
function btn_buscar_producto()
{
     // console.log();
     const cerrar = document.querySelector('#seleccionarProducto');
     cerrar.style.display='inline';

    var palabraProducto = $("#producto").val();
    //console.log(palabraProducto);
    var obje= {palabraProducto};

        $.ajax({
                    //el protocolo
                    type: "POST",
                    //a donde quiero mandar el objeto
                    url: 'venta/buscar_en_bd_producto',    
                    data: obje,
    
                    //que quieres mostrar como recargable al iniciar
                    beforeSend: function(objeto){
                        
                    },
    
                    //al finalizar
                    success: function(data)
                    {
                        $("#seleccionarProducto").html(data);

                       
                    }
                });
}

function btn_cerrar(){
     const cerrar = document.querySelector('#seleccionarCliente');
     cerrar.style.display='none';
}
function btn_cerrar_producto(){
     const cerrar = document.querySelector('#seleccionarProducto');
     cerrar.style.display='none';
}

function agregarClienteInput(id,nombre,nit){
     const cliente = document.querySelector('#cliente');
     const idCliente = document.querySelector('#idCliente');
     idCliente.value = id;
     cliente.value = `${nombre} - ${nit}`;
     btn_cerrar();
     // const producto = $('#producto').val();
}

function agregarProductoInput(id,productoNombre,precio,codigo,stock){
     const producto = document.querySelector('#producto');
     const precioNormal = document.querySelector('#precioNormal');
     const txtCantidadProducto = document.querySelector('#txtCantidadProducto');
     const idProducto = document.querySelector('#idProducto');
     precioNormal.value = precio;

     idProducto.value=id;


     txtCantidadProducto.textContent=`Cantidad: ${stock}`



     const precioD = document.querySelector('#precio');
     precioD.value = precio;

     producto.value = `${productoNombre} - ${codigo}`;
     btn_cerrar_producto();
     // const producto = $('#producto').val();
}

function btn_calcular_total(){
     total.value="";
     const cant = document.querySelector('#cantidad').value;
     var stockActual=$("#txtCantidadProducto").text();
     var stockActual1=stockActual.split(" ");
     var stockActual2=parseInt(stockActual1[1])
     //console.log(stockActual1[1]);
     if(stockActual2>=cant){
     const p = document.querySelector('#precio').value;
     const total = document.querySelector('#total');
     total.value=`${cant*p}`;
     }else{
          alert("Stock insuficiente");
     }
     



}


function envioCarrito() {
     const ventasTota = document.querySelector('#ventasTotal').value;
     const idCliente = document.querySelector('#idCliente').value;
     var obj = {
          arreglo:JSON.stringify(carrito),
          ventasTotal:ventasTota,
          idCliente,
     };
     //console.log(obj);
     $.ajax({
          type: "POST",
          url:'venta/carrito',
          data:obj,
          beforeSend:function(){
               setTimeout(()=>{ 
                    window.location.reload()
               },2000)
          },
          success: function(data){
               // console.log(data);
               //window.location.href=`http://localhost/incos/2022/web2/SVES1/venta/imprimir/${data}`;



               window.open(
                    `http://localhost/incos/2022/web2/SVES1/venta/imprimir/${data}`,
                    '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
                  );
                window.location.href = "venta";



               
          }
     })
}


// $(document).ready(function()
// {
// //alert('gsdgdfgdfg');

// $('#btnGuardar').click(function(){

//  	var  formData=$('#FormDatos').serialize();
     
//      return false;

//      $.ajax({
//           type: "POST",
//           url: "usuario/insert",
//           data: formData,
//           success: function(r){

//           }
//      });

//           return false; // elimina que la pagina se recargue
// 	});

// });


function registrarCliente(){

     
     var nombres= $('#txtNombres').val();
     var primerApellido= $('#txtPrimerApellido').val();
     var segundoApellido= $('#txtSegundoApellido').val();
     var carnetIdentidad= $('#txtCarnetIdentidad').val();
     var fechaNacimiento= $('#txtFechaNacimiento').val();
     var sexo= $('#txtSexo').val();
     var telefono= $('#txtTelefono').val();
     var nit= $('#txtNit').val();
     

var datos = {
     "nombres":nombres,
     "primerApellido":primerApellido,
     "segundoApellido":segundoApellido,
     "carnetIdentidad":carnetIdentidad,
     "fechaNacimiento":fechaNacimiento,
     "sexo":sexo,
     "telefono":telefono,
     "nit":nit,

};

//var data={nombres,primerApellido,segundoApellido,carnetIdentidad,fechaNacimiento,sexo,telefono,nit}

//console.log(data);


$.ajax({
     url: 'cliente/insert1',
     type: 'POST',
     data:{nombres:nombres,primerApellido:primerApellido,segundoApellido:segundoApellido,carnetIdentidad:carnetIdentidad,fechaNacimiento:fechaNacimiento,sexo:sexo,telefono:telefono,nit:nit}
   }).done(function(data){
   
   //alert(data);
   $("#modal_form_vertical").modal('hide');   
   });



     }



  