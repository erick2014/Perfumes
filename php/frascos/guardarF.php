<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select count(*) as rows,codigoFrasco from frascos where codigoFrasco='".$_POST['codigoFrasco']."' ";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    
    if($rows['rows']>0){
        $data=array('id'=>false,'msj'=>'El frasco ya existe');
        echo json_encode($data);
        return false;
    } 
    
    $tabla = "`frascos`";
    $campos = "`codigoFrasco`, `frasco`,`medidas`, `descripcion`";
    $variable = "'".$_POST['codigoFrasco']."','".$_POST['frasco']."','".$_POST['medidas']."','".$_POST['descripcion']."' ";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $sql = "SELECT count(*) As con FROM  `frascos` WHERE estado = 'A'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true,'tablatr'=>array(
                                            $_POST['codigoFrasco'],
                                            $_POST['frasco'],
                                            $_POST['medidas'],
                                            $_POST['descripcion'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$_POST['codigoFrasco'].','.($rowcc['con']-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$_POST['codigoFrasco'].','.($rowcc['con']-1).');" align="center" />'),
                                            'msj'=>"Frasco guardado",
                                            'asi'=>'Ingresar'
        );
    echo json_encode($data);
	

