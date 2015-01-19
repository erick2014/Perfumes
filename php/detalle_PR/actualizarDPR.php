<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    $editar=false;
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    //creo las variables para los codigos
    isset($_POST['codigoDPViejo'])? $codDViejo=$_POST['codigoDPViejo']:$codDViejo='' ;
    isset($_POST['codigoPViejo'])? $codPViejo=$_POST['codigoPViejo']:$codPViejo='' ;
    isset($_POST['codigoProducto'])? $codPNuevo=$_POST['codigoProducto']:$codPNuevo='' ;
   
    //verifico si cambio el codigo del producto, si lo cambio, consulto que no exista
    if( $codPNuevo!=$codPViejo ){
        $sql="select count(*) as rows,codigoDetallePerfume from detalle_producto_perfume where codigoDetallePerfume='".$codDViejo."' and codigoProducto='".$codPNuevo."'";
        $stmt=$bd->ejecutar($sql);
        $rows= $bd->obtener_fila($stmt,0);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'Este detalle ya existe para este producto');
            echo json_encode($data);
            return false;
        } 
    }
    
    $tabla ="`detalle_producto_perfume`";
    $campovariable = " codigoProducto= '".$codPNuevo."', color= '".$_POST['color']."', talla= '".$_POST['talla']."', descripcion = '".$_POST['descripcion']."', precioCompra = '".$_POST['precioCompra']."', precioVenta = '".$_POST['precioVenta']."' ";
    $condicion = "codigoDetallePerfume= '".$codDViejo."' and codigoProducto='".$codPViejo."' ";
    $bd->actualizar($tabla,$campovariable,$condicion);

    $data=array('id'=>true,
                'asi'=>"Actualizar",
                'pos'=>$_POST['pos'],
                'campos'=>  array('codigoDetallePerfume'=>$codDViejo,
                                  'codigoProducto'=>$codPNuevo,
                                  'producto'=>$_POST['codigoPname'],
                                  'color'=>$_POST['color'],
                                  'talla'=>$_POST['talla'],
                                  'descripcion'=>$_POST['descripcion'],
                                  'precioCompra'=>$_POST['precioCompra'],
                                  'precioVenta'=>$_POST['precioVenta'],
                                  'estado'=>'Activo'),
                'msj'=>"Detalle ropa actualizado",
                'mode'=>array('codigo1'=>$codDViejo,'codigo2'=>$codPNuevo)
              );
  
    echo json_encode($data);
    return false;