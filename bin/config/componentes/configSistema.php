<?php
    
    namespace config\componentes;

    define("_URL_", "http://localhost/MediSalud/");
    define("_BD_" , "medisalud");
    define("_PASS_" , "");
    define("_USER_" , "root");
    define("_LOCAL_" , "localhost");
    define("DIRECTORY" , "bin/controlador/");
    define("MODEL", "modelo/");
    define("CONTROLADOR", "Controlador.php");
    define("_SMTP", "smtp.gmail.com");
    define("_SMTP_USER", "cfesricardo@gmail.com");
    define("_SMTP_PASS", "gsdmrveydcxqexpi");


    class configSistema{
    	
    public function _int(){
       if(!file_exists("bin/controlador/frontControlador.php")){
        return "Error configSistema!";

      }
    }
    
    public function _URL_(){
      return _URL_;
    }
    public function _BD_(){
      return _BD_;
    }
    public function _PASS_(){
      return _PASS_;
    }
    public function _USER_(){
      return _USER_;
    }
    public function _LOCAL_(){
      return _LOCAL_;
    }
    public function _Dir_(){
      return DIRECTORY;
    }
    public function _MODEL_(){
      return MODEL;
    }
    public function _Control_(){
      return CONTROLADOR;
    }

  }

?>