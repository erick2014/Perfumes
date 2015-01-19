	var posicion='';
        $(document).ready(function() {
                                
                              $("#Nuevo").click(function(){
                                $('#url_save_registro').val('guardarTipoP.php');
                                $('#codigo_tipo').val('');
                                $('#tipo').val('');
                                 show_message('#contenedorform','auto','auto','Nuevo tipo producto','Guardar','Cancelar','form');                             
                               });
                                      
			} );
                        
   
function Actualizar(id,pos){
			    $.post( "./consultaTipoP.php", { codigoT:  ""+id+""},function(j){
                                var data= jQuery.parseJSON(j);
                                if(data.id){
                                                        $('#url_save_registro').val('./actualizarTipoP.php');
                                                        $('#codigo_tipo').val(data.codT);
                                                        $('#codTipoPViejo').val(data.codT);
                                                        $('#tipo').val(data.type);
                                                        $('#pos').val(pos);
                                                        show_message('#contenedorform',580,300,'Editar tipo producto','Guardar','Cancelar','form'); 
                                            }
                           });
                       }


function deleteRow(codigoTP,pos){
                                
                                var data={funcion:'delete',codigoP:codigoTP,posicion:pos};
                                $("#mensaje").html("<p>"+"Desea eliminar el tipo producto "+codigoTP+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar tipo producto','Aceptar','Cancelar','verificar',data);
                               }
                          
                          
                          