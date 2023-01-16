<?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;

  $VarComp = new initcomponents();
  $header = new header();
  $menu = new menuLateral();


  if(file_exists("vista/interno/homeVista.php")){
    require_once("vista/interno/homeVista.php");
  } 


    /*

  if(isset($_GET["tipo"])){

    if($_GET["tipo"] == "home"){


     if(file_exists("vista/interno/homeVista.php")){
      require_once("vista/interno/homeVista.php");
    } 


    }elseif($_GET["tipo"] == "perfil"){

    if(file_exists("vista/interno/perfilVista.php")){
     require_once("vista/interno/perfilVista.php");
    } 

    }elseif($_GET["tipo"] == "usuario"){

    if(file_exists("modelo/usuarioModelo.php")) {
    require_once("modelo/usuarioModelo.php");
    }
      $objModel = new usuarios();

      $mostrar = $objModel->getMostrarUsuario();


      if(isset($_POST['cedula']) && isset($_POST['name'])&& isset($_POST['apellido'])&& isset($_POST['email'])  && isset($_POST['password']) && isset($_POST['tipoUsuario']) ){


      $respuesta = $objModel->getAgregarUsuario($_POST['cedula'] , $_POST['name'], $_POST['apellido'], $_POST['email'], $_POST['password'], $_POST['tipoUsuario']);

      }

    if(file_exists("vista/interno/usuarioVista.php")){
    require_once("vista/interno/usuarioVista.php");
    }

    }  
    elseif($_GET["tipo"] == "mercancia"){

    if(file_exists("vista/interno/mercanciaVista.php")){
    require_once("vista/interno/mercanciaVista.php");
    }
    }
    elseif($_GET["tipo"] == "ventas"){

    if(file_exists("modelo/ventasModelo.php")) {
    require_once("modelo/ventasModelo.php");
    }

      $objModel = new ventas();

      $mostrarP = $objModel->getMostrarProducto();
      $mostrarV = $objModel->getMostrarVentas();

      if(isset($_POST['cedula']) && isset($_POST['monto']) && isset($_POST['codigoP']) && isset($_POST['cantidad']) && isset($_POST['precioA']) ){

      $respuesta = $objModel->getAgregarVenta($_POST['cedula'] , $_POST['monto'] , $_POST['codigoP'] , $_POST['cantidad'], $_POST['precioA']);
      }


    if(file_exists("vista/interno/ventasVista.php")){
    require_once("vista/interno/ventasVista.php");
    }
    }

    elseif($_GET["tipo"] == "clientes"){

    if(file_exists("modelo/clienteModelo.php")){
    require_once("modelo/clienteModelo.php");
    }

      $objModel = new clientes();

      $mostrarClien = $objModel->mostrarClientes();




      if(isset($_POST['nomClien']) && isset($_POST['apeClien'])&& isset($_POST['cedClien'])&& isset($_POST['direcClien']) && isset($_POST['telClien']) && isset($_POST['emailClien'])){


      $respuesta = $objModel->getRegistrarClientes($_POST['nomClien'],$_POST['apeClien'],$_POST['cedClien'],$_POST['direcClien'],$_POST['telClien'],$_POST['emailClien']);
      }

    if(file_exists("vista/interno/clientesVista.php")){
    require_once("vista/interno/clientesVista.php");
    }

    }

    elseif($_GET["tipo"] == "compras"){

    if(file_exists("vista/interno/comprasVista.php")){
    require_once("vista/interno/comprasVista.php");
    }
    }

    elseif($_GET["tipo"] == "metodo"){
    if(file_exists("modelo/metodoModelo.php")){
    require_once("modelo/metodoModelo.php");
    }

      $objModel = new metodo();

      $mostrar = $objModel->getMostrarMetodo();

      if(isset($_POST["tipo"])) {

      $respuesta = $objModel->getAgregarMetodo($_POST["tipo"]  );  
      } 


    if(file_exists("vista/interno/configuraciones/metodoVista.php")){
    require_once("vista/interno/configuraciones/metodoVista.php");
    }
    }

    elseif($_GET["tipo"] == "moneda"){
    if(file_exists("modelo/monedaModelo.php")){
    require_once("modelo/monedaModelo.php");
    }

      $objModel = new moneda();

      $mostrar = $objModel->getMostrarMoneda();

      if(isset($_POST["moneda"]) && isset($_POST["alcambio"])) {

      $respuesta = $objModel->getAgregarMoneda($_POST["moneda"] , $_POST["alcambio"] ) ;  
      } 


    if(file_exists("vista/interno/configuraciones/monedaVista.php")){
    require_once("vista/interno/configuraciones/monedaVista.php");
    }
    }

    elseif($_GET["tipo"] == "producto"){

    if(file_exists("vista/interno/productos/productoVista.php")){
    require_once("vista/interno/productos/productoVista.php");
    }
    }


    elseif($_GET["tipo"] == "tipo"){

    if(file_exists("vista/interno/productos/tipoVista.php")){
    require_once("vista/interno/productos/tipoVista.php");
    }
    }

    elseif($_GET["tipo"] == "clase"){

    if(file_exists("vista/interno/productos/claseVista.php")){
    require_once("vista/interno/productos/claseVista.php");
    }
    }

    elseif($_GET["tipo"] == "drogueria"){

    if(file_exists("modelo/drogueriaModelo.php")){
    require_once("modelo/drogueriaModelo.php");
    }

      $objModel = new drogueria();
      $datos = $objModel->mostrarDroguerias();



      if(isset($_POST['rif']) && isset($_POST['direccion']) && isset($_POST['razon']) && isset($_POST['telefono'])&& isset($_POST['contacto'])){

      $respuesta = $objModel->getDatosDro($_POST['rif'], $_POST['direccion'], $_POST['razon'], $_POST['telefono'], $_POST['contacto']);

      }

    if(file_exists("vista/interno/productos/drogueriaVista.php")){
    require_once("vista/interno/productos/drogueriaVista.php");
    }

    }


    elseif($_GET["tipo"] == "laboratorio"){

    if(file_exists("modelo/laboratorioModelo.php")){
    require_once("modelo/laboratorioModelo.php");
    }

      $objModel = new laboratorio();
      $datos = $objModel->mostrarLaboratorios();


      if(isset($_POST['rif']) && isset($_POST['direccion']) && isset($_POST['razon']) && isset($_POST['telefono'])&& isset($_POST['contacto'])){

      $respuesta = $objModel->getDatosLab($_POST['rif'], $_POST['direccion'], $_POST['razon'], $_POST['telefono'], $_POST['contacto']);

      }

    if(file_exists("vista/interno/productos/laboratorioVista.php")){
    require_once("vista/interno/productos/laboratorioVista.php");
    }
    }


    elseif($_GET["tipo"] == "presentacion"){

    if(file_exists("vista/interno/productos/presentacionVista.php")){
    require_once("vista/interno/productos/presentacionVista.php");
    }
    }

    elseif($_GET["tipo"] == "reportes"){

    if(file_exists("vista/interno/reportesVista.php")){
    require_once("vista/interno/reportesVista.php");
    }
    }


    else{
    die(require_once("vista/interno/pages-error-404.php"));
    }

  }else{

  die("<script>window.location = `?url=home&tipo=home`</script>");

  } */

?>