<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idespec = (isset($_POST['idespec'])) ? $_POST['idespec'] : '';
$espec = (isset($_POST['espec'])) ? strtoupper(trim($_POST['espec'])) : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';




switch($opcion){
    case 1://GUARDAR 
        $consulta = "select count(*) total from especialidad where especialidad='$espec'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);    
        
        if ($data['total'] == 0) {
            $consulta = "insert into especialidad values(null,'$espec')";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $data = 1;
        }
        
        break;    
    case 2:  //EDITAR      
        $consulta = "SELECT count(*) total FROM especialidad e where especialidad='$espec' and idespecialidad!='$idespec'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        
        if ($data['total'] == 0) {

            $consulta = "SELECT count(*) total FROM especialidad e where especialidad='$espec' and idespecialidad ='$idespec'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetch(PDO::FETCH_ASSOC);
            if ($data['total'] == 0) {
                $consulta = "UPDATE especialidad SET especialidad='$espec' where idespecialidad ='$idespec'";			
                $resultado = $conexion->prepare($consulta);
                $resultado->execute(); 
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $data = 2;
            }
        }else{
            $data = 1;
        }
        break;
    case 3://ELIMINAR
        $consulta = "DELETE FROM especialidad WHERE idespecialidad='$idespec'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);            
        break;
    case 4: //CONSULTA TABLA PRINCIPAL
        $consulta = "select * from especialidad";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5://MOSTRAR DATOS A EDITAR
        $consulta = "SELECT * FROM especialidad e where idespecialidad='$idespec'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;