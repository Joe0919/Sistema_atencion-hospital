<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$idpersona = (isset($_POST['idper'])) ? $_POST['idper'] : '';
$dni = (isset($_POST['dni'])) ? trim($_POST['dni']) : '';
$codigo = (isset($_POST['codigo'])) ? trim($_POST['codigo']) : '';   


switch($opcion){
    case 1:
        $consulta = "SELECT count(*) total FROM medico where codigo='$codigo'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        if ($data['total'] == 0) {
            $consulta = "INSERT into medico values (null,'$codigo','$idpersona')";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            
            $consulta = "UPDATE usuarios SET estado='ACTIVO' where dni='$dni'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $data = 1;
        }
        break;    
    case 2:        
        $consulta = "SELECT count(*) total FROM medico where codigo='$codigo' and idmedico != '$id'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "SELECT count(*) total FROM medico where codigo='$codigo' and idmedico = '$id'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetch(PDO::FETCH_ASSOC);

            if ($data['total'] == 0) {
                $consulta = "UPDATE medico SET codigo='$codigo' where idmedico = '$id'";			
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
    case 3:
        $consulta = "SELECT count(*) total FROM espec_medico where idmedico='$id'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        if ($data['total'] == 0) {
            $consulta = "DELETE FROM medico WHERE idmedico='$id'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();  
            
            $consulta = "UPDATE usuarios SET estado='DESACTIVADO' where dni='$dni'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
        }else{
            $data = 1;
        }                        
        break;
    case 4:    
        $consulta = "select idmedico ID, pe.dni DNI, codigo, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Personal
        from medico p, persona pe
        where p.idpersona=pe.idpersona";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:// Mostrar datos del medico no registrado aun
        $consulta = "select idusuarios ID1, idpersona ID2, p.dni dni, nombres ,ap_paterno ap, ap_materno am, telefono, direccion
        from persona p, usuarios u
        where p.dni=u.dni and idpersona='$idpersona'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6: //PARA MOSTRAR DATOS DEL EMPLEADO
        $consulta = "select idmedico ID, p.dni dni, nombres ,ap_paterno ap, ap_materno am, telefono, direccion, codigo cod
        from medico e, persona p
        where e.idpersona=p.idpersona and idmedico='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;