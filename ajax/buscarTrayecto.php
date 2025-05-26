<?php
// Esta página se encarga de gestionar informacion del backend a petición del archivo index.js, 
// gestiona 3 acciones diferentes:
//     - buscarTrayectos-> se encarga de buscar en la base de datos en la tabla trayectos,los trayectos recurrentes y puntuales que coinciden con el origen,destino y fecha que inserta el usuario en index.php.
//     - infoModal-> se encarga de buscar en la base de datos la informacion que aparecerá cuando un usuario selecciona un viaje recurrente o puntual.
//     - mandarEmailConductor-> se encarga de mandar un mail al conductor del trayecto seleccionado por el usuario cuando selecciona el botón de "contactar".  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
header('Content-Type: application/json');
session_start();
include "../utils/conexionBD.php";
// Al tener varias llamadas por ajax a este archivo, se las asigna acciones para controlarlas aquí
$datosRecibidos = file_get_contents("php://input");
$data = json_decode($datosRecibidos, true);

if ($data) {
    $accion = $data['accion'];
} else {
    $accion = $_POST['accion'];
};
switch($accion){
    case 'buscarTrayectos':
        $hoy = date('Y-m-d');
        $conn->query("UPDATE trayectos SET activo=0 WHERE fecha < '$hoy' AND recurrente=0");
        
        $origen=$_POST['origen'];
        $destino=$_POST['destino'];
        $fecha=$_POST['fecha'];
        $recurrentes=[];
        $puntuales=[];
        $sql="SELECT t.id_trayecto,t.precio,t.dias,t.hora,t.plazas,u.nombre_usuario,u.apellido_usuario  FROM trayectos t INNER JOIN origenes o ON t.origen=o.id_origen INNER JOIN destinos d ON t.destino=d.id_destino INNER JOIN usuarios u ON u.id_usuario=t.usu_crea WHERE o.nombre='$origen' AND d.nombre='$destino' AND t.recurrente='1' AND t.activo='1'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($fila = $result->fetch_assoc()){
                $recurrentes[]=$fila;
            } 
        };
        $sql="SELECT t.id_trayecto,t.precio,t.hora,t.plazas,u.nombre_usuario,u.apellido_usuario FROM trayectos t INNER JOIN origenes o ON t.origen=o.id_origen INNER JOIN destinos d ON t.destino=d.id_destino INNER JOIN usuarios u ON u.id_usuario=t.usu_crea WHERE o.nombre='$origen' AND d.nombre='$destino' AND t.fecha='$fecha' AND t.recurrente='0' AND t.activo='1'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($fila = $result->fetch_assoc()){
                $puntuales[]=$fila;
            } 
        };
        
        echo json_encode([
            "recurrentes" => $recurrentes,
            "puntuales" => $puntuales
        ]);
    break;
    case 'infoModal' :
        if (!isset($_SESSION["usuario"])){
            
            echo json_encode([
                "error" => 'no logeado'   
            ]);
        } else {
            $datosModal=[];
            $idTrayeto=$data['idTrayecto'];
            $sql="SELECT u.nombre_usuario,u.apellido_usuario,u.email,t.id_trayecto, t.fecha, t.dias, t.precio, t.hora, t.plazas, o.latitud AS lat_origen, o.longitud AS lon_origen, d.latitud AS lat_destino, d.longitud AS lon_destino FROM trayectos t INNER JOIN usuarios u ON t.usu_crea=u.id_usuario INNER JOIN origenes o ON t.origen=o.id_origen INNER JOIN destinos d ON t.destino=d.id_destino WHERE t.id_trayecto='$idTrayeto'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $fila = $result->fetch_assoc();
                $datosModal=$fila;
            };
            $sql="SELECT v.marca FROM vehiculos v INNER JOIN  usuarios_vehiculos uv ON v.id_vehiculo=uv.id_vehiculo INNER JOIN trayectos t ON uv.id_usuario=t.usu_crea WHERE t.id_trayecto='$idTrayeto'";
            $result = $conn->query($sql); 
            if ($result->num_rows > 0) {
                $fila = $result->fetch_assoc();
                $datosModal['vehiculo']=$fila['marca'];
            }else{
                $datosModal['vehiculo']=false;           
            };
            echo json_encode([
            "datosModal" => $datosModal   
            ]);
        };
    break;
    case 'mandarEmailConductor' :
        $userMail=$data['email'];
        $idTrayeto=$data['idTrayecto'];
        $mailUserSolicita=$_SESSION["usuario"];
        $mail=new PHPMailer(true);
        try{
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
            $mail->Subject= 'Alguien se ha interesado por tu viaje';
            // Cuando el proyecto este desplegado se cambiara http://localhost/PROYECTO/proyectoFinal/eliminarPlaza.php por el dominio
            // En el url mando el id del trayecto para editarlo después
            $mail->Body= "<p> ¡¡ENHORABUENA!!<br> $mailUserSolicita tiene interés en tu trayecto publicado en CarPool.<br> Ponte en contacto cuanto antes.<br><br>
            Si quieres eliminar una plaza en tu viaje publicado, haz click en el siguiente botón</p><br><br>
            <a href='http://localhost/PROYECTO/proyectoFinal/pages/eliminarPlaza.php?numero=$idTrayeto' style='
                display:inline-block;
                padding:10px 20px;
                background-color:#28a745;
                color:white;
                text-decoration:none;
                border-radius:5px;'>Eliminar plaza</a>";

            $mail->send();
            echo json_encode([
            "info" => 'mensaje mandado...se supone'
            ]);
        } catch(Exception $e){
            echo json_encode([
            "info" => 'ERROR'.$mail->ErrorInfo   
            ]);
        };  
    break;
    default:
        echo json_encode([
            "error" => 'error'   
        ]);
    break;
};

include "../utils/cerrarBD.php";