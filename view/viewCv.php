<?php
include_once __DIR__ . '/../modules/getUser.php';
$id = isset($_GET['id'])?$_GET['id']:null;
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
include_once __DIR__ . '/../modules/head.php';
?>
<body>
<?php if ($userObj) { ?>
    <span id="isLogged" hidden>true</span>
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
                <li><a class="dropdown-item" href="/view/profile.php">Ver perfil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
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


</body>
</html>