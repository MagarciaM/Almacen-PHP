<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title> Vista de Errores </title>
         <link rel="stylesheet" type="text/css" href="../styles/style.css">
    </head>
    <body>
        <?php
       
        include '../modelo/UsuarioException.php';
        
        session_start();
        $e = $_SESSION['e'];
        
        ?>
        <table>
            <thead>
                <th> Informacion del Error </th>
            </thead>
            <tbody>
                <tr>
                    <td bgcolor="red"> <?php  echo $e; ?> </td>
                </tr>
            </tbody>
        </table>
        
        <button id="boton1" onclick="window.location.href='../index.php'"> 
            Volver al Menu Inicial 
        </button>

    </body>
</html>