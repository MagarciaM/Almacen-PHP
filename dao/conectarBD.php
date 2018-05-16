<?php

    //Establecer la conexión con el servidor
    $conexion= new mysqli("localhost","root","root");
  //print $conexion->server_info;

    /*if ($conexion) {
        echo "<h2> Conesión establecida con el servidor </h2>";
    } else {
        echo "<h2> No ha sido posible crear la conexión con el servidor </h2><br>";
    }*/
    // Seleccionar la base de datos
    $conexion->select_db("bd_almacen_magm") or die ("Base de Datos no encontrada");
        //echo "<h2> Conexión establecida con la base de datos bd_empleados </h2><br>";

?>
