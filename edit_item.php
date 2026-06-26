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
    "shop" => "shops"
];

if (!array_key_exists($type, $allowedTables)) {
    header("Location: admin.php");
    exit;
}

$table = $allowedTables[$type];

$stmt = $conn->prepare("SELECT * FROM $table WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$item = $result->fetch_assoc();

if (!$item) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edycja wpisu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="admin-header">
    <h1>Edycja wpisu</h1>
    <a href="admin.php">Powrót do panelu</a>
    <a href="index.php">Strona główna</a>
</header>

<main class="container">
    <section class="box">

        <form method="post" action="update_item.php">
            <input type="hidden" name="type" value="<?= htmlspecialchars($type) ?>">
            <input type="hidden" name="id" value="<?= (int)$id ?>">

            <?php if ($type === "lake"): ?>

                <label>Nazwa jeziora</label>
                <input type="text" name="name" value="<?= htmlspecialchars($item["name"]) ?>" required>

                <label>Region</label>
                <input type="text" name="region" value="<?= htmlspecialchars($item["region"]) ?>" required>

                <label>Opis</label>
                <textarea name="description" required><?= htmlspecialchars($item["description"]) ?></textarea>

                <label>Ryby</label>
                <input type="text" name="fish" value="<?= htmlspecialchars($item["fish"]) ?>" required>

            <?php elseif ($type === "fish"): ?>

                <label>Gatunek</label>
                <input type="text" name="name" value="<?= htmlspecialchars($item["name"]) ?>" required>

                <label>Opis</label>
                <textarea name="description" required><?= htmlspecialchars($item["description"]) ?></textarea>

                <label>Typowe środowisko</label>
                <input type="text" name="habitat" value="<?= htmlspecialchars($item["habitat"]) ?>" required>

            <?php elseif ($type === "protection"): ?>

                <label>Gatunek</label>
                <input type="text" name="species" value="<?= htmlspecialchars($item["species"]) ?>" required>

                <label>Okres ochronny</label>
                <input type="text" name="period" value="<?= htmlspecialchars($item["period"]) ?>" required>

                <label>Uwagi</label>
                <textarea name="notes" required><?= htmlspecialchars($item["notes"]) ?></textarea>

            <?php elseif ($type === "fee"): ?>

                <label>Rodzaj opłaty</label>
                <input type="text" name="fee_type" value="<?= htmlspecialchars($item["fee_type"]) ?>" required>

                <label>Opis</label>
                <textarea name="description" required><?= htmlspecialchars($item["description"]) ?></textarea>

                <label>Przykładowe zastosowanie</label>
                <input type="text" name="usage_example" value="<?= htmlspecialchars($item["usage_example"]) ?>" required>

            <?php elseif ($type === "shop"): ?>

                <label>Nazwa sklepu</label>
                <input type="text" name="name" value="<?= htmlspecialchars($item["name"]) ?>" required>

                <label>Lokalizacja</label>
                <input type="text" name="location" value="<?= htmlspecialchars($item["location"]) ?>" required>

                <label>Opis</label>
                <textarea name="description" required><?= htmlspecialchars($item["description"]) ?></textarea>

            <?php endif; ?>

            <button class="button" type="submit">Zapisz zmiany</button>
        </form>

    </section>
</main>

</body>
</html>