   $(document).ready(function(){
        var oTable = $('.informacion').dataTable();
        var contenedor=$("#contenedorform");   
	contenedor.dialog({autoOpen:false});	
        $(".form").validate({
                    submitHandler:function(){
                     //capturo la url
                      var url=$("#url_save_registro").val();
                      var data=$(".form").serialize();
                     //armo mi funcion ajax y envio el form por ajax :)
                      $.ajax({
                      type:"POST",
                      url:url,
                      data:data,
                      success:function(j){
                               var data= jQuery.parseJSON(j);
                               $("#mensaje").html("<p>"+data.msj+"</p>");
                               if(data.id){
                                   show_message('#mensaje','auto','auto','Exito','ok',null,'msj');
                                   $("#contenedorform").dialog("close");
                                  if(data.asi=="Ingresar"){
                                      var campo = data.tablatr; oTable.fnAddData(campo);contenedor.dialog("close");
                                      if(data.pasoApaso){
                                          var tipoP=$("#tipoP").val();
                                          var codP=$("#codigoProducto").val();
                                          var data={funcion:"seguir",tipoP:tipoP,codP:codP};
                                          show_message("#mensaje","auto","auto","Continuar proceso","Aceptar","cancelar","verificar",data);
                                          $("#contenedorform").dialog("close");
                                      }
                                  }
                                  if(data.asi=="Actualizar"){row_update(data);contenedor.dialog("close");}													  
                               }else{
                                     show_message('#mensaje','auto','auto','Error','ok',null,'msj');
                               }
                     }//end success
                     });
                    }
                });//end validate form
                
          
     
   });//end document ready
    //---------------------------------------------------------------------------------------------------------------------------------
   function auto_completar(formulario){
       
      $("#"+formulario).delegate(".buscar","focusin",function(){
                            $(this).autocomplete({
                                source: function(request,response){
                                    $.ajax({
                                       type:"POST",
                                       url:"../clases/autoCompletar.php",
                                       dataType:"json",
                                       data:{detallePP:request.term},
                                       success:function(data){response(data);}
                                    });
                                },
                                minLength: 1,
                                select:productoSeleccionado
                             });
             });//end autocomplete;
  }
  //---------------------------------------------------------------------------------------------------------------------------------
  function productoSeleccionado(event, ui){
       var producto = ui.item.value;
       $(this).val(producto.codigo);
       event.preventDefault();
 }
 //---------------------------------------------------------------------------------------------------------------------------------
   function row_update(data){
       var oTable = $('.informacion').dataTable();
       var cont=0;
       var pos=parseInt(data.pos);
       var btnEdit="";
       var btnDel="";
       
        for(var i in data["campos"]){
           oTable.fnUpdate(data["campos"][i] , pos, cont );
           if(cont==0){
            btnEdit='<img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('+data['campos'][i]+','+pos+');" align="center" />';
            btnDel='<img  src="../../images/delet.png" width="30" height="30" onclick="deleteRow('+data['campos'][i]+','+pos+');" align="center" />';
           }
           cont+=1;
        }
        if(data["mode"]){
            btnEdit='<img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('+data['mode']["codigo1"]+','+data['mode']["codigo2"]+','+pos+');" align="center" />';
            btnDel='<img  src="../../images/delet.png" width="30" height="30" onclick="deleteRow('+data['mode']["codigo1"]+','+data['mode']["codigo2"]+','+pos+');" align="center" />';
        }
       
       //actualizo el boton editar
       oTable.fnUpdate(btnEdit , pos, cont );
       //actualizo el boton eliminar
       cont+=1;
       oTable.fnUpdate(btnDel , pos, cont );

   }
   //---------------------------------------------------------------------------------------------------------------------------------
  function show_message(contenedor,ancho,alto,titulo,btn1,btn2,tipo,data){
      //aca almaceno los botones
      var mybtns=[];
      //si se va a mostrar un formulario entonces muestro estos botones     
      if(tipo=='form'){
          mybtns=[{text:btn1,click:function(){ $(".form").submit();}},{text:btn2,click:function(){$(this).dialog("close");}}];
      }
      //si se va a mostrar un mensaje entonces seteo estos botones 
       else if(tipo=='msj'){
         mybtns=[{text:btn1, click:function(){$(this).dialog("close");}}];
       }
       else if(tipo=='verificar'){
           mybtns=[{text:btn1, click:function(){
                       if(data.funcion=='delete'){delete_process(data);}
                       else if(data.funcion=='seguir'){continuar_process(data);}
                    }},
                   {text:btn2, click:function(){(this).dialog("close"); }}
                  ];
       }
       //inicializo las opciones del dialogo 
       var options={autoOpen:true,modal:true,width:ancho,height:alto,title:titulo,buttons:mybtns};
       //abro la caja con las opciones y los botones previamente seteados
       $(contenedor).dialog(options);      

   }
  
 //---------------------------------------------------------------------------------------------------------------------------------
  function delete_process(data){
                                var pos=data.posicion;
                                var url=$("#urlDelete").val();
                                $.ajax({
                                    type:"POST",
                                    url:url,
                                    data:data,
                                    success:function(j){
                                     var data= jQuery.parseJSON(j);
                                     $("#mensaje").html("<p>"+data.msj+"</p>");
                                     show_message("#mensaje",400,200,'Eliminacion','ok',null,'msj',null);
                                     if(data.id){
                                         var oTable = $('.informacion').dataTable();
                                            if(pos !== null) {
                                                pos=parseInt(pos);
                                                oTable.fnDeleteRow(pos);//delete row
                                            }
                                     }
                                   }//end ajax success
                                 });//end ajax submit
                            }//end function
