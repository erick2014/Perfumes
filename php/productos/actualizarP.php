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
    isset($_POST['codProductoViejo'])? $codPViejo=$_POST['codProductoViejo']:$codPViejo='' ;
    isset($_POST['codigoProducto'])? $codPNuevo=$_POST['codigoProducto']:$codPNuevo='' ;
   
    //verifico si cambio el codigo del producto, si lo cambio, consulto que no exista
    if( $codPViejo != $codPNuevo  ){
        
        $sql="select count(*) as rows,codigoProducto from productos where codigoProducto='".$codPNuevo."' ";
        $rows=$bd->ejecutar($sql);
        $rows=  mysql_fetch_array($rows);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'El codigo de producto ya existe');
            echo json_encode($data);
            return false;
        } 
        
    }
    
    $tabla ="`productos`";
    $campovariable = "codigoProducto= '".$codPNuevo."', nombre = '".$_POST['nombre']."', descripcion = '".$_POST['descripcion']."', codigo_tipo = '".$_POST['codigo_tipo']."'";
    $condicion = "codigoProducto = '".$codPViejo."'";
    $bd->actualizar($tabla,$campovariable,$condicion);
    $data=array('id'=>true,
                'asi'=>"Actualizar",
                'pos'=>$_POST['pos'],
                'campos'=>  array('codigoP'=>$_POST['codigoProducto'],
                                  'nombre'=>$_POST['nombre'],
                                  'descripcion'=>$_POST['descripcion'],
                                  'tipo'=>$_POST['tipoP'],
                                  'estado'=>'Activo'),
                'codigo_tipo'=>$_POST['codigo_tipo'],
                'msj'=>"Producto actualizado");
  
    echo json_encode($data);
	
?>