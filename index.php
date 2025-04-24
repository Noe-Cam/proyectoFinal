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
        <div class='img'>
            <div class='fondoIcono'>
                <img class='imgIconos'src="img/iconos.png" alt="">
            </div>
        </div>
        <main class="contenido">
            <!-- From Uiverse.io by andrew-demchenk0 --> 
            <section class="section_form">
                <form id="consultation-form" class="feed-form" action="inicioSesion.php">
                    <div class="titulo-buscador"><h2>BUSCAR VIAJE</h2></div>
                    <input name="origen" required="" placeholder="Origen" type="text">
                    <input name="destino" required="" placeholder="Destino">
                    <input name="fecha" required="" placeholder="Fecha" type="date">
                    <button class="button_submit">BUSCAR</button>
                </form>
            </section>
        </main>
        <footer class="pie">
            <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src='js/index.js'></script>
</body>
</html>