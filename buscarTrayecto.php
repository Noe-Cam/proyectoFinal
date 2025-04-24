<?php
$origen=$_POST['origen'];
$destino=$_POST['destino'];
$fecha=$_POST['fecha'];

include "utils/conexionBD.php";
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