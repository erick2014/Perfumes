<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
   
    $tabla ="tipo_producto";
    $campavariable = "`estado` = 'I'";
    $condicion = "codigo_tipo= '".$_POST['codigoP']."'";
    $bd->actualizar($tabla,$campavariable,$condicion);
    $data=array('id'=>true,'msj'=>"Tipo de producto desactivado");
    echo json_encode($data);
    return false;
    
    
    