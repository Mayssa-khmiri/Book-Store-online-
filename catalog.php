<?php
// pages/bookcatalog.php
require 'db.php';

// Ajouter un livre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare('INSERT INTO bookcatalog (title, author, price) VALUES (?, ?, ?)');
    $stmt->execute([$title, $author, $price]);
}

// Modifier un livre
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    $stmt = $pdo->prepare('UPDATE bookcatalog SET title = ?, author = ?, price = ? WHERE id = ?');
    $stmt->execute([$title, $author, $price, $id]);
}

// Supprimer un livre
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM bookcatalog WHERE id = ?');
    $stmt->execute([$id]);
}

// Récupérer tous les livres
$stmt = $pdo->query('SELECT * FROM bookcatalog');
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalog</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="Catalog.css" />
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Book Catalog</h1>
    
    
    <!-- Formulaire pour ajouter/modifier un livre -->
    <form method="post">
        <input type="hidden" name="id" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '' ?>">
        
        <label for="title">Titre:</label>
        <input type="text" id="title" name="title" value="<?= isset($_GET['edit']) ? $books[array_search($_GET['edit'], array_column($books, 'id'))]['title'] : '' ?>" required>
        
        <label for="author">Auteur:</label>
        <input type="text" id="author" name="author" value="<?= isset($_GET['edit']) ? $books[array_search($_GET['edit'], array_column($books, 'id'))]['author'] : '' ?>" required>
        
        <label for="price">Prix:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?= isset($_GET['edit']) ? $books[array_search($_GET['edit'], array_column($books, 'id'))]['price'] : '' ?>" required>
        
        <button type="submit" name="<?= isset($_GET['edit']) ? 'edit' : 'add' ?>">
            <?= isset($_GET['edit']) ? 'Modifier' : 'Ajouter' ?>
        </button>
    </form>

    <!-- Tableau pour afficher les livres -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr> 
                <td><?= htmlspecialchars($book['id']) ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['author']) ?></td>
                <td><?= htmlspecialchars($book['price']) ?></td>
                <td>
                    <a href="?edit=<?= $book['id'] ?>">Modifier</a>
                    <a href="?delete=<?= $book['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table> <div class="export">
     <a href="exporter_csv.php" class="btn btn-primary" style="margin-left:688px; margin-top:-390px;"  >Exporter CSV</a>
    </div>
</body>
</html>