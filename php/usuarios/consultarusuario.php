<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT u.cedula , u.nombre, u.apellido,u.telefono, u.direccion, s.usuario,s.clave, s.tipoUsuario FROM  `usuario` u  JOIN `usuario_sistema` s ON s.cedulaNit = u.cedula  WHERE u.cedula = '".$_POST['cedula']."'";
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);

    $row=$bd->obtener_fila($stmt,0);
	
    $data=array('id'=>true, 
                'cedula'=>$row['cedula'],
                'nombre'=>$row['nombre'],
                'apellido'=>$row['apellido'],
                'telefono'=>$row['telefono'],
                'direccion'=>$row['direccion'],
                'usuario'=>$row['usuario'],
                'clave'=>$row['clave'],
                'tipoUsuario'=>$row['tipoUsuario']);
    echo json_encode($data);
	
?>
