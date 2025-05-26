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
            $sql="UPDATE trayectos SET activo=0 WHERE usu_crea=(SELECT id_usuario FROM usuarios WHERE email='$emailUsu')";
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
    case 'modificar_datosTrayecto':
        $id_trayecto=$_POST['id_trayecto'];
        $origen=$_POST['origen'];
        $destino=$_POST['destino'];
        $dias=$_POST['dias'] ?? null;
        $fecha=$_POST['fecha'] ?? null;
        $precio=$_POST['precio'];
        $plazas=$_POST['plazas'];
        $hora=$_POST['hora'];
        $recurrente=$_POST['recurrente'];
        $cambioOrigen=false;
        $cambioDestino=false;
        $cambioTrayecto=false;

        $sql="UPDATE origenes o JOIN  trayectos t ON t.origen=o.id_origen SET o.nombre= '$origen' WHERE t.id_trayecto='$id_trayecto'";
        if($conn->query($sql)){
            $cambioOrigen=true;
        };
        $sql="UPDATE destinos d JOIN trayectos t ON t.destino=d.id_destino SET d.nombre= '$destino' WHERE t.id_trayecto='$id_trayecto'";
        if($conn->query($sql)){
            $cambioDestino=true;
        };
        $sql="UPDATE trayectos SET fecha='$fecha', precio='$precio',dias='$dias',hora='$hora',plazas='$plazas' WHERE id_trayecto='$id_trayecto'";
        if($conn->query($sql)){
            $cambioTrayecto=true;
        };
        if($cambioOrigen && $cambioDestino && $cambioTrayecto){
            echo json_encode([
                "datosModifTrayecto" => true
            ]);
        }else{
            echo json_encode([
                "datosModifTrayecto" => false
            ]);
        }
    break;
    case 'cambiar_estado_trayecto':
        $idTrayecto=$_POST['id_trayecto'];
        $nuevoEstado=$_POST['nuevo_estado'];
        $fechaOk=false;
        $plazasOk=false;
        $sql = "SELECT fecha, plazas FROM trayectos WHERE id_trayecto = '$idTrayecto'";
        $result = $conn->query($sql);
        if($result->num_rows>0){
            $fila=$result->fetch_assoc();
            $fecha = $fila['fecha'];
            $plazas = $fila['plazas'];
            if($nuevoEstado=='1'){
                if($fecha == '0000-00-00'){
                    $fechaOk=true;
                }else{
                    if (strtotime($fecha) < strtotime(date('Y-m-d'))){
                        $fechaOk=false;
                    }else{
                        $fechaOk=true;
                    };
                };
                if($plazas <= 0){
                    $plazasOk=false;
                }else{
                    $plazasOk=true;
                };
                if($fechaOk==false || $plazasOk==false){
                    echo json_encode([
                        "datosModifEstado" => false,
                        "mensaje" => 'fecha o plaza no ok'
                    ]);
                    exit;
                };
            };
            $sql="UPDATE trayectos SET activo= '$nuevoEstado' WHERE id_trayecto= '$idTrayecto'";
            if ($conn->query($sql)) {
                echo json_encode([
                        "datosModifEstado" => true, 
                ]);
            } else {
                echo json_encode([
                        "datosModifEstado" => false, 
                ]);
            }
        }else{
            echo json_encode([
                "datosModifEstado" => false, 
            ]);
        };
    break;
    default:
        echo json_encode([
                    "cambioUsu" => false,
                    "cambioContra"=> false,
                    "desactivarCuenta"=> false,
                    "datosVehiculo"=> false,
                    "datosModifVehiculo"=> false,
                    "datosModifTrayecto" => false,
                    "datosModifEstado" => false
            ]);
    break;
};
include "../utils/cerrarBD.php";