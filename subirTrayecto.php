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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Estilos de leatlet(para el mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <!-- script de leaflet (para el mapa) -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <div class="contenedor-grid">
        <header class='logo'>LOGO</header>
        <nav class="navegador">
            <a href="index.php">Buscar trayecto</a>
            <a href="subirTrayecto.php">Subir trayecto</a>
            <a href="miZona.php">Mi zona</a>
            <a href='#'><i class='fa fa-sign-out' style='font-size:28px;color:white'></i></a>
        </nav>
        <main class='contenido'>
            <video autoplay muted loop playsinline class="video-background">
                <source src="img/fondoSubir.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <!-- div con card resumen trayecto y mapa -->
             <div class="oculto contenedorInfo">
                <div class="cardInformativo"></div>
                <div class="contenedorMapa">
                    <!-- From Uiverse.io by rzouga001 --> 
                    
                    <div id="map" class='mapa'></div>
                    <div class="card oculto"> 
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
                </div>     
             </div>
            <div class="mensaje_tipoviaje">
                <div class='titulo'>
                    <h3>PUBLICA TU VIAJE COMO CONDUCTOR</h3>  
                    <h4>¿Qué tipo de viaje vas a realizar?</h4>
                </div>
                <div class='tipoViaje'>   
                    <!-- From Uiverse.io by himanshu9682 --> 
                    <div class="container">
                        <a href="#" class="button type--C puntual">
                            <div class="button__line"></div>
                            <div class="button__line"></div>
                            <span class="button__text">Viaje puntual</span>
                            <div class="button__drow1"></div>
                            <div class="button__drow2"></div>
                        </a>
                    </div>
                    <div class="container">
                        <a href="#" class="button type--C recurrente">
                            <div class="button__line"></div>
                            <div class="button__line"></div>
                            <span class="button__text">Viaje recurrente</span>
                            <div class="button__drow1"></div>
                            <div class="button__drow2"></div>
                        </a>
                    </div>
                </div>
            </div>
            
                <!-- From Uiverse.io by andrew-demchenk0 --> 
            <div class="contenedor_form_error oculto">
                <div class="error oculto">
                    <div class="error__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none"><path fill="#393a37" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"></path></svg>
                    </div>
                    <div class="error__title">Error al introducir la dirección de origen o destino</div>
                    <div class="error__close"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20"><path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path></svg></div>
                </div>
                <form class="form oculto">
                    <div class='titulo'>
                        <h3>PUBLICA TU VIAJE COMO CONDUCTOR</h3>
                    </div>
                    <div class="flex">
                        <label>
                            <input required placeholder="" type="text" class="input" name='origen'>
                            <span>Origen</span>
                            <ul id="sugerencias-origen"></ul>
                        </label>
                        
                        <label>
                            <input required placeholder="" type="text" class="input" name='destino'>
                            <span>Destino</span>
                            <ul id="sugerencias-destino"></ul>
                        </label>
                        <label>
                            <input required type="number" min="1" max="10" placeholder="" class="input" name='plazas'>
                            <span>Número de plazas</span>
                        </label>
                    </div>  

                    <div class="flex">
                        <label>
                            <input class="oculto input fechaPuntual" placeholder="" type="date" name='fecha'>
                            <fieldset class="grid-dias oculto">
                                <legend>Días de viaje</legend>
                                <label><input type="checkbox" name="dias[]" value="lunes"> Lunes</label>
                                <label><input type="checkbox" name="dias[]" value="martes"> Martes</label>
                                <label><input type="checkbox" name="dias[]" value="miércoles"> Miércoles</label>
                                <label><input type="checkbox" name="dias[]" value="jueves"> Jueves</label>
                                <label><input type="checkbox" name="dias[]" value="viernes"> Viernes</label>
                                <label><input type="checkbox" name="dias[]" value="sábado"> Sábado</label>
                                <label><input type="checkbox" name="dias[]" value="domingo"> Domingo</label>
                            </fieldset>
                        </label>
                        <label>
                            <input required placeholder="" type="time" class="input" name='hora'>
                        </label>
                        <label>
                            <input required type="number" step="0.01" placeholder=" " class="input" name='precio'>
                            <span>Precio €</span>
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
            </div>
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