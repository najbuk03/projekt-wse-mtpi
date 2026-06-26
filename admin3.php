<?php
require_once "includes/db.php";
require_once "includes/auth.php";

requireAdmin();

$lakes = $conn->query("SELECT * FROM lakes ORDER BY name ASC");
$fishList = $conn->query("SELECT * FROM fish ORDER BY name ASC");
$protections = $conn->query("SELECT * FROM protection_periods ORDER BY species ASC");
$fees = $conn->query("SELECT * FROM fees ORDER BY fee_type ASC");
$shops = $conn->query("SELECT * FROM shops ORDER BY name ASC");
$messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
$users = $conn->query("SELECT id, login, created_at FROM users ORDER BY created_at DESC");

$countLakes = $conn->query("SELECT COUNT(*) AS total FROM lakes")->fetch_assoc()["total"];
$countFish = $conn->query("SELECT COUNT(*) AS total FROM fish")->fetch_assoc()["total"];
$countProtections = $conn->query("SELECT COUNT(*) AS total FROM protection_periods")->fetch_assoc()["total"];
$countFees = $conn->query("SELECT COUNT(*) AS total FROM fees")->fetch_assoc()["total"];
$countShops = $conn->query("SELECT COUNT(*) AS total FROM shops")->fetch_assoc()["total"];
$countMessages = $conn->query("SELECT COUNT(*) AS total FROM contact_messages")->fetch_assoc()["total"];
$countUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()["total"];
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administratora | Informator dla wędkarza</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="admin-header">
    <h1>Panel administratora</h1>
    <p>Zarządzanie treścią serwisu „Informator dla wędkarza”</p>

    <nav class="admin-top-nav">
        <a href="index.php">Strona główna</a>
        <a href="logout.php">Wyloguj</a>
    </nav>
</header>

