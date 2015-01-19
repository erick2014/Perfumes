        $(document).ready(function() {
                                $("#codigoProducto").change(function(){
                                    var value=$("#codigoProducto option:selected").html();
                                    $("#codigoPname").val(value);
                               });
                                $("#codigoFrasco").change(function(){
                                    var value=$("#codigoFrasco option:selected").html();
                                    $("#codigoFname").val(value);
                               });
                                $("#codigoEtiqueta").change(function(){
                                    var value=$("#codigoEtiqueta option:selected").html();
                                    $("#codigoEname").val(value);
                               });
                                $("#genero").change(function(){
                                    var value=$("#genero option:selected").html();
                                    $("#generoname").val(value);
                               });
                             
                              $("#Nuevo").click(function(){
                                $('#url_save_registro').val('guardarDPP.php');
                                $('#codigoProducto').val('');
                                $('#codigoFrasco').val('');
                                $('#codigoEtiqueta').val('');
                                $('#fragancia').val('');
                                $('#precioCompra').val('');
                                $('#precioVenta').val('');
                                $('#genero').val('');
                                show_message('#contenedorform','auto','auto','Nuevo detalle perfume','Guardar','Cancelar','form',null,null);
                               });
			});
                        
   
function Actualizar(codigoDPP,codigoP,pos){
			    $.post( "./consultaDPP.php", { codigoDPP: codigoDPP,codigoP:codigoP},function(j){
                               var data= jQuery.parseJSON(j);
                               if(data.id){
                                            $('#url_save_registro').val('./actualizarDPP.php');
                                            $('#codigoDetallePerfume').val(data.codigoDetallePerfume);
                                            $('#codigoDPViejo').val(data.codigoDetallePerfume);
                                            $('#codigoProducto').val(data.codigoProducto);
                                            $('#codigoPViejo').val(data.codigoProducto);
                                            $('#codigoPname').val(data.producto);
                                            $('#codigoFrasco').val(data.codigoFrasco);
                                            $('#codigoFname').val(data.frasco);
                                            $('#codigoEtiqueta').val(data.codigoEtiqueta);
                                            $('#codigoEname').val(data.etiqueta);
                                            $('#fragancia').val(data.fragancia);
                                            $('#precioCompra').val(data.precioCompra);
                                            $('#precioVenta').val(data.precioVenta);
                                            $('#genero').val(data.genero);
                                            $('#pos').val(pos);
                                            show_message('#contenedorform','auto','auto','Editar detalle perfume','Guardar','Cancelar','form',null,null);
                                           }
                           });
                           
                       }


function deleteRow(codigoDPP,codigoP,pos){
                                var data={funcion:'delete',codigoDPP:codigoDPP,posicion:pos,codigoP:codigoP};
                                $("#mensaje").html("<p>"+"Desea eliminar el detalle de perfume "+codigoDPP+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar producto','Aceptar','Cancelar','verificar',data);
                            }
                          
                          
   