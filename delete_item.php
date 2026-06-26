<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$type = $_GET["type"] ?? "";
$id = (int)($_GET["id"] ?? 0);

$allowedTables = [
    "lake" => "lakes",
    "fish" => "fish",
    "protection" => "protection_periods",
    "fee" => "fees",
    "shop" => "shops",
    "message" => "contact_messages"
];

if (!array_key_exists($type, $allowedTables)) {
    header("Location: admin.php");
    exit;
}

$table = $allowedTables[$type];

$stmt = $conn->prepare("DELETE FROM $table WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin.php");
exit;
?>