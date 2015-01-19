        $(document).ready(function() {
																			
                              $("#Nuevo").click(function(){
                                $('#url_save_registro').val('guardarF.php');
                                $('#codigoFrasco').val('');
                                $('#frasco').val('');
                                $('#medidas').val('');
                                $('#descripcion').val('');
                                show_message('#contenedorform','auto','auto','Nuevo frasco','Guardar','Cancelar','form',null,null);
                               });
                             
                                
			} );
                        
   
function Actualizar(id,pos){
                            var con = id;
			    $.post( "./consultaF.php", { codigoF:  ""+id+""},function(j){
                               var data= jQuery.parseJSON(j);
                               if(data.id){
                                            $('#url_save_registro').val('./actualizarF.php');
                                            $('#codigoFrasco').val(data.codigoF);
                                            $('#codFViejo').val(data.codigoF);
                                            $('#frasco').val(data.frasco);
                                            $('#medidas').val(data.medidas);
                                            $('#descripcion').val(data.descripcion);
                                            $('#pos').val(pos);
                                            show_message('#contenedorform',600,400,'Editar frasco','Guardar','Cancelar','form',null,null);
                                           }
                           });
                           
                       }


function deleteRow(codigoF,pos){
                                var data={funcion:'delete',codigoP:codigoF,posicion:pos};
                                $("#mensaje").html("<p>"+"Desea eliminar el frasco "+codigoF+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar frasco','Aceptar','Cancelar','verificar',data);
                                
                            }
                          
                          
   

