<?php

	namespace modelo;
	use config\connect\DBConnect as DBConnect;

	class recuperar extends DBConnect{
		private $email;


		public function __construct(){
			parent::__construct();

		}

		public function getRecuperarSistema($email){
			if(preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email) == false){
				$resultado = ['resultado' => 'Error de email' , 'error' => 'Correo inválido.'];
				echo json_encode($resultado);
				die();
			}

			$this->email = $email;

			return $this->recuperarSistema();
		}

		protected function recuperarSistema(){
			$new = $this->con->prepare("SELECT `correo` FROM `usuario` WHERE `status` = 1 and `correo` = ?");
			$new->bindValue(1 , $this->email);
			$new->execute();
			$data = $new->fetchAll();

			if(isset($data[0]['correo'])){

				try{
					$new = $this->con->prepare("SELECT `correo`,`password` FROM `usuario` WHERE `status` = 1 and `correo` = ?"); 
					$new->bindValue(1 , $this->email);
					$new->execute();
					$data = $new->fetchAll();
					$correo = $data[0]["correo"];
					$pass = $data[0]["password"];
					
					$this->enviarEmail($correo, $pass);
					$resultado = ['resultado' => 'Correo enviado.'];
					echo json_encode($resultado);
					die();
					
				}catch(exection $error){
					return $error;
				}

			}else{
				$resultado = ['resultado' => 'Error de email' , 'error' => 'El correo no está registrado.'];
				echo json_encode($resultado);
				die();
			}

		}

		private function enviarEmail($email, $pass){

			$para      = $email;
			$titulo    = 'Recuperación de contraseña Medisalud';
			$mensaje   = 'Recuperación de contraseña Medisalud'. "\r\n";
			$mensaje  .= 'Esta es su contraseña: '.$pass;
			$cabeceras = 'From: cfesricardo@gmail.com' . "\r\n" .
			'Reply-To: medisalud@farmacia.com' . "\r\n";

			mail($para, $titulo, $mensaje, $cabeceras);
		}
	}

?>