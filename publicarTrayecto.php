<?php
session_start();
$origen=$_POST['origen'];
$destino=$_POST['destino'];
$fecha=$_POST['fecha'];
$hora=$_POST['hora'];
$plazas=$_POST['plazas'];
$descripcion=$_POST['descripcion'];
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
    $origenes=true;
};
$sql="INSERT INTO destinos (nombre,latitud,longitud) VALUES ('$destino','$latDestino','$lonDestino')";
if ($conn->query($sql) === TRUE) {
    $destinos=true;
};
$sql="SELECT id_usuario FROM usuarios WHERE email='$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    $idUsu=$fila["id_usuario"];
};
if($origenes==true && $destinos==true){
    $sql="SELECT id_origen FROM origenes WHERE nombre='$origen'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $idOrigen=$fila["id_origen"];
    };
    $sql="SELECT id_destino FROM destinos WHERE nombre='$destino'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        $idDestino=$fila["id_destino"];
    };
}
$sql = "INSERT INTO trayectos(fecha,hora,plazas,usu_crea,origen,destino) VALUES ('$fecha','$hora','$plazas','$idUsu','$idOrigen','$idDestino')";
if ($conn->query($sql) === TRUE) {
    $trayectos=true;
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


