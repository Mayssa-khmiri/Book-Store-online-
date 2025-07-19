<?php
// login_query.php
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Récupérer les données du formulaire
    $username = htmlspecialchars($_POST['username']); // Supprimer les espaces inutiles
    $password = htmlspecialchars($_POST['password']);

    // Valider les données
    if (empty($username) || empty($password)) {
        $_SESSION['message'] = [
            'alert' => 'danger',
            'text' => 'Veuillez remplir tous les champs.'
        ];
        header('Location: index.php');
        exit();
    }

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

    // Hacher le mot de passe avant de l'enregistrer
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Ajouter les données du formulaire dans le fichier CSV
    fputcsv($file, [$username, $hashed_password]);

    // Fermer le fichier
    fclose($file);

    // Définir un message de succès
    $_SESSION['message'] = [
        'alert' => 'success',
        'text' => 'Données de connexion enregistrées avec succès !'
    ];

    // Définir une session utilisateur pour indiquer qu'il est connecté
    $_SESSION['username'] = $username;

    // Rediriger l'utilisateur vers la page d'accueil
    header('Location: dashboard.php');
    exit();
} else {
    // Rediriger l'utilisateur si le formulaire n'a pas été soumis
    $_SESSION['message'] = [
        'alert' => 'danger',
        'text' => 'Accès non autorisé.'
    ];
    header('Location: index.php');
    exit();
}
?>