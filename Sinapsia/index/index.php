<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="estilo.css"> -->
    <link rel="stylesheet" href="./index.css">
    <title>Document</title>  

</head>
<body>
    <div class="contenedor">

         <h1 class="p">BIENVENIDO A
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Prompt:ital,wght@0,400;0,500;1,200&display=swap" 
                rel="stylesheet">
         </h1>
         <img  src="../imagenes/logo.png" alt="logo" width=730px; height=132px;> <br><br>
        <button class="LOGIN" 
        onclick="window.location.href = '/Proyecto-4to-SinapsIA/Sinapsia/login/Iniciosesion.php'">
        LOG IN
        </button>
       <button class="textbox excluir">
        ?
       </button> 
    </div>

    <div class="informacion">
        <span class="icon-close">
            <ion-icon name="close-circle-outline"></ion-icon>
        </span>
        <div class="text-information">
            <h1 class="queEs">
                ¿Qué es SinapsIA?
                <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
            </h1>
            <p class="descripcion">
                SINAPSIA ES UNA INTELIGENCIA ARTIFICIAL DESTINADA AL 
                ANÁLISIS DE ELECTROENCEFALOGRAMAS, MÁS ESPECÍFICAMENTE A
                 LA DETECCIÓN DE TIPOS DE EPILEPSIA.
    <br><br>
                ESTE SITIO WEB ES UNA HERRAMIENTA DISEÑADA PARA
                NEURÓLOGOS ESPECIALIZADOS EN EPILEPSIA, PARA QUE PUEDAN
                ORGANIZAR SU TRABAJO CON UNA MAYOR FACILIDAD Y PUEDAN 
                RECIBIR SUGERENCIAS PARA LOS DIAGNÓSTICOS A SUS PACIENTES.
            </p>
        </div>
    </div>

    <script src="index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
