<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Registro Usuario </title>
        <link rel="stylesheet" type="text/css" href="../styles/style.css">
    </head>
    <body>
        <div class="form">
            <header>
                <h1> Registro Usuario </h1>
            </header>
            
            <form method="post" accept-charset="utf-8" action="../controlador/controlador_registroUsuario.php">

                <label for="name" > Usuario:
                    <input type="text" name="nombre"autofocus="autofocus"><br>
                </label>

                <label for="name" > Pass:
                    <input type="password" name="pass" required="required"><br>
                </label>

                <!--input type="button" onclick="window.location.href='../vista/vista_menuInicial.php'" value="Volver" id="boton"-->
                <input type="submit" value="Registrar" id="boton">
                
            </form>
        </div>
    </body>
</html>
