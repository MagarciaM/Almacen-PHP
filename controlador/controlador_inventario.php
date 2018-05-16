<?php

session_start();
include '../dao/Operaciones.php';

try {
    $obj_inventario = Operaciones::inventario();
    $_SESSION['obj_inventario'] = $obj_inventario;

    header('Location:../vista/vista_inventario.php');
} catch (EstanteriaException $e) {
    $_SESSION['e'] = $e;
    header('Location:../vista/vista_exception.php');
}
    