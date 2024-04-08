<?php
session_start();
require_once '../config/db.php'; // Inclure le fichier de configuration de la base de données
require_once '../core/functions.php'; // Inclure le fichier de fonctions

if (isset($_POST['submit'])) { // Vérification de la soumission du formulaire
    $nameError = validateNotEmpty($_POST['name'], 'nom') ?: validateUsername($_POST['name']); // ['name'] correspond  à la valeur saisie par l'utilisateur dans un champ de formulaire HTML avec l'attribut name. Dans votre contexte, il est utilisé pour récupérer le nom que l'utilisateur a entré dans le formulaire.'nom'  est utilisé comme une chaîne de caractères arbitraire passée à la fonction validateNotEmpty comme deuxième argument. Cette chaîne de caractères est simplement un identifiant utilisé à l'intérieur de la fonction pour référencer le champ de formulaire spécifique qui est en cours de validation.L'utilisation de 'nom' comme identifiant dans validateNotEmpty est indépendante de toute référence à ma base de données ou à mes données. C'est simplement une convention de nommage interne à la fonction de validation pour identifier quel champ de formulaire est en train d'être validé. Je pourrais utiliser n'importe quelle autre chaîne de caractères à la place de 'nom', tant que je m'assure de l'utiliser de manière cohérente avec le champ de formulaire que je valide.
    $emailError = validateNotEmpty($_POST['email'], 'email') ?: validateEmail($_POST['email']); // Validation de l'email
    $passwordError = validateNotEmpty($_POST['password'], 'mot de passe') ?: validatePassword($_POST['password']); // Validation du mot de passe

    if ($nameError || $emailError || $passwordError) { // Si une erreur est survenue
        $_SESSION['flash']['danger'] = $nameError ?: ($emailError ?: $passwordError); // Enregistrement du message d'erreur dans la session
        header('Location: ../user/register'); // Redirection vers la page d'inscription
        exit; // Arrêt du script
    }

    $userExistsError = validateUserExists($_POST['email']); // Validation de l'existence de l'utilisateur
    if ($userExistsError) { // Si une erreur est survenue
        $_SESSION['flash']['danger'] = $userExistsError; // Enregistrement du message d'erreur dans la session
        header('Location: ../user/register'); // Redirection vers la page d'inscription
        exit; // Arrêt du script
    }

    $userId = createUser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['niveauMagie']); // Création de l'utilisateur
    if ($userId) { // Si l'utilisateur est créé
        $_SESSION['profil'] = ['name' => $_POST['name'], 'email' => $_POST['email'], 'idusers' => $userId['userId'], 'roles' => [$userId['roleLevel']]]; // Enregistrement des informations de l'utilisateur dans la session
        $_SESSION['flash']['success'] = "Bienvenue " . $_POST['name'] . " !"; // Enregistrement du message de succès dans la session
        header('Location: ../user/profil'); // Redirection vers la page de profil
        exit; // Arrêt du script
    } else {
        $_SESSION['flash']['danger'] = "Une erreur s'est produite lors de la création de la potion."; // Enregistrement du message d'erreur dans la session
        header('Location: ../index.php'); // Redirection vers la page d'inscription
        exit; // Arrêt du script
    }
}



