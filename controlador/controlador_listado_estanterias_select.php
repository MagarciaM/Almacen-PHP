<?php

session_start();
include_once '../dao/Operaciones.php';

    try {
        $array_estanterias = Operaciones::estanteriasLibres();

        $_SESSION['array_estanterias'] = $array_estanterias; 
        // subimos el array de obj_estanteria que nos devuelve Operaciones a SESSION, para recogerlo en la vista

        $option = $_REQUEST['option'];
        $_SESSION['option'] = $option;

        if ($option == 'devolucion') {
            header('Location:../controlador/controlador_listado_cajas_venta.php');
        } else {
            header('Location:../vista/vista_alta_caja.php');
        }
        
    } catch (EstanteriaException $e) {
        
        $_SESSION['e'] = $e;
        header('Location:../vista/vista_exception.php');
    }
    
    

