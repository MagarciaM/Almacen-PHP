<?php

include '../dao/Operaciones.php';
session_start();

    $nombre = $_REQUEST['nombre'];
    $pass = $_REQUEST['pass'];
    $usuario = new Usuario($nombre, $pass);
    
    try {
        Operaciones::loginUsuario($usuario);
        header('Location:../vista/vista_menuInicial.php');
    } catch (UsuarioException $e) {
        $_SESSION['e'] = $e;
        header('Location:../vista/vista_usuarioException.php');
    }
