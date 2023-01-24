<!DOCTYPE html>
<html lang="en">
<?php
$title = "Registrate";
$mustLogin = false;
include_once __DIR__ . '/modules/head.php';

?>
<link rel="stylesheet" href="/assets/style/register.css">
<body>
<main class="form-signin w-100 m-auto">
  <!-- // TODO cambiar acorde MVC -->
  <form action="/controller/userHandler.php" method="post" id="loginForm">
    <input type="hidden" name="action" value="register">
    <h1 class="h3 mb-3 fw-normal">Registrate</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="userInput" name="userInput" placeholder="Username" required>
      <label for="userInput">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="passwordInput" name="passwordInput" placeholder="Password" required>
      <label for="passwordInput">Contraseña</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="passwordInputRep" name="passwordInput" placeholder="Password" required>
      <label for="passwordInput">Repite la Contraseña</label>
    </div>
    <p class="error-info" id="errorInfo"></p>
    <button class="w-100 btn btn-lg btn-primary disabled" type="submit">Registrate</button>
    <br>
    <br>
    <p class="text-muted">Ya tienes cuenta? <a href="/login.php">Inicia Sesion aqui</a>.</p>
    <p class="mt-5 mb-3 text-muted">&copy; Carlos Moran 2023</p>
  </form>
</main>

<script src="/assets/js/register.js"></script>

</body>
</html>