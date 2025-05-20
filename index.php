<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- css para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Estilos de leatlet(para el mapa) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <!-- script de leaflet (para el mapa) -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    
    <title>Buscar trayectos</title>
</head>
<body>
    <div class="contenedor-grid">
        <header class="logo">
            <img class="logoCarpool" src="img/LOGO_CARPOOL.png" alt="">
        </header>
        <nav class="navegador">
            <button class="burger"> &#9776;</button>
            <div class='menu'>
                <a  href="index.php">Buscar trayecto</a>
                <a href="subirTrayecto.php">Subir trayecto</a>
                <a href="miZona.php">Mi zona</a>
                <?php
                if (!isset($_SESSION["usuario"])){
                    echo '<a href="login.php">Iniciar sesión</a>';
                } else {
                    echo "<a href=#><i class='fa fa-sign-out' style='font-size:28px;color:white'></i></a>";
                }
                ?>
            </div>
        </nav>
        <main class="contenido">
            <video autoplay muted loop playsinline class="video-background">
                <source src="img/cabecera.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <section class="section_form ">
                    <div class="titulo-buscador"><h2>Buscar viaje</h2></div>
                    <form method='POST' id="consultation-form" class="feed-form">
                        <div class="posi-columna">
                            <input name="origen" required="" placeholder="Origen" type="text">
                            <ul id="sugerencias-origen"></ul>
                        </div>
                        <div class="posi-columna">
                            <input name="destino" required="" placeholder="Destino">
                            <ul id="sugerencias-destino"></ul>
                        </div>
                        <input name="fecha" required="" placeholder="Fecha" type="date"><br>
                        <button class="button_submit">BUSCAR</button>
                    </form>
            </section>
            <div class="trayectos oculto">
                <div class="contenedor_titulo">
                    <h2 class="nom_trayecto"><h2>
                </div>
                <div class="mostrar_trayect">
                    <div class="recurrentes"></div>
                    <div class="puntuales"></div>
                </div>
            </div>
            <div class="modal-oscurecer-fondo oculto"></div>
            <div class="modal oculto" >
                <div class="datosModal">
                    <div class='informContacto oculto'>
                        <!-- From Uiverse.io by andrew-demchenk0 --> 
                        <div class="info">
                            <div class="info__icon">
                            <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z" fill="#393a37"></path></svg>
                            </div>
                            <div class="info__title">Se ha avisado al conductor, se pondrá en contacto contigo vía email</div>
                            <!-- <div class="info__close"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20"><path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path></svg></div> -->
                        </div>
                    </div>
                </div>
                <div class="map" id="map"></div>
            </div> 
        </main>
        <footer class="pie">
            <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src='js/index.js'></script>
        <!-- OpenRouteService para rutas -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- Decodificador -->
<script src="https://unpkg.com/@mapbox/polyline@1.1.1/src/polyline.js"></script>
</body>
</html>