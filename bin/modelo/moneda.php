<?php

  namespace modelo;
  use config\connect\DBConnect as DBConnect;


class moneda extends DBConnect{
	 
	private $moneda;
	private $alcambio;
  private $id;
  private $idedit;


	function __construct(){
	parent::__construct();
    }
   
   public function getAgregarMoneda($alcambio,$moneda){

   	 if(preg_match_all("/^[a-zA-Z]{0,30}$/", $moneda) == false){
            $resultado = ['resultado' => 'Error de moneda' , 'error' => 'moneda inválido.'];
            echo json_encode($resultado);
            die();
        }
     if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $alcambio)){
            return "Error de cambio!";
        }
    
    $this->moneda = $moneda;
    $this->alcambio = $alcambio;
   

     $this->agregarMoneda(); 


   }
   
     private function agregarMoneda(){
     try{
      $new = $this->con->prepare("INSERT INTO `moneda`(`id_moneda`, `cambio`, `nombre`, `status`) VALUES (default,?,?,1)");

      $new->bindValue(1 , $this->alcambio);
      $new->bindValue(2 , $this->moneda);
      $new->execute();
      $data = $new->fetchAll();
      
      $resultado = ['resultado' => 'Registado con exito'];
      echo json_encode($resultado);      
      die();

     }catch(\PDOexection $error){
    	return $error;
      }

   }
   public function getMostrarMoneda(){

   	try{
       $new = $this->con->prepare("SELECT  nombre,cambio, CONCAT('<button type=\"button\" class=\"btn btn-success editar\" data-bs-toggle=\"modal\" data-bs-target=\"#editarModal\" id=\"',id_moneda,'\"><i class=\"bi bi-pencil\"></i></button>
        <button type=\"button\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#delModal\" id=\"',id_moneda,'\">
        <i class=\"bi bi-trash3\"></i>
        </button>') AS Opciones FROM moneda WHERE status = 1");
     $new->execute();
     $data = $new->fetchAll();
     echo json_encode($data);
     die();

    }catch(\PDOexection $error){

     return $error;

    }
  }

  public function getEliminarMoneda($id){
   $this->id = $id;

   $this->eliminarMoneda();
  }

  private function eliminarMoneda(){

    try {
      $new = $this->con->prepare("UPDATE `moneda` SET `status` = '0' WHERE `moneda`.`id_moneda` = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $resultado = ['resultado' => 'Eliminado'];
      echo json_encode($resultado);
      die();
    }
    catch (\PDOException $error) {
      return $error;
    }
  }


  public function mostrarUnico($unico){
    $this->id = $unico;

    $this->unico();
  }

  private function unico(){
    try {
      $new = $this->con->prepare("SELECT cambio, nombre FROM moneda WHERE id_moneda = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $datas = $new->fetchAll();
     echo json_encode($datas);
     die();
      
    } catch (\PDOException $error) {
      return $error;
    }
  }

  public function getEditarMoneda($alcambio,$moneda, $unico){

     if(preg_match_all("/^[a-zA-Z]{3,30}$/", $moneda) == false){
            $resultado = ['resultado' => 'Error de Moneda' , 'error' => 'Moneda inválido.'];
            echo json_encode($resultado);
            die();
        }
     if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $alcambio)){
            return "Error de cambio!";
        }
    
    $this->moneda = $moneda;
    $this->alcambio = $alcambio;
    $this->idedit = $unico;
   

     $this->editarMoneda(); 


   }
   
     private function editarMoneda(){
     try{
      $new = $this->con->prepare("UPDATE `moneda` SET `cambio`= ?,`nombre`= ? WHERE id_moneda = ?");

      $new->bindValue(1, $this->alcambio);
      $new->bindValue(2, $this->moneda);
      $new->bindValue(3, $this->idedit);
      $new->execute();
      $data = $new->fetchAll();
      
      $resultado = ['resultado' => 'Editado'];
      echo json_encode($resultado);      
      die();

     }catch(\PDOexection $error){
      return $error;
      }

   }




}
?>