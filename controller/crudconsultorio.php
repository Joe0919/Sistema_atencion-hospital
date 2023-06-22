<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$dni = (isset($_POST['idni'])) ? $_POST['idni'] : '';
$nombre = (isset($_POST['inombre'])) ? $_POST['inombre'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$user_id = (isset($_POST['user_id'])) ? $_POST['user_id'] : '';



switch($opcion){
    case 1:
        $consulta = "INSERT into persona values (null,'$dni','$appat','$apmat','$nombre','$email','$celular','$direccion')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "INSERT into usuarios values (null,'$usuario','$dni','$contraseña','$email',sysdate(),null,sysdate(),'Activo',null,'$rol')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM usuarios ORDER BY idusuarios DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE persona SET dni='$dni', ap_paterno='$appat', ap_materno='$apmat', 
            nombres='$nombre', email='$email', telefono='$celular', direccion='$direccion'
            WHERE idusuarios='$user_id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        
        $consulta = "SELECT * FROM usuarios WHERE user_id='$user_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "DELETE FROM consultorio WHERE idconsultorio='$user_id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                                 
        break;
    case 4:    
        $consulta = "SELECT * FROM consultorio";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;