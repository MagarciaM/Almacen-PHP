<?php

session_start();
include_once '../dao/Operaciones.php';

try {
    
    $array_estanterias = Operaciones::listarEstanterias();
    $_SESSION['array_estanterias'] = $array_estanterias; 
    // subimos el array de obj_estanteria que nos devuelve Operaciones a SESSION, para recogerlo en la vista
    header('Location:../vista/vista_listado_estanterias.php');
    
} catch (EstanteriaException $e) {
    $_SESSION['e'] = $e;
    header('Location:../vista/vista_exception.php');
}


