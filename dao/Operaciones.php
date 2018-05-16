<?php
/**
 * Description of Operaciones
 *
 * @author migue
 */
include '../dao/conectarBD.php';
//include '../modelo/Estanteria.php';
//include_once '../modelo/Caja.php';
include '../modelo/Inventario.php';
include_once '../modelo/EstanteriaCajas.php';
//include_once '../modelo/CajaPosicion.php';
include '../modelo/CajaException.php';
include '../modelo/EstanteriaException.php';
include '../modelo/CajaBackup.php';
include '../modelo/Usuario.php';
include '../modelo/UsuarioException.php';

// incluimos lo que necesitamos para las funciones

// los errores se controlan con throw y lo recogemos con el try catch en el controlador correspondiente
class Operaciones {
    
    public function añadirEstanteria($ObjEstanteria){
        $codigo = $ObjEstanteria->getCodigo();
        $material = $ObjEstanteria->getMaterial();
        $n_lejas = $ObjEstanteria->getN_lejas();
        $pasillo = $ObjEstanteria->getPasillo();
        $n_pasillo = $ObjEstanteria->getN_pasillo();
        $lejas_ocupadas = 0;
        
        global $conexion; // Necesitamos traer esta variable porque el conectar esta fuera de la funcion
        
        // Usamos sentenicas preparadas
        $ordenSQL = ("INSERT INTO estanteria (codigo_estanteria, material, n_lejas, pasillo, n_pasillo, lejas_ocupadas)"
                . "VALUES (?,?,?,?,?,?);");
        $sql = $conexion->prepare($ordenSQL); 
        // Vinculamos las ?? con los parametros, diciendo que tipo son s=VARCHAR i=integer
        $sql->bind_param("ssissi",$codigo, $material, $n_lejas, $pasillo, $n_pasillo, $lejas_ocupadas);
        $res = $sql->execute();// internamente comprueba que no es maliciosa y la ejecuta
        
        if (!$res) {
            throw new EstanteriaException($conexion->error, $conexion->errno, "Error en la inserción de datos de la Estanteria");
        }
    }
    
    // Funcion que devuelve un array de obj_estanterias
    public function listarEstanterias() {
        
        $ordenSQL = ("SELECT * FROM estanteria");
        global $conexion;
        $res = $conexion->query($ordenSQL);
        $dimension = $res->num_rows; // guardamos en $dimension el numero de filas que nos devuelve el SELECT
        
        if ($dimension > 0) {
            
            for ($i=0 ; $i<$dimension ; $i++) {
                $aux[] = $res->fetch_array();
                $arrayEstanterias[]= new Estanteria($aux[$i]['codigo_estanteria'], 
                                                    $aux[$i]['material'], 
                                                    $aux[$i]['n_lejas'], 
                                                    $aux[$i]['pasillo'], 
                                                    $aux[$i]['n_pasillo']);
                $arrayEstanterias[$i]->setLejas_ocupadas($aux[$i]['lejas_ocupadas']);
                /* Tenemos que añadir las lejas ocupadas que nos devuelve el SELECT
                 * pero desde el set ya que el contructor no tiene este parametro
                 */
            }
            return $arrayEstanterias;
            
        } else {
            throw new EstanteriaException($conexion->error, $conexion->errno, "Error, no se encuentran Estanterías Disponibles");
        }
    }
    
    // Funcion que nos devuelve un array de obj_estanterias que las cuales tienes lejas libres
    public function estanteriasLibres() {
        
        $ordenSQL = ("SELECT * FROM estanteria WHERE lejas_ocupadas<n_lejas");
        global $conexion;
        $res = $conexion->query($ordenSQL);
        $dimension = $res->num_rows;
        
        if ($dimension > 0) {
            
            for ($i=0 ; $i<$dimension ; $i++) {
                $aux[] = $res->fetch_array();
                $arrayEstanterias[]= new Estanteria($aux[$i]['codigo_estanteria'], 
                                                    $aux[$i]['material'], 
                                                    $aux[$i]['n_lejas'], 
                                                    $aux[$i]['pasillo'], 
                                                    $aux[$i]['n_pasillo']);
                $arrayEstanterias[$i]->setLejas_ocupadas($aux[$i]['lejas_ocupadas']);
                /* Tenemos que añadir las lejas ocupadas que nos devuelve el SELECT
                 * pero desde el set ya que el contructor no tiene este parametro
                 */
            }
            return $arrayEstanterias;
            
        } else {
            throw new EstanteriaException($conexion->error, $conexion->errno, "Error, no se encuentran Estanterías con lejas Libres");
        }
    }
    
