<?php
session_start();
require_once '../config/db.php'; // Inclure le fichier de configuration de la base de données
require_once '../core/functions.php'; // Inclure le fichier de fonctions


if (isset($_POST['submit'])) { // Vérification de la soumission du formulaire
    $nomEffetError = validateNotEmpty($_POST['nomEffet'], 'nomEffet'); // Validation que le champ nom n'est pas vide
    $descriptionEffetError = validateNotEmpty($_POST['descriptionEffet'], 'descriptionEffet'); // Validation que le champ propriete n'est pas vide
    $dureeEffet = validateNotEmpty($_POST['dureeEffet'], 'dureeEffet'); 
   
// Vérifie s'il y a des erreurs de validation dans le nom de la l'ingrédient, la propriété, la durée, le type et la rareté
if ( $nomEffetError ||  $descriptionEffetError ||  $dureeEffet) { 
    // S'il y a des erreurs, elles sont concaténées pour former un seul message d'erreur, puis ce message est enregistré dans la session sous la clé flash avec le niveau danger.
    $_SESSION['flash']['danger'] = $nomEffetError ?: ( $descriptionEffetError ?: $dureeEffet); 
    // Redirection vers la page de profil avec un message d'erreur dans la session
    header('Location: ../user/profil');
}

    $effectExistsError = validateEffectExists($_POST['nomEffet']); // Validation de l'existence de l'effet'
    if ($effectExistsError) { // Si une erreur est survenue
        $_SESSION['flash']['danger'] = $effectExistsError; // Enregistrement du message d'erreur dans la session
        header('Location: ../user/profil'); // Redirection vers la page d'inscription
        exit; // Arrêt du script
    }

    $userId = createEffet(
        $_POST['nomEffet'], //nomPotion correspond au html input name='nomIngredient'
        $_POST['descriptionEffet'], 
        $_POST['dureeEffet']
    ); 
    // Vérifie si la création de l'ingrédient' a réussi (la fonction createIngredient retourne true)
if ($userId) { 
    // Enregistrement d'un message de succès dans la session
    $_SESSION['flash']['success'] = "Effet ajouté avec succès !"; 
    // Redirection vers la page de profil
    header('Location: ../user/profil'); 
    exit; // Arrêt du script
} else {
    // Enregistrement d'un message d'erreur dans la session
    $_SESSION['flash']['danger'] = "Une erreur s'est produite lors de la création de l'effet"; 
    // Redirection vers la page de profil
    header('Location: ../user/profil');
    exit; // Arrêt du script
}}
