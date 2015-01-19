<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select count(*) as rows,codigoMateriaPrima from materia_prima where codigoMateriaPrima='".$_POST['codigoMateriaPrima']."' ";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    
    if($rows['rows']>0){
        $data=array('id'=>false,'msj'=>'La materia prima ya existe');
        echo json_encode($data);
        return false;
    } 
    
    $tabla = "`materia_prima`";
    $campos = "`codigoMateriaPrima`, `nombre`, `descripcion`, `cantidad`";
    $variable = "'".$_POST['codigoMateriaPrima']."','".$_POST['nombre']."','".$_POST['descripcion']."','".$_POST['cantidad']."' ";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $sql = "SELECT count(*) As con FROM  `materia_prima` WHERE estado = 'A'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true,'tablatr'=>array(
                                            $_POST['codigoMateriaPrima'],
                                            $_POST['nombre'],
                                            $_POST['descripcion'],
                                            $_POST['cantidad'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$_POST['codigoMateriaPrima'].','.($rowcc['con']-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$_POST['codigoMateriaPrima'].','.($rowcc['con']-1).');" align="center" />'),
                                            'msj'=>"Materia prima guardada",
                                            'asi'=>'Ingresar'
                );
    echo json_encode($data);
	

