<?php
require_once __DIR__ . '/../controller/userHandler.php';

session_start();
$sessionUser = isset($_SESSION['user']) ? $_SESSION['user'] : "Anonimo";

$userObj = $sessionUser !== "Anonimo" ? User::fetchUser($sessionUser) : null;

?>