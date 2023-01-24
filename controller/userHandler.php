<?php
require_once __DIR__  . '/../model/User.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action'])) {
    switch ($_POST['action']) {
      case 'login':
        initSession($_POST['userInput'], hash('sha256', $_POST['passwordInput']));
        break;
      case 'register':
        registerUser($_POST);
        break;
      default:
        setcookie("errorMessage", "Error Desconocido.", 0, "/");
        header("Location:/view/error.php");
        break;
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (isset($_GET['action'])) {
    switch ($_GET['action']) {
      case 'logout':
        logOut();
        break;
      default:
        setcookie("errorMessage", "Error Desconocido.", 0, "/");
        header("Location:/view/error.php");
        break;
    }
  }
}


function logOut() {
  session_start();
  $_SESSION['user'] = null;
  session_destroy();
  header("Location:/");
}

function tryUserLogin(string $user, string $pass) {
  $userObj = User::fetchUser($user);
  if (!$userObj) {
    return "'$user' NO EXISTE";
  }
  if ($pass !== $userObj['passwd']) {
    return "CONTRASENA INCORRECTA";
  }

  return true;
}

function registerUser($data) {
  $username = $data['userInput'];
  $passwd = hash('sha256', $data['passwordInput']);
  if (User::fetchUser($username)) {
    setcookie("errorMessage", "El usuario ya existe.", 0, "/");
    header("Location:/view/error.php");
    return;
  }

  User::registerNewUser($username, $passwd);

}


function initSession(string $username, string $passwd) {
  $result = tryUserLogin($username, $passwd);
  if ($result === true) {
    session_start();
    $_SESSION['user'] = $username;
    header("Location:/");
  } else {
    setcookie("errorMessage", $result, 0, "/");
    header("Location:/view/error.php");
  }
}
