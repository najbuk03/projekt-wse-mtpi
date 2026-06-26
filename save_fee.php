<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$fee_type = $_POST["fee_type"];
$description = $_POST["description"];
$usage_example = $_POST["usage_example"];

$stmt = $conn->prepare(
    "INSERT INTO fees (fee_type, description, usage_example)
     VALUES (?, ?, ?)"
);

$stmt->bind_param("sss", $fee_type, $description, $usage_example);
$stmt->execute();

header("Location: admin.php");
exit;
?>
