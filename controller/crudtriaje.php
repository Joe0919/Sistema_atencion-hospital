<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
date_default_timezone_set('America/Lima');
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idcita = (isset($_POST['idcita'])) ? $_POST['idcita'] : '';

$hoy = date("Y-m-d");
$turno = (isset($_POST['turno'])) ? $_POST['turno'] : '';
$especialidad = (isset($_POST['especialidad'])) ? $_POST['especialidad'] : '';

$peso = (isset($_POST['peso'])) ? $_POST['peso'] : '';
$talla = (isset($_POST['talla'])) ? $_POST['talla'] : '';
$imc = (isset($_POST['imc'])) ? $_POST['imc'] : '';
$tempe = (isset($_POST['tempe'])) ? $_POST['tempe'] : '';
$presion = (isset($_POST['presion'])) ? $_POST['presion'] : '';
$frecu = (isset($_POST['frecu'])) ? $_POST['frecu'] : '';
$satu = (isset($_POST['satu'])) ? $_POST['satu'] : '';

$motivo = (isset($_POST['motivo'])) ? $_POST['motivo'] : '';
$tiempo = (isset($_POST['tiempo'])) ? $_POST['tiempo'] : '';
$diag = (isset($_POST['diag'])) ? $_POST['diag'] : '';
$trata = (isset($_POST['trata'])) ? $_POST['trata'] : '';
$referencia = (isset($_POST['referencia'])) ? $_POST['referencia'] : '';
$pxcita = (isset($_POST['pxcita'])) ? $_POST['pxcita'] : '';
$firma = (isset($_POST['firma'])) ? $_POST['firma'] : '';

switch($opcion){
    case 1:
        
        $consulta = "INSERT into atencion values (null,curdate(),curtime(),'$peso','$talla','$imc','$tempe','$presion','$frecu','$satu',
        '','','','',null,null,null,'$idcita')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "UPDATE cita set idestado=4 where idcita='$idcita'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;    
    case 2:        
        
        break;
    case 3:
        $consulta = "SELECT count(*) total FROM atencion where idcita='$idcita'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "DELETE FROM cita WHERE idcita='$idcita'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();    
        }else{
            $data=1; 
        }
                             
        break;
    case 4:    
        $consulta = "select idcita ID, concat(date_format(fech_registro, '%d/%m/%Y'),' ',time_format(fech_registro,'%H:%i:%s')) registrado, date_format(fech_cita, '%d/%m/%Y') Fecha, time_format(hora_cita,'%h:%i %p ') Hora, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente,
        concat(ps.nombres,' ',ps.ap_paterno,' ',ps.ap_materno) Médico, especialidad, estado
        from cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep, especialidad ad, horario io
        where c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=io.idhorario
         and fecha='$hoy' and estado='Registrado' and turno like '%$turno%' and especialidad LIKE '%$especialidad%'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "select idcita ID, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente, pe.dni,calc_edad(pe.fech_nac) edad, concat(pe.g_sangui,' ',pe.factor_rh) grupo,
        especialidad, concat(ps.nombres,' ',ps.ap_paterno,' ',ps.ap_materno) Médico
        from cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep, especialidad ad, horario io
        where c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=io.idhorario and idcita='$idcita'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6:
    
        break;
    
    case 7:

        break;
}


print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;