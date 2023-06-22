<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$idpersona = (isset($_POST['idper'])) ? $_POST['idper'] : '';
$dni = (isset($_POST['dni'])) ? trim($_POST['dni']) : '';
$codigo = (isset($_POST['codigo'])) ? trim($_POST['codigo']) : '';   

$idmed = (isset($_POST['cbo'])) ? trim($_POST['cbo']) : '';
$idesp = (isset($_POST['cboE'])) ? trim($_POST['cboE']) : '';


switch($opcion){
    case 1:
        $consulta = "SELECT count(*)total FROM espec_medico where idmedico='$idmed' and idespecialidad='$idesp'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        if ($data['total'] == 0) {
            $consulta = "INSERT into espec_medico values(null, '$idmed','$idesp')";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $data = 1;
        }
        break;    
    case 2:        
        $consulta = "SELECT count(*) total FROM espec_medico where idmedico='$idmed' and idespecialidad='$idesp' and idespec_medico='$id'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        if ($data['total'] == 0) {
            $consulta = "UPDATE espec_medico SET idmedico='$idmed',idespecialidad='$idesp' where idespec_medico='$id'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $data = 1;
        }
        break;
    case 3:
        $consulta = "SELECT Count(*) total FROM horario_especialidad where idespec_medico='$id'";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetch(PDO::FETCH_ASSOC);
        if ($data['total'] == 0) {
            $consulta = "DELETE FROM espec_medico where idespec_medico='$id'";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $data = 1;
        }          
        break;
    case 4:    
        $consulta = "select idespec_medico ID,  codigo, concat(p.nombres,' ',p.ap_paterno,' ',p.ap_materno) Medico, especialidad
        from espec_medico e, medico m, especialidad es, persona p
        where e.idmedico=m.idmedico and e.idespecialidad=es.idespecialidad and p.idpersona=m.idpersona";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:// Mostrar datos del medico no registrado aun
        $consulta = "select idusuarios ID1, p. idpersona ID2, idmedico ID3, p.dni dni, nombres ,ap_paterno ap, ap_materno am, telefono, direccion
        from persona p, usuarios u, medico m
        where p.dni=u.dni and m.idpersona=p.idpersona and p.idpersona='$idpersona'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 6:
        $consulta = "select idespec_medico IDEM,e.idmedico IDM, p.dni dni, nombres ,ap_paterno ap, ap_materno am, telefono, direccion, codigo cod, idespecialidad
        from medico e, persona p, espec_medico es
        where e.idpersona=p.idpersona and e.idmedico=es.idmedico and idespec_medico='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;