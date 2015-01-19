<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
     //creo las variables para los codigos
    isset($_POST['codTipoPViejo'])? $codTPViejo=$_POST['codTipoPViejo']:$codTPViejo='' ;
    isset($_POST['codigo_tipo'])? $codTPNuevo=$_POST['codigo_tipo']:$codTPNuevo='' ;
    
   //verifico si cambio el codigo del producto, si lo cambio, consulto que no exista
    if($codTPNuevo!= $codTPViejo  ){
        
        $sql="select count(*) as rows,codigo_tipo from tipo_producto where codigo_tipo='".$_POST['codigo_tipo']."' ";
        $rows=$bd->ejecutar($sql);
        $rows=  mysql_fetch_array($rows);
    
        if($rows['rows']>0){
            $data=array('id'=>false,'msj'=>'El codigo del tipo producto ya existe');
            echo json_encode($data);
            return false;
        } 
        
    }
        
    $tabla ="`tipo_producto`";
    $campovariable = "codigo_tipo= '".$codTPNuevo."',tipo= '".$_POST['tipo']."'  ";
    $condicion = "codigo_tipo = '".$codTPViejo."'";
    $bd->actualizar($tabla,$campovariable,$condicion);
   
    $data=array('id'=>true,
                'asi'=>"Actualizar",
                'pos'=>$_POST['pos'],
                'campos'=>  array('codigoT'=>$_POST['codigo_tipo'],'type'=>$_POST['tipo'],'estado'=>'Activo'),
                'msj'=>"Tipo producto actualizado"
                );
               
    echo json_encode($data);
    return false;

