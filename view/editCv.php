<?php
include_once __DIR__ . '/../view/modules/getUser.php';

?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = "Edita tu CV";
$mustLogin = true;
include_once __DIR__ . '/../view/modules/head.php';
?>

<body>
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
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/view/profile.php">Ver perfil</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item active" href="/view/createCv.php">Crear/Editar CV</a></li>
              <li><a class="dropdown-item" href="/view/viewCv.php">Ver CV</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="/controller/userHandler.php?action=logout">Cerrar sesion</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END: NAVBAR -->
  <div class="container px-lg-5">
    <h1 class="text-center">Edita tu curriculum</h1>
    <form action="/controller/cvHandler.php" method="post">
      <input type="hidden" name="action" value="createCv">
      <input type="hidden" name="userId" value="<?php echo $userObj[0] ?>">
      <input type="hidden" name="formations" value="1">
      <input type="hidden" name="experiences" value="1">
      <input type="hidden" name="others" value="1">

      <h2>Datos Personales</h2>
      <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="John">
      </div>
      <div class="mb-3">
        <label for="surname" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="surname" name="surname" placeholder="Doe">
      </div>
      <div class="mb-3">
        <label for="birthday" class="form-label">Fecha de nacimiento</label>
        <input type="date" class="form-control" id="birthday" name="birthday">
      </div>
      <div class="mb-3">
        <label for="contact" class="form-label">Contacto</label>
        <input type="text" class="form-control" id="contact" name="contact" placeholder="611200545">
      </div>
      <hr>
      <h2>Formacion</h2>
      <div class="mb-3" id="formations">
        <div id="formation-1">
          <label for="formationName-1" class="form-label">Titulo</label>
          <input type="text" class="form-control" id="formationName-1" name="formationName-1" placeholder="Primaria">
          <label for="formationCenter-1" class="form-label">Centro o Universidad</label>
          <input type="text" class="form-control" id="formationCenter-1" name="formationCenter-1" placeholder="IES San Idelfonso">
          <label for="formationPeriod-1" class="form-label">Periodo</label>
          <input type="text" class="form-control" id="formationPeriod-1" name="formationPeriod-1" placeholder="Sep 2010 - Jul 2016">
        </div>

        <br>
        <button type="button" id="addFormation" class="btn btn-secondary">Añadir otra formacion</button>
        <button type="button" id="removeFormation" class="btn btn-secondary">Borrar Ultima</button>
      </div>

      <hr>
      <h2>Experiencia profesional</h2>
      <div class="mb-3" id="experiences">
        <div id="experience-1">
          <label for="experienceName-1" class="form-label">Puesto</label>
          <input type="text" class="form-control" id="experienceName-1" name="experienceName-1" placeholder="Tecnico">
          <label for="experienceCenter-1" class="form-label">Empresa</label>
          <input type="text" class="form-control" id="experienceCenter-1" name="experienceCenter-1" placeholder="Coca Cola SA">
          <label for="experiencePeriod-1" class="form-label">Periodo</label>
          <input type="text" class="form-control" id="experiencePeriod-1" name="experiencePeriod-1" placeholder="Sep 2010 - Jul 2016">
        </div>

        <br>
        <button type="button" id="addExperience" class="btn btn-secondary">Añadir otro puesto</button>
        <button type="button" id="removeExperience" class="btn btn-secondary">Borrar Ultimo</button>
      </div>

      <hr>
      <h2>Otros</h2>
      <div class="mb-3" id="others">
        <div id="other-1">
          <label for="otherName-1" class="form-label">Titulo</label>
          <input type="text" class="form-control" id="otherName-1" name="otherName-1" placeholder="Ingles">
          <label for="otherDescription-1" class="form-label">Descripcion</label>
          <input type="text" class="form-control" id="otherDescription-1" name="otherDescription-1" placeholder="Nivel Alto">
        </div>
        <br>
        <button type="button" id="addOther" class="btn btn-secondary">Añadir otro</button>
        <button type="button" id="removeOther" class="btn btn-secondary">Borrar Ultimo</button>
      </div>

      <hr>
      <input type="submit" class="w-100 btn btn-lg btn-primary" value="Crear">
      <br>
      <br>
      <button type="button" id="deleteCv" class="w-100 btn btn-lg btn-danger">Eliminar</button>
    </form>
  </div>
  <br>
  <br>


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

  <!-- MODAL CONFIRMACION BORRAR -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Borrar tu CV</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Seguro que quieres borrar tu CV? Toda la informacion relacionada sera eliminada. <b>Esta accion no se puede deshacer.</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="confirmDeleteCv" class="btn btn-danger">Borrar</button>
      </div>
    </div>
  </div>
</div>
<!-- END: MODAL CONFIRMACION BORRAR -->


  <script src="/view/assets/js/editCv.js"></script>
</body>

</html>