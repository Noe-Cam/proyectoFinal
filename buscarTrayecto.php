<?php
header('Contentent-Type: application/json');
include "utils/conexionBD.php";
// Al tener varias llamadas por ajax a este archivo, se las asigna acciones para controlarlas aquí
$accion=$_POST['accion'];

switch($accion){
    case 'buscarTrayectos':
        $origen=$_POST['origen'];
        $destino=$_POST['destino'];
        $fecha=$_POST['fecha'];
        $recurrentes=[];
        $puntuales=[];
        $sql="SELECT t.id_trayecto,t.precio,t.dias,t.hora,t.plazas,u.nombre_usuario,u.apellido_usuario  FROM trayectos t INNER JOIN origenes o ON t.origen=o.id_origen INNER JOIN destinos d ON t.destino=d.id_destino INNER JOIN usuarios u ON u.id_usuario=t.usu_crea WHERE o.nombre='$origen' AND d.nombre='$destino' AND t.recurrente='1'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($fila = $result->fetch_assoc()){
                $recurrentes[]=$fila;
            } 
        };

        $sql="SELECT t.id_trayecto,t.precio,t.hora,t.plazas,u.nombre_usuario,u.apellido_usuario FROM trayectos t INNER JOIN origenes o ON t.origen=o.id_origen INNER JOIN destinos d ON t.destino=d.id_destino INNER JOIN usuarios u ON u.id_usuario=t.usu_crea WHERE o.nombre='$origen' AND d.nombre='$destino' AND t.fecha='$fecha' AND t.recurrente='0'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($fila = $result->fetch_assoc()){
                $puntuales[]=$fila;
            } 
        };
        include "utils/cerrarBD.php";
        echo json_encode([
            "recurrentes" => $recurrentes,
            "puntuales" => $puntuales
        ]);
        break;

}
