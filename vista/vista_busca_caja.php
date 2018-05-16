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
            include '../modelo/Caja.php';    
            session_start();
            $array_cajas = $_SESSION['array_cajas']; 
        ?>
            <header>
                <h1> Buscar Caja </h1>
            </header>
            <div class="form">
                <form method="post" accept-charset="utf-8" action="../controlador/controlador_datos_caja_venta.php">
                    <label> Introduce Código: 
                        <input list="cajas" name="codigo" required="required" autofocus="autofocus">
                    </label>
                    
                    <datalist id="cajas">
                        <?php
                            foreach ($array_cajas as $caja) {
                        ?>
                        <option value="<?php echo $caja->getCodigo();?>">
                        <?php
                            }
                        ?>
                    </datalist>
                    
                    <input type="button" onclick="window.location.href='../vista/vista_menuInicial.php'" value="Volver" id="boton">
                    <input type="submit" value="Buscar" id="boton">
                </form>   
            </div>
    </body>
</html>

