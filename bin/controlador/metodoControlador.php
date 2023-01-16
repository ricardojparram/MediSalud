<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\metodo as metodo;

  $objModel = new metodo();

  $mostrar = $objModel->getMostrarMetodo();

  if(isset($_POST["tipo"])) {
    
    $respuesta = $objModel->getAgregarMetodo($_POST["tipo"]  );  
  } 

  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();


  if(file_exists("vista/interno/configuraciones/metodoVista.php")){
    require_once("vista/interno/configuraciones/metodoVista.php");
  }

?>