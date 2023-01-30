<?php
include_once __DIR__ . '/../modules/getUser.php';
$id = isset($_GET['id'])?$_GET['id']:$userObj[0];
$target = User::fetchUserId($id);
if(is_null($target)) {
  setcookie("errorMessage", "No se ha encontrado el usuario", 0, "/");
  header("Location:/view/error.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = $target['username'] . " - AutoCV";
$mustLogin = false;

include_once __DIR__ . '/../modules/head.php';
?>
<body>

</body>
</html>