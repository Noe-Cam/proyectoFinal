<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticación</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="contenedor-grid">
        <header class='logo'>LOGO</header>
        <nav class="navegador">
            <a href="index.php">BUSCAR TRAYECTO</a>
            <a href="subirTrayecto.php">SUBIR TRAYECTO</a>
            <a>CHAT</a>
            <a>MI ZONA</a>
            <a href="login.php">INICIAR SESIÓN</a>
        </nav>
        <div class='img'>
            <div class='fondoIcono'>
                <img class='imgIconos'src="img/iconos.png" alt="">
            </div>
        </div>
        <!-- <div class='iconos'>
            <div class='fondoIcono'>
                <img class='imgIconos'src="img/iconos.png" alt="">
            </div>
        </div> -->
        <main class='contenido'>
            <!-- Tarjeta error menor de edad -->
             <!-- From Uiverse.io by kennyotsu --> 
             <div class="notifications-container oculto">
              <div class="error-alert">
                <div class="flex">
                  <div class="flex-shrink-0">
                    
                    <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="error-svg">
                      <path clip-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" fill-rule="evenodd"></path>
                    </svg>
                  </div>
                  <div class="error-prompt-container">
                    <p class="error-prompt-heading">Login incorrecto
                    </p><div class="error-prompt-wrap">
                      <ul class="error-prompt-list" role="list">
                        <li>Correo o contraseña incorrectos</li>
                      </ul>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- From Uiverse.io by Praashoo7 --> 
            <form class="form">
                <p class="heading">LOGIN</p>
                <input placeholder="Correo electrónico" class="input" name='correo' type="email">
                <input placeholder="Password" class="input" name='contra' type="password">
                <a class="enlace" href="formularioRegistro.html">¿Aun no tienes cuenta?</br>Registrate aquí</a>
                <button class="btn">Entrar</button>
            </form>
        </main>
        <footer class='pie'>
        <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="js/login.js"></script>
</body>
</html>