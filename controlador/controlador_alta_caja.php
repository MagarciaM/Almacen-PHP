<?php

//include_once '../modelo/Caja.php';
include '../modelo/Ocupacion.php';
include '../dao/Operaciones.php';

    $codigo = $_REQUEST['codigo'];
    $altura = $_REQUEST['altura'];
    $anchura = $_REQUEST['anchura'];
    $profundidad = $_REQUEST['profundidad'];
    $color = $_REQUEST['color'];
    $material = $_REQUEST['material'];
    $contenido = $_REQUEST['contenido'];

    $cod_estanteria = $_REQUEST['estanteria'];
    $leja = $_REQUEST['leja'];

    $ObjCaja = new Caja($codigo, $altura, $anchura, $profundidad, $color, $material, $contenido);
    $ObjOcupacion = new Ocupacion($ObjCaja, $cod_estanteria, $leja);
    
    session_start();
    
    try {
        // Pasamos el obj Ocupacion, que contiene un ObjCaja y cod_estanteria y su leja
        Operaciones::añadirCaja($ObjOcupacion);
        header('Location:../vista/vista_correcto.php?msj=Caja añadida correctamente');
    
    // Recogemos la exception que creamos dentro de operaciones::añadircaja
    } catch (CajaException $e) { 
        $_SESSION['e'] = $e;
        header('Location:../vista/vista_exception.php');
    
    // Recogemos la exception que creamos dentro de operaciones::añadircaja cuando se llama a id_estanteria
    } catch (EstanteriaException $e) { 

        $_SESSION['e'] = $e;
        header('Location:../vista/vista_exception.php');
    }

