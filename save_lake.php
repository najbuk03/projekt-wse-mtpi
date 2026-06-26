<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$name = $_POST["name"];
$region = $_POST["region"];
$description = $_POST["description"];
$fish = $_POST["fish"];

$stmt = $conn->prepare(
    "INSERT INTO lakes (name, region, description, fish)
     VALUES (?, ?, ?, ?)"
);

$stmt->bind_param("ssss", $name, $region, $description, $fish);
$stmt->execute();

header("Location: admin.php");
exit;
?>