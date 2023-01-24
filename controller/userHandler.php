<?php
require_once __DIR__ . '/../model/DB.php';


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


/**
 * Fetch an specific user from DB
 * @param string $user The user to find
 * @return mixed The user Object, or null if no match.
 */
function fetchUser(string $user) {
  $query = 'SELECT * FROM users WHERE username = ?';
  $values = array($user);
  $result = DB::preparedQuery($query, $values);
  return empty($result[0]) ? null : $result[0];
}

function logOut() {
  session_start();
  $_SESSION['user'] = null;
  session_destroy();
  header("Location:/");
}

function tryUserLogin(string $user, string $pass) {
  $userObj = fetchUser($user);
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
  if (fetchUser($username)) {
    setcookie("errorMessage", "El usuario ya existe.", 0, "/");
    header("Location:/view/error.php");
  } else {
    $queryString =
      "INSERT INTO users(username, passwd) VALUES (?, ?)";
    $queryValues = array($username, $passwd);
    DB::preparedQuery($queryString, $queryValues);
    initSession($username, $passwd);
  }
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
