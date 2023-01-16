<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Droguería</title>
   <?php  $VarComp->header(); ?>
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
          <li class="breadcrumb-item"><h1> Gestionar Droguería</h1></li>
        </ol>
      </nav>

    </div>
    
  <div class="card">
            <div class="card-body">
            
              <div class="row">
                <div class="col-6">
                  <h5 class="card-title">Droguerías</h5>
                </div>

                <div class="col-6 text-end mt-3">
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Agregar">Agregar</button>
                </div>
              </div>


              <!-- COMIENZO DE TABLA -->
         <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th scope="col">Rif</th>
                      <th scope="col">Razón Social</th>
                      <th scope="col">Dirección</th>
                      <th scope="col">Teléfono</th>
                      <th scope="col">Contacto</th>
                      <th scope="col">Opciones</th>
                    
                    </tr>
                  </thead>
              
                
              <tbody>
                <?php if(isset($datos)){ $count= 0; foreach($datos as $col){?>
                    <tr>
                      <td><?php echo $col->rif; ?></td>
                      <td><?php echo $col->direccion; ?></td>
                      <td><?php echo $col->razon_social; ?></td>
                      <td><select><option value="<?php echo $col->telefono; ?>"><?php echo $col->telefono; ?></option></select></td>
                      <td><select><option value="<?php echo $col->contacto; ?>"><?php echo $col->contacto; ?></select></td>
                      <td><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Editar">
                      <i class="bi bi-pencil"></i>
                      </button>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Borrar">
                        <i class="bi bi-trash3"></i>
                      </button></td>
                    </tr>
                <?php } }else{ echo " "; } ?>
                    
                  </tbody>
                </table>
              </div>
              <!-- FINAL DE TABLA -->

            </div>
          </div>

          <!-- TODOS LOS MODAL -->

          <!-- MODAL AGREGAR -->
              <div class="modal fade" id="Agregar" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header alert alert-success">
                      <h4 class="modal-title"> <strong>Registrar Droguería</strong> </h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body ">

                    <form method="POST">

                    <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">

                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>RIF</strong> </label>
                            <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el RIF de la drogueria"><i class="ri-file-3-fill"></i></button> 
                              <input class="form-control" name="rif" id="rif" required="" placeholder="">
                            </div>
                            <p id="error_1" class="errores" style="display: none;">Rif Inválido</p> 
                            </div>
                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>Razón Social</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la razón social de la drogueria"><i class="ri-account-pin-circle-fill"></i></button> 
                                <input class="form-control" name="razon" id="razon" placeholder="">
                              </div>
                              <p id="error_2" class="errores" style="display: none;">Nombre inválido</p> 
                            </div>

                            
                        </div>
                      </div>
                    </div>

                     <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">

                            <div class="form-group col-12">                          
                            <label class="col-form-label"> <strong>Dirección</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la direccion de la drogueria"><i class="ri-map-pin-user-fill"></i></button> 
                                <input class="form-control" name="direccion" id="direccion" required="" placeholder="">
                              </div>
                              <p id="error_4" class="errores" style="display: none;">Dirección inválida</p> 
                            </div>

                           

                        </div>
                      </div>
                    </div>
                     
                      <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">

                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>Teléfono</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el número telefónico de la drogueria"><i class="bi bi-telephone-inbound-fill"></i></button> 
                                <input class="form-control" name="telefono" id="telefono" required="" placeholder="">
                              </div>
                              <p id="error_3" class="errores" style="display: none;">Teléfono inválido</p> 
                            </div>

                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>Contacto</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca otro tipo de contacto del Laboratorio"><i class="ri-account-box-fill"></i></button> 
                                <input class="form-control" name="contacto"  id="contacto" placeholder="(opcional)">
                              </div>
                              
                            </div>

                        </div>
                      </div>
                    </div>

                  </div>

                    <p style="color:#ff0000;text-align: center;" id="error"><?php echo (isset($respuesta)) ? $respuesta : " "; ?></p>
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-success" id="enviar">Registrar</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <!-- MODAL AGREGAR FINAL -->


              <!-- MODAL EDITAR -->
              <div class="modal fade" id="Editar" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header alert alert-success">
                      <h4 class="modal-title"> <strong>Editar Droguería</strong> </h4>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body ">

                    <form method="POST">

                    <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">

                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>RIF</strong> </label>
                            <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el RIF del Laboratorio"><i class="bi bi-key-fill"></i></button> 
                              <input class="form-control" name="rif" disabled="" placeholder="">
                            </div>
                            </div>

                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>Razón Social</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la razón social del Laboratorio"><i class="bi bi-key-fill"></i></button> 
                                <input class="form-control" name="razon"  placeholder="">
                              </div>
                            </div>



                        </div>
                      </div>
                    </div>

                     <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">

                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>Dirección</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca la direccion del Laboratorio"><i class="bi bi-key-fill"></i></button> 
                                <input class="form-control" name="direccion" required="" placeholder="">
                              </div>
                            </div>

                            
                        </div>
                      </div>
                    </div>
                     
                      <div class="form-group col-md-12">  
                      <div class="container-fluid">
                        <div class="row">

                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>Teléfono</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca el número telefónico del Laboratorio"><i class="bi bi-key-fill"></i></button> 
                                <input class="form-control" name="telefono" required="" placeholder="">
                              </div>
                            </div>

                            <div class="form-group col-6">                          
                            <label class="col-form-label"> <strong>Contacto</strong> </label>
                              <div class="input-group">
                                <button type="button" class="iconos btn btn-secondary" data-bs-trigger="hover focus"data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Introduzca otro tipo de contacto del Laboratorio"><i class="bi bi-key-fill"></i></button> 
                                <input class="form-control" name="contacto"  placeholder="">
                              </div>
                            </div>

                        </div>
                      </div>
                    </div>

                  </div>

                    <p style="color:#ff0000;text-align: center;"><?php echo (isset($respuesta)) ? $respuesta : " "; ?></p>
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                      <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                  </form>
                  </div>
                </div>
              </div>
              <!-- MODAL EDITAR FINAL --> 

              <!-- MODAL BORRAR -->
              <div class="modal fade" id="Borrar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" style="display: none; ">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Advertencia</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ¿Desea borar los datos de la droguería?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-danger">Borrar</button>
                    </div>
                  </div> 
                </div>
              </div>
              <!-- MODAL BORRAR FINAL-->

  </main>


</body>

  <?php $VarComp->js();?>
  <script src="assets/js/drogueria.js"></script> 

 
</html>