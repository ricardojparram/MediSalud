<?php 

	namespace modelo;
    use config\connect\DBConnect as DBConnect;

	class compras extends DBConnect{

		private $proveedor;
		private $orden;
		private $fecha;
		private $montoT;

		private $producto;
		private $cantidad;
		private $precio;
		private $id;

		public function __construct(){
			parent::__construct();
		}

		public function mostrarCompras(){

			try {
				
				$query = "SELECT c.orden_compra, p.razon_social, CONCAT('<a class=\"a-asd detalleCompra\" id=\"', c.cod_compra ,'\" data-bs-toggle=\"modal\" data-bs-target=\"#detalleCompra\">Ver detalles</a>') as productos, c.fecha, c.monto_total, CONCAT('<button type=\"button\" id=\"', c.cod_compra ,'\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#Borrar\"><i class=\"bi bi-trash3\"></i></button>') as opciones FROM compra c 
				INNER JOIN proveedor p
				ON c.cod_prove = p.cod_prove 
				WHERE c.status = 1";

				$new = $this->con->prepare($query);
				$new->execute();
				$data = $new->fetchAll();

				echo json_encode($data);
				die();

			} catch (\PDOException $e) {
				return $e;
			}

		}

		public function mostrarProveedor(){
			try {

				$new = $this->con->prepare("SELECT cod_prove, razon_social FROM proveedor WHERE status = 1");
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				
				return $data;

			} catch (\PDOException $e) {
				return $e;
			}
		}

		public function mostrarSelect(){
			try {

				$new = $this->con->prepare("SELECT cod_producto , descripcion FROM producto WHERE status = 1");
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				
				echo json_encode($data);
				die();

			} catch (\PDOException $e) {
				return $e;
			}
		}


		public function productoDetalle($id){
			if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
				die(json_encode(['error' => 'Id inválida.']));
			}
			$this->producto = $id;

			try {
				$new = $this->con->prepare("SELECT p_venta, stock FROM producto WHERE cod_producto = ? and status = 1");
				$new->bindValue(1, $this->producto);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				
				echo json_encode($data);
				die();

			} catch (\PDOException $e) {
				return $e;
			}
		}

		public function getOrden($orden){
			if(preg_match_all("/^[0-9]{1,30}$/", $orden) != 1){
				die(json_encode(['error' => 'Orden inválida']));
			}
			$this->orden = $orden;

			$this->validarOrden();
		}

		private function validarOrden(){
			try {
				
				$new = $this->con->prepare("SELECT orden_compra FROM compra WHERE status = 1 AND orden_compra = ?;");
				$new->bindValue(1, $this->orden);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				if(isset($data[0]->orden_compra)){
					die(json_encode(['resultado' => 'Error de orden', 'error' => 'Orden de compra ya registrada.']));
				}else{
					die(json_encode(['resultado' => 'Orden válida']));
				}

			} catch (\PDOException $e) {
				
			}
		}

		public function getcompras($prove, $orden, $fecha, $montoT){

			if(preg_match_all("/^[0-9]{1,10}$/", $prove) != 1){
				die(json_encode(['error' => 'Proveedor inválido.']));
			}
			if(preg_match_all("/^[0-9]{1,30}$/", $orden) != 1){
				die(json_encode(['error' => 'Orden inválida']));
			}
			if(preg_match_all("/^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/", $fecha) != 1){
				die(json_encode(['error' => 'Fecha inválida.']));
			}
			if(preg_match_all("/^[0-9]{1,30}$/", $montoT) != 1){
				die(json_encode(['error' => 'Monto inválido.']));
			}

			$this->proveedor = $prove;
			$this->orden = $orden;
			$this->fecha = $fecha;
			$this->montoT = $montoT;

			$this->registrarCompras();
		}

		private function registrarCompras(){

			try{

				$new = $this->con->prepare("SELECT orden_compra FROM compra WHERE status = 1 AND orden_compra = ?;");
				$new->bindValue(1, $this->orden);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);

				if(isset($data[0]->orden_compra)){
					die(json_encode(['resultado' => 'Error de orden', 'error' => 'Orden de compra ya registrada.']));
				}

				$new = $this->con->prepare('INSERT INTO compra (orden_compra, fecha, monto_total, status , cod_prove) VALUES (?, ?, ?, 1, ?)');
				$new->bindValue(1, $this->orden);
				$new->bindValue(2, $this->fecha);
				$new->bindValue(3, $this->montoT);
				$new->bindValue(4, $this->proveedor);
				$new->execute();

				$this->id = $this->con->lastInsertId();
				echo json_encode(['resultado' => 'Orden registrada.', 'id' => $this->id]);
				die();

			}catch(\PDOException $e){
				return $e;
			}

		}

		public function getProducto($cantidad, $precio, $producto, $idcompra){
			if(!is_numeric($cantidad) || !is_numeric($precio) || !is_numeric($producto) || !is_numeric($idcompra)){
				die(['error' => 'Registro de producto inválido.']);
			}
			$this->cantidad = $cantidad;
			$this->precio = $precio;
			$this->producto = $producto;
			$this->id = $idcompra;

			$this->registrarProducto();
		}

		private function registrarProducto(){

			try {
				
				$new = $this->con->prepare('INSERT INTO compra_producto (cod_compra, cod_producto, cantidad, precio_compra) 
											VALUES (?, ?, ?, ?) ');
				$new->bindValue(1, $this->id);
				$new->bindValue(2, $this->producto);
				$new->bindValue(3, $this->cantidad);
				$new->bindValue(4, $this->precio);
				$new->execute();

				$new = $this->con->prepare('SELECT stock FROM producto WHERE cod_producto = ?');
				$new->bindValue(1, $this->producto);
				$new->execute();
				$stock= $new->fetchAll(\PDO::FETCH_OBJ);
				$stockActual = $stock[0]->stock;

				$stockActual += $this->cantidad;
				$new = $this->con->prepare('UPDATE producto SET	stock = ? WHERE cod_producto = ?');
				$new->bindValue(1, $stockActual);
				$new->bindValue(2, $this->producto);
				$new->execute();
				echo "Stock actualizado";
				die();	
				
			} catch (\PDOException $e) {
				return $e;
			}

		}

		public function detalleCompra($id){
			if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
				die(json_encode(['error' => 'Id inválida.']));
			}
			$this->id = $id;
			try {
				$new = $this->con->prepare('SELECT cp.cantidad, cp.precio_compra, c.orden_compra, p.descripcion FROM compra_producto cp 
											INNER JOIN producto p 
											ON p.cod_producto = cp.cod_producto
											INNER JOIN compra c 
											ON c.cod_compra = cp.cod_compra
											WHERE cp.cod_compra = ?');
				$new->bindValue(1, $this->id);
				$new->execute();
				$data = $new->fetchAll(\PDO::FETCH_OBJ);
				echo json_encode($data);
				die();
				
			} catch (\PDOException $e) {
				return $e;
			}

		}

		public function eliminarCompra($id){
			if(preg_match_all("/^[0-9]{1,10}$/", $id) != 1){
				die(json_encode(['error' => 'Id inválida.']));
			}
			$this->id = $id;

			try {
				
				$new = $this->con->prepare('UPDATE compra SET status = 0 WHERE cod_compra = ?');
				$new->bindValue(1, $this->id);
				$new->execute();

				die();

			} catch (\PDOException $e) {
				return $e;
			}

		}


	}


?>