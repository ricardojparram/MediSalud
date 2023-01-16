<?php

  namespace modelo;
  use config\connect\DBConnect as DBConnect;


  class metodo extends DBConnect{
      
    	private $metodo;



    	function __construct(){
       parent::__construct();
     }
     
     public function getAgregarMetodo($metodo){
       if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $metodo)){
        return "Error de metodo!";
      }
      
      
      $this->metodo = $metodo;
      

      return $this->agregarMetodo(); 


    }

    private function agregarMetodo(){
     try{
      $new = $this->con->prepare("INSERT INTO `tipo_pago`(`cod_tipo_pago`, `num_pago`, `des_tipo_pago`, `status`) VALUES (?,1)");

      $new->bindValue(1 , $this->metodo);
      $new->execute();
      $data = $new->fetchAll();

      printf("<script>alert('registrado')</script>");
      
    }catch(\PDOexection $error){
     return $error;
    }

    }
    public function getMostrarMetodo(){

      try{
       $new = $this->con->prepare("SELECT * FROM `metodo` WHERE 1");
       $new->execute();
       $data = $new->fetchAll(\PDO::FETCH_OBJ);
       return $data;

     }catch(\PDOexection $error){

       return $error;

     }
    }
  }
?>