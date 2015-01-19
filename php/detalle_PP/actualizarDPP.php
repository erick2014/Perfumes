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
    if( ($codPNuevo!=$codPViejo) ){
        $sql="select count(*) as rows,codigoDetallePerfume "
            ."from detalle_producto_perfume where codigoDetallePerfume='".$codDViejo."' and codigoProducto='".$codPNuevo."'  ";
        $rows=$bd->ejecutar($sql);
        $rows=  mysql_fetch_array($rows);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'Este detalle ya existe para este producto');
            echo json_encode($data);
            return false;
        } 
    }
    
    $tabla ="`detalle_producto_perfume`";
    $campovariable = "codigoProducto = '".$codPNuevo."', fragancia = '".$_POST['fragancia']."', codigoFrasco = '".$_POST['codigoFrasco']."', codigoEtiqueta = '".$_POST['codigoEtiqueta']."', precioCompra = '".$_POST['precioCompra']."', precioVenta = '".$_POST['precioVenta']."', genero = '".$_POST['genero']."'";
    $condicion = "codigoDetallePerfume = '".$codDViejo."' and codigoProducto='".$codPViejo."' ";
    $bd->actualizar($tabla,$campovariable,$condicion);

    $data=array('id'=>true,
                'asi'=>"Actualizar",
                'pos'=>$_POST['pos'],
                'campos'=>  array('codigoDetallePerfume'=>$codDViejo,
                                  'codigoProducto'=>$codPNuevo,
                                  'producto'=>$_POST['codigoPname'],
                                  'fragancia'=>$_POST['fragancia'],
                                  'frasco'=>$_POST['codigoFname'],
                                  'etiqueta'=>$_POST['codigoEname'],
                                  'precioCompra'=>$_POST['precioCompra'],
                                  'precioVenta'=>$_POST['precioVenta'],
                                  'genero'=>$_POST['generoname'],
                                  'estado'=>'Activo'),
                'msj'=>"Detalle perfume actualizado",
                'mode'=>array('codigo1'=>$codDViejo,'codigo2'=>$codPNuevo)
              );
  
    echo json_encode($data);
	
?>