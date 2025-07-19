<?php
// pages/admin_panel.php
require 'db.php';

// Ajouter un paramètre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $setting_name = $_POST['setting_name'];
    $setting_value = $_POST['setting_value'];

    $stmt = $pdo->prepare('INSERT INTO admin_settings (setting_name, setting_value) VALUES (?, ?)');
    $stmt->execute([$setting_name, $setting_value]);
}

// Modifier un paramètre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $setting_name = $_POST['setting_name'];
    $setting_value = $_POST['setting_value'];

    $stmt = $pdo->prepare('UPDATE admin_settings SET setting_name = ?, setting_value = ? WHERE id = ?');
    $stmt->execute([$setting_name, $setting_value, $id]);
}

// Supprimer un paramètre
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM admin_settings WHERE id = ?');
    $stmt->execute([$id]);
}

// Récupérer tous les paramètres
$stmt = $pdo->query('SELECT * FROM admin_settings');
$settings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="Admin.css">
</head>
<body>
    <h1>Admin Panel</h1>

    <!-- Formulaire pour ajouter/modifier un paramètre -->
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '' ?>">
        
        <label for="setting_name">Nom du paramètre:</label>
        <input type="text" id="setting_name" name="setting_name" value="<?= isset($_GET['edit']) ? $settings[array_search($_GET['edit'], array_column($settings, 'id'))]['setting_name'] : '' ?>" required>
        
        <label for="setting_value">Valeur du paramètre:</label>
        <input type="text" id="setting_value" name="setting_value" value="<?= isset($_GET['edit']) ? $settings[array_search($_GET['edit'], array_column($settings, 'id'))]['setting_value'] : '' ?>" required>
        
        <button type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'add' ?>">
            <?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?>
        </button>
    </form>

    <!-- Tableau pour afficher les paramètres -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du paramètre</th>
                <th>Valeur du paramètre</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($settings as $setting): ?>
            <tr>
                <td><?= htmlspecialchars($setting['id']) ?></td>
                <td><?= htmlspecialchars($setting['setting_name']) ?></td>
                <td><?= htmlspecialchars($setting['setting_value']) ?></td>
                <td>
                    <a href="?edit=<?= $setting['id'] ?>">Modifier</a>
                    <a href="?delete=<?= $setting['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paramètre ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>