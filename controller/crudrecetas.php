<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
date_default_timezone_set('America/Lima');

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$hoy = date("Y-m-d");


$fech = (isset($_POST['fech'])) ? $_POST['fech'] : $hoy;
$idreceta = (isset($_POST['idreceta'])) ? $_POST['idreceta'] : $hoy;

switch($opcion){
    case 1:    
        $consulta = "SELECT iddetalle_receta ID,denom,tipo, dias, cantidad, indicacion
        FROM detalle_receta d , receta r, medicina m , tipo t 
        where m.idmedicina=d.idmedicina and d.idreceta=r.idreceta and m.idtipo=t.idtipo and r.idreceta='$idreceta'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 4:    
        $consulta = "SELECT idreceta, concat(pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) paciente,date_format(fech_importe, '%d/%m/%Y') fech, time_format(hora_importe,'%H:%i:%s %p') hor, estado, estado FROM receta r ,atencion a, cita c, paciente p, persona pe
        where r.idatencion=a.idatencion and a.idcita=c.idcita and c.idpaciente=p.idpaciente and p.idpersona=pe.idpersona and fech_importe like '%%'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "UPDATE receta set estado='Recogido' where idreceta='$idreceta'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

}


print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;