<!-- Página que se encarga de insertar a nuevos usuarios en la bd, a esta página se llega mediante el link enviado al correo al crearse una cuenta de usuario.
A esta página llega el token enviado en la url, se comprueba si ese token tiene alguna coincidencia con alguna fila de la tabal usuarios_tmp.
    - Si hay coincidencias:  
        1.se insertan los datos de la tabla usuarios_tmp en la tabla usuarios, formando ya parte del sistema.
        2.se elimina el usuario de la tabla usuarios_tmp.
    - Si no hay coincidencias: No se crea el usuario.
-->
<?php
session_start();
include '../utils/conexionBD.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cuenta verificada</title>
</head>
<body>
    <div class="contenedor-grid">
        <header class="logo">
            <a href="../index.php"><img class="logoCarpool" src="../img/logoChatGPT.png" alt=""></a>
        </header>
        <nav class="navegador">
            <a href="../index.php">Buscar trayecto</a>
            <a href="subirTrayecto.php">Subir trayecto</a>
            <a href="miZona.php">Mi zona</a>
            <?php
            if (!isset($_SESSION["usuario"])){
                echo '<a href="login.php">Iniciar sesión</a>';
            } else {
                echo "<a href=#><i class='fa fa-sign-out' style='font-size:28px;color:white'></i></a>";
            }
            ?>
        </nav>
        <main class="contenido">
            <video autoplay muted loop playsinline class="video-background">
                <source src="../img/cabecera.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <?php
            // Verificamos que tenemos el token obtenido por GET
            if (isset($_GET['token'])){
                $token=$_GET['token'];
                $sql="SELECT * FROM usuarios_tmp WHERE token='$token'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $fila = $result->fetch_assoc();
                    $nombre=$fila["nombre_usuario"];
                    $apellidos=$fila["apellido_usuario"];
                    $hashContrasena=$fila["contrasena"];
                    $edad=$fila["edad"];
                    $correo=$fila["email"];

                    $sql = "INSERT INTO usuarios(nombre_usuario,apellido_usuario,contrasena,edad,email) VALUES ('$nombre','$apellidos','$hashContrasena','$edad','$correo')";  
                    if ($conn->query($sql) === TRUE) {
                        $conn->query("DELETE FROM usuarios_tmp WHERE token='$token'")
                        ?>
                        <div class="card"> 
                            <div class="header"> 
                                <div class="image">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                </div> 
                                <div class="content">
                                    <span class="title">Usuario registrado</span> 
                                    <p class="message">BIENVENID@<br>Ya formas parte de la comunidad Carpool</p> 
                                </div> 
                                <div class="actions">
                                    <a href="index.php"><button class="history" type="button">Buscar trayecto</button></a>
                                    <a href="subirTrayecto.php"><button class="track" type="button">Subir trayecto</button></a> 
                                </div> 
                            </div> 
                        </div>
                        
                    <?php
                    }else{
                        echo 'error';
                    }
                }
            }
            ?>
        </main>
        <footer class="pie">
            <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>
<?php
include '../utils/cerrarBD.php';
