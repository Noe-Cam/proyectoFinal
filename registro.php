
<?php
    session_start();

    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $edad=$_POST['edad'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $password=$_POST['password'];
    
    $hashContrasena=password_hash($password,PASSWORD_DEFAULT);

    //conectamos con la BD y se hace el insert
    include "utils/conexionBD.php";
    $sql = "INSERT INTO usuarios(nombre_usuario,apellido_usuario,contrasena,edad,email) VALUES ('$nombre','$apellidos','$hashContrasena','$edad','$correo')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION["usuario"]=$usuario;
    }
    include "utils/cerrarBD.php";
    ?>



