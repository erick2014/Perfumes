<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select count(distinct codigoCombo ) as rows from combos";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    $RowsNumber=$rows['rows'];
    $RowsNumber++;
    
    $arrayCodP=$_POST['codigoProducto'];
    $arrayCodD=$_POST['codigoDetalle'];
    $arraynomP=$_POST['nombreProducto'];
    
    $tabla = "`combos`";
    $campos = "`codigoCombo`, `codigoProducto`, `descripcion`, `valorCombo`,`codigotipoDetalle`";
    
    foreach ($arrayCodP as $key => $value) {
        $variable = "'".$RowsNumber."' ,'".$value."','".$_POST['descripcion']."','".$_POST['valorCombo']."','".$arrayCodD[$key]."'";
        $stmt=$bd->insertar($tabla,$campos,$variable);	
    }
    
    $sql = "SELECT count(*) As con FROM  `combos` WHERE estado = 'A'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true,'tablatr'=>array(
                                            $RowsNumber,
                                            $arrayCodP[0],
                                            $arraynomP[0],
                                            $_POST['valorCombo'],
                                            $_POST['descripcion'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$RowsNumber.','.($rowcc['con']-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$RowsNumber.','.($rowcc['con']-1).');" align="center" />'),
                                            'msj'=>"Combo guardado",
                                            'asi'=>'Ingresar'
                );
    echo json_encode($data);
	

