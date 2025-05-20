
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
header('Content-Type: application/json');
session_start();

    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $edad=$_POST['edad'];
    $correo=$_POST['correo'];
    $password=$_POST['password'];
    
    $hashContrasena=password_hash($password,PASSWORD_DEFAULT);
    // Se insertan los datos a una tabla temporal en la base de datos, cuando el usuario confirme el correo por medio del boton, se eliminan los datos de esta tabla temporal (verificando el token aleatorio que vamos a vincular a cada usuario) yse insertan los datos del usuario en la tabla definiticva de usuarios

    // Se crea un token seguro y aleatorio será el que se mande por GET al cliente para verificar su cuenta
    $token=bin2hex(random_bytes(16));

    include "utils/conexionBD.php";
    $sql = "INSERT INTO usuarios_tmp(nombre_usuario,apellido_usuario,contrasena,edad,email,token) VALUES ('$nombre','$apellidos','$hashContrasena','$edad','$correo','$token')";
    // Si la insercion a la base de datos es correcta se manda el correo al usuario
    if ($conn->query($sql) === TRUE) {
        try{
            $mail = new PHPMailer(true);
            // Config del seervidor SMTP
            $mail-> isSMTP();
            $mail->Host ='smtp.gmail.com';
            $mail->SMTPAuth =true;
            $mail->Username='carpool025@gmail.com';
            // Contraseña de aplicación
            $mail->Password='nmfjizrffmmeojvw';
            $mail->SMTPSecure='tls';
            $mail->Port=587;

            // config del correo de CarPool y del usuario al que se le envia el correo
            $mail->setFrom('carpool025@gmail.com','CarPool');
            $mail->addAddress('noeecamara@gmail.com');

            $mail->isHTML(true);
            $mail->Subject= 'Verifica tu cuenta';
            // Cuando el proyecto este desplegado se cambiara http://localhost/PROYECTO/proyectoFinal/eliminarPlaza.php por el dominio
            // En el url mando el id del trayecto para editarlo después
            $mail->Body= "<p> ¡¡ BIENVENIDX !!<br>Ya casi formas parte de CarPool, haz click en el siguiente boton para empezar a compartir trayectos puntuales o recurrentes .<br><br>
            </p>
            <a href='http://localhost/PROYECTO/proyectoFinal/verificar.php?token=$token' style='
            display:inline-block;
            padding:10px 20px;
            background-color:#28a745;
            color:white;
            text-decoration:none;
            border-radius:5px;'>Verificar cuenta</a>";
            
            $mail->send();
             echo json_encode([
            "registro" => 'true'   
            ]);
        }catch(Exception $e){
            echo json_encode([
            "registro" => 'false'   
            ]);
        }
    } else{
        echo json_encode([
        "registro" => 'false'
        ]);
    }

    

include "utils/cerrarBD.php";
?>



