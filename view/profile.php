<?php
include_once __DIR__ . '/../view/modules/getUser.php';
$id = isset($_GET['id']) ? $_GET['id'] : $userObj[0];
if (is_null($id)) {
  setcookie("errorMessage", "Error Inesperado.", 0, "/");
  header("Location:/view/error.php");
} else {
  $target = User::fetchUserId($id);
  if (is_null($target)) {
    setcookie("errorMessage", "No se ha encontrado al usuario.", 0, "/");
    header("Location:/view/error.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = $target['username'] . " - AutoCV";
$mustLogin = false;

include_once __DIR__ . '/../view/modules/head.php';
?>

<body>

</body>

</html>