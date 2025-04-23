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
                    <!-- From Uiverse.io by rzouga001 --> 
                    <div class="card oculto"> 
                        <button class="dismiss" type="button">x</button> 
                        <div class="header"> 

                            <div class="div_image_v">
                                <div class="image">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                </div> 
                            </div> 
                            <div class="content">
                                <span class="title">VIAJE PUBLICADO</span> 
                                <p class="message">Gracias por publicar tu viaje en CarPool, puedes ver tus viajes en 'MI ZONA'</p> 
                            </div> 
                        </div>
                        
                    </div>       
                    <div id="map" class='mapa'></div>
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
        <footer class='pie'>
        <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="js/subirTrayecto.js"></script>
    
    <!-- OpenRouteService para rutas -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- Decodificador -->
<script src="https://unpkg.com/@mapbox/polyline@1.1.1/src/polyline.js"></script>


</body>
</html>