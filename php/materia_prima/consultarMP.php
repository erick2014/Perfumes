<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT  m.`codigoMateriaPrima`, m.`nombre`, m.`descripcion`, m.`cantidad`,m.`estado`
            FROM  `materia_prima` m 
            WHERE m.codigoMateriaPrima ='".$_POST['codigoMP']."' ";
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $row=$bd->obtener_fila($stmt,0);
	
    $data=array('id'=>true, 'codigoMateriaPrima'=>$row['codigoMateriaPrima'],
                            'nombre'=>$row['nombre'],
                            'descripcion'=>$row['descripcion'],
                            'cantidad'=>$row['cantidad'],
               );
    echo json_encode($data);

