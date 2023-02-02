<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;
  use modelo\home as home;

  $objModel = new home();

  if(!isset($_SESSION['cedula'])){
    die('<script> window.location = "?url=login" </script>');
  }

  if (isset($_POST['clien'])) {
    $objModel->mostrarClientes();
  }

  if(isset($_POST['fechas'])){
    $objModel->getFechas();
  }

  if(isset($_POST['grafico']) && isset($_POST['compra'])){
    $objModel->getCompraG();
  }

  if(isset($_POST['grafico']) && isset($_POST['venta'])){
    $objModel->getVentaG();
  }


  if(isset($_POST['ventas']) && isset($_POST['opcionV'])){
    $objModel->getVentas($_POST['opcionV']);
  }

  if(isset($_POST['compras']) && isset($_POST['opcionC'])){
    $objModel->getCompras($_POST['opcionC']);
  }

  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();

  if(file_exists("vista/interno/homeVista.php")){
    require_once("vista/interno/homeVista.php");
  } 


    

?>