<main class="container">

    <section class="dashboard-grid">

        <article class="dashboard-card">
            <span>Jeziora</span>
            <strong><?= $countLakes ?></strong>
        </article>

        <article class="dashboard-card">
            <span>Ryby</span>
            <strong><?= $countFish ?></strong>
        </article>

        <article class="dashboard-card">
            <span>Ochrona</span>
            <strong><?= $countProtections ?></strong>
        </article>

        <article class="dashboard-card">
            <span>Opłaty</span>
            <strong><?= $countFees ?></strong>
        </article>

        <article class="dashboard-card">
            <span>Sklepy</span>
            <strong><?= $countShops ?></strong>
        </article>

        <article class="dashboard-card">
            <span>Wiadomości</span>
            <strong><?= $countMessages ?></strong>
        </article>

        <article class="dashboard-card">
            <span>Użytkownicy</span>
            <strong><?= $countUsers ?></strong>
        </article>

    </section>

    <section class="admin-tabs">

        <input type="radio" name="tabs" id="tab-lakes" checked>
        <input type="radio" name="tabs" id="tab-fish">
        <input type="radio" name="tabs" id="tab-protection">
        <input type="radio" name="tabs" id="tab-fees">
        <input type="radio" name="tabs" id="tab-shops">
        <input type="radio" name="tabs" id="tab-messages">
        <input type="radio" name="tabs" id="tab-users">

        <div class="tab-labels">
            <label for="tab-lakes">Jeziora</label>
            <label for="tab-fish">Ryby</label>
            <label for="tab-protection">Ochrona</label>
            <label for="tab-fees">Opłaty</label>
            <label for="tab-shops">Sklepy</label>
            <label for="tab-messages">Wiadomości</label>
            <label for="tab-users">Użytkownicy</label>
        </div>

        <section class="tab-content tab-lakes-content">
            <div class="box">
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
            </div>

            <div class="box">
                <h2>Lista jezior</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Region</th>
                            <th>Ryby</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($lake = $lakes->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($lake["name"]) ?></td>
                                <td><?= htmlspecialchars($lake["region"]) ?></td>
                                <td><?= htmlspecialchars($lake["fish"]) ?></td>
                                <td>
                                    <a class="button small" href="edit_item.php?type=lake&id=<?= $lake["id"] ?>">Edytuj</a>
                                    <a class="button danger small"
                                       href="delete_item.php?type=lake&id=<?= $lake["id"] ?>"
                                       onclick="return confirm('Czy na pewno usunąć jezioro?')">
                                        Usuń
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="tab-content tab-fish-content">
            <div class="box">
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
            </div>

            <div class="box">
                <h2>Lista ryb</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Gatunek</th>
                            <th>Środowisko</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($fish = $fishList->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($fish["name"]) ?></td>
                                <td><?= htmlspecialchars($fish["habitat"]) ?></td>
                                <td>
                                    <a class="button small" href="edit_item.php?type=fish&id=<?= $fish["id"] ?>">Edytuj</a>
                                    <a class="button danger small"
                                       href="delete_item.php?type=fish&id=<?= $fish["id"] ?>"
                                       onclick="return confirm('Czy na pewno usunąć rybę?')">
                                        Usuń
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="tab-content tab-protection-content">
            <div class="box">
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
            </div>

            <div class="box">
                <h2>Lista okresów ochronnych</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Gatunek</th>
                            <th>Okres</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($row = $protections->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row["species"]) ?></td>
                                <td><?= htmlspecialchars($row["period"]) ?></td>
                                <td>
                                    <a class="button small" href="edit_item.php?type=protection&id=<?= $row["id"] ?>">Edytuj</a>
                                    <a class="button danger small"
                                       href="delete_item.php?type=protection&id=<?= $row["id"] ?>"
                                       onclick="return confirm('Czy na pewno usunąć okres ochronny?')">
                                        Usuń
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="tab-content tab-fees-content">
            <div class="box">
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
            </div>

            <div class="box">
                <h2>Lista opłat</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rodzaj opłaty</th>
                            <th>Zastosowanie</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($fee = $fees->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($fee["fee_type"]) ?></td>
                                <td><?= htmlspecialchars($fee["usage_example"]) ?></td>
                                <td>
                                    <a class="button small" href="edit_item.php?type=fee&id=<?= $fee["id"] ?>">Edytuj</a>
                                    <a class="button danger small"
                                       href="delete_item.php?type=fee&id=<?= $fee["id"] ?>"
                                       onclick="return confirm('Czy na pewno usunąć opłatę?')">
                                        Usuń
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="tab-content tab-shops-content">
            <div class="box">
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
            </div>

            <div class="box">
                <h2>Lista sklepów</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Lokalizacja</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($shop = $shops->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($shop["name"]) ?></td>
                                <td><?= htmlspecialchars($shop["location"]) ?></td>
                                <td>
                                    <a class="button small" href="edit_item.php?type=shop&id=<?= $shop["id"] ?>">Edytuj</a>
                                    <a class="button danger small"
                                       href="delete_item.php?type=shop&id=<?= $shop["id"] ?>"
                                       onclick="return confirm('Czy na pewno usunąć sklep?')">
                                        Usuń
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="tab-content tab-messages-content">
            <div class="box">
                <h2>Wiadomości kontaktowe</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Imię</th>
                            <th>E-mail</th>
                            <th>Temat</th>
                            <th>Wiadomość</th>
                            <th>Data</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($msg = $messages->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($msg["name"]) ?></td>
                                <td><?= htmlspecialchars($msg["email"]) ?></td>
                                <td><?= htmlspecialchars($msg["subject"]) ?></td>
                                <td><?= nl2br(htmlspecialchars($msg["message"])) ?></td>
                                <td><?= htmlspecialchars($msg["created_at"]) ?></td>
                                <td>
                                    <a class="button danger small"
                                       href="delete_item.php?type=message&id=<?= $msg["id"] ?>"
                                       onclick="return confirm('Czy na pewno usunąć wiadomość?')">
                                        Usuń
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="tab-content tab-users-content">
            <div class="box">
                <h2>Dodaj użytkownika</h2>

                <form method="post" action="add_user.php">
                    <label>Login</label>
                    <input type="text" name="login" required>

                    <label>Hasło</label>
                    <input type="password" name="password" required>

                    <button class="button" type="submit">Dodaj użytkownika</button>
                </form>
            </div>

            <div class="box">
                <h2>Lista użytkowników</h2>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Login</th>
                            <th>Data utworzenia</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while ($user = $users->fetch_assoc()): ?>
                            <tr>
                                <td><?= (int)$user["id"] ?></td>
                                <td><?= htmlspecialchars($user["login"]) ?></td>
                                <td><?= htmlspecialchars($user["created_at"]) ?></td>
                                <td>
                                    <?php if ((int)$user["id"] !== 1): ?>
                                        <a class="button danger small"
                                           href="delete_user.php?id=<?= $user["id"] ?>"
                                           onclick="return confirm('Czy na pewno usunąć użytkownika?')">
                                            Usuń
                                        </a>
                                    <?php else: ?>
                                        <span class="admin-badge">Główny administrator</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </section>

</main>

</body>
</html>