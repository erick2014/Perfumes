<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
      $sql = "SELECT  p.`nit`, p.`nombre`, p.`direccion`, p.`telefono`,p.`celular`,p.`estado`,p.`descripcion` 
              FROM  `proveedores` p
              WHERE p.nit ='".$_POST['nit']."' ";
           
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $row=$bd->obtener_fila($stmt,0);
	
    $data=array('id'=>true, 'nit'=>$row['nit'],
                            'nombre'=>$row['nombre'],
                            'direccion'=>$row['direccion'],
                            'telefono'=>$row['telefono'],
                            'celular'=>$row['celular'],
                            'descripcion'=>$row['descripcion']
               );
    echo json_encode($data);

