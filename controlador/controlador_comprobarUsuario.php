<?php

include '../dao/Operaciones.php';

    $usuario = Operaciones::comprobarUsuario();
    
    if ($usuario == null) {
        
        header("Location:../vista/vista_registroUsuario.php");
    } else {
        
        header("Location:../vista/vista_loginUsuario.php");
    }

