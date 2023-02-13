<?php 

namespace modelo;
Use config\connect\DBConnect as DBConnect;

class perfil extends DBConnect{

	private $cedula;
	private $dni;
	private $nombre;
	private $apellido;
	private $correo;

	private $passwordAct;
	private $passwordNew;

	public function __construct(){
        parent::__construct();
    }

    public function mostrarDatos($cedula){
    	
    	$this->cedula = $cedula;

    	$this->datos();
    }

    private function datos(){
    	try {
    		$new = $this->con->prepare("SELECT u.cedula, u.nombre, u.apellido, u.correo, n.nombre as nivel FROM usuario u INNER JOIN nivel n ON n.cod_nivel = u.nivel WHERE u.cedula = ?");
            $new->bindValue(1, $this->cedula);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
    	} catch(\PDOexection $error){
            return $error;
        }
    }

    public function getEditar($nombre, $apellido, $dni, $correo, $cedula){

	    if(preg_match_all("/^[a-zA-Z]{3,30}$/", $nombre) == false){
	      $resultado = ['resultado' => 'Error de nombre' , 'error' => 'Nombre invalido.'];
	      echo json_encode($resultado);
	      die();
	    }
	    if(preg_match_all("/^[a-zA-Z]{3,30}$/", $apellido) == false){
	      $resultado = ['resultado' => 'Error de apellido' , 'error' => 'Apellido invalido.'];
	      echo json_encode($resultado);
	      die();
	    }
	    if(preg_match_all("/^[0-9]{7,10}$/", $dni) == false){
	      $resultado = ['resultado' => 'Error de cedula' , 'error' => 'Cédula invalida.'];
	      echo json_encode($resultado);
	      die();
	    }
	    if(preg_match_all("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $correo) == false){
	      $resultado = ['resultado' => 'Error de email' , 'error' => 'Correo invalida.'];
	      echo json_encode($resultado);
	      die();
	    }

	    $this->nombre = $nombre;
	    $this->apellido = $apellido;
	    $this->dni = $dni;
	    $this->correo = $correo;
	    $this->cedula = $cedula;

	    $this->editarDatos();
	}

	private function editarDatos(){
		try {
			$new = $this->con->prepare("UPDATE `usuario` SET `cedula`= ?,`nombre`= ?,`apellido`= ?,`correo`= ? WHERE cedula = ?");
            $new->bindValue(1, $this->dni);
            $new->bindValue(2, $this->nombre);
            $new->bindValue(3,$this->apellido);
            $new->bindValue(4, $this->correo);
            $new->bindValue(5, $this->cedula);
            $new->execute();
            $resultado = ['resultado' => 'Editado'];
            echo json_encode($resultado);
            die();
		} catch (\PDOException $error) {
			return $error;
		}
	}

	public function getCambioContra($cedula, $passwordAct, $passwordNew, $passwordNewR){

		if(preg_match_all("/^[A-Za-z0-9 *?=&_!¡()@#]{3,30}$/", $passwordNew) == false) {
          $resultado = ['resultado' => 'Error de contraseña' , 'error' => 'Correo inválida.'];
          echo json_encode($resultado);
          die();
        }
        if($passwordNew != $passwordNewR) {
          $resultado = ['resultado' => 'Error de repass' , 'error' => 'Las contraseñas no coinciden.'];
          echo json_encode($resultado);
          die();
        }

		$this->cedula = $cedula;
		$this->passwordAct = $passwordAct;
		$this->passwordNew = $passwordNew;

		$this->cambioContra();
	}

	private function cambioContra(){

	}

}

 ?>