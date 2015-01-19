<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql="select count(*) as rows,cedula from usuario where cedula='".$_POST['cedula']."' ";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    
    if($rows['rows']>0){
        $data=array('id'=>false,'msj'=>'El usuario ya existe');
        echo json_encode($data);
        return false;
    } 
    
    $tabla = "`usuario`";
    $campas = "`cedula`, `nombre`, `apellido`, `telefono`, `direccion`";
    $variable = "'".$_POST['cedula']."','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['telefono']."','".$_POST['direccion']."'";
    $stmt=$bd->insertar($tabla,$campas,$variable);	
	
    $tabla = "`usuario_sistema`";
    $campas = "`cedulaNit`, `clave`, `usuario`, `tipoUsuario`";
    $variable = "'".$_POST['cedula']."','".$_POST['clave']."','".$_POST['usuario']."','".$_POST['tipoUsuario']."'";
    $stmt=$bd->insertar($tabla,$campas,$variable);
   
    $sql = "SELECT count(*) As con FROM  `usuario` u  JOIN `usuario_sistema` s ON s.cedulaNit = u.cedula  WHERE s.estado = 'A'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);
	
    $data=array('id'=>true,
                'asi'=>"Ingresar",
                'tablatr'=>array($_POST['cedula'],$_POST['nombre'].' '.$_POST['apellido'],
                '<img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$_POST['cedula'].','.($rowcc['con']-1).');" align="center" />',
                '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="eleminar('.$_POST['cedula'].','.($rowcc['con']-1).');" align="center" />'),
                'msj'=>"Usuario guardado");
    
    echo json_encode($data);
	

