<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$login = $_POST["login"];
$password = md5($_POST["password"]);

$stmt = $conn->prepare(
    "INSERT INTO users (login, password)
     VALUES (?, ?)"
);

$stmt->bind_param("ss", $login, $password);
$stmt->execute();

header("Location: admin.php");
exit;
?>