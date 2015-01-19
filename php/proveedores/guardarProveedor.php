<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select count(*) as rows,nit from proveedores where nit='".$_POST['nit']."' ";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    
    if($rows['rows']>0){
        $data=array('id'=>false,'msj'=>'El proveedor ya existe');
        echo json_encode($data);
        return false;
    } 
    
    $tabla = "`proveedores`";
    $campos = "`nit`, `nombre`, `direccion`, `telefono`, `celular`, `descripcion`";
    $variable = "'".$_POST['nit']."','".$_POST['nombre']."','".$_POST['direccion']."','".$_POST['telefono']."','".$_POST['celular']."','".$_POST['descripcion']."'";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $sql = "SELECT count(*) As con FROM  `proveedores` WHERE estado = 'A'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true,'tablatr'=>array(
                                            $_POST['nit'],
                                            $_POST['nombre'],
                                            $_POST['direccion'],
                                            $_POST['telefono'],
                                            $_POST['celular'],
                                            $_POST['descripcion'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$_POST['nit'].','.($rowcc['con']-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$_POST['nit'].','.($rowcc['con']-1).');" align="center" />'),
                                            'msj'=>"Producto guardado",
                                            'asi'=>'Ingresar'
                );
    echo json_encode($data);
    return false;

