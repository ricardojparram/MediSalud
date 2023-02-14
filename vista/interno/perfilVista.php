<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <?php $VarComp->header(); ?>
    <link rel="stylesheet" href="assets/css/estiloInterno.css">
    <link rel="stylesheet" href="assets/css/perfil.css">
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

  <main id="main" class="main"> 
<div class="pagetitle">
      <h1>Perfil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Perfil</li>
        </ol>
      </nav>
    </div>
  
    <section class="section profile">
      <div class="row">
      <div class="col-xl-4"></div>
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img class="fotoPerfil" src="<?= $_SESSION['fotoPerfil']; ?>" alt="Profile" class="rounded-circle">
              <h2 class="nombreCompleto"> </h2>
              <h3></h3>
            </div>
          </div>

        </div>
        <div class="col-xl-4"></div>

        <div class="col-xl-7">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" id="perfil">Ver Perfil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar Contraseña</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Detalles del Perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nombre Completo</div>
                    <div class="col-lg-9 col-md-8" id="name"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Trabajo</div>
                    <div class="col-lg-9 col-md-8" id="nivel"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Cedula</div>
                    <div class="col-lg-9 col-md-8" id="cedula"></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Correo</div>
                    <div class="col-lg-9 col-md-8" id="email"></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="formEditar" enctype="multipart/form-data">

                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Imagen de Perfil</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="row">
                          <div class="col-lg-5 col-md-4 col-sm-4 col-xs-3">
                            <img class="fotoPerfil" id="imgEditar" src="<?= $_SESSION['fotoPerfil']; ?>" alt="Profile">
                          </div>
                          <div class="col-lg-7 col-md-8 col-sm-8 col-xs-9 row">
                            <div class="col-12 mt-3">

                              <input type="file" name="foto" id="foto" class="form-control " title="Sube tu nueva foto de perfil"></input>

                            </div>

                            <div class="col-12 mt-2">
                              <a href="#" class="btn btn-danger" id="borrarFoto" title="Eliminar foto de perfil">Eliminar <i class="bi bi-trash"></i></a>
                            </div>
                          </div>

                        </div>
                        
                        
                      </div>
                    </div>

                    
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nombre" type="text" class="form-control" id="nameEdit" >
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Apellido</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="apellido" type="text" class="form-control" id="apeEdit" >
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Cedula</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="cedula" type="text" class="form-control" id="cedulaEdit" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="emailEdit" >
                      </div>
                    </div>
                    <p id="error" style="color:#ff0000;text-align: center;"></p>
                    <div class="text-center">
                      <button type="submit" class="btn btn-success" id="enviarDatos">Guardar Cambios</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Actual</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva Contraseña</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Repita Nueva Contraseña</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>
                    <p id="error2" style="color:#ff0000;text-align: center;"></p>
                    <div class="text-center">
                      <button type="submit" class="btn btn-success">Cambiar Contraseña</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        
      </div>
      <div class="col-xl-5">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Otros Usuarios</h5>
              <div class="bd-example">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">
                    <img src="assets/img/messages-1.jpg" alt="Profile" class="imgUser">
                    <p>Maria Hudson</p>
                  </li>
                  <li class="list-group-item">
                    <img src="assets/img/messages-2.jpg" alt="Profile" class="imgUser">
                    <p>Anna Nelson</p>
                  </li>
                  <li class="list-group-item">
                    <img src="assets/img/messages-3.jpg" alt="Profile" class="imgUser">
                    <p>David Muldon</p>
                  </li>
                </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>


</main>
</body>
<?php $VarComp->js(); ?>
<script type="text/javascript" src="assets/js/perfil.js"></script>
</html>