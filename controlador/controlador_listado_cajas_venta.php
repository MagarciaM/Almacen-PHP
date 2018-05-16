<?php
include '../dao/Operaciones.php';
session_start();
    
    $option = $_REQUEST['option'];
    
    try {
        if ($option == 'venta') {
            $array_cajas = Operaciones::listarCajas();
        } else {
            $array_cajas = Operaciones::listarCajasBackup();
        }

        $_SESSION['array_cajas'] = $array_cajas;
        $_SESSION['option'] = $option;
        header('Location:../vista/vista_busca_caja.php');
        
    } catch (CajaException $e) {
            $_SESSION['e'] = $e;
            header('Location:../vista/vista_exception.php');
        }