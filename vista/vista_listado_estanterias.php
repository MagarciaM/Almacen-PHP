<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Listado Estanterias </title>
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
    </head>
    <body>
        <?php
        include_once "../modelo/Estanteria.php";
        
        session_start();
        $array_estanterias = $_SESSION['array_estanterias'];
        ?>
        <table>
            <thead>
                <th> Codigo </th>
                <th> Material </th>
                <th> Nº de Lejas </th>
                <th> Pasillo </th>
                <th> Nº de Pasillo </th>
                <th> Lejas Ocupadas </th>
            </thead>
            <tbody>
                <?php
                    foreach ($array_estanterias as $valor) {
                        ?>
                    <tr>
                        <td> <?php echo $valor->getCodigo(); ?></td>
                        <td> <?php echo $valor->getMaterial(); ?></td>
                        <td> <?php echo $valor->getN_lejas(); ?></td>
                        <td> <?php echo $valor->getPasillo(); ?></td>
                        <td> <?php echo $valor->getN_pasillo(); ?></td>
                        <td> <?php echo $valor->getLejas_ocupadas(); ?></td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        
        <button id="boton1" onclick="window.location.href='../vista/vista_menuInicial.php'"> Volver al Menu Inicial </button>
        
    </body>
</html>
