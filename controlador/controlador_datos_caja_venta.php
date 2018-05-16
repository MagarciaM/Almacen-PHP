<?php
include '../dao/Operaciones.php';
session_start();
    $cod_caja = $_REQUEST['codigo'];
    $option = $_SESSION['option']; // Rescatamos la variable que nos indica si es venta o devolucion
    
    if($option == 'venta') {
        try {
            $obj_cajaBackup = Operaciones::datos_caja($cod_caja);
            $_SESSION['obj_cajaBackup'] = $obj_cajaBackup;
            header('Location:../vista/vista_venta_caja.php');
        } catch (CajaException $e) {
            $_SESSION['e'] = $e;
            header('Location:../vista/vista_exception.php');
        }
    
    } else {
        try {
            $obj_cajaBackup = Operaciones::datos_cajaBackup($cod_caja); 
            $_SESSION['obj_cajaBackup'] = $obj_cajaBackup;
            header('Location:../vista/vista_devolucion_caja.php');
        } catch (CajaException $e) {
            $_SESSION['e'] = $e;
            header('Location:../vista/vista_exception.php');
        }
    }
    
