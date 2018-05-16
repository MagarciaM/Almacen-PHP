<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Inventario </title>
         <link rel="stylesheet" type="text/css" href="../styles/style.css">
    </head>
    <body>
        <?php
        
        include '../modelo/Inventario.php';
        include '../modelo/EstanteriaCajas.php';
        include '../modelo/CajaPosicion.php';
        
        session_start();
        $obj_inventario = $_SESSION['obj_inventario'];     
        ?>
        <header> 
            <h1> Inventario Fecha: 
            <?php echo $obj_inventario->getFecha_inv(); ?> 
            </h1>
        </header>
        <?php
        
            foreach ($obj_inventario->getarray_estanteriaCajas() as $estanteria) {
        ?>
                <table>
                    <thead>
                        <th> Tipo </th>
                        <th> Codigo </th>
                        <th> Material </th>
                        <th> Nº de Lejas </th>
                        <th> Pasillo </th>
                        <th> Nº de Pasillo </th>
                        <th> Lejas Ocupadas </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Estanteria </td>
                            <td> <?php echo $estanteria->getCodigo(); ?></td>
                            <td> <?php echo $estanteria->getMaterial(); ?></td>
                            <td> <?php echo $estanteria->getN_lejas(); ?></td>
                            <td> <?php echo $estanteria->getPasillo(); ?></td>
                            <td> <?php echo $estanteria->getN_pasillo(); ?></td>
                            <td> <?php echo $estanteria->getLejas_ocupadas(); ?></td>
                        </tr>
                        <thead>
                            <th class="titulo"> Tipo </th>
                            <th class="titulo"> Codigo </th>
                            <th class="titulo"> Altura </th>
                            <th class="titulo"> Anchura </th>
                            <th class="titulo"> Profundidad </th>
                            <th class="titulo"> Color </th>
                            <th class="titulo"> Material </th>
                            <th class="titulo"> Contenido </th>
                            <th class="titulo"> Fecha de Alta </th>
                        </thead>
                    
                        <?php
                            if ($estanteria->getArray_caja() != null) {
                                foreach ($estanteria->getArray_caja() as $caja) {
                        ?>
                                    <tr>
                                        <td> Caja </td>
                                        <td> <?php echo $caja->getCodigo(); ?></td>
                                        <td> <?php echo $caja->getAltura(); ?></td>
                                        <td> <?php echo $caja->getAnchura(); ?></td>
                                        <td> <?php echo $caja->getProfundidad(); ?></td>
                                        <td bgcolor="<?php echo $caja->getColor(); ?>"> <?php echo $caja->getColor(); ?></td>
                                        <td> <?php echo $caja->getMaterial(); ?></td>
                                        <td> <?php echo $caja->getContenido(); ?></td>
                                        <td> <?php echo $caja->getFecha_alta(); ?></td>
                                    </tr>
                        <?php
                                } 
                            } else {
                        ?>
                                    <td colspan="9"> Estanteria Libre </td>
                <?php
                            }
                    }
                ?>
            </tbody>
        </table>
        
        <button id="boton1" onclick="window.location.href='../vista/vista_menuInicial.php'"> Volver al Menu Inicial </button>
    </body>
</html>
