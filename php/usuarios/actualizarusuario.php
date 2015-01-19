<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
     //creo las variables para los codigos
    isset($_POST['cedUViejo'])? $cedUViejo=$_POST['cedUViejo']:$cedUViejo='' ;
    isset($_POST['cedula'])? $cedUNuevo=$_POST['cedula']:$cedUNuevo='' ;
    
    //verifico si cambio el codigo del producto, si lo cambio, consulto que no exista
    if( $cedUViejo != $cedUNuevo  ){
        
        $sql="select count(*) as rows,cedula from usuario where cedula='".$cedUNuevo."' ";
        $stmt=$bd->ejecutar($sql);
        $rows=$bd->obtener_fila($stmt,0);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'Este usuario ya existe');
            echo json_encode($data);
            return false;
        } 
        
    }
    
    $tabla ="`usuario`";
    $campavariable = " cedula= '".$cedUNuevo."',  nombre= '".$_POST['nombre']."', apellido = '".$_POST['apellido']."', telefono = '".$_POST['telefono']."', direccion = '".$_POST['direccion']."'";
    $condicion = "cedula = '".$cedUViejo."'";
    $bd->actualizar($tabla,$campavariable,$condicion);
	
    $tabla ="usuario_sistema";
    $campavariable = " cedulaNit = '".$cedUNuevo."',usuario = '".$_POST['usuario']."', tipoUsuario = '".$_POST['tipoUsuario']."', clave = '".$_POST['clave']."'";
    $condicion = "`cedulaNit` = '".$cedUViejo."'";
    $bd->actualizar($tabla,$campavariable,$condicion);
	
    $sql = "SELECT count(*) As con FROM  `usuario` u  JOIN `usuario_sistema` s ON s.cedulaNit = u.cedula  WHERE s.estado = 'A'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);
    
    $data=array('id'=>true,
        'asi'=>"Actualizar",
        'pos'=>$_POST['pos'],
        'campos'=>array('cedula'=>$cedUNuevo,
                        'nombre'=>$_POST['nombre'].' '.$_POST['apellido'],
                        ),
        'msj'=>"El usuario se actualizo"
                );
    echo json_encode($data);
    return false;
	
