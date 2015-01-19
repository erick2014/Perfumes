<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT  d.`codigoDetallePerfume`, d.`fragancia`, d.`precioCompra`, d.`precioVenta`,d.`estado`, d.`genero`,
                p.`codigoProducto`,p.`nombre`,
                f.`codigoFrasco`,f.`frasco`,
                e.`codigoEtiqueta`,e.`etiqueta`
            FROM  `detalle_producto_perfume` d
            JOIN `productos` p ON p.codigoProducto = d.codigoProducto
            JOIN `frascos` f ON f.codigoFrasco = d.codigoFrasco
            JOIN `etiquetas` e ON e.codigoEtiqueta = d.codigoEtiqueta
            WHERE d.codigoDetallePerfume ='".$_POST['codigoDPP']."' and d.codigoProducto ='".$_POST['codigoP']."'  ";
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $row=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true, 'codigoDetallePerfume'=>$row['codigoDetallePerfume'],
                            'codigoProducto'=>$row['codigoProducto'],
                            'producto'=>$row['nombre'],
                            'codigoFrasco'=>$row['codigoFrasco'],
                            'frasco'=>$row['frasco'],
                            'codigoEtiqueta'=>$row['codigoEtiqueta'],
                            'etiqueta'=>$row['etiqueta'],
                            'fragancia'=>$row['fragancia'],
                            'precioCompra'=>$row['precioCompra'],
                            'precioVenta'=>$row['precioVenta'],
                            'genero'=>$row['genero'],
               );
    echo json_encode($data);