    // Funcion que nos devuelve las lejas libres de una estanteria a partir de su codigo, 
    // no necesitamos controlar el error ya que el codestanteria viene de un select de un formulario controlado
    public function lejasLibres ($codEstanteria) {
        
        global $conexion;
        
        $ordenSQL1 = ("SELECT e.n_lejas FROM estanteria e WHERE e.codigo_estanteria='" . $codEstanteria . "'");
            
        $res1 = $conexion-> query ($ordenSQL1);
        $nfilas1 = $res1->num_rows;

        if ($nfilas1 > 0) {
            $fila = $res1->fetch_array();
            $lejas_totales = $fila[0];
        }

        for ($i=0 ; $i<$fila[0] ; $i++) {
            // Generamos un array con el numero de lejas totales de la estanteria, cada posicion contiene el numero de leja
            $array_lejas_totales[]=(String)$i+1; 
        }

        $ordenSQL2 = ("SELECT o.leja_ocupada FROM ocupacion o "
                    . "WHERE (SELECT id FROM estanteria WHERE codigo_estanteria='" 
                    . $codEstanteria ."') = o.id_estanteria");
        $res2 = $conexion-> query ($ordenSQL2);
        $nfilas2 = $res2->num_rows;

        if ($nfilas2 > 0) { 
            for ($i=0 ; $i<$nfilas2 ; $i++) {
                $aux[] = $res2->fetch_array();
                $array_lejas_ocupadas[]=$aux[$i][0]; // Generamos un array con las lejas ocupadas
            }
            $array_lejas_libres = array_diff($array_lejas_totales, $array_lejas_ocupadas);   
            // Usamos fucion que nos devuelve la diferencia de valores entre los 2 array y creamos un array con la ella
        } else {
            for ($i=1 ; $i<$lejas_totales+1 ; $i++) {
                // Sino tiene ninguna leja ocuapada rellenamos el array con las lejas totales
                $array_lejas_libres[]=$i;
            }
        }
        return $array_lejas_libres;
    }
    
    //funcion que nos devuelve el id_estanteria a partir de su codigo
    public function id_estanteria ($cod_estanteria) {
        
        $ordenSQL2 = "SELECT id FROM estanteria WHERE codigo_estanteria = '" . $cod_estanteria . "'";
        global $conexion;
        $res2 = $conexion->query($ordenSQL2);
        $nfilas2 = $res2->num_rows;

        if ($nfilas2 > 0) {
            $fila = $res2->fetch_array();
            $id_estanteria = $fila[0]; // extraemos el id de estanteria
            return $id_estanteria;
        } else {
            throw new EstanteriaException($conexion->error, $conexion->errno, "Error, estantería no encontrada");
        }    
    }
    
     //funcion que nos devuelve el id_CAJA a partir de su codigo
    public function id_caja ($cod_caja) {
        
        $ordenSQL2 = "SELECT id FROM caja WHERE codigo_caja = '" . $cod_caja . "'";
        global $conexion;
        $res2 = $conexion->query($ordenSQL2);
        $nfilas2 = $res2->num_rows;

        if ($nfilas2 > 0) {
            $fila = $res2->fetch_array();
            $id_caja = $fila[0]; // extraemos el id de caja
            return $id_caja;
            
        } else {
            throw new CajaException($conexion->error, $conexion->errno, "Error, Caja no encontrada");
        }        
    }
    
