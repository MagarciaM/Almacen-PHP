<?php

session_start();
include_once '../dao/Operaciones.php';

try {
    $array_cajas = Operaciones::listarCajas();
    
    $_SESSION['array_cajas'] = $array_cajas; 
    // subimos el array de obj_estanteria que nos devuelve Operaciones a SESSION, para recogerlo en la vista

    header('Location:../vista/vista_listado_cajas.php');
} catch (Exception $e) {
    $_SESSION['e'] = $e;
    header('Location:../vista/vista_exception.php');
}



