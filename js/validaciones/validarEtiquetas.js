$(document).ready(function() {

                          $("#Nuevo").click(function(){
                                $('#url_save_registro').val('guardarE.php');
                                $('#codigoEtiqueta').val('');
                                $('#codEtiquetaViejo').val('');
                                $('#etiqueta').val('');
                                $('#descripcion').val('');
                                show_message('#contenedorform','auto','auto','Nueva etiqueta','Guardar','Cancelar','form',null,null);
                          });


                } );
                        
   
function Actualizar(id,pos){
                            var con = id;
			    $.post( "./consultaE.php", { codigoE:  ""+id+""},function(j){
                               var data= jQuery.parseJSON(j);
                               if(data.id){
                                            $('#url_save_registro').val('./actualizarE.php');
                                            $('#codigoEtiqueta').val(data.codigoE);
                                            $('#codEtiquetaViejo').val(data.codigoE);
                                            $('#etiqueta').val(data.etiqueta);
                                            $('#descripcion').val(data.descripcion);
                                            $('#pos').val(pos);
                                            show_message('#contenedorform',600,400,'Editar etiqueta','Guardar','Cancelar','form',null,null);
                                           }
                           });
                           
                        }


function deleteRow(codigoE,pos){
                               
                                var data={funcion:'delete',codigoP:codigoE,posicion:pos};
                                $("#mensaje").html("<p>"+"Desea eliminar la etiqueta "+codigoE+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar etiqueta','Aceptar','Cancelar','verificar',data);
                                
                              }
                           
                          
   