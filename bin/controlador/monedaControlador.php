<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\moneda as moneda;
  
  $objModel = new moneda();

  if (isset($_POST["mostrar"])) {
    $objModel->getMostrarMoneda();
  }

  if(isset($_POST["cambio"]) && isset($_POST["tipo"])) {

    $objModel->getAgregarMoneda($_POST["cambio"], $_POST["tipo"]);  
  } 



  if (isset($_POST["borrar"]) && isset($_POST["id"])) {
    $objModel->getEliminarMoneda($_POST["id"]);
  }

  if (isset($_POST["unico"]) && isset($_POST["editar"])) {

    
    $objModel->mostrarUnico($_POST["unico"]);
  }

   if(isset($_POST["cambioEdit"]) && isset($_POST["tipoEdit"]) && isset($_POST["unico"])) {

    $objModel->getEditarMoneda($_POST["cambioEdit"], $_POST["tipoEdit"], $_POST["unico"]);  
  } 










  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();

  if(file_exists("vista/interno/configuraciones/monedaVista.php")){
    require_once("vista/interno/configuraciones/monedaVista.php");
  }


?>