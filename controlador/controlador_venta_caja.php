<?php

include '../dao/Operaciones.php';
include '../modelo/Ocupacion.php';

session_start();
       
    $codigo = $_REQUEST['codigo'];
    $option = $_SESSION['option'];
    //$option1 = ;
    
    // Comprobar si se ha clicado en volver o en vender
    if (!$_REQUEST['option']) {
        
        if ($option == 'venta') {
            try {
                Operaciones::ventaCaja($codigo);
                header('Location:../vista/vista_correcto.php?msj=Caja Vendida Correctamente');

            } catch (CajaException $e) {
                $_SESSION['e'] = $e;
                header('Location:../vista/vista_exception.php');
            }
        } else {
            try {
                $cod_estanteria = $_REQUEST['cod_estanteria'];
                $leja = $_REQUEST['leja'];
                
                $obj_ocupacion = new Ocupacion($codigo, $cod_estanteria, $leja);
                Operaciones::devolucionCaja($obj_ocupacion);
                header('Location:../vista/vista_correcto.php?msj=Caja Devuelta Correctamente');

            } catch (CajaException $e) {
                $_SESSION['e'] = $e;
                header('Location:../vista/vista_exception.php');
                
            // Recogemos la exception que creamos dentro de operaciones::añadircaja cuando se llama a id_estanteria
            } catch (EstanteriaException $e) { 

                $_SESSION['e'] = $e;
                header('Location:../vista/vista_exception.php');
            }
        }
    } else {
        header('Location:../vista/vista_busca_caja.php');
    }