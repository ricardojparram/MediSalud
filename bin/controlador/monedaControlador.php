<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\moneda as moneda;
  
  $objModel = new moneda();

  $mostrar = $objModel->getMostrarMoneda();

  if(isset($_POST["moneda"]) && isset($_POST["alcambio"])) {

    $respuesta = $objModel->getAgregarMoneda($_POST["moneda"] , $_POST["alcambio"] ) ;  
  } 

  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();

  if(file_exists("vista/interno/configuraciones/monedaVista.php")){
    require_once("vista/interno/configuraciones/monedaVista.php");
  }


?>