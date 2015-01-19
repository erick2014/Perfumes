<?php require("listarMP.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="../image/x-icon" href="/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Perfumes</title>
<link href="../../style/estilos_genericos.css" rel="stylesheet" type="text/css" />
<link href="../../style/estilo_unico.css" rel="stylesheet" type="text/css" />
<link href="../../style/style.css" rel="stylesheet" type="text/css" />
<link href="../../style/cupertino/jquery-ui-1.8.11.custom.css" rel="stylesheet" type="text/css" />
<!-- Link de los Estilos plos formularios------------------------------------------->
<link href="../../style/estilos_formularios.css" rel="stylesheet" type="text/css" />
<!-- Link de los Estilospara el menu-------->
<link href="../../style/estilos_menu.css" rel="stylesheet" type="text/css" />

<style type="text/css" title="currentStyle">
			@import "../../style/demo_page.css";
			@import "../../style/demo_table.css";
</style>

<script type="text/javascript" language="javascript" src="../../js/librerias/jquery-1.10.1.min.js"></script>
<script type="text/javascript" language="javascript" src="../../js/librerias/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="../../js/librerias/jquery.dataTables.js"></script>
<!---------------------------------------------------------------------------------------------------------------------------------------->
<script src="../../js/librerias/jquery.validate.js" type="text/javascript"></script>
<script src="../../js/validaciones/validar.js" type="text/javascript"></script>
<script src="../../js/validaciones/validarMP.js" type="text/javascript"></script>

</head>
<body>
<input type="hidden" id="urlDelete" value="eliminarMP.php" />
<div id="mensaje"></div>
<div id="GENERAL">

    <div id="USUARIO-3">
   <table width="948" border="0" cellpadding="0" cellspacing="0">
       <tr>
        <td width="269"> BIENVENIDO(A)</td>
		<td width="520" align="center" class="TITULO1"></td>
        <td width="159" align="right"><a href="../cerrar_session.php">CERRAR SESSION</a></td>
      </tr>
    </table>
  </div>

 <div id="BANNER-2"><div id="DIV_TITULO_PAGINA">INSCRITOS</div>
 	<div id="CONTENIDO"><a href="./menucss.php" class="btn1">VOLVER AL MENU PRINCIPAL </a><br />
         <div id="INFORMACION_PAGINA">
                  <div class="div_tablas" id="DIV_TABLA1">
                      <div  id="Nuevo"  class="btn1">Nueva materia prima</div> <br/><br/>
                      <table  width="784" border="0" align="center" cellpadding="0" cellspacing="0" class="informacion">
                           <center>
                                <thead>
                                 <tr>
                                       <th>Codigo</th>
                                       <th>Nombre</th>
                                       <th>Descripcion</th>
                                       <th>Cantidad</th>									
                                       <th>Estado</th>									
                                       <th>Editar</th>									
                                       <th>Eliminar</th>									
                                </tr>
                                </thead>
                                <?php echo "<tbody>".$menusolici."</tbody>";?>	
                            </center>
                      </table>
                  </div>
                 <div id="COMPLEMENTOS">
                            <a href="#" class="vinculos2">IR A MENU PRINCIPAL</a>
                     &nbsp;<a href="#" class="vinculos2">SALIR</a>
                 </div>
            </div>
	</div>
 </div>
</body>
</html>

<div id="contenedorform">
  <form id="materiaPrima" name="materiaPrima" >
    <!--links -->
    <input type="hidden" id="url_save_registro"  />
    <input type="hidden" name='pos' id='pos' />
    <table>
        <tr>
            <td>Codigo</td>
            <td>
                <input name='codigoMateriaPrima' id='codigoMateriaPrima' class="required" />
                <input type="hidden" name='codigoMViejo' id='codigoMViejo' class="required" />
            </td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><input name='nombre' id='nombre' class="required " /></td>
        </tr>
        <tr>
            <td>Descripcion</td>
            <td><input name='descripcion' id='descripcion' class="required" /></td>
        </tr>
         <tr>
            <td>Cantidad</td>
            <td><input name='cantidad' id='cantidad' class="required" /></td>
        </tr>
        
    </table>
  </form>
</div>