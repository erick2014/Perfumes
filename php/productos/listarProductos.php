<?php
     error_reporting(0);
	// put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    $menusolici='';
    $selectTipo='';
    $estado='';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT  p.`codigoProducto`, p.`nombre`, p.`descripcion`, tp.`codigo_tipo`,tp.`tipo`, p.`estado` 
            FROM  `productos` p  JOIN `tipo_producto` tp ON tp.codigo_tipo = p.codigo_tipo
            WHERE p.estado = 'A'";
    
    $sql2="SELECT  codigo_tipo,tipo,estado 
            FROM  `tipo_producto` 
            WHERE  estado = 'A'";
    
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $stmt2=$bd->ejecutar($sql2);
    $con = 0;
    while($rowcc=$bd->obtener_fila($stmt,0))
    {
     if($rowcc['estado']=='A'){$estado='Activo';}
     if($rowcc['estado']=='I'){$estado='Inactivo';}
     $menusolici .= '<tr>'
                        .'<td >'.$rowcc['codigoProducto'].'</td>'
                        .'<td >'.$rowcc['nombre'].'</td>'
                        .'<td >'.$rowcc['descripcion'].'</td>'
                        .'<td >'.$rowcc['tipo'].'</td>'
                        .'<td >'.$estado.'</td>'
                        .'<td class="Act"><img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$rowcc['codigoProducto'].','.$con.');" align="center" /></td>'
                        .'<td class="elimi"><img  src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$rowcc['codigoProducto'].','.$con.');" align="center" /></td>'
                    .'</tr>';
       $con++;
    }
    while($rowt=$bd->obtener_fila($stmt2,0))
    {
     $selectTipo .= "<option value='".$rowt['codigo_tipo']."'  >".$rowt['tipo'].'</option>';
    }

