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
            <a href="index.php">Buscar trayecto</a>
            <a href="subirTrayecto.php">Subir trayecto</a>
            <a href="miZona.php">Mi zona</a>
            <a href="login.php">Iniciar sesión</a>
        </nav>
        <div class='img'>
          <!-- <div class='fondoIcono'>
              <img class='imgIconos'src="img/iconos.png" alt="">
          </div> -->
          <video autoplay muted loop playsinline class="video-background">
                <source src="img/cabecera.mp4" type="video/mp4">
                Tu navegador no soporta el video.
          </video>
          
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
            <!-- <form class="form">
                <p class="heading">LOGIN</p>
                <input placeholder="Correo electrónico" class="input" name='correo' type="email">
                <input placeholder="Password" class="input" name='contra' type="password">
                <a class="enlace" href="formularioRegistro.html">¿Aun no tienes cuenta?</br>Registrate aquí</a>
                <button class="btn">Entrar</button>
            </form> -->

            <!-- From Uiverse.io by Praashoo7 --> 
            <div class="contenedor_form">
              <form class="form" method='POST'>
                  <!-- From Uiverse.io by foxyyyyyyyyyyyyy --> 
                  <div class="form-control">
              
                <div class="campo">
                  <input required="" type="email" name='correo'>
                  <label class="correo">
                      <span style="transition-delay:250ms">C</span>
                      <span style="transition-delay:200ms">o</span>
                      <span style="transition-delay:150ms">r</span>
                      <span style="transition-delay:100ms">r</span>
                      <span style="transition-delay:50ms">e</span>
                      <span style="transition-delay:0ms">o</span>
                  </label>
                </div>

                <div class="campo">
                  <input required="" type="password" name='contra'>
                  <label class="contra">
                      <span style="transition-delay:250ms">C</span>
                      <span style="transition-delay:200ms">o</span>
                      <span style="transition-delay:150ms">n</span>
                      <span style="transition-delay:100ms">t</span>
                      <span style="transition-delay:50ms">r</span>
                      <span style="transition-delay:0ms">a</span>
                      <span style="transition-delay:0ms">s</span>
                      <span style="transition-delay:0ms">e</span>
                      <span style="transition-delay:0ms">ñ</span>
                      <span style="transition-delay:0ms">a</span>
                  </label>
                </div>
                <div class="campo1">
                  <a href="formularioRegistro.html" class="enlace">¿Aun no tienes cuenta? Registrate aquí</a>
                </div>
                <div class="campo1">
                  <button class="btn_inisesion"> Entrar </button>
                </div>
              </div>
            </form>
          </div>
      </div>
        

              
        <!-- <div class='iconos'>
            <div class='fondoIcono'>
                <img class='imgIconos'src="img/iconos.png" alt="">
            </div>
        </div> -->
        <!-- <main class='contenido'> -->
            <!-- Tarjeta error menor de edad -->
             <!-- From Uiverse.io by kennyotsu --> 
             
        <!-- </main> -->
        <footer class='pie'>
        <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="js/login.js"></script>
</body>
</html>