    // Funcion que añade una Caja apartir de un objOcupacion
    public function añadirCaja ($ObjOcupacion){
        // Recibimos un ObjOcupacion que contiene un ObjCaja, cod_estanteria y leja ocupada
        
        $codigo = $ObjOcupacion->getCaja()->getCodigo();
        $altura = $ObjOcupacion->getCaja()->getAltura();
        $anchura = $ObjOcupacion->getCaja()->getAnchura();
        $profundidad = $ObjOcupacion->getCaja()->getProfundidad();
        $color = $ObjOcupacion->getCaja()->getColor();
        $material = $ObjOcupacion->getCaja()->getMaterial();
        $contenido = $ObjOcupacion->getCaja()->getContenido();
        $fecha_alta = $ObjOcupacion->getCaja()->getFecha_alta();
        
        $cod_estanteria = $ObjOcupacion->getCod_estanteria();
        $leja = $ObjOcupacion->getLeja();
        
        global $conexion;
        $conexion->autocommit(false); // Quitamos que se ejecute automatico las ordenes SQL (transaccion)
        
        // Comprobamos que el codigo que instroducimos no este en la tabla de backup ya que sino no podriamos venderla
        $ordenSQL0 = "SELECT codigo_caja FROM caja_backup;";
        $res0 = $conexion->query($ordenSQL0);
        $filas = $res0->fetch_array();
        //$filas = $res0->num_rows;
        
        foreach ($filas as $fila) {

            if ($codigo == $fila) {
                throw new CajaException ($conexion->error, $conexion->errno, "Error, el codigo ya se encuentra en uso");
            }
        }
          
        $ordenSQL1 = "INSERT INTO caja (codigo_caja, altura, anchura, profundidad, color, material, contenido, fecha_alta)"
            . " VALUES ('$codigo','$altura','$anchura','$profundidad','$color','$material','$contenido', '$fecha_alta');";

        $res1 = $conexion->query($ordenSQL1);
        $id_caja = $conexion->insert_id;
        
        if (!$res1) {
            throw new CajaException($conexion->error, $conexion->errno, "Error en la inserción de datos de la caja"); // Si no se realiza el INSERT creamos la Exception y la recoge el controlador_alta_caja
        }      
        
        // si esta funcion produce un error lo recogemos en el controlador
        $id_estanteria = Operaciones::id_estanteria($cod_estanteria);
        
        $ordenSQL3 = "INSERT INTO ocupacion (id_caja, id_estanteria, leja_ocupada)"
                        . "VALUES ('$id_caja', '$id_estanteria', '$leja');";

        $res3 = $conexion->query($ordenSQL3);
        
        if (!$res3) {
            throw new CajaException($conexion->error, $conexion->errno, "Error en los datos de ubicación de la caja");
        }
        
        $ordenSQL4 = "UPDATE estanteria SET lejas_ocupadas = lejas_ocupadas + 1 "
                                . "WHERE codigo_estanteria = '" . $cod_estanteria . "'";

        $res4 = $conexion->query($ordenSQL4);
        if (!$res4) {
            throw new CajaException("Error UPDATE estanteria", 4);
        }
        
        /* Guardamos todas las ordenes SQL en un bufer con el autocommit(false)
         *  y hasta que no ponemos el commit() no se ejecutan. Y con el rollback() borramos todas
         * las sentencias de ese bufer. Transacciones.
         */
        
        if ($res1 && $id_estanteria && $res3 && $res4) {
            $conexion->commit(); // Si todo va bien, lo ejecuta todo del golpe
        } else {
            $conexion->rollback(); // Sino no ejecutes ninguna orden SQL de las anteriores
        }
    }
    
    // Funcion que lista las cajas en un array
    public function listarCajas () {
        $ordenSQL = ("SELECT * FROM caja");
        global $conexion;
        $res = $conexion->query($ordenSQL);
        $dimension = $res->num_rows;
        
        if ($dimension > 0) {
            
            for ($i=0 ; $i<$dimension ; $i++) {
                $aux[] = $res->fetch_array();
                $arrayCajas[]= new Caja($aux[$i]['codigo_caja'], 
                                        $aux[$i]['altura'], 
                                        $aux[$i]['anchura'], 
                                        $aux[$i]['profundidad'],
                                        $aux[$i]['color'],
                                        $aux[$i]['material'],
                                        $aux[$i]['contenido']);
                
                $arrayCajas[$i]->setFecha_alta($aux[$i]['fecha_alta']); 
                /*
                 * Necesitamos contruir una caja con la fecha que recogemos de la bbdd, desde setFecha_alta
                 * ya que por defecto en el constructor se pone la actual.
                 */
            }
            return $arrayCajas;
            
        } else {
            throw new CajaException($conexion->error, $conexion->errno, "Error, no hay ninguna caja registrada");
        }
    }
    
