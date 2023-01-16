 <?php 

  use component\initcomponents as initcomponents;
  use component\header as header;
  use component\menuLateral as menuLateral;

   $VarComp = new initcomponents();
   $header = new header();
   $menu = new menuLateral();


	if(file_exists("vista/interno/productos/claseVista.php")){
		require_once("vista/interno/productos/claseVista.php");
	}

?>