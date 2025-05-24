<?php
// Esta página se encarga de gestionar la información del backend a petición del archivo miZona.js,
// gestiona varias acciones diferentes relativas a cambios en los datos del usuario, vehiculo o trayectos activos o inactivos.
session_start();
$emailUsu=$_SESSION["usuario"];
include "../utils/conexionBD.php";
$accion = $_POST['accion'];

switch($accion){
    case 'modificar_datosUsu':
        $nombre=$_POST['nombre'];
        $apellidos=$_POST['apellidos'];
        $email=$_POST['email'];
        $edad=$_POST['edad'];
        $sql="SELECT id_usuario FROM usuarios WHERE email='$email' AND email <> '$emailUsu'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            echo json_encode([
            "cambioUsu" => false,
            "mensaje"=>"email usado"
            ]);
        } else {
            $sql="UPDATE usuarios SET nombre_usuario='$nombre',email='$email',apellido_usuario='$apellidos',edad='$edad' WHERE email='$emailUsu'";
            if($conn->query($sql)){
                $_SESSION["usuario"]=$email;
                echo json_encode([
                "cambioUsu" => true
                ]);
            }else{
                echo json_encode([
                "cambioUsu" => false,
                "error"=> true,
                "errorSQL" => $conn->error
                ]);
            };
        };
    break;
    case 'modificar_contra':
        $actual=$_POST['actual'];
        $nueva1=$_POST['nueva1'];
        $nueva2=$_POST['nueva2'];
        if(strlen($nueva1)<4 || strlen($nueva1)>12){
            echo json_encode([
                "cambioContra" => false,
                "mensaje"=> 'fail longitud',
            ]);
            exit;
        }
        if($nueva1!==$nueva2){
            echo json_encode([
                "cambioContra" => false,
                "mensaje"=> 'contras diferentes',
            ]);
            exit;
        };
        $sql="SELECT contrasena FROM usuarios WHERE email = '$emailUsu'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $fila = $result->fetch_assoc();
            if ((!password_verify($actual,$fila["contrasena"]))){
                echo json_encode([
                "cambioContra" => false,
                "mensaje"=> 'error contra actual',
                ]);
                exit;
            };
            $nuevaContra=password_hash($nueva1,PASSWORD_DEFAULT);
            $sql="UPDATE usuarios SET contrasena='$nuevaContra' WHERE email='$emailUsu'";
            if($conn->query($sql)){
                echo json_encode([
                "cambioContra" => true
                ]);
            }else{
                echo json_encode([
                "cambioContra" => false,
                "error"=> true,
                "errorSQL" => $conn->error
                ]);
            };
        }; 
    break;
    case 'desactivarCuenta':
        $sql="UPDATE usuarios SET activo=0 WHERE email='$emailUsu'";
        if($conn->query($sql)){
            echo json_encode([
            "desactivarCuenta" => true
            ]);
        }else{
            echo json_encode([
            "desactivarCuenta" => false,
            "error"=> true,
            "errorSQL" => $conn->error
            ]);
        };
    break;
    case 'añadir_datosVehic':
        $matricula=$_POST['matricula'];
        $color=$_POST['color'];
        $marca=$_POST['marca'];
        $plazas=$_POST['plazas'];
        
        $sql="INSERT INTO vehiculos (matricula,marca,color,plazas) VALUES ('$matricula','$marca','$color','$plazas')";
        if($conn->query($sql)){
            $idVehiculo=$conn->insert_id;
            $sql="SELECT id_usuario FROM usuarios WHERE email = '$emailUsu'";
            $result=$conn->query($sql);
            if($result->num_rows>0){
                $fila=$result->fetch_assoc();
                $idUsuario=$fila['id_usuario'];

                $sql="INSERT INTO usuarios_vehiculos (id_usuario,id_vehiculo) VALUES ('$idUsuario','$idVehiculo')";
                if($conn->query($sql)){
                    echo json_encode([
                        "datosVehiculo" => true
                    ]);
                } else{
                    echo json_encode([
                        "datosVehiculo" => false
                    ]);
                }
            }else{
                echo json_encode([
                    "datosVehiculo" => false
                ]);
            }  
        }else{
            echo json_encode([
                    "datosVehiculo" => false
            ]);
        };
    break;
    case 'modificar_datosVehic':
        $matricula=$_POST['matricula'];
        $marca=$_POST['marca'];
        $color=$_POST['color'];
        $plazas=$_POST['plazas'];
        $sql="SELECT id_vehiculo FROM vehiculos WHERE matricula='$matricula'";
        $result=$conn->query($sql);
        if($result->num_rows==0){
            echo json_encode([
                    "datosModifVehiculo" => false
            ]);
            exit;
        };
        $fila=$result->fetch_assoc();
        $idVehiculo=$fila['id_vehiculo'];

        $sql="UPDATE vehiculos SET matricula='$matricula', marca='$marca',color='$color',plazas='$plazas' WHERE id_vehiculo='$idVehiculo'";
        if($conn->query($sql)){
            echo json_encode([
                    "datosModifVehiculo" => true
            ]);
        }else{
            echo json_encode([
                    "datosModifVehiculo" => false
            ]);
        }
    break;
};
include "../utils/cerrarBD.php";