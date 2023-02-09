<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\perfil as perfil;

  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();

  $objModel = new perfil();

  if(!isset($_SESSION['nivel'])){
    die('<script> window.location = "?url=login" </script>');
  }

  if(isset($_POST['user']) && isset($_POST['cedula']) && isset($_POST['cedula'])){
    $objModel->getUser($_POST['cedula']);
  }

  if(file_exists("vista/interno/perfilVista.php")){
    require_once("vista/interno/perfilVista.php");
  } 


?>