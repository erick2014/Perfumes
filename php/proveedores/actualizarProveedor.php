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
    isset($_POST['nitViejo'])? $nitViejo=$_POST['nitViejo']:$nitViejo='' ;
    isset($_POST['nit'])? $nitNuevo=$_POST['nit']:$nitNuevo='' ;
   
    //verifico si cambio el codigo del producto, si lo cambio, consulto que no exista
    if( $nitViejo != $nitNuevo  ){
        
        $sql="select count(*) as rows,nit from proveedores where nit='".$nitNuevo."' ";
        $stmt=$bd->ejecutar($sql);
        $rows= $bd->obtener_fila($stmt,0);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'El proveedor ya existe');
            echo json_encode($data);
            return false;
        } 
        
    }
    
    $tabla ="`proveedores`";
    $campovariable = "nit= '".$nitNuevo."', nombre = '".$_POST['nombre']."', direccion = '".$_POST['direccion']."', telefono= '".$_POST['telefono']."', celular= '".$_POST['celular']."',descripcion= '".$_POST['descripcion']."' ";
    $condicion = "nit= '".$nitViejo."'";
    $bd->actualizar($tabla,$campovariable,$condicion);
    $data=array('id'=>true,
                'asi'=>"Actualizar",
                'pos'=>$_POST['pos'],
                'campos'=>  array('nit'=>$_POST['nit'],
                                  'nombre'=>$_POST['nombre'],
                                  'direccion'=>$_POST['direccion'],
                                  'telefono'=>$_POST['telefono'],
                                  'celular'=>$_POST['celular'],
                                  'descripcion'=>$_POST['descripcion'],
                                  'estado'=>'Activo'),
                'msj'=>"Producto actualizado"
               );
  
    echo json_encode($data);
    return false;
