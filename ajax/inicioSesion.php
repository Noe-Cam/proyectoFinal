<?php
// Esta página se encarga de gestionar los inicios de sesión, 
//  verificando que  el usuario como la contraeña introducidas por el usuario son correctas, asi como que la cuenta está activa (activo=1).
//  Llamada desde el archivo js/login.js 
session_start();
$correo=$_POST['correo'];
$contra=$_POST['contra'];

$autenticacionCorrecta = false;
include '../utils/conexionBD.php';
$sql="SELECT nombre_usuario,contrasena FROM usuarios WHERE email = '$correo' AND activo = 1";

$result = $conn->query($sql);
if ($result->num_rows == 0) {
    $autenticacionCorrecta = false;
} else{
    $fila = $result->fetch_assoc();
    if ((password_verify($contra,$fila["contrasena"]))){
        $autenticacionCorrecta = true;
    };
};
// Si la autenticación es correcta creamos al variable de sesion usuario
//y mandamos la respuesta a js para operar dependiendo de la autenticacion 
include '../utils/cerrarBD.php'; 
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

