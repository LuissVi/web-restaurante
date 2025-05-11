<?php
require_once "sesiones.php";
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: 0");
header("Pragma: no-cache");
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>

</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    @font-face {
        font-family: "Trade Gothic LT";
        src: url("fonts/TradeGothicLT.woff2") format("woff2"),
            url("fonts/TradeGothicLT.woff") format("woff");
        font-weight: normal;
        font-style: normal;
    }

    body {
        background-color: rgb(177, 177, 175);
        line-height: 1.4;
    }

    .contenedor {
        width: 90%;
        margin: 30px auto;
    }

    .grid-tabla {
        display: grid;
        grid-template-columns: .3fr .7fr .5fr .4fr .5fr 1fr .3fr .3fr;
        /* Ajusta los tamaños de columnas */
        width: 100%;
    }

    /* >: operador que indica que solo afectara a los hijos 'div' de .grid-tabla*/
    .grid-tabla>div {
        padding: 10px;
        border: 1px solid gray;
        text-align: center;
    }

    /* Estilo para cabecera */
    .grid-tabla .cabecera {
        font-weight: bold;
        background-color: rgb(234, 208, 208);
        /* border-bottom: 2px solid #999; */
        font-family: "Imperial Script", cursive;
    }

    .cabecera h2 {
        font-size: 1.2rem;
        font-weight: 600;
        color: rgb(57, 56, 56);
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .fila {
        display: contents;
        /*desaparece al elemento(.fila) como contenedor; al no ser como una caja que enceirra a sus hijos, hereda los estilos del contenedor padre*/
    }

    .fila .celda {
        position: relative;
        background-color: whitesmoke;
        border: 1px solid gray;
        padding: 8px;
        font-size: 1.3rem;
        font-family: 'Berkshire Swash', handwriting;

    }

    .grid-tabla .fila:nth-child(odd) .celda {
        background-color: #e0dbdb;
    }

    /* h2 y link cerrar sesion*/

    .contenedor .link {
        width: 100%;
        display: flex;
        /* background-color: gray; */
        color: rgb(57, 56, 56);
        justify-content: space-evenly;
        align-items: center;
    }

    .contenedor .link a {
        text-decoration: none;
        color: whitesmoke;
        background-color: hsl(347, 88.00%, 39.20%);
        padding: .1rem .5rem;
        border-radius: 10px;
    }

    /* estilo oculto para id */
    .hidden {
        display: none;
    }

    /** estilo oculto de textos d la cabecera */
    /* media querys */
    .cabecera .corto {
        display: none;
    }

    /**centramos verticalmente los botones de la celda */
    .celda button {
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
    }

    @media (max-width:1220px) {
        .grid-tabla>div {
            padding: 0px;
        }
        .contenedor {
            width: 95%;
        }

        .cabecera .compl {
            display: none;
        }

        .cabecera .corto {
            display: block;
        }
    }

    @media (max-width:1080px) {
        .grid-tabla {
            display: grid;
            grid-template-columns: .3fr .7fr .5fr .4fr .5fr 1fr .3fr .3fr;
        }

        .grid-tabla .cabecera {
            font-size: 1rem;
        }

        .grid-tabla>div {
            padding: 5px;
           
        }

        .fila .celda {
            padding: 4px;
            font-size: 1.3rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

    }
    @media (max-width:920px) {
        .contenedor {
            width: 100%;
        }

    }
    
    /* pantallas moviles */
    @media (max-width:600px) {

        .cabecera .compl {
            display: none;
        }

        .cabecera .corto {
            display: block;
        }



        .fila .celda {
            align-items: center;
            /* Centrado vertical */
            justify-content: center;
            /* (opcional) Centrado horizontal */
            height: 100%;
        }


    }
</style>

<body>
    <section class="contenedor">
        <h3>
            <?php
            echo "Hola, " . $_SESSION["user"];
            ?>
        </h3>
        <section class="link">
            <h2>Lista de Reservas</h2>
            <a href="cerrar_sesion.php">Salir</a>
        </section>
        <div class="grid-tabla" id="tabla-datos">
            <div class="cabecera hidden">ID</div>
            <div class="cabecera">
                <h2>NOMBRE</h2>
            </div>
            <div class="cabecera">
                <h2>EMAIL</h2>
            </div>
            <div class="cabecera">
                <h2>FECHA</h2>
            </div>
            <div class="cabecera">
                <h2>HORA</h2>
            </div>
            <div class="cabecera">
                <h2 class="per"><span class="compl">PERSONAS</span>
                    <span class="corto">PER</span>
                </h2>
            </div>
            <div class="cabecera">
                <h2>OBSERVACIÓN</h2>
            </div>
            <div class="cabecera">
                <h2 class="yes"><span class="compl">ACEPTAR</span>
                    <span class="corto">SI</span>
                </h2>
            </div>
            <div class="cabecera">
                <h2 class="not"><span class="compl">NEGAR</span>
                    <span class="corto">NO</span>
                </h2>
            </div>

            <!-- Aquí van las filas dinamicas -->
        </div>
    </section>
    <script src="admin.js"></script>

</body>

</html>