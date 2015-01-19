<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
       
    $sql = "SELECT c.`codigoCombo`,c.`descripcion` as desCombo,c.`valorCombo`, c.`codigotipoDetalle`, 
		   p.`codigoProducto`,p.`nombre`,
		   d.talla,d.descripcion,d.fragancia
	   FROM  `combos` c 
           JOIN `productos` p ON p.codigoProducto = c.codigoProducto
           JOIN detalle_producto_perfume d ON d.codigoDetallePerfume=c.codigotipoDetalle
	   WHERE c.codigoCombo ='".$_POST['codC']."'";
           
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $combo=array();
    //$combo= array("info"=>array("codCombo"=>'001'),"row"=>array("valorC"=>"10000")  );
    $cont=0;
    while($rows= $bd->obtener_fila($stmt,0)){
     if($cont==0){
         array_push($combo,array("codCombo"=>$rows['codigoCombo'],"desCombo"=>$rows['desCombo'],"valorC"=>$rows['valorCombo']));
         $cont++;
     } 
     array_push($combo,array("codigoP"=>$rows['codigoProducto'],'nombre'=>$rows['nombre'],'desP'=>$rows["descripcion"],'fragancia'=>$rows["fragancia"],'talla'=>$rows["talla"]));
    }	
  
    $data=array('id'=>true,'info'=>$combo);
    echo json_encode($data);
