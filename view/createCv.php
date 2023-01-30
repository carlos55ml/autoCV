<?php
include_once __DIR__ . '/../modules/getUser.php';

?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = "Crea tu CV";
$mustLogin = true;
include_once __DIR__ . '/../modules/head.php';
?>

<body>
  <div class="container px-lg-5">
    <h1 class="text-center">Crea tu curriculum</h1>
    <form action="/controller/cvHandler.php" method="post">
      <input type="hidden" name="action" value="createCv">

      <h2>Datos Personales</h2>
      <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="John">
      </div>
      <div class="mb-3">
        <label for="surname" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="surname" name="surname" placeholder="Doe">
      </div>

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
      </div>

      <hr>
      <input type="submit" class="w-100 btn btn-lg btn-primary" value="Crear">
    </form>
  </div>

  <script src="/assets/js/createCv.js"></script>
</body>

</html>