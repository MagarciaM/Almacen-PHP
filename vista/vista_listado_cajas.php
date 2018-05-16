<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> Listado Cajas </title>
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
    </head>
    <body>
        <?php
        include_once "../modelo/Caja.php";
        
        session_start();
        $array_cajas = $_SESSION['array_cajas'];
        ?>
        <table>
            <thead>
                <th> Codigo </th>
                <th> Altura </th>
                <th> Anchura </th>
                <th> Profundidad </th>
                <th> Color </th>
                <th> Material </th>
                <th> Contenido </th>
                <th> Fecha de Alta </th>
            </thead>
            <tbody>
                <?php
                    foreach ($array_cajas as $valor) {
                        ?>
                    <tr>
                        <td> <?php echo $valor->getCodigo(); ?></td>
                        <td> <?php echo $valor->getAltura(); ?></td>
                        <td> <?php echo $valor->getAnchura(); ?></td>
                        <td> <?php echo $valor->getProfundidad(); ?></td>
                        <td bgcolor="<?php echo $valor->getColor(); ?>"> <?php echo $valor->getColor(); ?></td>
                        <td> <?php echo $valor->getMaterial(); ?></td>
                        <td> <?php echo $valor->getContenido(); ?></td>
                        <td> <?php echo $valor->getFecha_alta(); ?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        
        <button id="boton1" onclick="window.location.href='../vista/vista_menuInicial.php'"> 
            Volver al Menu Inicial 
        </button>
    </body>
</html>