    // Devuelve las cajas que se encuntran en cajaBackup (solo caja normales ya que solo lo usamos para buscar)
    public function listarCajasBackup () {
        $ordenSQL = ("SELECT * FROM caja_backup");
        global $conexion;
        $res = $conexion->query($ordenSQL);
        $dimension = $res->num_rows;
        
        if ($dimension > 0) {
            
            for ($i=0 ; $i<$dimension ; $i++) {
                $aux[] = $res->fetch_array();
                $arrayCajas[]= new Caja($aux[$i]['codigo_caja'], 
                                        $aux[$i]['altura'], 
                                        $aux[$i]['anchura'], 
                                        $aux[$i]['profundidad'],
                                        $aux[$i]['color'],
                                        $aux[$i]['material'],
                                        $aux[$i]['contenido']);
                
                $arrayCajas[$i]->setFecha_alta($aux[$i]['fecha_alta']); 
                /*
                 * Necesitamos contruir una caja con la fecha que recogemos de la bbdd, desde setFecha_alta
                 * ya que por defecto en el constructor se pone la actual.
                 */
            }
            return $arrayCajas;
            
        } else {
            throw new CajaException($conexion->error, $conexion->errno, "Error, no hay ninguna caja registrada en backup");
        }
    }
    
    // Funcion que devuelve un obj_cajaPosicion a partir de su id
    public function obj_cajaPosicion ($id_caja) { 
        global $conexion;
        
        // Obtenemos la leja que ocupa la caja a partir de su id
        $ordenSQL1 = "SELECT leja_ocupada FROM ocupacion WHERE id_caja = '" . $id_caja . "';";
        $res1 = $conexion->query($ordenSQL1);
        $dimension1 = $res1->num_rows;
        
        if ($dimension1 > 0) {
            $fila = $res1->fetch_array();
            $leja_ocupada = $fila[0];
        } else {
            $leja_ocupada = -1;
        }
        
        // Sacamos todas las propiedades de caja de su tabla y le añadimos la leja
        $ordenSQL2 = "SELECT * FROM caja WHERE id = '" . $id_caja . "'";
        $res2 = $conexion->query($ordenSQL2);
        $dimension2 = $res2->num_rows;
        
        if ($dimension2 > 0) {
            $aux = $res2->fetch_array();
            $obj_caja= new Caja($aux['codigo_caja'], 
                                    $aux['altura'], 
                                    $aux['anchura'], 
                                    $aux['profundidad'],
                                    $aux['color'],
                                    $aux['material'],
                                    $aux['contenido']);
            $obj_caja->setFecha_alta($aux['fecha_alta']);
            $obj_caja->setId($id_caja);
            
            $obj_cajaPosicion = new CajaPosicion($obj_caja, $leja_ocupada);
            $obj_cajaPosicion->setFecha_alta($obj_caja->getFecha_alta());
        } else {
            throw new CajaException($conexion->error, $conexion->errno, "Error, Caja no encontrada");
        }
        return $obj_cajaPosicion;
    }
    
    // Funcion para inventario, devuelve un obj_inventario (array_estanteriaCajas[] y fecha)
    // Nohacemos throw ya que sino hay estaterias saltaria error de listarestanteria y sino tienen cajas las mostrarmos sin ellas
    public function inventario () {
        
        $array_estanterias = Operaciones::listarEstanterias();   
        
        foreach ($array_estanterias as $estanteria) {
            
            $cod_estanteria = $estanteria->getCodigo();
            $id_estanteria = Operaciones::id_estanteria($cod_estanteria);
            
            $ordenSQL = "SELECT id_caja FROM ocupacion WHERE id_estanteria = '" . $id_estanteria . "'";
            global $conexion;
            $res = $conexion->query($ordenSQL);
            $dimension = $res->num_rows;
            
            if ($dimension > 0) {
                for ($i=0 ; $i<$dimension ; $i++) {
                    $array_idCaja = $res->fetch_array();
                    // LLamamos a la función que nos devuelve un obj_caja a partir de su id
                    $obj_caja = Operaciones::obj_cajaPosicion($array_idCaja['id_caja']); 
                    // Llenamos el array con obj_caja
                    $array_caja[] = $obj_caja;
                }
                
                // Contruimos la estanteria con cajas, pasamos un obj_estanteria y un array de obj_cajas
                $obj_estanteriaCajas = new EstanteriaCajas($estanteria, $array_caja);
                
                // volvemos a dejar le array de cajas vacio para que se llene con las cajas de la siguiente estanteria
                $array_caja = null; 

                $array_estanteriaCajas[] = $obj_estanteriaCajas; 
            } else {
                
                // Construimos la estanteria sin cajas y se la añadimos al array de estanterias
                $obj_estanteriaCajas = new EstanteriaCajas($estanteria, null);
                $array_estanteriaCajas[] = $obj_estanteriaCajas;
            }
        }
        $obj_inventario = new Inventario($array_estanteriaCajas);
        return $obj_inventario;
    }
    
