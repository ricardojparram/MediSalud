<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moneda</title>
   <?php $VarComp->header(); ?>
    <link rel="stylesheet" href="assets/css/estiloInterno.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap5.min.css">
</head>
<body>
<!-- ======= Header ======= -->

      <?php 
      
       $header->Header();
                
      ?>
      
<!-- End Header -->


<!-- ======= Sidebar ======= -->

      <?php 
      
        $menu->Menu();
                
      ?>
         
  <!-- End Sidebar-->


 <main class="main" id="main">
    <div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><h1>Gestionar tipo de moneda</h1></li>
        </ol>
      </nav>

    </div>

  <div class="card">
            <div class="card-body">
            
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">Tipos de moneda</h5>
                </div>
                 
                <div class="col-6 text-end mt-3">
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registrarModal">Agregar</button>

                </div>
              </div>
          
         <div class="table-responsive">
          

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th scope="col">tipos de moneda</th>
                      <th scope="col">Alcambio</th>
                      <th scope="col">Opciones</th>
                    </tr>
                  </thead>
                   <tbody>
                     <?php if(isset($mostrar)) {
                      foreach ($mostrar as $col) {
                       ?>
                     <tr>
                      <td><?php echo $col->nombre; ?></td>
                      <td><?php echo $col->cambio; ?></td>
                      <td>
                      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editarModal"><i class="bi bi-pencil"></i></button>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal">
                        <i class="bi bi-trash3"></i>
                      </button></td>
                    </tr>
                     <?php
                        }
                      }
                        ?>

                     
                      
            </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>


  </main>


<!-- Modal Registrar-->
<div class="modal fade" id="registrarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header alert alert-success">
                      <h3 class="modal-title"> <strong>Registrar tipo de moneda</strong> </h3>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
      <div class="modal-body">
       
    
                    <div class="modal-body ">
                    <form class="user" method="POST">
                    <div class="form-group col-md-11">  
                      <div class="container-fluid">
                        <div class="row">

                           <div class="form-group col-lg-4">
                              <label class="col-form-label"> <strong>Tipo de Moneda*</strong> </label>

                          <div class="input-group">
                    
                              <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""><i class="bi bi-currency-exchange"></i></button> 

                              <input id="tipMon" class="form-control" required="" placeholder="Moneda" name="moneda">
                            </div> 
                             <p class="p" id="error_1" style="display: none">Tipo de moneda inválida</p>  
                          </div>
                            <div class="form-group col-lg-7">
                              <label class="col-form-label"> <strong>Alcambio*</strong> </label>

                               <div class="input-group">
                              
                              <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""><i class="bi bi-cash-coin"></i></button>
                              <input id="cambio"class="form-control" required="" placeholder="Alcambio" name="alcambio">
                            </div>
                            <p class="p" id="error_2" style="display: none"> Digito inválida</p>  
                             
                            </div>
                        
                      </div>
                    </div>
                  </div>
                 <p style="color:#ff0000;text-align: center;"><?php echo (isset($respuesta))? $respuesta : " " ?></p>
                  
      <div class="modal-footer">
        
        <button id="boton" type="sumit" class="btn btn-success">Registrar</button>
      </div>

    </div>
  </div>
 </div>
</div>
</div>



<!-- Modal Editar-->

<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
 <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-header alert alert-success">
                      <h3 class="modal-title"> <strong> tipo de moneda</strong> </h3>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
      <div class="modal-body">
       

                    <div class="modal-body ">
                    

                    <div class="form-group col-md-11">  
                      <div class="container-fluid">
                        <div class="row">

                           <div class="form-group col-lg-4">
                              <label class="col-form-label"> <strong>Tipo de Moneda*</strong> </label>

                          <div class="input-group">
                    
                              <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""><i class="bi bi-currency-exchange"></i></button> 

                              <input class="form-control" required="" value="Dolares">
                            </div> 
                            </div>
                            <div class="form-group col-lg-6">
                              <label class="col-form-label"> <strong>Alcambio*</strong> </label>

                               <div class="input-group">
                              
                              <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content=""><i class="bi bi-cash-coin"></i></button>

                              <input class="form-control" required="" Value="9,68">
                            </div>
                        
                      </div>
                    </div>
                  </div>


      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-success">Actualizar</button>
      </div>

    </div>
   </div>
  </div>
 </div>
</div>

<!-- Modal Eliminar-->

<div class="modal fade" id="delModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="staticBackdropLabel">¿Estás seguro?</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Los datos serán eliminados completamente del sistema</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger">Borrar</button>
      </div>
    </div>
  </div>
</div>

  
   <?php $VarComp->js(); ?>   
 <script src="assets/js/moneda.js"></script> 

 <!-- Development version -->
<script src="assets/js/popper.js"></script>

<!-- Production version -->
<script src="assets/js/popper.min.js"></script>

<script type="text/javascript">
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>


</body>

</html>