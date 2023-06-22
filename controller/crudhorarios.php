<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$cupos = (isset($_POST['cupoH'])) ? $_POST['cupoH'] : '';
$fecha = (isset($_POST['fechaH'])) ? $_POST['fechaH'] : '';
$horario = (isset($_POST['horarioH'])) ? $_POST['horarioH'] : '';
$especi = (isset($_POST['espc'])) ? $_POST['espc'] : '';
$consulto = (isset($_POST['consul'])) ? $_POST['consul'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';


switch($opcion){
    case 1:
        $consulta = "SELECT count(*) total FROM horario_especialidad h where fecha='$fecha' and idespec_medico='$especi' and idhorario='$horario'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);   
        
        if($data['total'] == 0){
            $consulta = "SELECT count(*) total FROM horario_especialidad h where fecha='$fecha' and idconsultorio='$consulto' and idhorario='$horario'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetch(PDO::FETCH_ASSOC);
            if($data['total'] == 0){
                $consulta = "INSERT INTO horario_especialidad values(null, '$cupos','$fecha','$horario','$consulto','$especi')";
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
    case 2:        
        $consulta = "SELECT count(*) total FROM horario_especialidad h where fecha='$fecha' and idespec_medico='$especi' and idhorario='$horario' and idhorario_especialidad!='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);   
        
        if($data['total'] == 0){
            $consulta = "SELECT count(*) total FROM horario_especialidad h where fecha='$fecha' and idconsultorio='$consulto' and idhorario='$horario' and idhorario_especialidad!='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetch(PDO::FETCH_ASSOC);
            if($data['total'] == 0){
                $consulta = "SELECT count(*) total FROM horario_especialidad h where fecha='$fecha' and cupos='$cupos' and idconsultorio='$consulto'  and idespec_medico='$especi' and idhorario='$horario' and idhorario_especialidad='$id'";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetch(PDO::FETCH_ASSOC);
                if ($data['total'] == 0) {
                    $consulta = "UPDATE horario_especialidad SET cupos='$cupos',fecha='$fecha',idhorario='$horario',idconsultorio='$consulto',idespec_medico='$especi' where idhorario_especialidad='$id'";
                    $resultado = $conexion->prepare($consulta);
                    $resultado->execute();
                    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                }else{
                    $data = 3;
                }
            }else{
                $data = 2;
            }
        }else{
            $data = 1;
        }

        break;
    case 3:
        $consulta = "SELECT count(*) total FROM cita c where idhorario_especialidad='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetch(PDO::FETCH_ASSOC);    
        if ($data['total'] == 0) {
            $consulta = "DELETE FROM horario_especialidad WHERE idhorario_especialidad='$id'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();   
        }else{
            $data = 1;
        }                           
        break;
    case 4:    
        $consulta = "select idhorario_especialidad ID, cupos,  date_format(fecha, '%d/%m/%Y') fecha, turno, c.nomcons, especialidad
        from horario_especialidad h, horario ho, consultorio c, espec_medico es, especialidad ep
        where h.idhorario=ho.idhorario and h.idconsultorio=c.idconsultorio and h.idespec_medico=es.idespec_medico and ep.idespecialidad=es.idespecialidad";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "SELECT idhorario_especialidad ID , cupos,  date_format(fecha, '%d/%m/%Y') fecha, idhorario IDHO, idconsultorio IDCON, idespec_medico IDES 
        FROM horario_especialidad h where idhorario_especialidad='$id';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;