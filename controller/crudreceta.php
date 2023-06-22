<?php
include_once '../config/conexion1.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
date_default_timezone_set('America/Lima');

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$idreceta = (isset($_POST['idreceta'])) ? $_POST['idreceta'] : '';
$iddetalle = (isset($_POST['iddetalle'])) ? $_POST['iddetalle'] : '';
$idmedicina = (isset($_POST['idmedicina'])) ? $_POST['idmedicina'] : '';
$dias = (isset($_POST['dias'])) ? $_POST['dias'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$indicacion = (isset($_POST['indicacion'])) ? strtoupper($_POST['indicacion']) : '';

switch($opcion){
    case 1:
        $consulta = "SELECT count(*) total from detalle_receta where idreceta='$idreceta' and idmedicina='$idmedicina'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetch(PDO::FETCH_ASSOC);

        if ($data['total'] == 0) {
            $consulta = "INSERT into detalle_receta values(null, '$idmedicina','$idreceta','$dias','$cantidad','$indicacion')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
        }else{
            $data=1;
        }
        break;    
    case 2: 
        $consulta = "SELECT count(*) total FROM detalle_receta where idreceta='$idreceta' and idmedicina='$idmedicina' and iddetalle_receta!='$iddetalle'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetch(PDO::FETCH_ASSOC);   
        
        if($data['total'] == 0){
            $consulta = "SELECT count(*) total FROM detalle_receta where idreceta='$idreceta' and idmedicina='$idmedicina' and dias='$dias' and cantidad='$cantidad' 
            and indicacion='$indicacion' and iddetalle_receta='$iddetalle'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetch(PDO::FETCH_ASSOC);
            if($data['total'] == 0){
                
                    $consulta = "UPDATE detalle_receta SET idreceta='$idreceta', idmedicina='$idmedicina' , dias='$dias' , cantidad='$cantidad' 
                    , indicacion='$indicacion' and iddetalle_receta='$iddetalle'";
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
            $consulta = "DELETE FROM detalle_receta WHERE iddetalle_receta='$iddetalle'";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                 
        break;
    case 4:    
        $consulta = "SELECT iddetalle_receta ID,denom,tipo, dias, cantidad, indicacion
        FROM detalle_receta d , receta r, medicina m , tipo t 
        where m.idmedicina=d.idmedicina and d.idreceta=r.idreceta and m.idtipo=t.idtipo and r.idreceta='$idreceta'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 5:
        $consulta = "SELECT iddetalle_receta ID, m.idmedicina IDM, dias, cantidad, indicacion
        FROM detalle_receta d , receta r, medicina m where m.idmedicina=d.idmedicina and d.idreceta=r.idreceta and iddetalle_receta='$iddetalle';";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 7:

        break;
    case 8:

        break;
    

}


print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;