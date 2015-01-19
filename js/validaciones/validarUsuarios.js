	$(document).ready(function() {
                   $("#cedula").autocomplete({
			source: "../clases/autoCompletar.php",
			minLength: 2,
			select: productoSeleccionado,
			focus: productoMarcado
		    });
		
		   function productoMarcado(event, ui)
	           {
		    var producto = ui.item.value;
		    $("#cedula").val(producto.cedula);
		    event.preventDefault();
		   }

		   function productoSeleccionado(event, ui)
		  {
   		   var producto = ui.item.value;
		   $("#cedula").val(producto.cedula);
	           event.preventDefault();
		  }      
            
                    $("#Nuevo").click(function(){
                            $('#url_save_registro').val('./usuario.php');
                            $(".required").val("");
                            $('#pos').val('');
                            show_message('#contenedorform','auto','auto','Nuevo usuario','Guardar','Cancelar','form');
                           });

                    } );
                        
   
function Actualizar(id,pos){
			    $.post( "./consultarusuario.php", { cedula:  ""+id+""},function(j){
                                var data= jQuery.parseJSON(j);
                                if(data.id){
                                             $('#url_save_registro').val('./actualizarusuario.php');
                                             $('#cedula').val(data.cedula);
                                             $('#cedUViejo').val(data.cedula);
                                             $('#nombre').val(data.nombre);
                                             $('#apellido').val(data.apellido);
                                             $('#telefono').val(data.telefono);
                                             $('#direccion').val(data.direccion);
                                             $('#usuario').val(data.usuario);
                                             $('#clave').val(data.clave);
                                             $('#tipoUsuario').val(data.tipoUsuario);
                                             $('#pos').val(pos);
                                             show_message('#contenedorform',600,400,'Editar usuario','Guardar','Cancelar','form');
                                            }
                           });
                       }


function deleteRow(cedula,pos){
                                var data={funcion:'delete',codigoP:cedula,posicion:pos};
                                $("#mensaje").html("<p>"+"Desea eliminar el usuario "+cedula+" ?"+"</p>");
                                show_message('#mensaje','auto','auto','Eliminar usuario','Aceptar','Cancelar','verificar',data);
                                
                            }
                          
                          
                          