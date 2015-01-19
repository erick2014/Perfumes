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
    isset($_POST['codigoMViejo'])? $codMViejo=$_POST['codigoMViejo']:$codMViejo='' ;
    isset($_POST['codigoMateriaPrima'])? $codMNuevo=$_POST['codigoMateriaPrima']:$codMNuevo='' ;
   
    //verifico si cambio el codigo del producto, si lo cambio, consulto que no exista
    if( $codMViejo != $codMNuevo  ){
        
        $sql="select count(*) as rows,codigoMateriaPrima from materia_prima where codigoMateriaPrima='".$codMNuevo."' ";
        $rows=$bd->ejecutar($sql);
        $rows=  mysql_fetch_array($rows);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'La materia prima ya existe');
            echo json_encode($data);
            return false;
        } 
        
    }
    
    $tabla ="`materia_prima`";
    $campovariable = "codigoMateriaPrima= '".$codMNuevo."', nombre = '".$_POST['nombre']."', descripcion = '".$_POST['descripcion']."', cantidad = '".$_POST['cantidad']."'";
    $condicion = "codigoMateriaPrima = '".$codMViejo."'";
    $bd->actualizar($tabla,$campovariable,$condicion);
    $data=array('id'=>true,
                'asi'=>"Actualizar",
                'pos'=>$_POST['pos'],
                'campos'=>  array('codigoMateriaPrima'=>$_POST['codigoMateriaPrima'],
                                  'nombre'=>$_POST['nombre'],
                                  'descripcion'=>$_POST['descripcion'],
                                  'cantidad'=>$_POST['cantidad'],
                                  'estado'=>'Activo'),
                'msj'=>"materia prima actualizada");
  
    echo json_encode($data);
