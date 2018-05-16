<?php

session_start();
include '../dao/Operaciones.php';

    $codigo = $_REQUEST['codigo'];
    $material = $_REQUEST['material'];
    $n_lejas = $_REQUEST['n_lejas'];
    $pasillo = $_REQUEST['pasillo'];
    $n_pasillo = $_REQUEST['n_pasillo'];

    $ObjEstanteria = new Estanteria($codigo, $material, $n_lejas, $pasillo, $n_pasillo);
    
    try {
        Operaciones::añadirEstanteria($ObjEstanteria);
        // Pasamos el control a vista_correcto y le pasamos por GET el msj que queremos que muestre
        header('Location:../vista/vista_correcto.php?msj=Estanteria añadida correctamente');
        
    } catch (EstanteriaException $e) {
        $_SESSION['e'] = $e;
        header('Location:../vista/vista_exception.php');
    }