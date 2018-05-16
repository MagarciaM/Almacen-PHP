<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include '../dao/Operaciones.php';
            //OBTENEMOS LA VARIABLE Origen
            $codEstanteria=$_REQUEST['Lista_Origen'];
            // Se hace la consulta oportuna en la clase Operaciones
            
            // No necesitamos controlarlo con un try ya que la informacion se encuentra dentro de un select
            $array_lejas_libres = Operaciones::lejasLibres($codEstanteria);
            
            foreach ($array_lejas_libres as $valor) {
            ?>
                <option value="<?php echo $valor;?>"> <?php echo $valor;?> </option>
            <?php
            }
            ?>
    </body>
</html>
