<?php
// pages/shopping_cart.php
require 'db.php';

// Ajouter un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare('INSERT INTO shopping_cart (product_name, quantity, price) VALUES (?, ?, ?)');
    $stmt->execute([$product_name, $quantity, $price]);
}

// Modifier un produit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare('UPDATE shopping_cart SET product_name = ?, quantity = ?, price = ? WHERE id = ?');
    $stmt->execute([$product_name, $quantity, $price, $id]);
}

// Supprimer un produit
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM shopping_cart WHERE id = ?');
    $stmt->execute([$id]);
}

// Récupérer tous les produits
$stmt = $pdo->query('SELECT * FROM shopping_cart');
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="Shopping.css">
</head>
<body>
    <h1>Shopping Cart</h1>

    <!-- Formulaire pour ajouter/modifier un produit -->
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '' ?>">
        
        <label for="product_name">Nom du produit:</label>
        <input type="text" id="product_name" name="product_name" value="<?= isset($_GET['edit']) ? $products[array_search($_GET['edit'], array_column($products, 'id'))]['product_name'] : '' ?>" required>
        
        <label for="quantity">Quantité:</label>
        <input type="number" id="quantity" name="quantity" value="<?= isset($_GET['edit']) ? $products[array_search($_GET['edit'], array_column($products, 'id'))]['quantity'] : '' ?>" required>
        
        <label for="price">Prix:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?= isset($_GET['edit']) ? $products[array_search($_GET['edit'], array_column($products, 'id'))]['price'] : '' ?>" required>
        
        <button type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'add' ?>">
            <?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?>
        </button>
    </form>

    <!-- Tableau pour afficher les produits -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du produit</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['id']) ?></td>
                <td><?= htmlspecialchars($product['product_name']) ?></td>
                <td><?= htmlspecialchars($product['quantity']) ?></td>
                <td><?= htmlspecialchars($product['price']) ?></td>
                <td>
                    <a href="?edit=<?= $product['id'] ?>">Modifier</a>
                    <a href="?delete=<?= $product['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>