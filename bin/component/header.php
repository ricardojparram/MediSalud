<?php 

  namespace component;

  class header{

  public function Header(){

  $header = '
    <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="?url=home" class="logo d-flex align-items-center">
    <img src="assets/img/Logo_Medi.png" alt="">
    <span class="d-none d-lg-block">MediSalud</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">

    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2">'.$_SESSION["nombre"].' '.$_SESSION['apellido'].'</span>
      </a><!-- End Profile Iamge Icon -->


      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6>'.$_SESSION["nombre"].' '.$_SESSION['apellido'].'</h6>
          <span>Diseñador web</span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="?url=perfil">
            <i class="bi bi-person"></i>
            <span>Mi perfil</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="?url=usuario">
            <i class="bi bi-gear"></i>
            <span>Configuraciones de usuarios</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="bi bi-question-circle"></i>
            <span>¿Necesitas ayuda?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="?url=cerrar">
            <i class="bi bi-box-arrow-right"></i>
            <span>Cerrar sesion</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header>
  ';
  
   echo $header;

  }  
}

?>