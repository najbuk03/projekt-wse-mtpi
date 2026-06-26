<?php
require_once "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $stmt = $conn->prepare(
        "INSERT INTO contact_messages (name, email, subject, message)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    $stmt->execute();

    header("Location: index.php?section=kontakt&sent=1");
    exit;
}

header("Location: index.php?section=kontakt");
exit;
?>