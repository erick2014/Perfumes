<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select count(*) as rows,codigoProducto from productos where codigoProducto='".$_POST['codigoProducto']."' ";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    
    if($rows['rows']>0){
        $data=array('id'=>false,'msj'=>'El codigo de producto ya existe');
        echo json_encode($data);
        return false;
    } 
    
    $tabla = "`productos`";
    $campos = "`codigoProducto`, `nombre`, `descripcion`, `codigo_tipo`";
    $variable = "'".$_POST['codigoProducto']."','".$_POST['nombre']."','".$_POST['descripcion']."','".$_POST['codigo_tipo']."' ";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $sql = "SELECT count(*) As con FROM  `productos` WHERE estado = 'A'";
    $stmt2=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt2,0);

    $data=array('id'=>true,'tablatr'=>array(
                                            $_POST['codigoProducto'],
                                            $_POST['nombre'],
                                            $_POST['descripcion'],
                                            $_POST['tipoP'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$_POST['codigoProducto'].','.($rowcc['con']-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$_POST['codigoProducto'].','.($rowcc['con']-1).');" align="center" />'),
                                            'msj'=>"Producto guardado",
                                            'asi'=>'Ingresar',
                                            'pasoApaso'=>true
                );
    echo json_encode($data);
	
?>
