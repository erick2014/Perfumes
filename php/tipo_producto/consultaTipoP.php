<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT  codigo_tipo,tipo,estado
            FROM  `tipo_producto`
            WHERE codigo_tipo ='".$_POST['codigoT']."' ";
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $row=$bd->obtener_fila($stmt,0);
	
    $data=array('id'=>true, 'codT'=>$row['codigo_tipo'],
                            'type'=>$row['tipo'],
               );
    echo json_encode($data);
	
?>
