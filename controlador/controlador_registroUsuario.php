<?php

include '../dao/Operaciones.php';
session_start();
    
    $nombre = $_REQUEST['nombre'];
    $pass = $_REQUEST['pass'];
    $pass_en = password_hash($pass, PASSWORD_BCRYPT);
    
    try {
        $usuario = new Usuario($nombre, $pass_en);
        Operaciones::registroUsuario($usuario);
        header('Location:../vista/vista_correcto_usuario.php?msj=Usuario añadido correctamente');
        
    } catch (UsuarioException $e) {
        $_SESSION['e'] = $e;
        header('Location:../vista/vista_exception.php');
    }