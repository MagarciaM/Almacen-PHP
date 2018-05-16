<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Almacen - Servidor </title>

        <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800'>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="../styles/style.css">
    </head>

    <body>
        <div class='container'>
            <nav>
                <header>
                    <h1> Almacen - Servidor </h1>
                </header>
                <ul>
                    <!--li>
                        <a href='#'> Login </a>
                    </li-->
                    <li class='sub-menu'>
                        <a href='#'> Estanterías 
                            <div class='fa fa-angle-down right'></div>
                        </a>
                        <ul>
                            <li>
                                <a href='vista_alta_estanteria.php'> Alta </a>
                            </li>
                            <li>
                                <a href='../controlador/controlador_listado_estanterias.php'> Listado </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                    <li class='sub-menu'>
                        <a href='#'> Cajas 
                            <div class='fa fa-angle-down right'></div>
                        </a>
                        <ul>
                            <li>
                                <a href='../controlador/controlador_listado_estanterias_select.php'> Alta </a>
                            </li>
                            <li>
                                <a href='../controlador/controlador_listado_cajas.php'> Listado </a>
                            </li>
                        </ul>
                    </li>
                    <li class='sub-menu'>
                        <a href='#'> Gestión de Almacen 
                            <div class='fa fa-angle-down right'></div> 
                        </a>
                        <ul>
                            <li>
                                <a href="../controlador/controlador_inventario.php"> Inventario </a>
                            </li>
                            <li>
                                <a href='../controlador/controlador_listado_cajas_venta.php?option=venta'> Venta de Caja </a>
                            </li>
                            <li>
                                <a href='../controlador/controlador_listado_estanterias_select.php?option=devolucion'> Devolución de Cajas </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href='#'> Otros </a>
                    </li>
                </ul>
            </nav>
        </div>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script>

            $('.sub-menu a').click(function () {
                $(this).parent("li").children("ul").slideToggle('active');
            });

        </script>

    </body>
</html>
