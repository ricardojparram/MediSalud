<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentación</title>
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
          <li class="breadcrumb-item"><h1> Presentación del producto</h1></li>
        </ol>
      </nav>

    </div>

  <div class="card">
            <div class="card-body">
            
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">Presentación</h5>
                </div>

                <div class="col-6 text-end mt-3">
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal">Agregar</button>
                </div>
              </div>

              <!-- Modal AGREGAR -->

              <div class="modal fade" id="basicModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-xm">
                  <div class="modal-content">
                    <div class="modal-header alert alert-success">
                      <h4 class="modal-title"> <strong>Registrar Tipo de Presentación del Producto</strong> </h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body ">
                    <form>

                    <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">

                         

                            <div class="form-group col-lg-6">

                              <label class="col-form-label"> <strong>Unidad de medida</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca unidad de medida"><i class="ri-bar-chart-fill"></i></button> 
                              <input class="form-control" required="" placeholder="Unidad de Medida">
                            </div>
                            </div>

                            <div class="form-group col-lg-6">
                              <label class="col-form-label"> <strong>Cantidad*</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca cantidad"><i class="ri-bar-chart-horizontal-fill"></i></button> 
                              <input type="number" class="form-control" required="" placeholder="123">
                            </div>
                            </div>
                        </div>
                      </div>
                    </div>
                     
                     
                      <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">


                            <div class="form-group col-lg-6">
                              <label class="col-form-label"> <strong>Tipo</strong> </label>
                              <select class="form-control" aria-label="Default select example"><option value="" selected="" >Seleccione una opción</option>
                                  <option value="">Comprimido</option>
                                  <option value="">Unidad</option>
                                
                                  
                              </select>
                            </div>

                            <div class="form-group col-lg-6">

                              <label class="col-form-label"> <strong>Peso</strong> </label>
                              <input class="form-control" required="" placeholder="peso">

                            </div>
                        </div>
                      </div>
                    </div>
      

                  </div>


                    

                      
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-success">Registrar</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>

              <!-- Modal Editar -->

              <div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-xm">
                  <div class="modal-content">
                    <div class="modal-header alert alert-success">
                      <h4 class="modal-title"> <strong>Editar Tipo de Presentación del Producto</strong> </h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body ">
                    <form>

                    <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">

                         

                            <div class="form-group col-lg-6">

                              <label class="col-form-label"> <strong>Unidad de medida</strong> </label>
                              <input class="form-control" required="" value="500mg">

                            </div>

                            <div class="form-group col-lg-6">
                              <label class="col-form-label"> <strong>Cantidad*</strong> </label>
                              <input type="number" class="form-control" required="" value="3">

                            </div>
                        </div>
                      </div>
                    </div>
                     
                     
                      <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">


                            <div class="form-group col-lg-6">
                              <label class="col-form-label"> <strong>Tipo</strong> </label>
                              <select class="form-control" aria-label="Default select example"><option value="" selected="" >Seleccione una opción</option>
                                  <option value="">Comprimido</option>
                                  <option value="">Unidad</option>
                                
                                  
                              </select>
                            </div>

                            <div class="form-group col-lg-6">

                              <label class="col-form-label"> <strong>Peso</strong> </label>
                              <input class="form-control" required="" value="10">

                            </div>
                        </div>
                      </div>
                    </div>
      

                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-success">Actualizar</button>
                    </div>
                  </form>
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

         <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th scope="col">Peso</th>
                      <th scope="col">U.Medida</th>
                      <th scope="col">Cant</th>
                      <th scope="col">Tipo</th>
                      <th scope="col">Opciones</th>
                    
                    </tr>
                  </thead>
              
                
              <tbody>
                    <tr>
                      <td>10</td>
                      <td>500mg</td>
                      <td>3</td>
                      <td>Comprimido</td>
                      <td><button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#editModal">
                      <i class="bi bi-pencil"></i>
                      </button>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal">
                        <i class="bi bi-trash3"></i>
                      </button></td>
                    </tr>

                    <tr>
                      <td>10</td>
                      <td>800mg</td>
                      <td>2</td>
                      <td>Comprimido</td>
                      <td><button type="button" class="btn btn-success " >
                      <i class="bi bi-pencil"></i>
                      </button>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal">
                        <i class="bi bi-trash3"></i>
                      </button></td>
                    </tr>

                    <tr>
                      <td>Cetirizina</td>
                      <td>10mg</td>
                      <td>5</td>
                      <td>Comprimido</td>
                      <td><button type="button" class="btn btn-success ">
                      <i class="bi bi-pencil"></i>
                      </button>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModal">
                        <i class="bi bi-trash3"></i>
                      </button></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>


  </main>


</body>

  <?php $VarComp->js(); ?>

 
</html>