# 📚 Book-Store-online

Application web de librairie en ligne permettant de consulter un catalogue de livres,
de gérer un panier d'achat et d'administrer le stock via un espace administrateur.

## Technologies utilisées

| Couche | Technologies |
|---|---|
| Front-End | HTML, CSS, JavaScript |
| Back-End | PHP |
| Base de données | MySQL |

## Fonctionnalités

### Espace client
- Consultation du catalogue de livres
- Panier d'achat
- Profil utilisateur

### Espace administrateur
- Tableau de bord (`dashboard.php`)
- Panneau d'administration (`adminpanel.php`)
- Gestion du catalogue
- Export des données au format CSV (`exporter_csv.php`)

## Structure du projet

```
Book-Store-online-/
├── index.php            # Page d'accueil
├── catalog.php          # Catalogue des livres
├── dashboard.php        # Tableau de bord
├── adminpanel.php       # Espace administrateur
├── exporter_csv.php     # Export CSV
├── conn.php / db.php    # Connexion à la base de données
├── archtecture          # Schéma d'architecture
├── index.css            # Styles de l'accueil
├── Catalog.css          # Styles du catalogue
├── Shopping.css         # Styles du panier
├── UserProfil.css       # Styles du profil
├── Admin.css            # Styles de l'administration
└── dashboard.css        # Styles du tableau de bord
└──

## Installation

### Prérequis
- XAMPP ou WAMP (Apache, PHP, MySQL)
- Git

### Étapes

1. **Cloner le dépôt** dans le dossier web (`htdocs` pour XAMPP) :
   ```bash
   git clone https://github.com/Mayssa-khmiri/Book-Store-online-.git
   ```

2. **Créer la base de données** :
   - Ouvrir phpMyAdmin (`http://localhost/phpmyadmin`)
   - Créer une base de données (par exemple `bookstore`)
   - Importer le fichier SQL du projet

3. **Configurer la connexion** dans `conn.php` / `db.php` :
   ```php
   $host = "localhost";
   $user = "root";
   $password = "";
   $database = "bookstore";
   ```

4. **Lancer l'application** : démarrer Apache et MySQL, puis ouvrir
   `http://localhost/Book-Store-online-/index.php`

## Sécurité

- Ne jamais publier de mot de passe réel de base de données sur GitHub
- Utiliser des requêtes préparées (PDO ou MySQLi) contre les injections SQL
- Hacher les mots de passe des utilisateurs (`password_hash`)

## Améliorations possibles

- Conteneurisation avec Docker
- Pipeline CI/CD avec GitHub Actions
- Paiement en ligne
- Déploiement avec Terraform et Ansible

## Auteur

**Mayssa Khmiri**
