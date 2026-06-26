<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$type = $_POST["type"] ?? "";
$id = (int)($_POST["id"] ?? 0);

if ($type === "lake") {
    $stmt = $conn->prepare(
        "UPDATE lakes 
         SET name=?, region=?, description=?, fish=?, updated_at=NOW()
         WHERE id=?"
    );

    $stmt->bind_param(
        "ssssi",
        $_POST["name"],
        $_POST["region"],
        $_POST["description"],
        $_POST["fish"],
        $id
    );

    $stmt->execute();
}

if ($type === "fish") {
    $stmt = $conn->prepare(
        "UPDATE fish
         SET name=?, description=?, habitat=?, updated_at=NOW()
         WHERE id=?"
    );

    $stmt->bind_param(
        "sssi",
        $_POST["name"],
        $_POST["description"],
        $_POST["habitat"],
        $id
    );

    $stmt->execute();
}

if ($type === "protection") {
    $stmt = $conn->prepare(
        "UPDATE protection_periods
         SET species=?, period=?, notes=?, updated_at=NOW()
         WHERE id=?"
    );

    $stmt->bind_param(
        "sssi",
        $_POST["species"],
        $_POST["period"],
        $_POST["notes"],
        $id
    );

    $stmt->execute();
}

if ($type === "fee") {
    $stmt = $conn->prepare(
        "UPDATE fees
         SET fee_type=?, description=?, usage_example=?, updated_at=NOW()
         WHERE id=?"
    );

    $stmt->bind_param(
        "sssi",
        $_POST["fee_type"],
        $_POST["description"],
        $_POST["usage_example"],
        $id
    );

    $stmt->execute();
}

if ($type === "shop") {
    $stmt = $conn->prepare(
        "UPDATE shops
         SET name=?, location=?, description=?, updated_at=NOW()
         WHERE id=?"
    );

    $stmt->bind_param(
        "sssi",
        $_POST["name"],
        $_POST["location"],
        $_POST["description"],
        $id
    );

    $stmt->execute();
}

header("Location: admin.php");
exit;
?>