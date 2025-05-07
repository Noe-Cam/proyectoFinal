<?php
session_start();
include 'utils/controlLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleCuerpo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Mi zona</title>
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
            <!-- <video autoplay muted loop playsinline class="video-background">
                    <source src="img/miZona.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video> -->
            <div class="contenedor_datos">
                <div class="contenedor_usuario_vehiculo">
                    <div class="datosUsuario">
                        <h2 class="titulo">Datos personales</h2>
                        <div class="datos-lista">
                            <?php
                            include 'utils/conexionBD.php';
                            $email=$_SESSION["usuario"];
                            $sql="SELECT nombre_usuario, apellido_usuario, edad FROM usuarios WHERE email='$email'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $fila = $result->fetch_assoc();
                                $nombre=$fila["nombre_usuario"];
                                $apellido=$fila["apellido_usuario"];
                                $edad=$fila["edad"];
                            }; 
                            echo "<div><strong>Nombre:</strong> $nombre $apellido</div>";
                            echo "<div><strong>Email:</strong> $email</div>";
                            echo "<div><strong>Edad:</strong> $edad</div>";
                            ?>
                        </div>
                        <div class="botones-datos">
                            <button class="fancy">Cambiar datos</button>
                            <button class="fancy">Cambiar contraseña</button>
                            <button class="fancy eliminar">Eliminar cuenta</button>
                        </div>
                    </div>
                    <div class="linea-vertical"></div>
                    <div class="datosVehiculo">
                        <h2 class="titulo">Datos de vehículo</h2>
                        <div class="datos-lista">
                            <?php
                            $sql="SELECT v.matricula, v.marca, v.color FROM usuarios u INNER JOIN usuarios_vehiculos uv ON u.id_usuario=uv.id_usuario INNER JOIN vehiculos v ON uv.id_vehiculo=v.id_vehiculo WHERE u.email='$email'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $fila = $result->fetch_assoc();
                                $maricula=$fila["matricula"];
                                $marca=$fila["marca"];
                                $color=$fila["color"];
                                echo "<div><strong>Matricula:</strong> $maricula</div>";
                                echo "<div><strong>Marca:</strong> $marca</div>";
                                echo "<div><strong>Color:</strong> $color</div>";
                                echo "<div class='botones-datos'>";
                                    echo"<button class='fancy'>Cambiar datos</button>";
                                echo "</div>";
                            }else{
                                echo "<div><strong>Aún no has introducido los datos de tu vehículo</div>";
                                echo "<div class='botones-datos'>";
                                    echo"<button class='fancy'>Añadir datos</button>";
                                echo "</div>";
                            }; 

                            ?>
                        </div>
                    </div>
                </div>
                <div class="datosTrayectos">
                    <h2 class="titulo">Viajes publicados activos</h2>
                </div>
            </div>
        </main>
        <footer class='pie'>
            <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>