<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$species = $_POST["species"];
$period = $_POST["period"];
$notes = $_POST["notes"];

$stmt = $conn->prepare(
    "INSERT INTO protection_periods (species, period, notes)
     VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $species, $period, $notes);
$stmt->execute();

header("Location: admin.php");
exit;
?>