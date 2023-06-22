<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
date_default_timezone_set('America/Lima');

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$idreceta = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$iddetalle = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idmedicina = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$dias = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$cantidad = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$indicacion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1:
        $consulta = "SELECT count(*) total from detalle_receta where idreceta='$idreceta' and idmedicina='$idmedicina'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "INSERT into detalle_receta values(null, '$idmedicina','$idreceta','$dias','$cantidad','$indicacion')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
        }else{
            $data=1;
        }
        break;   
    }