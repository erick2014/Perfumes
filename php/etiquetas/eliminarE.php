<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
   
    $tabla ="etiquetas";
    $campavariable = "`estado` = 'I'";
    $condicion = "codigoEtiqueta = '".$_POST['codigoP']."'";
    $bd->actualizar($tabla,$campavariable,$condicion);
    $data=array('id'=>true,'msj'=>"Etiqueta desactivada");
    echo json_encode($data);
    return false;
    
    
    