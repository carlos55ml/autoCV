<?php
require_once __DIR__ . '/../model/Cv.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['action'])) {
    switch ($_POST['action']) {
      case 'createCv':
        tryCv($_POST);
        break;
      case 'fetchUserCv':
        fetchUserCv($_POST['userId']);
        break;

      default:
        setcookie("errorMessage", "Error Desconocido.", 0, "/");
        header("Location:/view/error.php");
        break;
    }
  }
}

function tryCv($data) {
  unset($data['action']);
  print_r($data);
  $user = $data['userId'];
  unset($data['userId']);
  $content = json_encode($data, JSON_UNESCAPED_UNICODE);
  $currentCv = CV::fetchUserCv($user);
  if ($currentCv) {
    updateCv($content, $currentCv[0]);
  } else {
    createCv($content, $user);
  }
}

function createCv($content, $user) {
  CV::createCv($content, $user);
}

function updateCv($content, $id) {
  CV::updateCv($id, $content);
}

function fetchUserCv($user) {
  $result = CV::fetchUserCv($user);
  echo $result['content'] ?? null;
}
