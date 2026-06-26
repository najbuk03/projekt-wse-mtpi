<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="admin-header">
    <h1>Panel administratora</h1>
    <a href="index.php">Strona główna</a>
    <a href="logout.php">Wyloguj</a>
</header>

<main class="container admin-grid">

    <section class="box">
        <h2>Dodaj jezioro</h2>
        <form method="post" action="save_lake.php">
            <label>Nazwa jeziora</label>
            <input type="text" name="name" required>

            <label>Region</label>
            <input type="text" name="region" required>

            <label>Opis</label>
            <textarea name="description" required></textarea>

            <label>Ryby</label>
            <input type="text" name="fish" required>

            <button class="button" type="submit">Dodaj jezioro</button>
        </form>
    </section>

    <section class="box">
        <h2>Dodaj rybę</h2>
        <form method="post" action="save_fish.php">
            <label>Gatunek</label>
            <input type="text" name="name" required>

            <label>Opis</label>
            <textarea name="description" required></textarea>

            <label>Typowe środowisko</label>
            <input type="text" name="habitat" required>

            <button class="button" type="submit">Dodaj rybę</button>
        </form>
    </section>

    <section class="box">
        <h2>Dodaj okres ochronny</h2>
        <form method="post" action="save_protection.php">
            <label>Gatunek</label>
            <input type="text" name="species" required>

            <label>Okres ochronny</label>
            <input type="text" name="period" required>

            <label>Uwagi</label>
            <textarea name="notes" required></textarea>

            <button class="button" type="submit">Dodaj okres</button>
        </form>
    </section>

    <section class="box">
        <h2>Dodaj opłatę</h2>
        <form method="post" action="save_fee.php">
            <label>Rodzaj opłaty</label>
            <input type="text" name="fee_type" required>

            <label>Opis</label>
            <textarea name="description" required></textarea>

            <label>Przykładowe zastosowanie</label>
            <input type="text" name="usage_example" required>

            <button class="button" type="submit">Dodaj opłatę</button>
        </form>
    </section>

    <section class="box">
        <h2>Dodaj sklep</h2>
        <form method="post" action="save_shop.php">
            <label>Nazwa sklepu</label>
            <input type="text" name="name" required>

            <label>Lokalizacja</label>
            <input type="text" name="location" required>

            <label>Opis</label>
            <textarea name="description" required></textarea>

            <button class="button" type="submit">Dodaj sklep</button>
        </form>
    </section>

    <section class="box">
        <h2>Dodaj użytkownika</h2>
        <form method="post" action="add_user.php">
            <label>Login</label>
            <input type="text" name="login" required>

            <label>Hasło</label>
            <input type="password" name="password" required>

            <button class="button" type="submit">Dodaj użytkownika</button>
        </form>
    </section>

</main>

<main class="container">
    <section class="box">
        <h2>Wiadomości kontaktowe</h2>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Imię</th>
                    <th>E-mail</th>
                    <th>Temat</th>
                    <th>Wiadomość</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
                while ($msg = $messages->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($msg["name"]) ?></td>
                        <td><?= htmlspecialchars($msg["email"]) ?></td>
                        <td><?= htmlspecialchars($msg["subject"]) ?></td>
                        <td><?= nl2br(htmlspecialchars($msg["message"])) ?></td>
                        <td><?= htmlspecialchars($msg["created_at"]) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>
</main>

</body>
</html>