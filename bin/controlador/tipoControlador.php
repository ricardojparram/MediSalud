<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral();


	if(file_exists("vista/interno/productos/tipoVista.php")){
		require_once("vista/interno/productos/tipoVista.php");
	}else{
		die('La vista no existe.');
	}

?>