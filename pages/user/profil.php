  <?php
  session_start(); // Démarrage de la session
  $title = 'Profil'; // Déclaration du titre de la page
  require '../../core/functions.php'; // Inclusion du fichier de fonctions
  require '../../config/db.php'; // Inclusion du fichier de connexion à la base de données
  $user = $_SESSION['profil']; // Récupération des données de l'utilisateur
  $roles = $_SESSION['profil']['roles'];  // Récupération des rôles de l'utilisateur
  logedIn(); // Appel de la fonction de connexion
  include '../partials/head.php'; // Inclusion du fichier d'en-tête
  include '../partials/menu.php'; // Inclusion du fichier de navigation
 ?>
<div class="container">
  <?php displayMessage(); ?>
    <h1 class="mt-3">Bonjour <?= $user['nom'] ?></h1>
    <pre>id user : <?= $user['idutilisateur']?></pre>
    <p>Mon email: <?= $user['email'] ?></p>
    <p class="fs-3">Mes rôles : </br>
  <?php foreach($roles as $role): ?>
      <p><?= $role ?></p>
    <?php endforeach; ?>
  </p>
    
    <a class="btn btn-danger" href="../controllers/logout.php">déconnexion</a>
</div>
    
<div class="row">
    <div class="col-6 m-auto list p-3 mt-3 border-bottom border-top border-success-subtle border-5"> 
        <h2 class="fs-3 mb-4">Liste des effets disponibles :</h2>
            <div class="list-user">
                <?php displayEffets(); ?> <!-- Appel de la fonction pour afficher les effets -->
            </div> 
        </div>

    <div class="row">
        <div class="col-6 m-auto list p-3 mt-3 border-bottom border-top border-success-subtle border-5"> 
        <h2 class="fs-3 mb-4">Liste des ingrédients disponibles :</h2>
            <div class="list-user">
                <?php displayIngredients(); ?> <!-- Appel de la fonction pour afficher les ingrédients -->
            </div> 
        </div>
    </div>
</div>

<?php
  include '../partials/footer.php'; // Inclusion du fichier de pied de page