<?php
session_start();
$correo=$_POST['correo'];
$contra=$_POST['contra'];

$autenticacionCorrecta = false;
include 'utils/conexionBD.php';
$sql="SELECT nombre_usuario,contrasena FROM usuarios WHERE email = '$correo'";

$result = $conn->query($sql);
if ($result->num_rows == 0) {
    $autenticacionCorrecta = false;
} else{
    $fila = $result->fetch_assoc();
    if ((password_verify($contra,$fila["contrasena"]))){
        $autenticacionCorrecta = true;
        // $usuario=$fila['nombre_usuario'];
    };
};
// Si la autenticación es correcta creamos al variable de sesion usuario
//y mandamos la respuesta a js para operar dependiendo de la autenticacion 
include 'utils/cerrarBD.php'; 
header('Content-Type: application/json');
if ($autenticacionCorrecta == true){
    $_SESSION["usuario"]=$correo;
    echo json_encode([
        'autenticacion' => 'true'
    ]);
    
} else { 
    echo json_encode([
        'autenticacion' => 'false'
    ]);
};