    // Funcion para eliminar una caja y añadirla a la tabla de caja_backup
    public function ventaCaja($cod_caja) {
        
        // Realizamos toda la operacion mediante un obj_cajaBackup(caja Posicion(caja normal + leja) + cod_estanteria)
        $obj_cajaBackup = Operaciones::datos_caja($cod_caja);
                
        global $conexion;
        $conexion->autocommit(false);
        
        /* 
         * Ejecutamos la sentencia de borrar caja y desde el disparador creado, quitamos una leja ocupada
         * en la estanteria correspondiente, hacemos la copia de los datos de caja menos donde se ubicaba (estanteria y leja)
         * y quitamos la fila correspondiente en la tabla de ocupacion.
         * Podemos hacer todas las operaciones desde el disparados, pero devidimos carga
         */
        
        $ordenSQL2 = "DELETE FROM caja WHERE id = '" . $obj_cajaBackup->getId() ."';";
        $res2 = $conexion->query($ordenSQL2);
        
        if (!$res2) {
            throw new CajaException($conexion->error, $conexion->errno, "Error al eliminar la Caja");
        }
        
        // Actualizamos los datos de la ubicacion de la caja en la tabla caja_bakup
        $ordenSQL3 = "UPDATE caja_backup "
                    . "SET cod_estanteria = '" . $obj_cajaBackup->getCod_estanteria() . "', leja = '" . $obj_cajaBackup->getLeja() . "'"
                    . "WHERE codigo_caja = '" . $cod_caja . "';";
        $res3 = $conexion->query($ordenSQL3);
        
        if (!$res3) {
            throw new CajaException($conexion->error, $conexion->errno, "Error, al actulizar registros ocupacion");
        }
        
        if (/*$id_estanteria &&*/ $res2 && $res3) {
            $conexion->commit();
        } else {
            $conexion->rollback();
        }
    }
    
    // Funcion la cual a partir de un cod_caja devuelve una caja backup (cajaPosicion(caja + leja), y estanteria)
    function datos_caja($cod_caja){
        
        $id_caja = Operaciones::id_caja($cod_caja);
        
        $obj_cajaPosicion = Operaciones::obj_cajaPosicion($id_caja);
        
        global $conexion;
        
        // Sacamos el cod_estanteria que ocupa al caja, a partir del id_estanteria de ocupacion
        $ordenSQL1 = 'SELECT codigo_estanteria FROM estanteria'
                    . ' WHERE id = (SELECT id_estanteria FROM ocupacion WHERE id_caja = "' . $id_caja . '");';
        $res = $conexion->query($ordenSQL1);
        $dimension = $res->num_rows;
        
        if ($dimension > 0) {
            $fila = $res->fetch_array();
            $cod_estanteria = $fila[0];
        } else {
            throw new CajaException($conexion->error, $conexion->errno, "Error, Caja no encontrada");
        }
        
        // Contruimos la cajaBackup
        $obj_cajaBackup = new CajaBackup($obj_cajaPosicion, $cod_estanteria);
        
        return $obj_cajaBackup;
    }
    
    // Funcion que nos devulve un obj_cajaBakup de la tabla caja_backup
    function datos_cajaBackup($cod_caja) {
        
        global $conexion;
        $ordenSQL = "SELECT * FROM caja_backup WHERE codigo_caja = '" . $cod_caja . "'";
        $res = $conexion->query($ordenSQL);
        $dimension = $res->num_rows;
        
        if ($dimension > 0) {
            $fila = $res->fetch_array();
            $obj_caja = new Caja($fila['codigo_caja'], 
                                $fila['altura'], 
                                $fila['anchura'], 
                                $fila['profundidad'], 
                                $fila['color'], 
                                $fila['material'], 
                                $fila['contenido']);
            $obj_caja->setFecha_alta($fila['fecha_alta']);
            $obj_caja->setId($fila['id']);
            $obj_cajaPosicion = new CajaPosicion($obj_caja, $fila['leja']);
            $obj_cajaBackup = new CajaBackup($obj_cajaPosicion, $fila['cod_estanteria']);
            $obj_cajaBackup->setFecha_salida($fila['fecha_salida']);
            
        } else {
            throw new CajaException($conexion->error, $conexion->errno, "Error, no se encuentra la caja");
        } 
        return $obj_cajaBackup;
    }
    
