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
	
    $sql = "SELECT  codigo_tipo,tipo,estado
            FROM  tipo_producto
            WHERE estado = 'A'";
 
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $con = 0;
    while($rowcc=$bd->obtener_fila($stmt,0))
    {
     if($rowcc['estado']=='A'){$estado='Activo';}
     if($rowcc['estado']=='I'){$estado='Inactivo';}
     $menusolici .= '<tr>'
                        .'<td >'.$rowcc['codigo_tipo'].'</td>'
                        .'<td >'.$rowcc['tipo'].'</td>'
                        .'<td >'.$estado.'</td>'
                        .'<td class="Act"><img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$rowcc['codigo_tipo'].','.$con.');" align="center" /></td>'
                        .'<td class="elimi"><img  src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$rowcc['codigo_tipo'].','.$con.');" align="center" /></td>'
                    .'</tr>';
     $con++;
    }
   

