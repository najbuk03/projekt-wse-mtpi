<?php
require_once "includes/db.php";
require_once "includes/auth.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT password FROM users WHERE login=?");
    $stmt->bind_param("s", $login);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (md5($password) === $user["password"]) {
            $_SESSION["admin"] = true;
            header("Location: admin.php");
            exit;
        }
    }

    $error = "Błędny login lub hasło.";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie | Informator dla wędkarza</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<main class="container">
    <section class="box login-box">
        <h1>Logowanie administratora</h1>

        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post">
            <label>Login</label>
            <input type="text" name="login" required>

            <label>Hasło</label>
            <input type="password" name="password" required>

            <button class="button" type="submit">Zaloguj</button>
        </form>

        <p>
            <a href="index.php">Powrót na stronę główną</a>
        </p>
    </section>
</main>

</body>
</html>