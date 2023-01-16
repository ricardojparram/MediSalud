<?php 
   
    namespace modelo;
    use config\connect\DBConnect as DBConnect;

    class drogueria extends DBConnect{

      private $cod_dro;
      private $rif;
      private $direccion;
      private $razon;
      private $telefono;
      private $contacto;

      public function __construct(){
        parent::__construct();

      }


      public function mostrarDroguerias(){

        $new = $this->con->prepare("SELECT * FROM drogueria l INNER JOIN contacto_drogue cl ON l.cod_drogue = cl.cod_drogue WHERE l.status = 1;");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      } 

      public function getDatosDro($rif,$razon,$direccion,$telefono,$contacto){

       
        $this->rif = $rif;
        $this->direccion = $direccion;
        $this->razon = $razon;
        $this->telefono = $telefono;
        $this->contacto = $contacto;

        return $this->registrarDro();

      }

      private function registrarDro(){


        try{

           $new = $this->con->prepare("SELECT rif FROM drogueria WHERE status = 1 and rif = ?");
          $new->bindValue(1, $this->rif);
          $new->execute();
          $data = $new->fetchAll();

            if(!isset($data[0]["rif"])){ 

              $new = $this->con->prepare("INSERT INTO drogueria(cod_drogue,rif,direccion,razon_social,status) VALUES(DEFAULT,?,?,?,1)");
              
              $new->bindValue(1, $this->rif); 
              $new->bindValue(2, $this->direccion); 
              $new->bindValue(3, $this->razon);
              $new->execute();
              $lastInsertId = $this->con->lastInsertId();


              $new = $this->con->prepare("INSERT INTO contacto_drogue(id_contacto_drogue, telefono, contacto, cod_drogue) VALUES (DEFAULT, ?, ?, ?)");
              $new->bindValue(1, $this->telefono);
              $new->bindValue(2, $this->contacto);
              $new->bindValue(3, $lastInsertId);
              $new->execute();
              
            }else{
              return ("La Drogueria ya está registrado");
            }

      }catch(\PDOException $error){
         return $error;
      }  
    }
  }

?>