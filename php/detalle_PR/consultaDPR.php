<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
       $sql = "SELECT  d.`codigoDetallePerfume`, d.`color`,d.`talla`,d.`descripcion`, d.`precioCompra`, d.`precioVenta`,d.`estado`,
                       p.`codigoProducto`,p.`nombre`
               FROM  `detalle_producto_perfume` d
               JOIN `productos` p ON p.codigoProducto = d.codigoProducto
               WHERE d.codigoDetallePerfume ='".$_POST['codigoDPR']."' and d.codigoProducto ='".$_POST['codigoP']."'  ";
    
           
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $row=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true, 'codigoDetalleRopa'=>$row['codigoDetallePerfume'],
                            'codigoProducto'=>$row['codigoProducto'],
                            'producto'=>$row['nombre'],
                            'color'=>$row['color'],
                            'talla'=>$row['talla'],
                            'descripcion'=>$row['descripcion'],
                            'precioCompra'=>$row['precioCompra'],
                            'precioVenta'=>$row['precioVenta']
                  );
    echo json_encode($data);

