 var paso=0;      
 $(document).ready(function() {
                              $("#codigo_tipo").change(function(){
                                    var opcion=$("#codigo_tipo option:selected").html();
                                    $("#tipoP").val(opcion);
                                  }
                              );
                              $("#Nuevo").click(function(){
                                $(".required").val(" ");
                                $("#tipoP").val("");
                                $("#codigo_tipo").val("");
                                $('#url_save_registro').val('guardarP.php');
                                var form=$("#contenedorform form").attr("id");
                                auto_completar(form);
                                show_message('#contenedorform','auto','auto','Nuevo producto','Guardar','Cancelar','form',null);
                               });
			} );//end ready function
   
function Actualizar(id,pos){
                            var con = id;
			    $.post( "./consultaP.php", { codigoP:  ""+id+""},function(j){
                               var data= jQuery.parseJSON(j);
                               if(data.id){
                                            $('#url_save_registro').val('./actualizarP.php');
                                            $('#codigoProducto').val(data.codigoProducto);
                                            $('#codProductoViejo').val(data.codigoProducto);
                                            $('#nombre').val(data.nombre);
                                            $('#descripcion').val(data.descripcion);
                                            $('#codigo_tipo').val(data.codigo_tipo);
                                            $('#tipoP').val(data.tipo);
                                            $('#pos').val(pos);
                                            show_message('#contenedorform',600,400,'Editar producto','Guardar','Cancelar','form',null,null);
                                           }
                           });
                           
                         }
   

function deleteRow(codigoP,pos){
                                var data={funcion:'delete',codigoP:codigoP,posicion:pos};
                                $("#mensaje").html("<p>"+"Desea eliminar el producto "+codigoP+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar producto','Aceptar','Cancelar','verificar',data);
                               }
                            
//---------------------------------------------------------------------------------------------------------------------------------
  function continuar_process(data){
       //independiente de la opcion seleccionada primero cerramos
       //el formulario de producto y luego el del mensaje
       $("#mensaje").dialog("close");
       var objpasoApaso={destination:"",selector:"",loadView:"",title:"",continuar:false,codP:"",codD:""};
       
       var mybtns=[];
       //paso 1, ejecutamos los detalles tanto de ropa como para perfume-------------------------------------------------------------
      if(data.tipoP=='perfume'){
          objpasoApaso.destination="../detalle_PP/guardarDPP.php";
          objpasoApaso.selector="form#detallePP";
          objpasoApaso.loadView="../detalle_PP/detallePP_view.php #detallePP";
          objpasoApaso.title='Detalle perfume';
          paso=2;
          objpasoApaso.continuar=true;
      }
      else if(data.tipoP=='ropa'){
          objpasoApaso.destination="../detalle_PR/guardarDPR.php";
          objpasoApaso.selector="form#detallePR";
          objpasoApaso.loadView="../detalle_PR/detallePR_view.php #detallePR";
          objpasoApaso.title='Detalle ropa';
          paso=2;
          objpasoApaso.continuar=true;
      }
      ///-----------------------------------------------------------------------------------------------------------------------------------
      //paso2
       else if(data.tipoP=='stock'){
          objpasoApaso.codP=$("#codigoProducto").val(); 
          objpasoApaso.codD=$("#codigoDetallePerfume").val();
          
          if(objpasoApaso.codD!==""){
            objpasoApaso.codD=$("#codigoDetalleRopa").val();
          }
          
          objpasoApaso.destination="guardarStock.php";
          objpasoApaso.selector="form#stock";
          objpasoApaso.loadView="stock_view.php";
          objpasoApaso.title='stock producto';
          paso=3;
          objpasoApaso.continuar=true;
      }
      ///-----------------------------------------------------------------------------------------------------------------------------------
      //paso3
      else if(data.tipoP=="materiaPrima"){
          objpasoApaso.destination="../materia_prima/guardarMP.php";
          objpasoApaso.selector="form#materiaPrima";
          objpasoApaso.loadView="../materia_prima/materiaPrima_view.php #materiaPrima";
          objpasoApaso.title='Materia prima';
          paso=4;
          objpasoApaso.continuar=true;
      }
      ///-----------------------------------------------------------------------------------------------------------------------------------
      //seguimios con el paso 4
      else if(data.tipoP=="proveedor"){
          objpasoApaso.destination="../proveedores/guardarProveedor.php";
          objpasoApaso.selector="form#proveedor";
          objpasoApaso.loadView="../proveedores/proveedores_view.php #proveedor";
          objpasoApaso.title='Proveedores';
          paso=5;
          objpasoApaso.continuar=true;
      }
     ///-----------------------------------------------------------------------------------------------------------------------------------
     //show the load view
      if(objpasoApaso.continuar){
          mybtns=[{text:"guardar",click:function(){$(objpasoApaso.selector).submit();} },
                  {text:"cancelar",click:function(){$(this).dialog("close");}
                  }];
          var options={autoOpen:true,modal:true,width:'auto',height:'auto',title:objpasoApaso.title,buttons:mybtns};
          load_view(options,objpasoApaso.loadView,objpasoApaso.destination,objpasoApaso.selector,objpasoApaso);
      }else{
          $("#mensaje").html("<p>"+"no se encontro un tipo de producto valido para continuar"+"</p>");
          show_message('#mensaje','auto','auto','Error','ok',null,'msj');
      }
  }
  //---------------------------------------------------------------------------------------------------------------------------------
  function load_view(options,loadView,destination,selector,objpasoApaso){
      $("#contenedorform2").dialog(options).load(loadView,function(){ 
          sent_form(destination,selector);
          var form=$("#contenedorform2 form").attr("id");
          //auto complete function
          auto_completar(form);
          //to remove form class
          $("#contenedorform2 form").toggleClass("form");
          //to the stock view--------------------------
          if(objpasoApaso.codP!=""){
              $("#codPstock").val(objpasoApaso.codP);
          }
          if(objpasoApaso.codD!=""){
              $("#codDstock").val(objpasoApaso.codD);
          }
          //--------------------------------------
      });
  }
  //--------------------------------------------------------------------------------------------------------------------------------
  function sent_form(url,selector){
   $(selector).validate({
                     submitHandler:function(){
                         var data=$(selector).serialize();
                         $.ajax({
                             url:url,
                             type:"POST",
                             data:data,
                             success:function(j){
                                 var data=jQuery.parseJSON(j);
                                 if(data.id){
                                     var continuar="";
                                     if(paso==2){continuar="stock"; }
                                     else if(paso==3){continuar="materiaPrima";}
                                     else if(paso==4){continuar="proveedor";}
                                     if(paso!=5){
                                        $("#mensaje").html(data.msj+", desea continuar el proceso?");
                                        show_message('#mensaje','auto','auto','Continuar proceso','Aceptar','Cancelar','verificar',data={tipoP:continuar,funcion:"seguir"});
                                     }else{
                                            $("#mensaje").html("proceso terminado");
                                            show_message('#mensaje','auto','auto','terminado','Aceptar',null,'msj',null);
                                            $("#contenedorform2").dialog("close");
                                          }
                                 }else if(!data.id){
                                     $("#mensaje").html(data.msj);
                                      show_message('#mensaje','auto','auto','Error','Aceptar','Cancelar','msj',null);
                                 }
                             }
                         })
                     }
                });
    
  }
                          
                          
   