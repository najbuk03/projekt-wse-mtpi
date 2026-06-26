<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$name = $_POST["name"];
$description = $_POST["description"];
$habitat = $_POST["habitat"];

$stmt = $conn->prepare(
    "INSERT INTO fish (name, description, habitat)
     VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $description, $habitat);
$stmt->execute();

header("Location: admin.php");
exit;
?>