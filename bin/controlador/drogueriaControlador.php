<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\drogueria as drogueria;

  $objModel = new drogueria();
  $datos = $objModel->mostrarDroguerias();


  if(isset($_POST['rif']) && isset($_POST['direccion']) && isset($_POST['razon']) && isset($_POST['telefono'])&& isset($_POST['contacto'])){

    $respuesta = $objModel->getDatosDro($_POST['rif'], $_POST['direccion'], $_POST['razon'], $_POST['telefono'], $_POST['contacto']);

  }

  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();

  if(file_exists("vista/interno/productos/drogueriaVista.php")){
    require_once("vista/interno/productos/drogueriaVista.php");
  }

?>