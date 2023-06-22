<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
date_default_timezone_set('America/Lima');

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idcita = (isset($_POST['idcita'])) ? $_POST['idcita'] : '';
$idatencion = (isset($_POST['idatencion'])) ? $_POST['idatencion'] : '';

$hoy = date("Y-m-d");
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : 'triaje';
$dniuser = (isset($_POST['dniuser'])) ? $_POST['dniuser'] : '';

$dnipaciente = (isset($_POST['dnipaciente'])) ? $_POST['dnipaciente'] : '';

$peso = (isset($_POST['peso'])) ? $_POST['peso'] : '';
$talla = (isset($_POST['talla'])) ? $_POST['talla'] : '';
$imc = (isset($_POST['imc'])) ? $_POST['imc'] : '';
$tempe = (isset($_POST['tempe'])) ? $_POST['tempe'] : '';
$presion = (isset($_POST['presion'])) ? $_POST['presion'] : '';
$frecu = (isset($_POST['frecu'])) ? $_POST['frecu'] : '';
$satu = (isset($_POST['satu'])) ? $_POST['satu'] : '';

$motivo = (isset($_POST['motivo'])) ? strtoupper($_POST['motivo']) : '';
$tiempo = (isset($_POST['tiempo'])) ? $_POST['tiempo'] : '';
$diag = (isset($_POST['diag'])) ? strtoupper($_POST['diag']) : '';
$trata = (isset($_POST['trata'])) ? $_POST['trata'] : '';
$referencia = (isset($_POST['refe'])) ? $_POST['refe'] : '';
$pxcita = (isset($_POST['pxcita'])) ? $_POST['pxcita'] : '';
$firma = (isset($_POST['firma'])) ? $_POST['firma'] : '';

switch($opcion){
    case 1:
        $consulta = "UPDATE atencion SET fech_ate=curdate(), hora_ate=curtime(),peso='$peso',talla='$talla',imc='$imc',temperatura='$tempe',presion_art='$presion',
        frec_cardio='$frecu',satur_o2='$satu',motivocons='$motivo',tiempo_enferm='$tiempo',diagnostico='$diag',tratamiento='$trata',referencia='$referencia',
        fech_pxcita='$pxcita',firma=concat('DR. ',(select concat(nombres,' ',ap_paterno,' ',ap_materno) from persona where dni='$firma')) where idatencion='$idatencion'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "UPDATE cita set idestado=2 where idcita='$idcita'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);    
        break;    
    case 2: 
        $consulta = "UPDATE atencion SET fech_ate=curdate(), hora_ate=curtime(),peso='$peso',talla='$talla',imc='$imc',temperatura='$tempe',presion_art='$presion',
        frec_cardio='$frecu',satur_o2='$satu',motivocons='$motivo',tiempo_enferm='$tiempo',diagnostico='$diag',tratamiento='$trata',referencia='$referencia',
        fech_pxcita='$pxcita',firma=concat('DR. ',(select concat(nombres,' ',ap_paterno,' ',ap_materno) from persona where dni='$firma')) where idatencion='$idatencion'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 


        $consulta = "UPDATE cita set idestado=2 where idcita='$idcita'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        // $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        $consulta = "INSERT into receta values(null, '$idatencion', curdate(), curtime(),'Por Recoger')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $id = $conexion->lastInsertId();

        $data= $id;

        break;
    case 3:
                      
        break;
    case 4:    
        $consulta = "select idatencion ID, concat(date_format(fech_registro, '%d/%m/%Y'),' ',time_format(fech_registro,'%H:%i:%s')) registrado, date_format(fech_cita, '%d/%m/%Y') Fecha, time_format(hora_cita,'%h:%i %p ') Hora,pe.dni dni, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Paciente,
        especialidad, estado
        from  atencion a,  cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep, especialidad ad, horario io
        where c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=io.idhorario and c.idcita=a.idcita
         and estado like '%$estado%' and fecha like '%$hoy%' and ps.dni='$dniuser';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "select  num_hc, establec, pe.dni DNI,concat(pe.ap_paterno,' ',pe.ap_materno) apell, pe.nombres nom, calc_edad(pe.fech_nac) edad, pe.sexo sexo, concat(pe.g_sangui,' ',pe.factor_rh) rh
        from atencion a, cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep,
        especialidad ad, horario io, hist_clinica hc
        where a.idcita=c.idcita and c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona and hc.idhist_clinica=p.idhist_clinica
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=io.idhorario and pe.dni='$dnipaciente' order by fech_ate;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 7:
        $consulta = "select idatencion, c.idcita idci, pe.dni DNI,concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) paci, calc_edad(pe.fech_nac) edad, especialidad,concat(ps.nombres,' ',ps.ap_paterno,' ',ps.ap_materno) medi,
        peso,talla, imc,temperatura,presion_art,frec_cardio,satur_o2,concat(pe.g_sangui,' ',pe.factor_rh) rh
        from atencion a, cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep,
        especialidad ad, horario io, hist_clinica hc
        where a.idcita=c.idcita and c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona and hc.idhist_clinica=p.idhist_clinica
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=io.idhorario and idatencion='$idatencion'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 8:
        $consulta = "select  num_hc, establec, pe.dni DNI,concat(pe.ap_paterno,' ',pe.ap_materno) apell, pe.nombres nom, calc_edad(pe.fech_nac) edad, pe.sexo sexo, concat(pe.g_sangui,' ',pe.factor_rh) rh,
        idatencion,fech_ate,motivocons,tiempo_enferm, diagnostico, tratamiento
        from atencion a, cita c, paciente p, persona pe, medico m, persona ps, horario_especialidad h, consultorio co, estado e, espec_medico ep,
        especialidad ad, horario io, hist_clinica hc
        where a.idcita=c.idcita and c.idpaciente=p.idpaciente and pe.idpersona=p.idpersona and m.idpersona=ps.idpersona and hc.idhist_clinica=p.idhist_clinica
        and c.idhorario_especialidad=h.idhorario_especialidad and h.idconsultorio=co.idconsultorio and c.idestado=e.idestado and ep.idespec_medico=h.idespec_medico
         and ep.idmedico=m.idmedico and ep.idespecialidad=ad.idespecialidad and h.idhorario=io.idhorario and motivocons != '' and pe.dni='$dnipaciente' order by fech_ate;";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    

}


print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;