<?php
     error_reporting(0);
	// put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    $menusolici='';
    $estado='';
    $selectP='';
 
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT  d.`codigoDetallePerfume`, d.`color`,d.`talla`,d.`descripcion`, d.`precioCompra`, d.`precioVenta`,d.`estado`,
                    p.`codigoProducto`,p.`nombre`
            FROM  `detalle_producto_perfume` d
            JOIN `productos` p ON p.codigoProducto = d.codigoProducto
            WHERE d.estado = 'A' and d.tipo='R'";
    
     $sql2="SELECT p.codigoProducto,p.nombre
           FROM  `productos` p
           JOIN  `tipo_producto` tp on p.codigo_tipo=tp.codigo_tipo
           WHERE  p.estado = 'A' and tp.tipo='ropa' ";
    
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $stmt2=$bd->ejecutar($sql2);
    $con = 0;
    
    
    while($rowcc=$bd->obtener_fila($stmt,0))
    {
     if($rowcc['estado']=='A'){$estado='Activo';}
     if($rowcc['estado']=='I'){$estado='Inactivo';}
 
     $menusolici .= '<tr>'
                        .'<td >'.$rowcc['codigoDetallePerfume'].'</td>'
                        .'<td >'.$rowcc['codigoProducto'].'</td>'
                        .'<td >'.$rowcc['nombre'].'</td>'
                        .'<td >'.$rowcc['color'].'</td>'
                        .'<td >'.$rowcc['talla'].'</td>'
                        .'<td >'.$rowcc['descripcion'].'</td>'
                        .'<td >'.$rowcc['precioCompra'].'</td>'
                        .'<td >'.$rowcc['precioVenta'].'</td>'
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
    
   


