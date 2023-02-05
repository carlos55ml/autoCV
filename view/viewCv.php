<?php
include_once __DIR__ . '/../view/modules/getUser.php';
$id = isset($_GET['id']) ? $_GET['id'] : null;
$target = 0;
if ($id) {
  $target = $id;
} else {
  $target = $userObj[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = "VerCV - AutoCV";
$mustLogin = false;
include_once __DIR__ . '/../view/modules/head.php';
?>
<link rel="stylesheet" href="/view/assets/style/viewCv.css">

<body>
  <?php if ($userObj) { ?>
    <span id="isLogged" hidden>true</span>
    <input type="hidden" name="userId" value="<?php echo $userObj[0] ?>">
  <?php } ?>
  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5" data-bs-theme="dark">
      <a class="navbar-brand" href="/">AutoCV</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" aria-current="page" href="/">Inicio</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $userObj['username'] ?? "Invitado" ?>
            </a>
            <?php if ($userObj) { ?>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/view/createCv.php">Crear/Editar CV</a></li>
                <li><a class="dropdown-item active" href="/view/viewCv.php">Ver CV</a></li>
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
  <!-- END: NAVBAR -->

  <br>
  <div id="selectCv" class="container px-lg-5">
    <form class="row g-3" action="./viewCv.php" method="GET">
      <div class="col-auto">
        <input type="text" readonly class="form-control-plaintext" value="Id de usuario para ver su CV">
      </div>
      <div class="col-auto">
        <input type="text" class="form-control" id="id" name="id">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Buscar</button>
      </div>
    </form>
  </div>

  <div id="cvContent" class="container px-lg-5">
    <br>
    <hr>
    <h2>Informacion Personal</h2>
    <div id="personaInfo">
      <h5>Nombre</h5>
      <span id="name"></span>
      <h5>Apellidos</h5>
      <span id="surname"></span>
      <h5>Fecha de Nacimiento</h5>
      <span id="birthday"></span>
      <h5>Contacto</h5>
      <span id="contact"></span>
    </div>
    <hr>
    <h2>Formaciones</h2>
    <div id="formationInfo">
      <div id="formation-1">
        <h5>Nombre</h5>
        <span id="formationName-1"></span>
        <h5>Centro realizado</h5>
        <span id="formationCenter-1"></span>
        <h5>Periodo</h5>
        <span id="formationPeriod-1"></span>
      </div>
    </div>
    <hr>
    <h2>Experiencia</h2>
    <div id="experienceInfo">
      <div id="experience-1">
        <h5>Puesto</h5>
        <span id="experienceName-1"></span>
        <h5>Empresa</h5>
        <span id="experienceCenter-1"></span>
        <h5>Periodo</h5>
        <span id="experiencePeriod-1"></span>
      </div>
    </div>
    <hr>
    <h2>Otros</h2>
    <div id="otherInfo">
      <div id="other-1">
        <b><span id="otherName-1"></span>: </b><span class="nobold" id="otherDescription-1"></span>
      </div>
    </div>
    <br>
    <br>
  </div>

  <!-- Loading modal -->
  <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-body text-center">
        <div class="spinner-border text-center text-light" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
  </div>
  <!-- END: loading modal -->

  <!-- MODAL ERROR -->
  <div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Error</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>No se ha encontrado CV</p>
        </div>
        <div class="modal-footer">
          <a href="./viewCv.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button></a>
        </div>
      </div>
    </div>
  </div>
  <!-- END: MODAL ERROR -->

  <script src="/view/assets/js/viewCv.js"></script>
</body>

</html>