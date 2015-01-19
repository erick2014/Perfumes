<?php

    // put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
    $sql="select count(*) as rows,codigo_tipo from tipo_producto where codigo_tipo='".$_POST['codigo_tipo']."' ";
    $stmt=$bd->ejecutar($sql);
    $rows=$bd->obtener_fila($stmt,0);
    
    if($rows['rows']>0){
        $data=array('id'=>false,'msj'=>'El codigo de tipo de producto ya existe');
        echo json_encode($data);
        return false;
    } 
    $tipo= strtolower($_POST['tipo']);
    $tabla = "`tipo_producto`";
    $campos = "`codigo_tipo`, `tipo`";
    $variable = "'".$_POST['codigo_tipo']."','".$tipo."'";
    $stmt=$bd->insertar($tabla,$campos,$variable);	
    
    $sql = "SELECT count(*) As con FROM  `tipo_producto` WHERE estado = 'A'";
    $stmt=$bd->ejecutar($sql);
    $rowcc=$bd->obtener_fila($stmt,0);
    
    $data=array('id'=>true,'tablatr'=>array(
                                            $_POST['codigo_tipo'],
                                            $_POST['tipo'],
                                            'Activo',
                                            '<img class="Act" src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$_POST['codigo_tipo'].','.($rowcc['con']-1).');" align="center" />',
                                            '<img class="elimi" src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$_POST['codigo_tipo'].','.($rowcc['con']-1).');" align="center" />'),
                                            'msj'=>"Tipo producto guardado",
                                            'asi'=>"Ingresar"
               );
    echo json_encode($data);
    return false;

