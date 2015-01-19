<?php
     /*Incluimos el fichero de la clase Db*/
    require 'Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require 'Conf.class.php';
    $tipo="";
    if (isset($_POST["term"])){
        echo "[";
    	/*Creamos la instancia del objeto. Ya estamos conectados*/
    	$bd=Db::getInstance();
        
	$sql = "select p.codigoProducto,p.nombre,tp.codigo_tipo,tp.tipo from productos p
                join tipo_producto tp on tp.codigo_tipo=p.codigo_tipo
                where concat(codigoProducto,' ',nombre ) like '%".$_POST["term"]."%' ";
	$stmt=$bd->ejecutar($sql);
        $contador = 0;
	
	while($row = $bd->obtener_fila($stmt,0))
	{
     	 $valor = 0;
	 $descripcion = $row['codigoProducto'];
	 $nombre = $row['nombre'];
	 $tipo = $row['tipo'];
	 if ($contador++ > 0) print ", "; // agregamos esta linea porque cada elemento debe estar separado por una coma
	 print "{ \"label\" : \"$descripcion-$nombre\", \"value\" : { \"codigoProducto\" : \"$descripcion\",\"nombre\" : \"$nombre\",\"tipo\" : \"$tipo\"} }";
	}
    echo "]";
    }
    if (isset($_POST["search"])) {
         echo "[";
	/*Creamos la instancia del objeto. Ya estamos conectados*/
    	$bd=Db::getInstance();
        (isset($_POST['tipo']))? $tipo=  strtolower($_POST['tipo']) : $tipo='';
        
        if($tipo=='perfume'){
            $sql = "SELECT codigoProducto,fragancia,codigoDetallePerfume FROM `detalle_producto_perfume` WHERE codigoProducto ='".$_POST['search']."' and tipo='P' ";
        }else if($tipo=='ropa'){
            $sql = "SELECT codigoDetallePerfume,codigoProducto,descripcion,talla FROM `detalle_producto_perfume` WHERE codigoProducto ='".$_POST['search']."' and tipo='R' ";
        }
        $stmt=$bd->ejecutar($sql);
        $contador = 0;
	
	while($row = $bd->obtener_fila($stmt,0))
	{
     	 $valor = 0;
         //esto es para el perfume
	 if($tipo=='perfume'){
            $codigo = $row['codigoProducto'];
            $nombre = $row['fragancia'];
            $id = $row['codigoDetallePerfume'];
            
         }
          //esto es para la ropa
         else if($tipo=='ropa'){
            $codigo = $row['descripcion'];
            $nombre = $row['talla'];
            $id = $row['codigoDetallePerfume'];
         }
                 
	 if ($contador++ > 0) print ", "; // agregamos esta linea porque cada elemento debe estar separado por una coma
         if($tipo=='perfume'){
            print "{ \"label\" : \"$codigo-$nombre\", \"value\" : { \"fragancia\" : \"$nombre\",\"codigoDetalle\" : \"$id\"} }";
         }
         else if($tipo=='ropa'){
            print "{ \"label\" : \"$codigo-$nombre\", \"value\" : { \"fragancia\" : \"$codigo\",\"codigoDetalle\" : \"$id\"} }"; 
         }
	}
    echo "]";
 }
 if (isset($_POST["detallePP"])) {
     echo "[";
    	/*Creamos la instancia del objeto. Ya estamos conectados*/
    	$bd=Db::getInstance();
        
	$sql = "select p.codigoProducto,p.nombre from productos p
                where concat(codigoProducto,' ',nombre ) like '%".$_POST["detallePP"]."%' ";
	$stmt=$bd->ejecutar($sql);
        $contador = 0;
	
	while($row = $bd->obtener_fila($stmt,0))
	{
     	 $valor = 0;
	 $descripcion = $row['codigoProducto'];
	 $nombre = $row['nombre'];
	 if ($contador++ > 0) print ", "; // agregamos esta linea porque cada elemento debe estar separado por una coma
	 print "{ \"label\" : \"$descripcion-$nombre\", \"value\" : { \"codigo\" : \"$descripcion\",\"nombre\" : \"$nombre\"} }";
	}
    echo "]";
 }
      
  ?>