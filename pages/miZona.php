<?php
session_start();
include '../utils/controlLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleCuerpo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Mi zona</title>
</head>
<body>
    <div class="contenedor-grid">
        <header class="logo">
            <a href="../index.php"><img class="logoCarpool" src="../img/LOGO_CARPOOL.png" alt=""></a>
        </header>
        <nav class="navegador">
            <button class="burger"> &#9776;</button>
            <div class="menu">
                <a href="../index.php">Buscar trayecto</a>
                <a href="subirTrayecto.php">Subir trayecto</a>
                <a href="miZona.php">Mi zona</a>
                <a href='#'><i class='fa fa-sign-out' style='font-size:28px;color:white'></i></a>
            </div>
        </nav>
        <main class='contenido'>
            <div class="contenedor_datos">
                <div class="contenedor_usuario_vehiculo">
                    <div class="datosUsuario">
                        <h2 class="titulo">Datos personales</h2>
                        <div class="datos-lista">
                            <?php
                            include '../utils/conexionBD.php';
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
                            <button class="btn-datos">Cambiar datos</button>
                            <button class="btn-datos btn-contra">Cambiar contraseña</button>
                            <button class="btn-datos eliminar">Eliminar cuenta</button>
                        </div>
                        <div class="modal-oscurecer-fondo oculto"></div>
                        <div class="modalDatosUsu oculto" >
                            <div class="datosModal">
                                <div class=cambioDatos>
                                    <h3>Modificar datos</h3>
                                    <form id="formUsuario" method="POST">
                                        <div>
                                            <label for="">Nombre :</label>
                                            <input type="text" name='nombre' required value="<?= $nombre ?>">
                                        </div>
                                        <div>
                                            <label for="">Apellidos :</label>
                                            <input type="text" name='apellidos' required value="<?= $apellido ?>">
                                        </div>
                                        <div>
                                            <label for="">Email :</label>
                                            <input type="email" name='email' required value="<?= $email ?>">
                                        </div>
                                        <div>
                                            <label for="">Edad :</label>
                                            <input type="number" name='edad' required value="<?= $edad ?>">
                                        </div>
                                        <div class="botones-modal">
                                            <button class="btn-datos guardar">Modificar datos</button>
                                            <button type="button" class="btn-datos cerrar">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class='infoUsu oculto'>
                                    <!-- From Uiverse.io by andrew-demchenk0 --> 
                                    <div class="info">
                                        <div class="info__icon">
                                        <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z" fill="#393a37"></path></svg>
                                        </div>
                                        <div class="info__title true">Datos modificados correctamente</div>
                                        <div class="info__title false">No se ha podido completar la operación</div>
                                        <div class="info__title emailFalse">Email en uso, prueba otro</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modalDatosContra oculto" >
                            <div class="datosModal">
                                <div class=cambioDatos>
                                    <h3>Modificar datos</h3>
                                    <form id="formContra" method="POST">
                                        <div>
                                            <label for="">Contraseña actual</label>
                                            <input type="password" name='actual' required>
                                        </div>
                                        <div>
                                            <label for="">Nueva contraseña</label>
                                            <input type="password" name='nueva1' required>
                                        </div>
                                        <div>
                                            <label for="">Confirma la nueva contraseña</label>
                                            <input type="password" name='nueva2' required >
                                        </div>
                                        <div class="botones-modal">
                                            <button class="btn-datos guardarContra">Modificar contraseña</button>
                                            <button type="button" class="btn-datos cerrar">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                                <div class='infoContra oculto'>
                                    <!-- From Uiverse.io by andrew-demchenk0 --> 
                                    <div class="info">
                                        <div class="info__icon">
                                        <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z" fill="#393a37"></path></svg>
                                        </div>
                                        <div class="info__title trueContra">Contraseña actualizada correctamente</div>
                                        <div class="info__title falseContra">No se ha podido completar la operación</div>
                                        <div class="info__title falseContraActual">Contraseña actual incorrecta</div>
                                        <div class="info__title contrasDif">Las contraseñas no coinciden</div>
                                        <div class="info__title contraLength">La contraseña debe tener entre 4 y 12 digitos</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modalEliminarCuenta oculto" >
                            <div class="datosModal">
                                <div class=cambioDatos>
                                    <h3>Desactivar cuenta</h3>
                                    <h6>¿Seguro qué deseas desactivar tu cuenta?</h6>
                                    <div class="botones-modal">
                                        <button class="btn-datos desactCuenta">Desactivar cuenta</button>
                                        <button type="button" class="btn-datos cerrar">Cerrar</button>
                                    </div>
                                </div>
                                <div class='infoDesactCuenta oculto'>
                                    <!-- From Uiverse.io by andrew-demchenk0 --> 
                                    <div class="info">
                                        <div class="info__icon">
                                        <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z" fill="#393a37"></path></svg>
                                        </div>
                                        <div class="info__title trueCuentaDesact">Cuenta desactivada correctamente</div>
                                        <div class="info__title falseCuentaDesact">Error al desactivar la cuenta</div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="linea-vertical"></div>
                    <div class="datosVehiculo">
                        <h2 class="titulo">Datos de vehículo</h2>
                        <div class="datos-lista">
                            <?php
                            $sql="SELECT v.matricula, v.marca, v.color,v.plazas FROM usuarios u INNER JOIN usuarios_vehiculos uv ON u.id_usuario=uv.id_usuario INNER JOIN vehiculos v ON uv.id_vehiculo=v.id_vehiculo WHERE u.email='$email'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                $fila = $result->fetch_assoc();
                                $matricula=$fila["matricula"];
                                $marca=$fila["marca"];
                                $color=$fila["color"];
                                $plazas=$fila["plazas"];
                                echo "<div><strong>Matricula:</strong> $matricula</div>";
                                echo "<div><strong>Marca:</strong> $marca</div>";
                                echo "<div><strong>Color:</strong> $color</div>";
                                echo "<div><strong>Plazas totales:</strong> $plazas</div>";
                                ?>
                                </div>
                                <div class='botones-datos'>
                                    <button class='btn-datos modfVehiculo'>Modificar datos del vehículo</button>
                                </div>
                                <div class="modalModfVehiculo oculto" >
                                <div class="datosModal">
                                    <div class=cambioDatos>
                                        <h3>Modificar datos</h3>
                                        <form id="formModfVehiculo" method="POST">
                                            <div>
                                                <label for="">Matricula </label>
                                                <input type="text" name='matricula' required value="<?= $matricula ?>">
                                            </div>
                                            <div>
                                                <label for="">Marca </label>
                                                <input type="text" name='marca' required value="<?= $marca ?>">
                                            </div>
                                            <div>
                                                <label for="">Color </label>
                                                <input type="text" name='color' required value="<?=  $color ?>">
                                            </div>
                                            <div>
                                                <label for="">Plazas totales </label>
                                                <input type="number" name='plazas' required value="<?= $plazas ?>">
                                            </div>
                                            <div class="botones-modal">
                                                <button class="btn-datos guardarModfVehic">Modificar datos</button>
                                                <button type="button" class="btn-datos cerrar">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class='infoModfVehic oculto'>
                                        <!-- From Uiverse.io by andrew-demchenk0 --> 
                                        <div class="info">
                                            <div class="info__icon">
                                            <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z" fill="#393a37"></path></svg>
                                            </div>
                                            <div class="info__title modfVehictrue">Datos modificados correctamente</div>
                                            <div class="info__title modfVehicfalse">No se ha podido completar la operación</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }else{
                                echo "<div><strong>Aún no has introducido los datos de tu vehículo</strong></div>"
                                ?>
                                </div>
                                <div class='botones-datos'>
                                    <button class='btn-datos vehiculoNuevo'>Añadir datos</button>
                                </div>
                                <div class="modalVehiculoNuevo oculto" >
                                    <div class="datosModal">
                                        <div class=cambioDatos>
                                            <h3>Añadir datos del vehículo</h3>
                                            <form id="formDatosVehic" method="POST">
                                                <div>
                                                    <label for="">Matricula </label>
                                                    <input type="text" name='matricula' required>
                                                </div>
                                                <div>
                                                    <label for="">Color </label>
                                                    <input type="text" name='color' required>
                                                </div>
                                                <div>
                                                    <label for="">Marca </label>
                                                    <input type="text" name='marca' required>
                                                </div>
                                                <div>
                                                    <label for="">Plazas totales </label>
                                                    <input type="text" name='plazas' required>
                                                </div>
                                                <div class="botones-modal">
                                                    <button class="btn-datos guardarVehiculoNuevo">Añadir datos</button>
                                                    <button type="button" class="btn-datos cerrar">Cerrar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class='infoVehiculoNuevo oculto'>
                                            <!-- From Uiverse.io by andrew-demchenk0 --> 
                                            <div class="info">
                                                <div class="info__icon">
                                                <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z" fill="#393a37"></path></svg>
                                                </div>
                                                <div class="info__title nuevoVehictrue">Datos añadidos correctamente</div>
                                                <div class="info__title nuevoVehicfalse">No se ha podido completar la operación</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php
                            }
                            ?>
                    </div>
                </div>
                    <?php
                        $sql="SELECT id_usuario FROM usuarios WHERE email='$email'";
                        $result=$conn->query($sql);
                        if($result->num_rows>0){
                            $fila = $result->fetch_assoc();
                            $idUsu=$fila['id_usuario'];
                            $sqlActivos="SELECT t.id_trayecto,t.fecha,t.precio,t.dias,t.hora,t.plazas,t.recurrente,t.activo,o.nombre AS origen ,d.nombre AS destino FROM trayectos t JOIN origenes o ON o.id_origen=t.origen JOIN destinos d ON d.id_destino=t.destino WHERE t.usu_crea='$idUsu' AND activo=1";
                            $viajesActivos=$conn->query($sqlActivos);

                            $sqlInactivos="SELECT t.id_trayecto,t.fecha,t.precio,t.dias,t.hora,t.plazas,t.recurrente,t.activo,o.nombre AS origen,d.nombre AS destino FROM trayectos t JOIN origenes o ON o.id_origen=t.origen JOIN destinos d ON d.id_destino=t.destino WHERE t.usu_crea='$idUsu' AND activo=0";
                            $viajesInactivos=$conn->query($sqlInactivos);
                        }
                    ?>
                    <div class="datosTrayectos">
                        <h2 class="titulo">Tus viajes</h2>
                        <div class="mostrar_trayect">
                            <div class="activos">
                                <h3>Viajes activos</h3>
                                    <div class="viajes-scroll">
                                        <?php if ($viajesActivos->num_rows > 0): ?>
                                            <?php while ($fila = $viajesActivos->fetch_assoc()): ?>
                                            <div class="viaje-card"
                                                data-id="<?= $fila['id_trayecto'] ?>"
                                                data-origen="<?=$fila['origen'] ?>"
                                                data-destino="<?=$fila['destino'] ?>"
                                                data-fecha="<?= $fila['fecha'] ?>"
                                                data-hora="<?= $fila['hora'] ?>"
                                                data-precio="<?= $fila['precio'] ?>"
                                                data-plazas="<?=$fila['plazas'] ?>"
                                                data-recurrente="<?= $fila['recurrente'] ?>"
                                                data-dias="<?= $fila['dias'] ?>"
                                                data-activo="<?= $fila['activo'] ?>">
                                                <strong><?= $fila['origen'] ?> → <?= $fila['destino'] ?></strong><br>
                                                Hora: <?= $fila['hora'] ?><br>
                                                Precio: <?= $fila['precio'] ?> € <br>
                                                Plazas: <?= $fila['plazas'] ?><br>
                                                <?php if ($fila['recurrente'] == 1): ?>
                                                    Días: <?= $fila['dias'] ?> <br>
                                                <?php else: ?>
                                                    Fecha: <?= $fila['fecha'] ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <p>No hay viajes activos publicados.</p>
                                        <?php endif; ?>
                                    </div>
                            </div>
                            <div class="inactivos">
                                <h3>Viajes inactivos</h3>
                                <div class="viajes-scroll">
                                        <?php if ($viajesInactivos->num_rows > 0): ?>
                                            <?php while ($fila = $viajesInactivos->fetch_assoc()): ?>
                                            <div class="viaje-card"
                                                data-id="<?= $fila['id_trayecto'] ?>"
                                                data-origen="<?=$fila['origen'] ?>"
                                                data-destino="<?=$fila['destino'] ?>"
                                                data-fecha="<?= $fila['fecha'] ?>"
                                                data-hora="<?= $fila['hora'] ?>"
                                                data-precio="<?= $fila['precio'] ?>"
                                                data-plazas="<?= $fila['plazas'] ?>"
                                                data-recurrente="<?= $fila['recurrente'] ?>"
                                                data-dias="<?= $fila['dias'] ?>"
                                                data-activo="<?= $fila['activo'] ?>">
                                                <strong><?= $fila['origen'] ?> → <?= $fila['destino'] ?></strong><br>
                                                Hora: <?= $fila['hora'] ?><br>
                                                Precio: <?= $fila['precio'] ?> € <br>
                                                Plazas: <?= $fila['plazas'] ?><br>
                                                <?php if ($fila['recurrente'] == 1): ?>
                                                    Días: <?= $fila['dias'] ?> <br>
                                                <?php else: ?>
                                                    Fecha: <?= $fila['fecha'] ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <p>No hay viajes activos publicados.</p>
                                        <?php endif; ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modalModifTrayecto oculto" >
                        <div class="datosModal">
                            <div class=cambioDatos>
                                <h3>Modificar datos</h3>
                                <form id="formModifTrayecto" method="POST">
                                    <input type="hidden" name="id_trayecto" id="id_trayecto">
                                    <input type="hidden" name="recurrente" id="recurrente">
                                    <div>
                                        <label for="">Origen </label>
                                        <input type="text" name='origen' id='origen' required>
                                    </div>
                                    <div>
                                        <label for="">Destino </label>
                                        <input type="text" name='destino' id='destino' required>
                                    </div>
                                    <div class='grupoFecha'>
                                        <label for="">Fecha </label>
                                        <input type="date" name='fecha' id='fecha' required>
                                    </div>
                                    <div class='grupoDias'>
                                        <label for="">Dias </label>
                                        <input type="text" name='dias' id='dias' required>
                                    </div>
                                    <div>
                                        <label for="">Hora </label>
                                        <input type="text" name='hora' id='hora' required>
                                    </div>
                                    <div>
                                        <label for="">Precio </label>
                                        <input type="number" name='precio' id='precio' step="0.01" required>
                                    </div>
                                    <div>
                                        <label for="">Plazas </label>
                                        <input type="number" name='plazas' id='plazas' required>
                                    </div>
                                    <div class="botones-modal">
                                        <button class="btn-datos guardarModifTrayecto">Guardar datos modificados</button>
                                        <button type="button" class="btn-datos actDesacTrayecto"></button>
                                        <button type="button" class="btn-datos cerrar">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                            <div class='infoModifTrayecto oculto'>
                                <!-- From Uiverse.io by andrew-demchenk0 --> 
                                <div class="info">
                                    <div class="info__icon">
                                    <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m12 1.5c-5.79844 0-10.5 4.70156-10.5 10.5 0 5.7984 4.70156 10.5 10.5 10.5 5.7984 0 10.5-4.7016 10.5-10.5 0-5.79844-4.7016-10.5-10.5-10.5zm.75 15.5625c0 .1031-.0844.1875-.1875.1875h-1.125c-.1031 0-.1875-.0844-.1875-.1875v-6.375c0-.1031.0844-.1875.1875-.1875h1.125c.1031 0 .1875.0844.1875.1875zm-.75-8.0625c-.2944-.00601-.5747-.12718-.7808-.3375-.206-.21032-.3215-.49305-.3215-.7875s.1155-.57718.3215-.7875c.2061-.21032.4864-.33149.7808-.3375.2944.00601.5747.12718.7808.3375.206.21032.3215.49305.3215.7875s-.1155.57718-.3215.7875c-.2061.21032-.4864.33149-.7808.3375z" fill="#393a37"></path></svg>
                                    </div>
                                    <div class="info__title modfTrayectotrue">Datos modificados correctamente</div>
                                    <div class="info__title modfTrayectofalse">No se ha podido completar la operación</div>
                                    <div class="info__title modfTrayectoEstadotrue">Estado del viaje cambiado correctamente</div>
                                    <div class="info__title modfTrayectoEstadofalse">Las plazas deben ser mayores a 0 y la fecha mayor a día de hoy.<br>Guarda los datos modificados y posteriormente activa tu viaje de nuevo</div>
                                </div>
                            </div>
                    </div>
            </div>
        </main>
        <?php include '../utils/cerrarBD.php'; ?>
        <footer class='pie'>
            <p class='derechos'>&copy; 2025 CarPool. Contenido propio, Todos los derechos reservados.</p>
        </footer>
    </div>
    <script src="../js/miZona.js"></script>
</body>
</html>