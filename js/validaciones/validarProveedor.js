        $(document).ready(function() {
                                
                              $("#Nuevo").click(function(){
                                $('#url_save_registro').val('guardarProveedor.php');
                                $('#nit').val('');
                                $('#nombre').val('');
                                $('#direccion').val('');
                                $('#telefono').val('');
                                $('#celular').val('');
                                $('#descripcion').val('');
                                show_message('#contenedorform','auto',370,'Nuevo proveedor','Guardar','Cancelar','form',null,null);
                               });
                                
			} );
                        
   
function Actualizar(nit,pos){
                           $.post( "./consultaProveedor.php", { nit:  ""+nit+""},function(j){
                               var data= jQuery.parseJSON(j);
                               if(data.id){
                                            $('#url_save_registro').val('./actualizarProveedor.php');
                                            $('#nit').val(data.nit);
                                            $('#nitViejo').val(data.nit);
                                            $('#nombre').val(data.nombre);
                                            $('#direccion').val(data.direccion);
                                            $('#telefono').val(data.telefono);
                                            $('#celular').val(data.celular);
                                            $('#descripcion').val(data.descripcion);
                                            $('#pos').val(pos);
                                            show_message('#contenedorform',600,400,'Editar proveedor','Guardar','Cancelar','form',null,null);
                                           }
                           });
                           
                       }


function deleteRow(nit,pos){
                                var data={funcion:'delete',nit:nit,posicion:pos};
                                $("#mensaje").html("<p>"+"Desea eliminar el proveedor "+nit+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar proveedor','Aceptar','Cancelar','verificar',data);
                            }
                          
                          
   