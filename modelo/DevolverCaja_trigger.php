<?php

    // Comprobamos si existe el trigger y lo borramos en ese caso ya que no nos permite OR REPLACE
    $ordenSQL1 = "DROP TRIGGER IF EXISTS devolucion_caja"; 
    $res1 = $conexion->query($ordenSQL1);

    // Triger desde PHP
    $trigger = "CREATE TRIGGER `devolucion_caja` "
                . " BEFORE DELETE ON `caja_backup` FOR EACH ROW"
                . " BEGIN"

                . " INSERT INTO caja (id, codigo_caja, altura, anchura, profundidad, color, material, contenido, fecha_alta)"
                . "     VALUES (NULL, OLD.codigo_caja, OLD.altura, OLD.anchura, OLD.profundidad, OLD.color, OLD.material, OLD.contenido, OLD.fecha_alta);"

                . " INSERT INTO ocupacion (id, id_caja, id_estanteria, leja_ocupada)"
                . "     VALUES (NULL, (SELECT id FROM caja WHERE codigo_caja = OLD.codigo_caja), "
                . "               '" . $id_estanteria . "', '" . $leja . "');"

                . " UPDATE estanteria SET lejas_ocupadas = lejas_ocupadas + 1 "
                                . "WHERE codigo_estanteria = '" . $cod_estanteria . "';"
                . " END;";
    $res2 = $conexion->query($trigger);