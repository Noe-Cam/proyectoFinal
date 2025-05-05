<?php
session_start();
$origen=$_POST['origen'];
$destino=$_POST['destino'];
$fecha=$_POST['fecha'] ?? null;
$hora=$_POST['hora'];
$plazas=$_POST['plazas'];
$descripcion=$_POST['descripcion'];
$diasSeleccionados=$_POST['dias'] ?? null;
$precio=$_POST['precio'];
$recurrente=$_POST['recurrente'];
$email=$_SESSION["usuario"];
// Coordenadas [longitud,latitud]
$coordOrigen = json_decode($_POST['coordOrigen'], true);
$coordDestino = json_decode($_POST['coordDestino'], true);

$latOrigen = $coordOrigen[1];
$lonOrigen = $coordOrigen[0];
$latDestino = $coordDestino[1];
$lonDestino = $coordDestino[0];

$origenes=false;
$destinos=false;
$trayectos=false;
include "utils/conexionBD.php";

$sql="INSERT INTO origenes (nombre,latitud,longitud) VALUES ('$origen','$latOrigen','$lonOrigen')";
if ($conn->query($sql) === TRUE) {
    $idOrigen = $conn->insert_id;
    $origenes=true;
};
$sql="INSERT INTO destinos (nombre,latitud,longitud) VALUES ('$destino','$latDestino','$lonDestino')";
if ($conn->query($sql) === TRUE) {
    $idDestino = $conn->insert_id;
    $destinos=true;
};
$sql="SELECT id_usuario FROM usuarios WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    $idUsu=$fila["id_usuario"];
};
if ($recurrente==='true'){
    $sql = "INSERT INTO trayectos(fecha,precio,dias,hora,plazas,usu_crea,origen,destino,recurrente) VALUES ('$fecha','$precio','$diasSeleccionados','$hora','$plazas','$idUsu','$idOrigen','$idDestino','1')";
        if ($conn->query($sql) === TRUE) {
            $trayectos=true;
        };  
} else {
    $sql = "INSERT INTO trayectos(fecha,precio,dias,hora,plazas,usu_crea,origen,destino,recurrente) VALUES ('$fecha','$precio','$diasSeleccionados','$hora','$plazas','$idUsu','$idOrigen','$idDestino','0')";
        if ($conn->query($sql) === TRUE) {
            $trayectos=true;
    };
};

if($origenes==true && $destinos==true && $trayectos==true){
    echo json_encode([
        'publicado' => 'true'
    ]);
} else { 
    echo json_encode([
        'publicado' => 'false'
    ]);
};
include "utils/cerrarBD.php";


