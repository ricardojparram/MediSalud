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

  if(isset($_SESSION['cedula']) && isset($_POST['mostrar'])) {
    $objModel->mostrarDatos($_SESSION['cedula']);
  }

  if (isset($_FILES['foto']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['correo']) && isset($_SESSION['cedula'])) {
    if(isset($_FILES['foto']['name'])){
      echo $_FILES['foto']['name'];
      die();
    }
    $objModel->getEditar($_POST['nombre'], $_POST['apellido'], $_POST['dni'], $_POST['correo'], $_SESSION['cedula']);
  }

  if(isset($_SESSION['cedula']) && isset($_POST['passwordAct']) && isset($_POST['passwordNew']) && isset($_POST['passwordNewR'])) {
    $objModel->getCambioContra($_SESSION['cedula'], $_POST['passwordAct'], $_POST['passwordNew'], $_POST['passwordNewR']);
  }

  if(file_exists("vista/interno/perfilVista.php")){
   require_once("vista/interno/perfilVista.php");
 } 


?>