    // Funcion elimina una caja de caja_backup y la añade en caja
    // Recibe un obj_ocupacion (cod_caja, cod_estanteria, leja)
    public function devolucionCaja($obj_ocupacion) { 
        
        global $conexion;
        
        // recogemos los datos de la nueva ubicacion que hemos indicado en el formulario
        $cod_estanteria = $obj_ocupacion->getCod_estanteria();
        
        $id_estanteria = Operaciones::id_estanteria($cod_estanteria); // id_estanteria lo necesitamos en el trigger
        
        $leja = $obj_ocupacion->getLeja();
        
        $conexion->autocommit(false); // Hacemos transacciones
        
        // Creamos el trigger desde PHP en modelo y lo incluimos
        include '../modelo/DevolverCaja_trigger.php';
      
        // Instruccion que dispara el trigger
        $ordenSQL3 = "DELETE FROM caja_backup WHERE codigo_caja = '" . $obj_ocupacion->getCaja() . "';"; // Usamos el cod_caja que pasamos desde el controlador
        $res3 = $conexion->query($ordenSQL3);
        
        // Comprobacion de errores con Exceptions y commit
        if (!$res1) {
            $conexion->rollback();
            throw new CajaExceptionCajaException($conexion->error, $conexion->errno, "Error al eliminar TRIGGER de devolución");
        } else {
            if (!$res2) {
                $conexion->rollback();
                throw new CajaException("Error TRIGGER devolucion Caja", 15);
                
            } else {
                if (!$res3) {
                    $conexion->rollback();
                    throw new CajaException($conexion->error, $conexion->errno, "Error al eliminar caja_backup");
                    
                } else {
                    $conexion->commit();
                }
            }
        }
    }
    
    // Funcion que comprueba si existe algun usuario en la bbdd si es asi lo devuelve sino null
    public function comprobarUsuario() {
        
        global $conexion;
        
        $ordenSQL1 = "SELECT * FROM usuario";
        $res1 = $conexion->query($ordenSQL1);
        $filas = $res1->num_rows;
        
        if ($filas > 0) {
            $fila = $res1->fetch_array();
            $usuario = new Usuario($fila['nombre'], $fila['pass']);
            return $usuario;
        } else {
            return null;
        }
    }
    
    // Funcion que añade un usuario a la tabla
    public function registroUsuario($usuario) {
        
        global $conexion;
        
        $ordenSQL = "INSERT INTO usuario (nombre, pass)"
                . " VALUES ('" . $usuario->getNombre() . "', '" . $usuario->getPass() . "');";
        $res = $conexion->query($ordenSQL);
        
        if (!$res) {
            throw new UsuarioException($conexion->error, $conexion->errno, "Error al añadir el usuario");
        }
    }
    
    // Funcion que comprueba que los valores del usuario introducido coocuerden con los de la bbdd
    
    public function loginUsuario($usuario) {
        
        global $conexion;
        
        $nombre = $usuario->getNombre();
        $pass = $usuario->getPass();
        
        $ordenSQL = "SELECT * FROM usuario WHERE nombre = '" . $nombre . "';";
        $res = $conexion->query($ordenSQL);
        $filas = $res->num_rows;
        
        if ($filas == 1) {
            $fila = $res->fetch_array();
            
            if ($fila['nombre'] == $nombre) {
                
                // Funcion que encripta la contraseña introducida y la compara con la ya encriptada de la bbdd
                if (password_verify($pass, $fila['pass'])){ 
                    
                } else {
                    throw new UsuarioException($conexion->error, $conexion->errno, "Error contraseña Incorrecta");
                }
            } else {
                throw new UsuarioException($conexion->error, $conexion->errno, "Nombre de usuario Incorrecto");
            }
        } else {
            throw new UsuarioException($conexion->error, $conexion->errno, "Error, no existe el Usuario");
        }
    }
}
