<?php
session_start();
include 'utils/controlLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir trayecto</title>
    <link rel="stylesheet" href="css/styleCuerpo.css">
    <!-- css para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Estilos de leatlet(para el mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <!-- script de leaflet (para el mapa) -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <div class="contenedor-grid">
        <header class='logo'>LOGO</header>
        <nav class="navegador">
            <a href="index.php">BUSCAR TRAYECTO</a>
            <a href="subirTrayecto.php">SUBIR TRAYECTO</a>
            <a>CHAT</a>
            <a>MI ZONA</a>
            <a href='#'><i class='fa fa-sign-out' style='font-size:28px;color:white'></i></a>
        </nav>
        <main class='contenido'>
            <!-- div con card resumen trayecto y mapa -->
             <div class="oculto contenedorInfo">
                <div class="cardInformativo"></div>
                <div class="contenedorMapa">       
                    <div id="map"></div>
                </div>     
             </div>
            <form class="form">
                <div class='titulo'>
                    <h3>PUBLICA TU VIAJE COMO CONDUCTOR</h3>
                </div>
                <div class="flex">
                    <label>
                    <input required placeholder="" type="text" class="input" name='origen'>
                    <span>Origen</span>
                    </label>

                    <label>
                    <input required placeholder="" type="text" class="input" name='destino'>
                    <span>Destino</span>
                    </label>
                </div>  

                <div class="flex">
                    <label>
                        <input required placeholder="" type="date" class="input" name='fecha'>
                    </label>
                    <label>
                        <input required placeholder="" type="time" class="input" name='hora'>
                    </label>
                    <label>
                        <input required type="number" min="1" max="10" placeholder="" class="input" name='plazas'>
                    <span>Número de plazas</span>
                    </label>
                </div>  

                <label>
                    <textarea  rows="3" placeholder="" class="input01" name='descripcion'></textarea>
                    <span>Descripción del trayecto</span>
                </label>

                <button class="fancy" href="#">
                    <span class="top-key"></span>
                    <span class="text">Publicar trayecto</span>
                    <span class="bottom-key-1"></span>
                    <span class="bottom-key-2"></span>
                </button>
            </form>

        </main>
        <footer class='pie'>AQUI EL PIE</footer>
    </div>
    <script src="js/subirTrayecto.js"></script>
    
    <!-- OpenRouteService para rutas -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- Decodificador -->
<script src="https://unpkg.com/@mapbox/polyline@1.1.1/src/polyline.js"></script>


</body>
</html>