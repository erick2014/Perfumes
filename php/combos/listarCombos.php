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
	
    $sql = "SELECT  c.`codigoCombo`, c.`descripcion`, c.`estado`,c.`valorCombo`,
                    p.`codigoProducto`,p.`nombre`
            FROM  `combos` c  JOIN `productos` p ON p.codigoProducto = c.codigoProducto
            WHERE c.estado = 'A' group by codigoCombo";
    
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $con = 0;
    
    while($rowcc=$bd->obtener_fila($stmt,0))
    {
     if($rowcc['estado']=='A'){$estado='Activo';}
     if($rowcc['estado']=='I'){$estado='Inactivo';}
     $menusolici .= '<tr>'
                        .'<td >'.$rowcc['codigoCombo'].'</td>'
                        .'<td >'.$rowcc['codigoProducto'].'</td>'
                        .'<td >'.$rowcc['nombre'].'</td>'
                        .'<td >'.$rowcc['valorCombo'].'</td>'
                        .'<td >'.$rowcc['descripcion'].'</td>'
                        .'<td >'.$estado.'</td>'
                        .'<td class="Act"><img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$rowcc['codigoCombo'].','.$con.');" align="center" /></td>'
                        .'<td class="elimi"><img  src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$rowcc['codigoCombo'].','.$con.');" align="center" /></td>'
                    .'</tr>';
       $con++;
    }
