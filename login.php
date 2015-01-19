<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <head>
        <title>New Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale = 1.0, maximum-scale = 1.0, user-scalable = no, width = device-width">
        <meta name="description" content="Description">
        <meta name="keywords" content="Keywords">
        
        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link rel="stylesheet" href="style/style.css" media="screen">
        <!--[if lte IE 7]><link rel="stylesheet" href="style/style.ie7.css" media="screen" /><![endif]-->
        <link rel="stylesheet" href="style/style.responsive.css" media="all">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Battambang|Andika&amp;subset=latin">
        <link rel="stylesheet" href="http://jquery.bassistance.de/validate/demo/site-demos.css">
        <script src="js/librerias/jquery-1.10.1.min.js"></script>
        <script src="js/validaciones/usuarios/validarLogin.js"></script>
        <link rel="stylesheet" href="js/librerias/jquery-ui-1.10.3.custom.min.css">

        <script src="js/librerias/jquery.validate.min.js"></script>
        <script src="js/librerias/additional-methods.js"></script>
        <script src="js/librerias/messages_es.js"></script>
        
         <style>.art-content .art-postcontent-0 .layout-item-0 { border-bottom-style:solid;border-bottom-width:0px;border-bottom-color:#65787B; padding-right: 10px;padding-left: 20px;  }
    .ie7 .post .layout-cell {border:none !important; padding:0 !important; }
    .ie6 .post .layout-cell {border:none !important; padding:0 !important; }

         </style>
         
    </head>
<body>
<input type="hidden" id="url_login" value="./php/funciones/validarLogin.php" />
<div id="art-main">
    <header class="art-header clearfix">
        <div class="art-shapes">  </div>
    </header>
    <div class="art-sheet clearfix">
         <div class="art-layout-wrapper clearfix" style="margin-left: 30%;">
             <form id="frmLogin" name="frmLogin">
                    <table id="tblLogin">
                        <tr>
                            <td>Cedula</td>
                            <td><input type="text" id="cedula" name="cedula" ></td>
                            <td><label id="divcedula"></label></td>
                        </tr>
                        <tr>
                            <td>Clave</td>
                            <td><input type="password" id="clave" name="clave" ></td>
                            <td><label id="divclave"></label></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="ingresar" id="btnLogin" ></td>
                        </tr>
                    </table>
               </form>
         </div>
    </div>
    
</div>


</body></html>
