<?php
// pages/user_profiles.php
require 'db.php';

// Ajouter un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare('INSERT INTO users (username, email, role) VALUES (?, ?, ?)');
    $stmt->execute([$username, $email, $role]);
}

// Modifier un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?');
    $stmt->execute([$username, $email, $role, $id]);
}

// Supprimer un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$id]);
}

// Récupérer tous les utilisateurs
$stmt = $pdo->query('SELECT * FROM users');
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profiles</title>
    <link rel="stylesheet" href="UserProfil.css">
</head>
<body>
    <h1>User Profiles</h1>

    <!-- Formulaire pour ajouter/modifier un utilisateur -->
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '' ?>">
        
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" value="<?= isset($_GET['edit']) ? $users[array_search($_GET['edit'], array_column($users, 'id'))]['username'] : '' ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= isset($_GET['edit']) ? $users[array_search($_GET['edit'], array_column($users, 'id'))]['email'] : '' ?>" required>
        
        <label for="role">Rôle:</label>
        <input type="text" id="role" name="role" value="<?= isset($_GET['edit']) ? $users[array_search($_GET['edit'], array_column($users, 'id'))]['role'] : '' ?>" required>
        
        <button type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'add' ?>">
            <?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?>
        </button>
    </form>

    <!-- Tableau pour afficher les utilisateurs -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <a href="?edit=<?= $user['id'] ?>">Modifier</a>
                    <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>