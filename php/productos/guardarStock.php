<?php
    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select count(*) as rows,codigoProducto,codigoTipoDetalle from inventarios where codigoProducto='".$_POST['codPstock']."' and codigoTipoDetalle='".$_POST['codDstock']."'  ";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    
    if($rows['rows']>0){
        $data=array('id'=>false,'msj'=>'El producto ya se encuentra en stock');
        echo json_encode($data);
        return false;
    } 
    
    $tabla = "`inventarios`";
    $campos = "`codigoProducto`, `codigoTipoDetalle`, `fecha`, `stockMaximo`,`stockMinimo`";
    $variable = "'".$_POST['codPstock']."','".$_POST['codDstock']."','".  date("Y-m-d")."','".$_POST['stockMaximo']."','".$_POST['stockMinimo']."' ";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $data=array('id'=>true,'msj'=>"stock guardado");
    echo json_encode($data);
	
?>
