<?php
// pages/order_processing.php
require 'db.php';

// Ajouter une commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $order_number = $_POST['order_number'];
    $customer_name = $_POST['customer_name'];
    $total_amount = $_POST['total_amount'];

    $stmt = $pdo->prepare('INSERT INTO orders (order_number, customer_name, total_amount) VALUES (?, ?, ?)');
    $stmt->execute([$order_number, $customer_name, $total_amount]);
}

// Modifier une commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $order_number = $_POST['order_number'];
    $customer_name = $_POST['customer_name'];
    $total_amount = $_POST['total_amount'];

    $stmt = $pdo->prepare('UPDATE orders SET order_number = ?, customer_name = ?, total_amount = ? WHERE id = ?');
    $stmt->execute([$order_number, $customer_name, $total_amount, $id]);
}

// Supprimer une commande
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM orders WHERE id = ?');
    $stmt->execute([$id]);
}

// Récupérer toutes les commandes
$stmt = $pdo->query('SELECT * FROM orders');
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Processing</title>
    <link rel="stylesheet" href="Orders.css">
</head>
<body>
    <h1>Order Processing</h1>

    <!-- Formulaire pour ajouter/modifier une commande -->
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '' ?>">
        
        <label for="order_number">Numéro de commande:</label>
        <input type="text" id="order_number" name="order_number" value="<?= isset($_GET['edit']) ? $orders[array_search($_GET['edit'], array_column($orders, 'id'))]['order_number'] : '' ?>" required>
        
        <label for="customer_name">Nom du client:</label>
        <input type="text" id="customer_name" name="customer_name" value="<?= isset($_GET['edit']) ? $orders[array_search($_GET['edit'], array_column($orders, 'id'))]['customer_name'] : '' ?>" required>
        
        <label for="total_amount">Montant total:</label>
        <input type="number" id="total_amount" name="total_amount" step="0.01" value="<?= isset($_GET['edit']) ? $orders[array_search($_GET['edit'], array_column($orders, 'id'))]['total_amount'] : '' ?>" required>
        
        <button type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'add' ?>">
            <?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?>
        </button>
    </form>

    <!-- Tableau pour afficher les commandes -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Numéro de commande</th>
                <th>Nom du client</th>
                <th>Montant total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['id']) ?></td>
                <td><?= htmlspecialchars($order['order_number']) ?></td>
                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                <td><?= htmlspecialchars($order['total_amount']) ?></td>
                <td>
                    <a href="?edit=<?= $order['id'] ?>">Modifier</a>
                    <a href="?delete=<?= $order['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>