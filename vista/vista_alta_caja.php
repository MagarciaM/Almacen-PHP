<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Alta Cajas </title>
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
        <script src="../js/JavaScript.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
        <?php
            include '../modelo/Estanteria.php';    
            session_start();
            $array_estanterias = $_SESSION['array_estanterias']; 
        ?>
        <div class="form">
        	<header>
        		<h1> Alta Cajas </h1>
        	</header>
		<form method="post" accept-charset="utf-8" action="../controlador/controlador_alta_caja.php">

			<label> Código: <span class="required">*</span>
				<input type="text" name="codigo" value="" required="required" autofocus="autofocus"><br>
			</label>

			<label> Color:
				<input type="color" name="color" value="" id="color"><br>
			</label>

			<label> Altura: <span class="required">*</span>
				<input type="number" name="altura" value="" required="required" placeholder="cm" min="1"><br>
			</label>

			<label> Anchura: <span class="required">*</span>
				<input type="number" name="anchura" value="" required="required" min="1"><br>
			</label>

			<label> Profuncidad: <span class="required">*</span>
				<input type="number" name="profundidad" value="" required="required" min="1"><br>
			</label>

			<label> Material: <span class="required">*</span>
				<input type="text" name="material" value="" required="required"><br>
			</label>

			<label> Contenido: <span class="required">*</span> 
				<input type="text" name="contenido" value="" required="required"><br>
			</label>

			<label> Selecciona Estanteria 
				<select id="Lista_Origen" onchange="muestraDestinos(this.value);" name="estanteria">
                                    <option value=""> </option>
                                    <?php 
					foreach ($array_estanterias as $valor) {
                                    ?>
                                        <option value="<?php echo $valor->getCodigo(); ?>"> 
                                            <?php echo "Cod:" . $valor->getCodigo() 
                                                        . " Pasillo:" . $valor->getPasillo()
                                                        . " Nº:" . $valor->getN_pasillo()?> 
                                        </option>
                                    <?php
                                        }
                                    ?>
				</select>
			</label>

			<br>

			<label for="name"> Lejas Disponibles 
				<select id="Lista_Destino" name="leja">
                                    <option value=""> </option>
				</select>
			</label>
                        
                        <input type="button" onclick="window.location.href='../vista/vista_menuInicial.php'" value="Volver" id="boton">
			<input type="submit" value="Enviar" id="boton">
		</form>
	</div>
    </body>
</html>

