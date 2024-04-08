<?php
session_start();
require_once '../config/db.php'; // Inclure le fichier de configuration de la base de données
require_once '../core/functions.php'; // Inclure le fichier de fonctions


if (isset($_POST['submit'])) { // Vérification de la soumission du formulaire
    $nomPotionError = validateNotEmpty($_POST['nomPotion'], 'nomPotion'); // Validation que le champ nom n'est pas vide
    $descriptionPotionError = validateNotEmpty($_POST['descriptionPotion'], 'descriptionPotion'); // Validation que le champ description n'est pas vide
    $prepaError = validateNotEmpty($_POST['tempsPrepa'], 'tempsPrepa'); 
    $qteError = validateNotEmpty($_POST['quantite'], 'quantite'); 

// Vérifie s'il y a des erreurs de validation dans le nom de la potion, la description, la durée, le temps de préparation ou la quantité
if ($nomPotionError || $descriptionPotionError ||  $prepaError || $qteError) { 
    // S'il y a des erreurs, elles sont concaténées pour former un seul message d'erreur, puis ce message est enregistré dans la session sous la clé flash avec le niveau danger.
    $_SESSION['flash']['danger'] = $nomPotionError ?: ($descriptionPotionError ?: $prepaError ?: $qteError); 
    // Redirection vers la page de profil avec un message d'erreur dans la session
    header('Location: ../user/profil');
}

    $potionExistsError = validatePotionExists($_POST['nomPotion']); // Validation de l'existence de la potion
    if ($potionExistsError) { // Si une erreur est survenue
        $_SESSION['flash']['danger'] = $potionExistsError; // Enregistrement du message d'erreur dans la session
        header('Location: ../user/profil'); // Redirection vers la page d'inscription
        exit; // Arrêt du script
    }

    $userId = createPotion(
        $_POST['nomPotion'], //nomPotion correspond au html input name='nomPotion'
        $_POST['descriptionPotion'], //descriptionPotion correspond au html input name='descriptionPotion'
        $_POST['tempsPrepa'], 
        $_POST['niveauMagie'], 
        $_POST['effet'], 
        $_POST['ingredient'], 
        $_POST['quantite'], 
        $_POST['uniteMesure']
    ); 
    // Vérifie si la création de la potion a réussi (la fonction createPotion retourne true)
if ($userId) { 
    // Enregistrement d'un message de succès dans la session
    $_SESSION['flash']['success'] = "Potion ajoutée avec succès !"; 
    // Redirection vers la page de profil
    header('Location: ../user/profil'); 
    exit; // Arrêt du script
} else {
    // Enregistrement d'un message d'erreur dans la session
    $_SESSION['flash']['danger'] = "Une erreur s'est produite lors de la création de la potion."; 
    // Redirection vers la page de profil
    header('Location: ../user/profil');
    exit; // Arrêt du script
}}

