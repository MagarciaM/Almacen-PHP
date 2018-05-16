<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Vista de Errores </title>
         <link rel="stylesheet" type="text/css" href="../styles/style.css">
    </head>
    <body>
        <?php
        
        include '../modelo/CajaException.php';
        include '../modelo/EstanteriaException.php';
        
        session_start();
        $msj = $_REQUEST['msj'];
        
        ?>
        <table>
            <thead>
                <th> Informacion del Mensaje </th>
            </thead>
            <tbody>
                <tr>
                    <td> <?php  echo $msj; ?> </td>
                </tr>
            </tbody>
        </table>
        
        <button id="boton1" onclick="window.location.href='../vista/vista_menuInicial.php'"> 
            Volver al Menu Inicial 
        </button>

    </body>
</html>
