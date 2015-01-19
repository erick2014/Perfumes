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
    $campos = "`codigoDetallePerfume`,`codigoProducto`, `color`, `talla`, `descripcion`, `precioCompra`, `precioVenta`, `tipo`";
    $variable = " '".$codDPerfume."','".$_POST['codigoProducto']."','".$_POST['color']."','".$_POST['talla']."','".$_POST['descripcion']."','".$_POST['precioCompra']."','".$_POST['precioVenta']."','R' ";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);

    $data=array('id'=>true,'tablatr'=>array(
                                            $codDPerfume,
                                            $_POST['codigoProducto'],
                                            $_POST['codigoPname'],
                                            $_POST['color'],
                                            $_POST['talla'],
                                            $_POST['descripcion'],
                                            $_POST['precioCompra'],
                                            $_POST['precioVenta'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$codDPerfume.','.$_POST['codigoProducto'].','.($codDPerfume-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$codDPerfume.','.$_POST['codigoProducto'].','.($codDPerfume-1).');" align="center" />'),
                                            'msj'=>"Detalle ropa guardado",
                                            'asi'=>'Ingresar'
                );
    echo json_encode($data);
	