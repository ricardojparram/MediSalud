<?php 

	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\reportes as reportes;

	$VarComp = new initcomponents();
	$header = new header();
	$menu = new menuLateral();

	$objModel = new reportes();

	session_start();
	if(!isset($_SESSION['cedula'])){
		die('<script> window.location = "?url=login" </script>');
	}

	if(isset($_POST['mostrar']) && isset($_POST['tipo']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])){
		$objModel->getMostrarReporte($_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']);
	}
	if(isset($_POST['exportar']) && isset($_POST['tipo']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFinal'])){
		$objModel->getExportar($_POST['tipo'], $_POST['fechaInicio'], $_POST['fechaFinal']);
	}


	if(file_exists("vista/interno/reportesVista.php")){
		require_once("vista/interno/reportesVista.php");
	}else{
		die('La vista no existe.');
	}

?>