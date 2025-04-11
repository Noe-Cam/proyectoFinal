
<?php
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $fecha=$_POST['fecha'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $password=$_POST['password'];
    ?>
    
<?php
    $hashContrasena=password_hash($password,PASSWORD_DEFAULT);
?>


