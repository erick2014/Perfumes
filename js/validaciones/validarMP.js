        $(document).ready(function() {
                                
                              $("#Nuevo").click(function(){
                                $('#url_save_registro').val('guardarMP.php');
                                $('#codigoMateriaPrima').val('');
                                $('#nombre').val('');
                                $('#descripcion').val('');
                                $('#cantidad').val('');
                                show_message('#contenedorform','auto','auto','Nueva materia prima','Guardar','Cancelar','form',null,null);
                               });
                             
                                
			} );
                        
   
function Actualizar(codigoMP,pos){
			    $.post( "./consultarMP.php", { codigoMP:  ""+codigoMP+""},function(j){
                               var data= jQuery.parseJSON(j);
                               if(data.id){
                                            $('#url_save_registro').val('./actualizarMP.php');
                                            $('#codigoMateriaPrima').val(data.codigoMateriaPrima);
                                            $('#codigoMViejo').val(data.codigoMateriaPrima);
                                            $('#nombre').val(data.nombre);
                                            $('#descripcion').val(data.descripcion);
                                            $('#cantidad').val(data.cantidad);
                                            $('#pos').val(pos);
                                            show_message('#contenedorform',600,280,'Editar materia prima','Guardar','Cancelar','form',null,null);
                                           }
                           });
                           
                       }


function deleteRow(codigoMP,pos){
                                var data={funcion:'delete',codigoMP:codigoMP,posicion:pos};
                                $("#mensaje").html("<p>"+"Desea eliminar la materia prima "+codigoMP+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar materia prima','Aceptar','Cancelar','verificar',data);
                                
                            }
                          
                          
   