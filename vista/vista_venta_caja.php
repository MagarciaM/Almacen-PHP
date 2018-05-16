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
            include '../modelo/CajaBackup.php';    
            session_start();
            $obj_cajaBackup = $_SESSION['obj_cajaBackup'];
        ?>

            <header>
                <h1> Venta de Cajas </h1>
            </header>
        
            <div class="form">
                <form method="post" accept-charset="utf-8" action="../controlador/controlador_venta_caja.php">
                    <label> Código: 
                        <input name="codigo" value="<?php echo $obj_cajaBackup->getCodigo();?>" autofocus="autofocus" readonly="readonly">
                    </label>
                    
                    <input type="button" onclick="window.location.href='../controlador/controlador_venta_caja.php?option=volver'" value="Volver" id="boton">
                    <input type="submit" value="Confirmar" id="boton">
                </form>   
            </div>
        <div class="">
            <table>
                <thead>
                    <th> Código Caja</th>
                    <th> Altura </th>
                    <th> Anchura </th>
                    <th> Profundidad </th>
                    <th> Color </th>
                    <th> Material </th>
                    <th> Contenido </th>
                    <th> Fecha de Alta </th>
                    <th> Código estantería </th>
                    <th> Leja Ocupada </th>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $obj_cajaBackup->getCodigo(); ?> </td>
                        <td><?php echo $obj_cajaBackup->getAltura(); ?></td>
                        <td><?php echo $obj_cajaBackup->getAnchura(); ?> </td>
                        <td><?php echo $obj_cajaBackup->getProfundidad(); ?> </td>
                        <td bgcolor="<?php echo $obj_cajaBackup->getColor(); ?>"> <?php echo $obj_cajaBackup->getColor(); ?></td>
                        <td><?php echo $obj_cajaBackup->getMaterial(); ?> </td>
                        <td><?php echo $obj_cajaBackup->getContenido(); ?> </td>
                        <td><?php echo $obj_cajaBackup->getFecha_alta(); ?> </td>
                        <td><?php echo $obj_cajaBackup->getCod_estanteria(); ?> </td>
                        <td><?php echo $obj_cajaBackup->getLeja(); ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>