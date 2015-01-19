<?php
     error_reporting(0);
	// put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    $menusolici='';
    $estado='';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT codigoFrasco,frasco,medidas,descripcion,estado
            FROM  frascos
            WHERE estado = 'A'";
    
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $con = 0;
    
    while($rowcc=$bd->obtener_fila($stmt,0))
    {
     if($rowcc['estado']=='A'){$estado='Activo';}
     if($rowcc['estado']=='I'){$estado='Inactivo';}
     $menusolici .= '<tr>'
                        .'<td >'.$rowcc['codigoFrasco'].'</td>'
                        .'<td >'.$rowcc['frasco'].'</td>'
                        .'<td >'.$rowcc['medidas'].'</td>'
                        .'<td >'.$rowcc['descripcion'].'</td>'
                        .'<td >'.$estado.'</td>'
                        .'<td class="Act"><img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$rowcc['codigoFrasco'].','.$con.');" align="center" /></td>'
                        .'<td class="elimi"><img  src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$rowcc['codigoFrasco'].','.$con.');" align="center" /></td>'
                    .'</tr>';
       $con++;
    }
    