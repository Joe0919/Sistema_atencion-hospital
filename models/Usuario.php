<?php
    class Usuario extends Conectar {
        
        public function login(){
			$conectar=parent::Conexion();
			parent::set_names();
			if(isset($_POST["enviar"])){
				
				$usuario = $_POST["usuario"];
				$password = $_POST["password"];
				
				if(empty($usuario) and empty($password)){
					header("Location:".Conectar::ruta()."Acceso/index.php?m=2");
					exit();
				}
				else {
				$sql= "select * from usuarios where dni=? and contraseña=? and estado='ACTIVO'";
				$sql=$conectar->prepare($sql);
				$sql->bindValue(1, $usuario);
				$sql->bindValue(2, $password);
				$sql->execute();
				$resultado = $sql->fetch();
					if(is_array($resultado) and count($resultado)>0){
						$_SESSION["idusuarios"] = $resultado["idusuarios"];
                        $_SESSION["nombre"] = $resultado["nombre"];
                        $_SESSION["dni"] = $resultado["dni"];
						$_SESSION["email"] = $resultado["email"];
						$_SESSION["foto"] = $resultado["foto"];
						$_SESSION["idroles"] = $resultado["idroles"];
						header("Location:".Conectar::ruta()."view/Home/");
						exit(); 
					} else {
						header("Location:".Conectar::ruta()."Acceso/index.php?m=1");
						exit();
					} 
				}
			}
		}

		public function insert_usuario($nombre,$dni,$email,$contra){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuario values (NULL,?,?,?,?,NULL, NULL, NULL, '1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$usu_nom);
            $sql->bindValue(2,$usu_ape);
			$sql->bindValue(3,$usu_correo);
			$sql->bindValue(4,$usu_pass);
            $sql->execute();
		}
		
		public function get_correo_usuario($usu_correo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE usu_correo=? AND est=1;";
            $sql=$conectar->prepare($sql);
			$sql->bindValue(1,$usu_correo);
			$sql->execute();
			return $resultado=$sql->fetchAll();
        }

    }
?>