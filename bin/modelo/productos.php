<?php

  namespace modelo;
  use config\connect\DBConnect as DBConnect;


  class productos extends DBConnect{
     
     private $id;
     private $fechaV;
     private $composicionP;
     private $posologia;
     private $laboratorio;
     private $tipoP;
     private $clase;
     private $presentación;
     private $ubicación;
     private $contraIn;
     private $cantidad;
     private $precioV;
     private $descripcion;


     function __construct(){
      parent::__construct();
    }

    public function getRegistraProd($descripcion, $fechaV ,$composicionP,$posologia,$laboratorio,$tipoP,$clase,$presentación,$ubicación,$contraIn,$cantidad,$precioV){
      
     if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $descripcion)){
      return "Error de nombre!";
    }
    if(preg_match_all("/^([0-9]{4}\-[0-9]{2}\-[0-9]{2})$/", $fechaV) !== 1){
      $result = ['resultado' => 'Error fecha', 'error' => 'Error de fecha vencimiento !'];
      echo json_encode($result);
      die();
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $composicionP)){
      return "Error de composicion de productos!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $posologia)){
      return "Error de pasologia!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $laboratorio)){
      return "Error de laboratorio!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $tipoP)){
      return "Error de tipo producto!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $clase)){
      return "Error de clase!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $presentación)){
      return "Error de presentación!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $ubicación)){
      return "Error de ubicación!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $contraIn)){
      return "Error de Contraindicaciones!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $cantidad)){
      return "Error de cantidad!";
    }
    if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $precioV) !== 1){
      return "Error de precio de venta!";
    }

    date_default_timezone_set("america/caracas");
    $time = date("Y-m-d");

    if(strftime($time) > strftime($fechaV)){

    $result = ['resultado' => 'Error de fecha', 'error' => 'La fecha es menor'];
    echo json_encode($result);
    die();
    }

    $this->descripcion = $descripcion;
    $this->composicionP = $composicionP;
    $this->fechaV = $fechaV;
    $this->contraIn = $contraIn;
    $this->ubicación = $ubicación;
    $this->posologia = $posologia;
    $this->cantidad = $cantidad;
    $this->precioV = $precioV;

    $this->laboratorio = $laboratorio;
    $this->tipoP = $tipoP;
    $this->clase = $clase;
    $this->presentación = $presentación; 


    return $this->registraProd();

    }

    private function registraProd(){
     try{

      $new = $this->con->prepare("INSERT INTO `producto`(`cod_producto`, `descripcion`, `composicion`, `contraindicaciones`, `ubicacion`, `posologia`, `stock`, `p_venta`, `vencimiento`, `status`) VALUES (default,?,?,?,?,?,?,?,?,1)");

      $new->bindValue(1, $this->descripcion);
      $new->bindValue(2, $this->composicionP);
      $new->bindValue(3, $this->contraIn);
      $new->bindValue(4, $this->ubicación);
      $new->bindValue(5, $this->posologia);
      $new->bindValue(6, $this->cantidad);
      $new->bindValue(7, $this->precioV);
      $new->bindValue(8, $this->fechaV);
      $new->execute();
      $lastInsertId = $this->con->lastInsertId();

      $new = $this->con->prepare("INSERT INTO `laboratorio_producto`(`cod_producto`, `cod_lab`) VALUES (?,?)");
      $new->bindValue(1, $lastInsertId);
      $new->bindValue(2,  $this->laboratorio);
      $new->execute();

      $new = $this->con->prepare("INSERT INTO `presentacion_producto`(`cod_pres`, `cod_producto`) VALUES (?,?)");
      $new->bindValue(1, $this->presentación);
      $new->bindValue(2, $lastInsertId);
      $new->execute();

      $new = $this->con->prepare("INSERT INTO `tipo_producto`(`cod_tipo`, `cod_producto`) VALUES (?,?)");
      $new->bindValue(1, $this->tipoP);
      $new->bindValue(2, $lastInsertId);
      $new->execute();

      $new = $this->con->prepare("INSERT INTO `clase_producto`(`cod_clase`, `cod_producto`) VALUES (?,?)");
      $new->bindValue(1, $this->clase);
      $new->bindValue(2, $lastInsertId);
      $new->execute();
            
      $result = ['resultado' => 'Registrado'];
      echo json_encode($result);
      die();

    }catch(\PDOexection $error) {
     $error;

    }
  }

   public function MostrarEditProductos($id){
      try{
        $this->id = $id;
        $new = $this->con->prepare("SELECT * FROM producto p INNER JOIN laboratorio_producto lp ON p.cod_producto = lp.cod_producto INNER JOIN presentacion_producto pp ON p.cod_producto = pp.cod_producto INNER JOIN tipo_producto tp ON p.cod_producto = tp.cod_producto INNER JOIN clase_producto cp ON cp.cod_producto = p.cod_producto WHERE p.status = 1 and p.cod_producto = ?");
        $new->bindValue(1, $this->id);
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($data);
        die();
        
      }catch(\PDOexection $error){
        
       return $error;   
     } 
    }


   public function getEditarProd($descripcionEd, $fechaEd ,$composicionEd,$posologiaEd,$laboratorioEd,$tipoEd,$claseEd,$presentaciónEd,$ubicaciónEd,$contraInEd,$cantidadEd,$VentaEd,$id){
 
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $descripcionEd)){
      return "Error de nombre!";
    }
    if(preg_match_all("/^([0-9]{4}\-[0-9]{2}\-[0-9]{2})$/", $fechaEd) !== 1){
      $result = ['resultado' => 'Error fecha', 'error' => 'Error de fecha vencimiento !'];
      echo json_encode($result);
      die();
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $composicionEd)){
      return "Error de composicion de productos!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $posologiaEd)){
      return "Error de pasologia!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $laboratorioEd)){
      return "Error de laboratorio!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $tipoEd)){
      return "Error de tipo producto!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $claseEd)){
      return "Error de clase!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $presentaciónEd)){
      return "Error de presentación!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $ubicaciónEd)){
      return "Error de ubicación!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $contraInEd)){
      return "Error de Contraindicaciones!";
    }
    if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $cantidadEd)){
      return "Error de cantidad!";
    }
    if(preg_match_all("/^([0-9]+\.+[0-9]|[0-9])+$/", $VentaEd) !== 1){
      return "Error de precio de venta!";
    }

   
    $this->id = $id;
    $this->descripcion = $descripcionEd;
    $this->composicionP = $composicionEd;
    $this->fechaV = $fechaEd;
    $this->contraIn = $contraInEd;
    $this->ubicación = $ubicaciónEd;
    $this->posologia = $posologiaEd;
    $this->cantidad = $cantidadEd;
    $this->precioV = $VentaEd;

    $this->laboratorio = $laboratorioEd;
    $this->tipoP = $tipoEd;
    $this->clase = $claseEd;
    $this->presentación = $presentaciónEd; 

    return $this->editarProd();

    }

    private function editarProd(){
      try{

      $new = $this->con->prepare("UPDATE `producto` SET `descripcion`= ? ,`composicion`= ? ,`contraindicaciones`= ?,`ubicacion`= ?,`posologia`= ?,`stock`= ?,`p_venta`= ?,`vencimiento`= ? WHERE cod_producto = ? and status = 1");

      $new->bindValue(1, $this->descripcion);
      $new->bindValue(2, $this->composicionP);
      $new->bindValue(3, $this->contraIn);
      $new->bindValue(4, $this->ubicación);
      $new->bindValue(5, $this->posologia);
      $new->bindValue(6, $this->cantidad);
      $new->bindValue(7, $this->precioV);
      $new->bindValue(8, $this->fechaV);
      $new->bindValue(9, $this->id);
      $new->execute();

      $new = $this->con->prepare("UPDATE `laboratorio_producto` SET `cod_lab`= ? WHERE cod_producto = ?");
      $new->bindValue(1,  $this->laboratorio);
      $new->bindValue(2, $this->id);
      $new->execute();

      $new = $this->con->prepare("UPDATE `presentacion_producto` SET `cod_pres` = ? WHERE `cod_producto` = ?");
      $new->bindValue(1, $this->presentación);
      $new->bindValue(2, $this->id);
      $new->execute();

      $new = $this->con->prepare("UPDATE `tipo_producto` SET `cod_tipo` = ? WHERE `cod_producto` = ?");
      $new->bindValue(1, $this->tipoP);
      $new->bindValue(2, $this->id);
      $new->execute();

      $new = $this->con->prepare("UPDATE `clase_producto` SET `cod_clase` = ? WHERE `cod_producto` = ?");
      $new->bindValue(1, $this->clase);
      $new->bindValue(2, $this->id);
      $new->execute();
      
      $resultado = ['resultado' => 'Editado'];
      echo json_encode($resultado);
      die();

    }catch(\PDOexection $error) {
     $error;

    }
  }

   
   public function getEliminarProd($id){
     try{
      $this->id = $id;
      $new = $this->con->prepare("UPDATE `producto` SET `status`= 0 WHERE cod_producto = ?");
      $new->bindValue(1, $this->id);
      $new->execute();
      $data = $new->fetchAll(\PDO::FETCH_OBJ);
      }
      catch(\PDOexection $error){
      return $error;
      }
    }

    public function MostrarProductos(){
      try{
        $query = "SELECT p.descripcion ,p.stock , p.p_venta, t.des_tipo , p.vencimiento , CONCAT('<button type=\"button\" id=\"', p.cod_producto ,'\"  class=\"btn btn-success editar\" data-bs-toggle=\"modal\" data-bs-target=\"#editModal\"><i class=\"bi bi-pencil\"></i></button>
        <button type=\"button\" id=\"',p.cod_producto,'\" class=\"btn btn-danger borrar\" data-bs-toggle=\"modal\" data-bs-target=\"#delModal\"><i class=\"bi bi-trash3\"></i></button>') as opciones FROM producto p INNER JOIN tipo_producto tp ON  p.cod_producto = tp.cod_producto INNER JOIN tipo t ON tp.cod_tipo = t.cod_tipo WHERE p.status = 1";

        $new = $this->con->prepare($query);
        $new->execute();
        $data = $new->fetchAll();
        echo json_encode($data);
        die();
      }catch(\PDOexection $error){
        
       return $error;   
     } 
    } 


    public function mostrarLaboratorio(){
      try{
        $new = $this->con->prepare("SELECT * FROM laboratorio l WHERE l.status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   
     } 
    }

   
    public function mostrarTipo(){
      try{
        $new = $this->con->prepare("SELECT * FROM tipo t WHERE t.status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   
     } 
    }

    public function mostrarPresentacion(){
      try{
        $new = $this->con->prepare("SELECT * FROM presentacion p WHERE p.status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   
     } 
    }

    public function mostrarClase(){
      try{
        $new = $this->con->prepare("SELECT * FROM clase c WHERE c.status = 1");
        $new->execute();
        $data = $new->fetchAll(\PDO::FETCH_OBJ);
        return $data;

      }catch(\PDOexection $error){

       return $error;   
     } 
    }

  }
?>