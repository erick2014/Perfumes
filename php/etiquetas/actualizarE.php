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
    isset($_POST['codEtiquetaViejo'])? $codEViejo=$_POST['codEtiquetaViejo']:$codEViejo='' ;
    isset($_POST['codigoEtiqueta'])? $codENuevo=$_POST['codigoEtiqueta']:$codENuevo='' ;
    
    //verifico si cambio el codigo de la etiqueta, si lo cambio, consulto que no exista
    if($codEViejo!=$codENuevo){
        $sql="select count(*) as rows,codigoEtiqueta from etiquetas where codigoEtiqueta='".$_POST['codigoEtiqueta']."' ";
        $stmt=$bd->ejecutar($sql);
        $rows=$bd->obtener_fila($stmt,0);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'El codigo etiqueta ya existe');
            echo json_encode($data);
            return false;
        } 
    }
    
    $tabla ="`etiquetas`";
    $campovariable = "codigoEtiqueta= '".$codENuevo."', etiqueta = '".$_POST['etiqueta']."', descripcion = '".$_POST['descripcion']."'";
    $condicion = "codigoEtiqueta = '".$codEViejo."'";
    $bd->actualizar($tabla,$campovariable,$condicion);
    
    $data=array('id'=>true,
                'asi'=>"Actualizar",
                'pos'=>$_POST['pos'],
                'campos'=>  array('codigoE'=>$_POST['codigoEtiqueta'],
                                  'etiqueta'=>$_POST['etiqueta'],
                                  'descripcion'=>$_POST['descripcion'],
                                  'estado'=>'Activo'),
                'msj'=>"Etiqueta actualizada");
  
    echo json_encode($data);
