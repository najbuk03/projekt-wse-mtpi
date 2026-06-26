<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$name = $_POST["name"];
$location = $_POST["location"];
$description = $_POST["description"];

$stmt = $conn->prepare(
    "INSERT INTO shops (name, location, description)
     VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $name, $location, $description);
$stmt->execute();

header("Location: admin.php");
exit;
?>