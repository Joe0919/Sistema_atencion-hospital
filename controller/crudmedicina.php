<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$dni = (isset($_POST['idni'])) ? $_POST['idni'] : '';
$nombre = (isset($_POST['inombre'])) ? $_POST['inombre'] : '';
$appat = (isset($_POST['iappat'])) ? $_POST['iappat'] : '';
$apmat = (isset($_POST['iapmat'])) ? $_POST['iapmat'] : '';
$celular = (isset($_POST['icel'])) ? $_POST['icel'] : '';
$direccion = (isset($_POST['idir'])) ? $_POST['idir'] : '';
$email = (isset($_POST['iemail'])) ? $_POST['iemail'] : '';

$usuario = (isset($_POST['inomusu'])) ? $_POST['inomusu'] : '';
$rol = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$contraseña = (isset($_POST['ipassco'])) ? $_POST['ipassco'] : '';


$dnipersona = (isset($_POST['dnipersona'])) ? $_POST['dnipersona'] : '';
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
        
        $consulta = "UPDATE usuarios SET nombre='$usuario', dni='$dni', contraseña='$password', 
            email='$email', fechaedicion=sysdate(), estado='$celular', idroles='$rol'
            WHERE idusuarios='$user_id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  
        
        $consulta = "SELECT * FROM usuarios WHERE user_id='$user_id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:
        $consulta = "DELETE FROM usuarios WHERE idusuarios='$user_id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();  

        $consulta = "DELETE FROM persona WHERE dni='$dnipersona'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                                   
        break;
    case 4:    
        $consulta = "SELECT idmedicina ID, denom, stock,date_format(fech_venc, '%d/%m/%Y') fecha, tipo
        FROM medicina m, tipo t
        WHERE m.idtipo=t.idtipo";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;