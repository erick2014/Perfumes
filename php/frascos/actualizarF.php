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
    isset($_POST['codFViejo'])? $codFViejo=$_POST['codFViejo']:$codFViejo='' ;
    isset($_POST['codigoFrasco'])? $codFNuevo=$_POST['codigoFrasco']:$codFNuevo='' ;
   
    //verifico si cambio el codigo del producto, si lo cambio, consulto que no exista
    if( $codFViejo != $codFNuevo  ){
        
        $sql="select count(*) as rows,codigoFrasco from frascos where codigoFrasco='".$codFNuevo."' ";
        $rows=$bd->ejecutar($sql);
        $rows=  mysql_fetch_array($rows);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'El codigo de frasco ya existe');
            echo json_encode($data);
            return false;
        } 
    }
    
    $tabla ="`frascos`";
    $campovariable = "codigoFrasco= '".$codFNuevo."', frasco = '".$_POST['frasco']."', medidas = '".$_POST['medidas']."', descripcion = '".$_POST['descripcion']."'";
    $condicion = "codigoFrasco = '".$codFViejo."'";
    $bd->actualizar($tabla,$campovariable,$condicion);
   
    $data=array('id'=>true,
                'asi'=>"Actualizar",
                'pos'=>$_POST['pos'],
                'campos'=>  array('codigoF'=>$codFNuevo,
                                  'frasco'=>$_POST['frasco'],
                                  'medidas'=>$_POST['medidas'],
                                  'descripcion'=>$_POST['descripcion'],
                                  'estado'=>'Activo'),
                'msj'=>"Frasco actualizado");
  
    echo json_encode($data);
	
?>