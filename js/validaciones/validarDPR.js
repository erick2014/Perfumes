        $(document).ready(function() {
                              $("#codigoProducto").change(function(){
                                    var value=$("#codigoProducto option:selected").html();
                                    $("#codigoPname").val(value);
                               });
                       																			
                              $("#Nuevo").click(function(){
                                $('#url_save_registro').val('guardarDPR.php');
                                $('.required').val("");
                                show_message('#contenedorform','auto','auto','Nuevo detalle ropa','Guardar','Cancelar','form',null,null);
                               });
			} );
                        
   
function Actualizar(codigoDPR,codigoP,pos){
			    $.post( "./consultaDPR.php", { codigoDPR: codigoDPR,codigoP:codigoP},function(j){
                               var data= jQuery.parseJSON(j);
                               if(data.id){
                                            $('#url_save_registro').val('./actualizarDPR.php');
                                            $('#codigoDetalleRopa').val(data.codigoDetalleRopa);
                                            $('#codigoDPViejo').val(data.codigoDetalleRopa);
                                            $('#codigoProducto').val(data.codigoProducto);
                                            $('#codigoPViejo').val(data.codigoProducto);
                                            $('#codigoPname').val(data.producto);
                                            $('#color').val(data.color);
                                            $('#talla').val(data.talla);
                                            $('#descripcion').val(data.descripcion);
                                            $('#precioCompra').val(data.precioCompra);
                                            $('#precioVenta').val(data.precioVenta);
                                            $('#pos').val(pos);
                                            show_message('#contenedorform','auto','auto','Editar detalle ropa','Guardar','Cancelar','form',null,null);
                                           }
                           });
                           
                       }


function deleteRow(codigoDPR,codigoP,pos){
                                var data={funcion:'delete',codigoDPR:codigoDPR,posicion:pos,codigoP:codigoP};
                                $("#mensaje").html("<p>"+"Desea eliminar el detalle de ropa "+codigoDPR+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar producto','Aceptar','Cancelar','verificar',data);
                            }
                          
                          
   