<?php
     error_reporting(0);
	// put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    ///*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    $menusolici='';
    $estado='';
    $selectP='';
    $selectE='';
    $selectF='';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT  d.`codigoDetallePerfume`, d.`fragancia`, d.`precioCompra`, d.`precioVenta`,d.`estado`, d.`genero`,
                p.`codigoProducto`,p.`nombre`,
                f.`codigoFrasco`,f.`frasco`,
                e.`codigoEtiqueta`,e.`etiqueta`
            FROM  `detalle_producto_perfume` d
            JOIN `productos` p ON p.codigoProducto = d.codigoProducto
            JOIN `frascos` f ON f.codigoFrasco = d.codigoFrasco
            JOIN `etiquetas` e ON e.codigoEtiqueta = d.codigoEtiqueta
            WHERE d.estado = 'A' and d.tipo='P'";
    
    $sql2="SELECT p.codigoProducto,p.nombre
           FROM  `productos` p
           JOIN  `tipo_producto` tp on p.codigo_tipo=tp.codigo_tipo
           WHERE  p.estado = 'A' and tp.tipo='perfume' ";
    
    $sql3="SELECT codigoFrasco,frasco
           FROM  `frascos` 
           WHERE  estado = 'A'";
    
    $sql4="SELECT codigoEtiqueta,etiqueta
           FROM  `etiquetas` 
           WHERE  estado = 'A'";
    
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $stmt2=$bd->ejecutar($sql2);
    $stmt3=$bd->ejecutar($sql3);
    $stmt4=$bd->ejecutar($sql4);
    $con = 0;
    
    
    while($rowcc=$bd->obtener_fila($stmt,0))
    {
     if($rowcc['estado']=='A'){$estado='Activo';}
     if($rowcc['estado']=='I'){$estado='Inactivo';}
     if($rowcc['genero']=='M'){$rowcc['genero']='Masculino';}
     if($rowcc['genero']=='F'){$rowcc['genero']='Femenino';}
     $menusolici .= '<tr>'
                        .'<td >'.$rowcc['codigoDetallePerfume'].'</td>'
                        .'<td >'.$rowcc['codigoProducto'].'</td>'
                        .'<td >'.$rowcc['nombre'].'</td>'
                        .'<td >'.$rowcc['fragancia'].'</td>'
                        .'<td >'.$rowcc['frasco'].'</td>'
                        .'<td >'.$rowcc['etiqueta'].'</td>'
                        .'<td >'.$rowcc['precioCompra'].'</td>'
                        .'<td >'.$rowcc['precioVenta'].'</td>'
                        .'<td >'.$rowcc['genero'].'</td>'
                        .'<td >'.$estado.'</td>'
                        .'<td class="Act"><img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$rowcc['codigoDetallePerfume'].','.$rowcc['codigoProducto'].','.$con.');" align="center" /></td>'
                        .'<td class="elimi"><img  src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$rowcc['codigoDetallePerfume'].','.$rowcc['codigoProducto'].','.$con.');" align="center" /></td>'
                    .'</tr>';
       $con++;
    }
  
    
    while($rowt=$bd->obtener_fila($stmt2,0))
    {
     $selectP .= "<option value='".$rowt['codigoProducto']."'  >".$rowt['nombre'].'</option>';
    }
    
     while($rowt=$bd->obtener_fila($stmt3,0))
    {
     $selectF .= "<option value='".$rowt['codigoFrasco']."'  >".$rowt['frasco'].'</option>';
    }
     while($rowt=$bd->obtener_fila($stmt4,0))
    {
     $selectE .= "<option value='".$rowt['codigoEtiqueta']."'  >".$rowt['etiqueta'].'</option>';
    }



