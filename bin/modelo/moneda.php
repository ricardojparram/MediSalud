<?php

  namespace modelo;
  use config\connect\DBConnect as DBConnect;


class moneda extends DBConnect{
	 
	private $moneda;
	private $alcambio;


	function __construct(){
	parent::__construct();
    }
   
   public function getAgregarMoneda($moneda,$alcambio){
   	 if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $moneda)){
            return "Error de moneda!";
         }
     if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $alcambio)){
            return "Error de cambio!";
        }
    
    $this->moneda = $moneda;
    $this->alcambio = $alcambio;
   

    return $this->agregarMoneda(); 


   }
   
     private function agregarMoneda(){
     try{
      $new = $this->con->prepare("INSERT INTO `moneda`(`id_moneda`, `cambio`, `nombre`, `status`) VALUES (default,?,?,1)");

      $new->bindValue(1 , $this->alcambio);
      $new->bindValue(2 , $this->moneda);
      $new->execute();
      $data = $new->fetchAll();
     
     }catch(\PDOexection $error){
    	return $error;
      }

   }
   public function getMostrarMoneda(){

   	try{
     $new = $this->con->prepare("SELECT * FROM `moneda` WHERE 1");
     $new->execute();
     $data = $new->fetchAll(\PDO::FETCH_OBJ);
     return $data;

    }catch(\PDOexection $error){

     return $error;

    }
  }
}
?>