<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
   
	$tabla ="usuario_sistema";
    $campavariable = "`estado` = 'I'";
	$condicion = "cedulaNit = '".$_POST['cedula']."'";
    $bd->actualizar($tabla,$campavariable,$condicion);
    $data=array('id'=>true,'msj'=>"el usuario guardado");
    echo json_encode($data);
	
?>