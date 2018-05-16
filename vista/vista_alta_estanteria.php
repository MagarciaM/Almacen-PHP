<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> Alta Estantería </title>
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
    </head>
    <body>
        <div class="form">
        	<header>
        		<h1> Alta Estantería </h1>
        	</header>
            <form method="post" accept-charset="utf-8" action="../controlador/controlador_alta_estanteria.php">

                <label for="name" > Código: <span class="required">*</span>
                        <input type="text" name="codigo" value="" required="required" autofocus="autofocus"><br>
                </label>

                <label for="name" > Material: <span class="required">*</span>
                        <input type="text" name="material" value="" required="required"><br>
                </label>

                <label for="name" > Nº de Lejas: <span class="required">*</span>
                        <input type="number" name="n_lejas" value="1" required="required" max="10" min="1"><br>
                </label>

                <label for="name" > Pasillo: <span class="required">*</span>
                        <input type="text" name="pasillo" value="" required="required"><br>
                </label>

                <label for="name" > Nº Pasillo: <span class="required">*</span>
                        <input type="number" name="n_pasillo" value="" required="required" min="0"><br>
                </label>
                
                <input type="button" onclick="window.location.href='../vista/vista_menuInicial.php'" value="Volver" id="boton">
                <input type="submit" value="Enviar" id="boton">
		  </form>
	   </div>
    </body>
</html>
