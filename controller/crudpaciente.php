<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$idpersona = (isset($_POST['idper'])) ? $_POST['idper'] : '';
$idpaciente = (isset($_POST['id'])) ? $_POST['id'] : '';
$dni = (isset($_POST['dni'])) ? trim($_POST['dni']) : '';
$nombres = (isset($_POST['nombres'])) ? strtoupper(trim($_POST['nombres'])) : '';
$appat = (isset($_POST['appat'])) ? strtoupper(trim($_POST['appat'])) : '';
$apmat = (isset($_POST['apmat'])) ? strtoupper(trim($_POST['apmat'])) : '';
$cel = (isset($_POST['cel'])) ? trim($_POST['cel']) : '';
$direccion = (isset($_POST['dir'])) ? strtoupper(trim($_POST['dir'])) : '';
$sexo = (isset($_POST['sexo'])) ? trim($_POST['sexo']) : '';
$fechN = (isset($_POST['fechN'])) ? trim($_POST['fechN']) : '';
$lugarN = (isset($_POST['lugarN'])) ? strtoupper(trim($_POST['lugarN'])) : '';
$edad = (isset($_POST['edadP'])) ? strtoupper(trim($_POST['edadP'])) : '';
$gsang = (isset($_POST['gsang'])) ? trim($_POST['gsang']) : '';
$Rh = (isset($_POST['Rh'])) ? trim($_POST['Rh']) : '';
$alergia = (isset($_POST['alergia'])) ? strtoupper(trim($_POST['alergia'])) : '';

switch($opcion){
    case 1:
        if ($idpersona != 0) {
            $consulta = "UPDATE persona SET  ap_paterno='$appat', ap_materno='$apmat', nombres='$nombres', sexo='$sexo', fech_nac='$fechN', edad='$edad',
             direccion='$direccion', g_sangui='$gsang', factor_rh='$Rh', telefono='$cel'
            WHERE idpersona='$idpersona'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "INSERT INTO hist_clinica values(null,gen_nrohc(),'021601A101 (RENAES: 0000001765-HACDP)',sysdate())";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "INSERT INTO paciente values(null, '$alergia','$idpersona',(Select max(idhist_clinica) from hist_clinica))";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        }else{
            $consulta = "INSERT INTO persona values(null,'$dni','$appat','$apmat','$nombres','$sexo','$fechN','$lugarN','$edad','$direccion'
            ,'$gsang','$Rh','$cel')";				
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "INSERT INTO hist_clinica values(null,gen_nrohc(),'021601A101 (RENAES:0000001765-HACDP)',sysdate())";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "INSERT INTO paciente values(null, '$alergia',(Select idpersona from persona where dni='$dni'),(Select max(idhist_clinica) from hist_clinica))";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        }           
        break;    
    case 2:  
        $consulta = "select count(*) total from persona where dni='$dni' and idpersona!='$idpersona'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        if ($data['total'] == 0) {
            $consulta = "UPDATE persona SET  ap_paterno='$appat', ap_materno='$apmat', nombres='$nombres', sexo='$sexo', fech_nac='$fechN', edad='$edad',
             direccion='$direccion', g_sangui='$gsang', factor_rh='$Rh', telefono='$cel'
            WHERE idpersona='$idpersona'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "UPDATE paciente SET alergia_medi='$alergia' where idpaciente='$idpaciente'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);   
        }else{
            $data = 1;
        }
        break;
    case 3:
        $consulta = "SELECT count(*) total FROM cita c where idpaciente='$idpaciente'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetch(PDO::FETCH_ASSOC);    
        if ($data['total'] == 0) {
            $consulta = "DELETE FROM paciente WHERE idpaciente='$idpaciente'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();   
        }else{
            $data = 1;
        }                           
        break;                            
        break;
    case 4:    
        $consulta = "select idpaciente ID, pe.dni DNI, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente,alergia_medi ALERGIA,num_hc NROHC, establec
        from paciente p, persona pe, hist_clinica h
        where p.idpersona=pe.idpersona and p.idhist_clinica=h.idhist_clinica;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:    
        $consulta = "select count(*) total from persona p, usuarios u where p.dni=u.dni and u.dni='$dni'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
           $data = 1;
        }else{
            $consulta = "select idpersona ID2, nombres ,ap_paterno ap, ap_materno am, sexo,  date_format(fech_nac, '%d/%m/%Y') fech_nac,lugar_nac,edad, direccion, g_sangui,factor_rh,telefono
            from persona p, usuarios u
            where p.dni=u.dni and u.dni='$dni'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();        
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }
        break;
    case 6:
        $consulta = "select idpaciente ID,pe.idpersona IDP, pe.dni DNI,num_hc,establec, pe.nombres nombres,pe.ap_paterno ap,pe.ap_materno am,alergia_medi ALERGIA,num_hc NROHC, establec, telefono, direccion, sexo,date_format(fech_nac, '%d/%m/%Y') fech_nac, lugar_nac, g_sangui,factor_rh,alergia_medi,calc_edad(fech_nac) edad
        from paciente p, persona pe, hist_clinica h
        where p.idpersona=pe.idpersona and p.idhist_clinica=h.idhist_clinica and idpaciente='$idpaciente'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 7:
              
            $consulta = "select idpaciente ID, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente
            from paciente p, persona pe, hist_clinica h
            where p.idpersona=pe.idpersona and p.idhist_clinica=h.idhist_clinica and dni='$dni'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            
            $filas = $resultado->rowCount();
            if ($filas <= 0) {
                $data=1;
            } else {
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            }
            
        break;
    case 8:
        $consulta = "SELECT calc_edad('$fechN') h;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;