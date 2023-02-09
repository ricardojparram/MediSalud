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

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?= "{$_SESSION['nombre']} {$_SESSION['apellido']}"; ?></h2>
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
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ver Perfil</button>
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
                    <div class="col-lg-9 col-md-8"><?= "{$_SESSION['nombre']} {$_SESSION['apellido']}"; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Puesto de trabajo</div>
                    <div class="col-lg-9 col-md-8"><?= "{$_SESSION['puesto']}"; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Cedula</div>
                    <div class="col-lg-9 col-md-8"><?= "{$_SESSION['cedula']}"; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= "{$_SESSION['correo']}"; ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form>
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Imagen de Perfil</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <input type="file" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></input>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombre Completo</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="<?= "{$_SESSION['nombre']} {$_SESSION['apellido']}"; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Puesto de trabajo</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" id="puesto" value="<?= $_SESSION['puesto']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Cedula</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" class="form-control" id="cedula" value="<?= $_SESSION['cedula']; ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?= $_SESSION['correo']; ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-success" id="guardar">Guardar Cambios</a>
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

                    <div class="text-center">
                      <a type="" class="btn btn-success">Cambiar Contraseña</a>
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

<script src="assets/js/perfil.js"></script>
</html>