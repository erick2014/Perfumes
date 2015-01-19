<?php
    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select MAX(codigoDetallePerfume) AS rows,codigoDetallePerfume from detalle_producto_perfume";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);

    $codDPerfume=$rows["rows"];
    $codDPerfume++;
    $tabla = "`detalle_producto_perfume`";
    $campos = "`codigoDetallePerfume`, `codigoProducto`, `fragancia`, `codigoFrasco`, `codigoEtiqueta`, `precioCompra`, `precioVenta`, `genero`, `tipo`";
    $variable = "'".$codDPerfume."','".$_POST['codigoProducto']."','".$_POST['fragancia']."','".$_POST['codigoFrasco']."','".$_POST['codigoEtiqueta']."','".$_POST['precioCompra']."','".$_POST['precioVenta']."','".$_POST['genero']."','P' ";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $sql = "SELECT count(*) As con FROM  `detalle_producto_perfume` WHERE estado = 'A' and tipo='P'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true,'tablatr'=>array(
                                            $codDPerfume,
                                            $_POST['codigoProducto'],
                                            $_POST['codigoPname'],
                                            $_POST['fragancia'],
                                            $_POST['codigoFname'],
                                            $_POST['codigoEname'],
                                            $_POST['precioCompra'],
                                            $_POST['precioVenta'],
                                            $_POST['generoname'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$codDPerfume.','.$_POST['codigoProducto'].','.($rowcc['con']-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$codDPerfume.','.$_POST['codigoProducto'].','.($rowcc['con']-1).');" align="center" />'),
                                            'msj'=>"Detalle perfume guardado",
                                            'asi'=>'Ingresar'
                );
    echo json_encode($data);
	

