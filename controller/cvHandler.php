<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action'])) {
    switch ($_POST['action']) {
      case 'createCv':
        createCv($_POST);
        break;
      default:
        setcookie("errorMessage", "Error Desconocido.", 0, "/");
        header("Location:/view/error.php");
        break;
    }
  }
}

function createCv($data) {
  unset($data['action']);
  print_r($data);
}
?>