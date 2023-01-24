<!DOCTYPE html>
<html lang="en">
<?php
$title = "Inicio";
$mustLogin = false;

include_once __DIR__ . '/modules/head.php';
?>
<link rel="stylesheet" href="/assets/style/index.css">

<body>
  <?php if ($userObj) { ?>
    <span id="isLogged" hidden>true</span>
  <?php } ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5" data-bs-theme="dark">
      <a class="navbar-brand" href="/">AutoCV</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Inicio</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $userObj['username'] ?? "Invitado" ?>
            </a>
            <?php if($userObj) { ?>
              <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Ver perfil</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="/controller/userHandler.php?action=logout">Cerrar sesion</a></li>
            </ul>
          </li>
          <?php } else { ?>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/login.php">Iniciar Sesion</a></li>
              <li><a class="dropdown-item" href="/register.php">Registrate</a></li>
            </ul>
            <?php } ?>

        </ul>
      </div>
    </div>
  </nav>
  <!-- Header-->
  <header class="py-5">
    <div class="container px-lg-5">
      <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
        <div class="m-4 m-lg-5">
          <h1 class="display-5 fw-bold">AutoCV</h1>
          <p class="fs-4">Crea tu Curriculum Vitae automaticamente.</p>
        </div>
      </div>
    </div>
  </header>
  <!-- Page Content-->
  <section class="pt-4">
    <div class="container px-lg-5">
      <!-- Page Features-->
      <div class="row gx-lg-5">
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-light border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
              <h2 class="fs-4 fw-bold">Diseño dinamico</h2>
              <p class="mb-0">Elige los elementos que quieres mostrar y vea una vista previa del resultado</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-light border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-cloud-download"></i></div>
              <h2 class="fs-4 fw-bold">Gratuito</h2>
              <p class="mb-0">Nuestras funciones estan disponibles para todos los usuarios.</p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xxl-4 mb-5">
          <div class="card bg-light border-0 h-100">
            <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
              <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-card-heading"></i></div>
              <h2 class="fs-4 fw-bold">Todas las funcionalidades</h2>
              <p class="mb-0">Separa el contenido por categorias y elementos, para ordenarlo a tu gusto.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer-->
  <footer class="py-5 bg-dark fixed-bottom">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; AutoCV - Carlos Moran 2023</p>
    </div>
  </footer>

  <!-- MODAL BIENVENIDA -->
  <div class="modal fade " id="welcomeModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crea tu CV</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Quieres crear tu propio CV? Registrate o inicia sesion.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary"><a class="no-decors" href="/login.php">Inicia sesion</a></button>
          <button type="button" class="btn btn-info"><a class="no-decors color-black" href="/register.php">Registrate</a></button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN MODAL BIENVENIDA -->

  <script src="/assets/js/index.js"></script>

</body>

</html>