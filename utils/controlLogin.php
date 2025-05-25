<?php
if (!isset($_SESSION["usuario"])){
    echo"
        <html>
            <head>
                <link rel='stylesheet' href='../css/styleCuerpo.css'>
                <meta http-equiv='refresh' content='5;url=login.php'>
            </head>
            <body>
                <div class='contenedor-grid'>
                    <header class='logo'>
                        <a href='../index.php'><img class='logoCarpool' src='../img/logoChatGPT.png' alt=''></a>
                    </header>
                    <nav class='navegador'>
                        <a href='../index.php'>Buscar trayecto</a>
                        <a href='../pages/subirTrayecto.php'>Subir trayecto</a>
                        <a href='../pages/miZona.php'>Mi zona</a>
                        <a href='../pages/login.php'>Iniciar sesión</i></a>
                    </nav>
                    <main class='contenido'>
                        <div class='contenedor'>
                    <video autoplay muted loop playsinline class='video-background'>
                        <source src='../img/fondoSubir.mp4' type='video/mp4'>
                        Tu navegador no soporta el video.
                    </video>
                        <div class='notifications-container'>
                            <div class='error-alert'>
                                <div class='flex'>
                                    <div class='flex-shrink-0'>
                            
                                        <svg aria-hidden='true' fill='currentColor' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg' class='error-svg'>
                                        <path clip-rule='evenodd' d='M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z' fill-rule='evenodd'></path>
                                        </svg>
                                    </div>
                                <div class='error-prompt-container'>
                                    <p class='error-prompt-heading'>Debe registrarse para continuar
                                    </p>
                                    <div class='error-prompt-wrap'>
                                        <ul class='error-prompt-list' role='list'>
                                            <li>Redirigiendo a página de inicio de sesión</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                    <footer class='pie'>
                        <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
                    </footer>
                </div>
            </body>
        </html>
    ";
    exit;
};
?>