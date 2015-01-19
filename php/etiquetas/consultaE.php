<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
   $sql = "SELECT codigoEtiqueta,etiqueta,descripcion,estado
           FROM  etiquetas 
           WHERE codigoEtiqueta = '".$_POST['codigoE']."' ";
          
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $row=$bd->obtener_fila($stmt,0);
	
    $data=array('id'=>true, 'codigoE'=>$row['codigoEtiqueta'],
                            'etiqueta'=>$row['etiqueta'],
                            'descripcion'=>$row['descripcion'],
                            'estado'=>$row['estado']
               );
    echo json_encode($data);
