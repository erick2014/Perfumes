<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT codigoFrasco,frasco,medidas,descripcion,estado
            FROM  frascos
            WHERE codigoFrasco ='".$_POST['codigoF']."' ";
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $row=$bd->obtener_fila($stmt,0);
	
    $data=array('id'=>true, 'codigoF'=>$row['codigoFrasco'],
                            'frasco'=>$row['frasco'],
                            'medidas'=>$row['medidas'],
                            'descripcion'=>$row['descripcion'],
                            'estado'=>$row['estado']
               );
    echo json_encode($data);
	