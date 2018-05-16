<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Devolucion de Cajas </title>
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
        <script src="../js/JavaScript.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
        <?php
            include '../modelo/Estanteria.php';
            include '../modelo/CajaBackup.php';
            session_start();
            $array_estanterias = $_SESSION['array_estanterias'];
            $obj_cajaBackup = $_SESSION['obj_cajaBackup'];
        ?>
        <div class="form">
        	<header>
        		<h1> Devolucion de Cajas </h1>
        	</header>
		<form method="post" accept-charset="utf-8" action="../controlador/controlador_venta_caja.php">

                    <label> Código: <span class="required">*</span>
                        <input type="text" name="codigo" 
                            value="<?php echo $obj_cajaBackup->getCodigo(); ?>" readonly="readonly"><br>
                    </label>

                    <label> Color:
                        <input type="color" name="color" 
                            value="<?php echo $obj_cajaBackup->getColor(); ?>" id="color" readonly="readonly"><br>
                    </label>

                    <label> Altura:
                        <input type="text" name="altura" 
                            value="<?php echo $obj_cajaBackup->getAltura(); ?>" readonly="readonly"><br>
                    </label>

                    <label> Anchura: 
                        <input type="text" name="anchura" 
                            value="<?php echo $obj_cajaBackup->getAnchura(); ?>" readonly="readonly"><br>
                    </label>

                    <label> Profuncidad:
                        <input type="text" name="profundidad" 
                                value="<?php echo $obj_cajaBackup->getProfundidad(); ?>" readonly="readonly"><br>
                    </label>

                    <label> Material:
                        <input type="text" name="material" 
                            value="<?php echo $obj_cajaBackup->getMaterial(); ?>" readonly="readonly"><br>
                    </label>

                    <label> Contenido: 
                        <input type="text" name="contenido" 
                            value="<?php echo $obj_cajaBackup->getContenido(); ?>" readonly="readonly"><br>
                    </label>
                    
                    <label> Fecha Alta: 
                        <input type="date" 
                            value="<?php echo $obj_cajaBackup->getFecha_alta(); ?>" readonly="readonly">
                    </label>
                    
                    <label> Fecha Salida: 
                        <input type="date" 
                            value="<?php echo $obj_cajaBackup->getFecha_salida(); ?>" readonly="readonly">
                    </label>

                    <label> Antigua Ubicación </label>
                    
                    <label> Estanteria:
                        <input type="text"
                            value="<?php echo $obj_cajaBackup->getCod_estanteria(); ?>" readonly="readonly">
                    </label>
                    
                    <label> Leja:
                        <input type="text"
                            value="<?php echo $obj_cajaBackup->getLeja(); ?>" readonly="readonly">
                    </label>
                    
                    <label> Nueva Ubicación: </label>
                    
                    <label> Selecciona Estanteria 
                            <select id="Lista_Origen" onchange="muestraDestinos(this.value);" name="cod_estanteria">
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

                    <input type="button" onclick="window.location.href='../vista/vista_busca_caja.php'" value="Volver" id="boton">
                    <input type="submit" value="Confirmar Devolución" id="boton">
		</form>
	</div>
    </body>
</html>