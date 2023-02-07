<?php

    namespace modelo;
	use config\connect\DBConnect as DBConnect;


	class login extends DBConnect{
		private $cedula;
		private $password;


		public function __construct(){
			parent::__construct();
			
		}
		
		public function getLoginSistema($cedula ,$password){
			if(preg_match_all("/^[0-9]{7,10}$/", $cedula) == false){
				$resultado = ['resultado' => 'Error de cedula' , 'error' => 'Cédula inválida.'];
				echo json_encode($resultado);
				die();
			}
			if(preg_match_all("/^[A-Za-z\d$@\/_.#-]{0,30}$/", $password) == false){
				$resultado = ['resultado' => 'Error de contraseña', 'error' => 'Contraseña inválida.'];
				echo json_encode($resultado);
				die();
			}

			$this->cedula = $cedula;
			$this->password = $password;
			
			return $this->loginSistema();
		}

		private function loginSistema(){
			try{
				$new = $this->con->prepare("SELECT * FROM `usuario` WHERE `status` = 1 and `cedula` = ?"); 
				$new->bindValue(1 , $this->cedula);
				$new->execute();
				$data = $new->fetchAll();

				if(isset($data[0]["password"])){
					if($data[0]["password"] == $this->password){

						$_SESSION['cedula'] = $data[0]['cedula'];
						$_SESSION['nombre'] = $data[0]['nombre'];
						$_SESSION['apellido'] = $data[0]['apellido'];
						$_SESSION['correo'] = $data[0]['correo'];
						$_SESSION['nivel'] = $data[0]['nivel'];

						
						$resultado = ['resultado' => 'Logueado'];
						echo json_encode($_SESSION);
						die();

						
					}else{
						$resultado = ['resultado' => 'Error de contraseña' , 'error' => 'Contraseña incorrecta.'];
						echo json_encode($resultado);
						die();
					}
				}else{
					$resultado = ['resultado' => 'Error de cedula', 'error' => 'La cédula no está registrada.'];
					echo json_encode($resultado);
					die();
				}

			}catch(PDOException $error){
				return $error;
			}
		}

		public function getValidarC($cedula){
			if(preg_match_all("/^[0-9]{7,10}$/", $cedula) == false){
				$resultado = ['resultado' => 'Error de cedula' , 'error' => 'Cédula inválida.'];
				echo json_encode($resultado);
				die();
			}
			$this->cedula = $cedula;

			$this->validarC();
		}

		private function validarC(){
			try{

				$new = $this->con->prepare("SELECT `cedula` FROM `usuario` WHERE `status` = 1 and `cedula` = ?");
				$new->bindValue(1, $this->cedula);
				$new->execute();
				$data = $new->fetchAll();
				if(!isset($data[0]['cedula'])){
					$resultado = ['resultado' => 'Error de cedula' , 'error' => 'La cédula no está registrada.'];
					echo json_encode($resultado);
					die();
				}

			}catch(\PDOException $error){
				return $error;
			}
		}


	}


?>