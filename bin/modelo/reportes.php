<?php 
	
	namespace modelo;
	use FPDF as FPDF;

	use config\connect\DBConnect as DBConnect;

	class reportes extends DBConnect{

		private $tipo;
		private $fechaInicio;
		private $fechaFinal;
		private $sql;
		private $reporte;
		private $lista;


		public function __construct(){
			parent::__construct();
		}

		private function obtenerReporte(){
			switch ($this->tipo) {
				case 'compra':
				$this->sql="SELECT c.orden_compra, p.razon_social, c.fecha, SUM(cp.cantidad) as cantidad,
							c.monto_total FROM compra c 
							INNER JOIN compra_producto cp
							ON cp.cod_compra = c.cod_compra
							INNER JOIN proveedor p 
							ON c.cod_prove = p.cod_prove
							WHERE fecha BETWEEN ? AND ? AND c.status = 1
							GROUP BY cp.cod_compra";
				break;
				case 'venta':
				$this->sql="SELECT v.num_fact, c.cedula, CONCAT(c.nombre,' ',c.apellido) as nombre,
							v.fecha, v.monto  FROM venta v 
							INNER JOIN cliente c 
							ON v.cedula_cliente = c.cedula
							WHERE fecha BETWEEN ? AND ? AND c.status = 1
							ORDER BY v.num_fact ASC";
				break;
				
				default:
				echo json_encode(['Error' => 'Tipo de reporte inválido.']);
				break;
			}


			try {

				$new = $this->con->prepare($this->sql);
				$new->bindValue(1, $this->fechaInicio);
				$new->bindValue(2, $this->fechaFinal);
				$new->execute();

				$reporte = $new->fetchAll();
				return $reporte;

			} catch (\PDOException $e) {
				return $e;
			}
		}

		public function getMostrarReporte($tipo, $inicio, $final){
			$this->tipo = $tipo;
			$this->fechaInicio = $inicio;
			$this->fechaFinal = $final;

			$this->mostrarReporte();
		}

		private function mostrarReporte(){
			$this->reporte = $this->obtenerReporte();	
			echo json_encode($this->reporte);
			die();

		}

		public function getExportar($tipo, $fecha1, $fecha2){
			$this->tipo = $tipo;
			$this->fechaInicio = $fecha1;
			$this->fechaFinal = $fecha2;

			$this->exportarReporte();
		}

		private function exportarReporte(){
			$reporte = $this->obtenerReporte();
			$fechaI = date('d-m-Y', strtotime($this->fechaInicio));
			$fechaF = date('d-m-Y', strtotime($this->fechaFinal));
			$nombre = ($this->tipo == 'compra') ? 'compras_'.$fechaI.'_'.$fechaF.'.pdf' : 'ventas_'.$fechaI.'_'.$fechaF.'.pdf';
			$titulo = ($this->tipo == 'compra') ? 'Reporte de Compras' : 'Reporte de Ventas';
			$subTitulo = $fechaI.' a '.$fechaF;
			$columnas = ($this->tipo == 'compra') ? [0 => 'Orden', 1 => 'Proveedor', 2 => 'Fecha', 3 => 'Cantidad', 4 => 'Monto Total'] : [0 => 'N°', 1 => 'Cédula', 2 => 'Nombre', 3 => 'Fecha', 4 => 'Monto'];

			$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetMargins(20,30,20);
			
			$pdf->Image('assets/img/Logo_titulo.png',20,5,40);
			$pdf->SetFont('Arial','B',16);
			$pdf->setX(20);
			$pdf->setY(15);
			$pdf->Cell(0,10,$titulo,0,1,'C');
			$pdf->Cell(0,10,$subTitulo,0,0,'C');
			$pdf->Ln(18); 

			$pdf->SetFont('Helvetica','B',12);
			$pdf->SetFillColor(210, 224, 137);

			$pdf->Cell(25,10,utf8_decode($columnas[0]),1,0,'C',1);
			$pdf->Cell(40,10,utf8_decode($columnas[1]),1,0,'C',1);
			$pdf->Cell(45,10,utf8_decode($columnas[2]),1,0,'C',1);
			$pdf->Cell(40,10,utf8_decode($columnas[3]),1,0,'C',1);
			$pdf->Cell(30,10,utf8_decode($columnas[4]),1,1,'C',1);

			$pdf->SetFont('Arial','',12);
			$pdf->SetFillColor(245,245,245);

			foreach ($reporte as $col => $value) {

				$pdf->Cell(25,10,utf8_decode($value[0]),1,0,'C',1);
				$pdf->Cell(40,10,utf8_decode($value[1]),1,0,'C',1);
				$pdf->Cell(45,10,utf8_decode($value[2]),1,0,'C',1);
				$pdf->Cell(40,10,utf8_decode($value[3]),1,0,'C',1);
				$pdf->Cell(30,10,utf8_decode($value[4]),1,1,'C',1);

			}

			$repositorio = 'assets/reportes/'.$nombre;
			$pdf->Output('F',$repositorio);
			
			$respuesta = ['respuesta' => 'Archivo guardado', 'ruta' => $repositorio];
			echo json_encode($respuesta);
			die();
		}

	}


?>