<?php
     error_reporting(0);
	    
	// put your code here
    /*Incluimos el fichero de la clase Db*/
    require '../clases/Db.class.php';
    /*Incluimos el fichero de la clase Conf*/
    require '../clases/Conf.class.php';
    $menusolici='';
    /*Creamos la instancia del objeto. Ya estamos conectados*/
    $bd=Db::getInstance();
	
    $sql = "SELECT `cedula`, `nombre`, `apellido` FROM  `usuario` u  JOIN `usuario_sistema` s ON s.cedulaNit = u.cedula  WHERE s.estado = 'A'";
    /*Ejecutamos la query*/
    $stmt=$bd->ejecutar($sql);
    $con = 0;
    while($rowcc=$bd->obtener_fila($stmt,0))
    {
     $menusolici .= '<tr><td >'.$rowcc['cedula'].'</td>'
             . '         <td >'.$rowcc['nombre'].' '.$rowcc['apellido'].'</td>'
             . '         <td class="Act"><img src="../../images/Actualizacion.png" width="30" height="30" onclick="Actualizar('.$rowcc['cedula'].','.$con.');" align="center" /></td>'
             . '         <td class="elimi"><img  src="../../images/delet.png" width="30" height="30" onclick="deleteRow('.$rowcc['cedula'].','.$con.');" align="center" /></td>'
             . '    </tr>';
     $con++;
    }
	