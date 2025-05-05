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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Buscar trayectos</title>
</head>
<body>
    <div class="contenedor-grid">
        <header class="logo">LOGO</header>
        <nav class="navegador">
            <a href="index.php">BUSCAR TRAYECTO</a>
            <a href="subirTrayecto.php">SUBIR TRAYECTO</a>
            <a>CHAT</a>
            <a>MI ZONA</a>
            <?php
            if (!isset($_SESSION["usuario"])){
                echo '<a href="login.php">INICIAR SESIÓN</a>';
            } else {
                echo "<a href=#><i class='fa fa-sign-out' style='font-size:28px;color:white'></i></a>";
            }
            ?>
        </nav>
        <div class="img">
            <video autoplay muted loop playsinline class="video-background">
                <source src="img/cabecera.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <section class="section_form ">
                    <div class="titulo-buscador"><h2>Buscar viaje</h2></div>
                    <form method='POST' id="consultation-form" class="feed-form">
                        <input name="origen" required="" placeholder="Origen" type="text">
                        <input name="destino" required="" placeholder="Destino">
                        <input name="fecha" required="" placeholder="Fecha" type="date"><br>
                        <button class="button_submit">BUSCAR</button>
                    </form>
            </section>
            <div class="trayectos oculto">
                <h3c class="nom_trayecto"><h3>
                <div class="mostrar_trayect">
                    <div class="recurrentes"></div>
                    <div class="puntuales"></div>
                </div>
            </div> 
        </div>
        <footer class="pie">
            <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src='js/index.js'></script>
</body>
</html>