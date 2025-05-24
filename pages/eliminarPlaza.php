<!-- Archivo que se encarga de quitar una plaza en caso de que el conducor indique dando al boton del email que se ha reservado una plaza.
 Se recibe el id del trayecto:
    - Se comprueba que el viaje seleccionado tiene más de 0 plazas disponibles.
    - En el caso de tener más de 0 plazas disponibles, se procede a eliminar una plaza en la información del trayecto
    - Posteriormente a la eliminación se comprueba las plazas del mismo trayecto, si ahora son 0 plazas el viaje pasa a estar no activo (activo->0 en la bd) y no aparecerá en futuras búsquedas. De manera predeterminada el valor de 'activo' en la base de datos es 1 por defecto.
    - Cualquier error en el proceso será notificado al usuario conductor mediate un card de aviso, si el proceso de eliminacion es correcto, se mostrará otro card informativo con la validez de la operación. -->
<?php
session_start();
include "../utils/conexionBD.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar plaza </title>
    <link rel="stylesheet" href="../css/styleCuerpo.css">
</head>
<body>
     <div class="contenedor-grid">
         <header class="logo">
            <a href="../index.php"><img class="logoCarpool" src="../img/LOGO_CARPOOL.png" alt=""></a>
        </header>
        <nav class="navegador">
            <a href="login.php">Buscar trayecto</a>
            <a href="login.php">Subir trayecto</a>
            <a href="login.php">Mi zona</a>
            <a href="login.php">Iniciar sesión</a>
        </nav>
        <main class='contenido'>
            <video autoplay muted loop playsinline class="video-background">
                <source src="../img/fondoSubir.mp4" type="video/mp4">
                Tu navegador no soporta el video.
            </video>
            <?php
                $idTrayecto=$_GET['numero'];
                $sql="SELECT plazas FROM trayectos WHERE id_trayecto='$idTrayecto'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0){
                    $fila = $result->fetch_assoc();
                    $plazas=$fila["plazas"];
                    if ($plazas>0){
                        $sql="UPDATE trayectos SET plazas=(plazas-1) WHERE id_trayecto='$idTrayecto'";
                        $result = $conn->query($sql); 
                        if ($result && $conn->affected_rows>0){
                            // Una vez borrada una plaza, se vuelve a comprobar, las plazas para cambiar el viaje de activo a no activo si las plazas son 0.
                            $sql="SELECT plazas FROM trayectos WHERE id_trayecto='$idTrayecto'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0){
                                $fila = $result->fetch_assoc();
                                $plazas=$fila["plazas"];
                                if ($plazas<=0){
                                    echo 'plazas menores que 0';
                                    $sql="UPDATE trayectos SET activo=0 WHERE id_trayecto='$idTrayecto'";
                                    $result = $conn->query($sql); 
                                    if ($result && $conn->affected_rows>0){
                                    // echo 'result del update '.$result->num_rows;
                                        echo ' Trayecto desactivado (plazas = 0)';
                                    } else {
                                        echo ' No se pudo desactivar el trayecto.'.$plazas;
                                    }
                                }
                            }
                        ?>
                            <div class="card "> 
                                <div class="header"> 
                                    <div class="div_image_v">
                                        <div class="image">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                        </div> 
                                    </div> 
                                    <div class="content">
                                        <span class="title">Plaza eliminada</span> 
                                        <p class="message">Se ha eliminado con éxito una plaza en tu trayecto revisa tus viajes activos en 'Mi zona'</p> 
                                    </div> 
                                </div> 
                            </div>       
                        <?php
                        }
                    } else {
                        ?>
                    <div class="error">
                        <div class="error__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none"><path fill="#393a37" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"></path></svg>
                        </div>
                        <div class="error__title">No se ha podido eliminar una plaza de tu trayecto, este trayecto tiene las plazas completas </div>
                        <div class="error__close"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20"><path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path></svg></div>
                    </div>
                <?php
                    }
                }else{
                    ?>
                    <div class="error">
                        <div class="error__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24" fill="none"><path fill="#393a37" d="m13 13h-2v-6h2zm0 4h-2v-2h2zm-1-15c-1.3132 0-2.61358.25866-3.82683.7612-1.21326.50255-2.31565 1.23915-3.24424 2.16773-1.87536 1.87537-2.92893 4.41891-2.92893 7.07107 0 2.6522 1.05357 5.1957 2.92893 7.0711.92859.9286 2.03098 1.6651 3.24424 2.1677 1.21325.5025 2.51363.7612 3.82683.7612 2.6522 0 5.1957-1.0536 7.0711-2.9289 1.8753-1.8754 2.9289-4.4189 2.9289-7.0711 0-1.3132-.2587-2.61358-.7612-3.82683-.5026-1.21326-1.2391-2.31565-2.1677-3.24424-.9286-.92858-2.031-1.66518-3.2443-2.16773-1.2132-.50254-2.5136-.7612-3.8268-.7612z"></path></svg>
                        </div>
                        <div class="error__title">No se ha podido eliminar una plaza de tu trayecto. Prueba más tarde o elimínala desde 'Mi zona' </div>
                        <div class="error__close"><svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20"><path fill="#393a37" d="m15.8333 5.34166-1.175-1.175-4.6583 4.65834-4.65833-4.65834-1.175 1.175 4.65833 4.65834-4.65833 4.6583 1.175 1.175 4.65833-4.6583 4.6583 4.6583 1.175-1.175-4.6583-4.6583z"></path></svg></div>
                    </div>
                <?php
                };
                ?>
        </main>
        <footer class='pie'>
        <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
     </div>
</body>
</html>
<?php
include "../utils/cerrarBD.php";
?>