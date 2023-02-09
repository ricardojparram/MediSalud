<?php  
	
	namespace modelo;
    use config\connect\DBConnect as DBConnect;

    class perfil extends DBConnect{

    	private $cedula;
    	private $nombre;
    	private $apellido;
    	private $password;
    	private $email;
    	private $nivel;
    	private $foto;

    	public function __construct(){
			parent::__construct();
		}

		public function getUser($cedula){
			$this->cedula = $cedula;

			$this->editUser();
		}

		private function editUser(){

			

		}
    }

?>