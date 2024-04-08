<?php
session_start();
require_once '../config/db.php'; // Inclure le fichier de configuration de la base de données
require_once '../core/functions.php'; // Inclure le fichier de fonctions


if (isset($_POST['submit'])) { // Vérification de la soumission du formulaire
    $nomIngredientError = validateNotEmpty($_POST['nomIngredient'], 'nomIngredient'); // Validation que le champ nom n'est pas vide
    $proprieteIngredientError = validateNotEmpty($_POST['propriete'], 'propriete'); // Validation que le champ propriete n'est pas vide
    $typeIngredientError = validateNotEmpty($_POST['typeIngredient'], 'typeIngredient'); 
    $rareteIngredientError = validateNotEmpty($_POST['rarete'], 'rarete'); 

// Vérifie s'il y a des erreurs de validation dans le nom de la l'ingrédient, la propriété, la durée, le type et la rareté
if ( $nomIngredientError || $proprieteIngredientError ||   $typeIngredientError || $rareteIngredientError) { 
    // S'il y a des erreurs, elles sont concaténées pour former un seul message d'erreur, puis ce message est enregistré dans la session sous la clé flash avec le niveau danger.
    $_SESSION['flash']['danger'] = $nomIngredientError ?: ($proprieteIngredientError ?: $typeIngredientError ?: $rareteIngredientError); 
    // Redirection vers la page de profil avec un message d'erreur dans la session
    header('Location: ../user/profil');
}

    $ingredientExistsError = validateIngredientExists($_POST['nomIngredient']); // Validation de l'existence de la potion
    if ($ingredientExistsError) { // Si une erreur est survenue
        $_SESSION['flash']['danger'] = $ingredientExistsError; // Enregistrement du message d'erreur dans la session
        header('Location: ../user/profil'); // Redirection vers la page d'inscription
        exit; // Arrêt du script
    }

    $userId = createIngredient(
        $_POST['nomIngredient'], //nomPotion correspond au html input name='nomIngredient'
        $_POST['propriete'], 
        $_POST['typeIngredient'], 
        $_POST['rarete'] 
    ); 
    // Vérifie si la création de l'ingrédient' a réussi (la fonction createIngredient retourne true)
if ($userId) { 
    // Enregistrement d'un message de succès dans la session
    $_SESSION['flash']['success'] = "Ingrédient ajouté avec succès !"; 
    // Redirection vers la page de profil
    header('Location: ../user/profil'); 
    exit; // Arrêt du script
} else {
    // Enregistrement d'un message d'erreur dans la session
    $_SESSION['flash']['danger'] = "Une erreur s'est produite lors de la création de l'ingrédient"; 
    // Redirection vers la page de profil
    header('Location: ../user/profil');
    exit; // Arrêt du script
}}
