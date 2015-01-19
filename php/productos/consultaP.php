<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT  p.`codigoProducto`, p.`nombre`, p.`descripcion`, tp.`codigo_tipo`,tp.`tipo` 
            FROM  `productos` p  JOIN `tipo_producto` tp ON tp.codigo_tipo = p.codigo_tipo
            WHERE p.codigoProducto ='".$_POST['codigoP']."' ";
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $row=$bd->obtener_fila($stmt,0);
	
    $data=array('id'=>true, 'codigoProducto'=>$row['codigoProducto'],
                            'nombre'=>$row['nombre'],
                            'descripcion'=>$row['descripcion'],
                            'codigo_tipo'=>$row['codigo_tipo'],
                            'tipo'=>$row['tipo']
               );
    echo json_encode($data);

