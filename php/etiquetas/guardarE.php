<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select count(*) as rows,codigoEtiqueta from etiquetas where codigoEtiqueta='".$_POST['codigoEtiqueta']."' ";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    
    if($rows['rows']>0){
        $data=array('id'=>false,'msj'=>'El codigo de etiqueta ya existe');
        echo json_encode($data);
        return false;
    } 
    
    $tabla = "`etiquetas`";
    $campos = "`codigoEtiqueta`, `etiqueta`, `descripcion`";
    $variable = "'".$_POST['codigoEtiqueta']."','".$_POST['etiqueta']."','".$_POST['descripcion']."' ";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $sql = "SELECT count(*) As con FROM  `etiquetas` WHERE estado = 'A'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true,'tablatr'=>array(
                                            $_POST['codigoEtiqueta'],
                                            $_POST['etiqueta'],
                                            $_POST['descripcion'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$_POST['codigoEtiqueta'].','.($rowcc['con']-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$_POST['codigoEtiqueta'].','.($rowcc['con']-1).');" align="center" />'),
                                            'msj'=>"Etiqueta guardada",
                                            'asi'=>'Ingresar'
        );
    echo json_encode($data);
	

