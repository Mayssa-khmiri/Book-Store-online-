<?php
require 'db.php';

try {
    // Vérifier si la connexion à la base de données est établie
    if (!$pdo) {
        throw new Exception("Erreur de connexion à la base de données.");
    }

    // Récupérer les données des produits avec une jointure
    $query = "SELECT bookcatalog.*, shopping_cart.price as 'shopping_cart_price' 
              FROM bookcatalog 
              INNER JOIN shopping_cart ON bookcatalog.id = shopping_cart.id";
    $stmt = $pdo->query($query);

    // Vérifier si des produits ont été trouvés
    if ($stmt === false) {
        throw new Exception("Erreur lors de l'exécution de la requête SQL.");
    }

    $categories = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (count($categories) > 0) {
        // Définir les entêtes HTTP pour télécharger un fichier CSV
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="catalog.csv"');

        // Ouvrir un fichier en mémoire pour l'écriture
        $output = fopen('php://output', 'w');

        // Écrire les en-têtes du CSV
        fputcsv($output, ['ID', 'Titre', 'Auteur', 'Prix']);

        // Écrire les données des produits dans le fichier CSV
        foreach ($categories as $bookcatalog) {
            fputcsv($output, [
                $bookcatalog->id,
                $bookcatalog->title,
                $bookcatalog->author,
                $bookcatalog->shopping_cart_price
            ]);
        }

        // Fermer le fichier
        fclose($output);
        exit;
    } else {
        echo "Aucun produit trouvé.";
    }
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>