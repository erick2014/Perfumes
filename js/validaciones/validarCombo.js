        var num=0;
        $(document).ready(function() {
                  $("#Nuevo").click(function(){
                    $('#url_save_registro').val('guardarCombo.php');
                    show_message('#contenedorform','auto','auto','Nuevo combo','Guardar','Cancelar','form',null,null);
                   });

                  $("#contenedorform").delegate( "#add", "click", function() {
                      num++;
                      var row="";
                          
                          row+="<tr id='row"+num+"'><td>Producto</td><td><input name='nombreProducto["+num+"]' alt='codrow"+num+"' class='required buscar' />";
                          row+="<input type='hidden' name='codigoProducto["+num+"]' id='codrow"+num+"' class='required buscar' /></td>";
                        
                          row+="<td>Detalle</td><td><input name='nombreDetalle["+num+"]' alt='codDerow"+num+"' class='required buscar2'/>";
                          row+="<input type='hidden' name='codigoDetalle["+num+"]' id='codDerow"+num+"' />";
                          row+="<td><input type='button' class='del' id='row"+num+"' value='X' /></td></tr>";
                      $(row).appendTo("#tablabox #tbodybox");

                  });
                  
                   $("#contenedorform").delegate( ".del", "click", function() {
                       var id=$(this).attr('id');
                       $("#tablabox #tbodybox #"+id).remove();
                       num--;
                   });

         $(".form").delegate(".buscar","focusin",function(){
                            $(this).autocomplete({
                                source: function(request,response){
                                    $.ajax({
                                       type:"POST",
                                       url:"../clases/autoCompletar.php",
                                       dataType:"json",
                                       data:{term:request.term},
                                       success:function(data){response(data);}
                                    });
                                },
                                minLength: 1,
                                select: productoSeleccionado
                                
                             });
                             
          });//end autocomplete
          
                      
   });//end document ready
  
 function productoSeleccionado(event, ui)
 {
  var producto = ui.item.value;
  $(this).val(producto.nombre);
  var codP=$(this).attr("alt");
  $("#"+codP).val(producto.codigoProducto);
  event.preventDefault();
  llenarDetalle(producto.codigoProducto,producto.tipo);
 }  
 function productoSeleccionado2(event, ui)
{
  var detalle = ui.item.value;
  $(this).val(detalle.fragancia);
  var alt=$(this).attr("alt");
  $("#"+alt).val(detalle.codigoDetalle);
  event.preventDefault();
}

function llenarDetalle(param,param2){
                              $(".buscar2").autocomplete({
                                            source: function(request,response){
                                                $.ajax({
                                                   type:"POST",
                                                   url:"../clases/autoCompletar.php",
                                                   dataType:"json",
                                                   data:{search:param,tipo:param2},
                                                   success:function(data){response(data);}
                                                });
                                            },
                                            select:productoSeleccionado2
      
                              }).focus(function(){
                                 $(this).val(param);
                                 $(this).autocomplete("search");
                             });
               
                            }
          
                        
   
function Actualizar(id,pos){
			    $.post( "./consultarC.php", { codC:  ""+id+""},function(j){
                               var data= jQuery.parseJSON(j);
                               var cont=0;
                               console.log(data.info);
                               var row="";
                               
                               for (var i in data.info){
                                 if(i!=0){
                                    row+=" <tr id='row0'>";
                                    row+="<td>Producto</td>";
                                    row+='<td><input name="nombreProducto[0]" alt="codrow0" class="required buscar" value="'+data.info[i].nombre+'" />'
                                    row+='<input type="hidden" name="codigoProducto[0]" id="codrow0" value="'+data.info[i].codigoP+'" /></td>'
                                    row+="</tr>";
                                  }
                               }
                               
                               $("#mensaje").html(row);
                               show_message('#mensaje','auto','auto','editar','Aceptar',null,'msj',null);
                                
//                               if(data.id){
//                                            $('#url_save_registro').val('./actualizarP.php');
//                                            $('#pos').val(pos);
//                                            show_message('#contenedorform',600,400,'Editar producto','Guardar','Cancelar','form',null,null);
//                                           }
                           });
                           
                       }


function deleteRow(codigoP,pos){
                                var data={funcion:'delete',codigoP:codigoP,posicion:pos};
                                $("#mensaje").html("<p>"+"Desea eliminar el producto "+codigoP+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar producto','Aceptar','Cancelar','verificar',data);
                                
                            }
                          
                          
   