<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$idespecialidad = (isset($_POST['id'])) ? $_POST['id'] : '';

$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';

    $consulta = "select count(*) total
    from horario_especialidad h, horario ho, consultorio c, espec_medico es, especialidad ep, medico m, persona pe
    where h.idhorario=ho.idhorario and h.idconsultorio=c.idconsultorio and h.idespec_medico=es.idespec_medico and ep.idespecialidad=es.idespecialidad
    and m.idpersona=pe.idpersona and es.idmedico=m.idmedico and es.idespecialidad='$idespecialidad' and fecha='$fecha';";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data = $resultado->fetch(PDO::FETCH_ASSOC);
    if ($data['total'] == 0) {
        echo '<option selected="selected">------ No se encontraron datos ------</option>';
    }else{

        $consulta = "select idhorario_especialidad ID, concat('Turno: ',turno,' : Dr. ',pe.nombres,' ',pe.ap_paterno,' ',pe.ap_materno) Datos
        from horario_especialidad h, horario ho, consultorio c, espec_medico es, especialidad ep, medico m, persona pe
        where h.idhorario=ho.idhorario and h.idconsultorio=c.idconsultorio and h.idespec_medico=es.idespec_medico and ep.idespecialidad=es.idespecialidad
        and m.idpersona=pe.idpersona and es.idmedico=m.idmedico and es.idespecialidad='$idespecialidad' and fecha='$fecha';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        echo '<option selected="selected">------ Elige la programación ------</option>';
        while ($datos = $resultado->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value='.$datos['ID'].'>'. $datos['Datos'] .'</option>';
        }
    }