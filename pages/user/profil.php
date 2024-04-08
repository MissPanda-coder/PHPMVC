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
<section class="container">
  <?php displayMessage(); ?>
    <h1 class="mt-3 text-center">Bonjour <?= $user['nom'] ?></h1>
    <p>Mon id user: <?= $user['idutilisateur']?></p>
    <p>Mon email: <?= $user['email'] ?></p>
    <p>Mes rôles: 
    <?php foreach($roles as $role): ?>
        <?= $role ?>
    <?php endforeach; ?>
</p>
    
    <a class="btn btn-danger" href="../controllers/logout.php">Déconnexion</a>
  </section>
    
  <section class="lists">
<div class="row">
    <div class="col-6 m-auto list p-3 mt-3 border-top border-success-subtle border-5"> 
        <h2 class="fs-3 mb-4">Liste des effets disponibles :</h2>
            <div class="list-user">
                <?php displayEffets(); ?> <!-- Appel de la fonction pour afficher les effets -->
            </div> 
            <div class="mb-3">
                <div>
                <input type="checkbox" name="effetcheckbox" id="effetcheckbox" class="checkEffect">
                <label for="effetcheckbox" class="form-label fw-bold"> </label> Créer un nouvel effet
                </div>
            </div>
    <form class="hiddenEffect" method="POST" action="../controllers/addEffect.php">
                <div class="mb-3">
                <label for="nomEffet" class="form-label fw-bold"> </label> Nom de l'effet
                <input type="text" name="nomEffet" id="nomEffet" class="form-control">
                </div>
            <div class="mb-3">
                <label for="descriptionEffet" class="form-label fw-bold">Description de l'effet</label>
                <input type="text" name="descriptionEffet" id="descriptionEffet" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="dureeEffet" class="form-label fw-bold">Durée de l'effet (nombre et unité de temps)</label>
                <input type="text" name="dureeEffet" id="dureeEffet" class="form-control" >
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-dark px-3 py-2">Valider</button>
            </div>
    </form>
    </div>
    

    <div class="col-6 m-auto list p-3 mt-3 border-top border-success-subtle border-5"> 
        <h2 class="fs-3 mb-4">Liste des ingrédients disponibles :</h2>
            <div class="list-user">
                <?php displayIngredients(); ?> <!-- Appel de la fonction pour afficher les ingrédients -->
            </div> 
        <div class="mb-3">
                <div>
                <input type="checkbox" name="checkIngredient" id="checkIngredient" class="checkIngredient">
                <label for="checkIngredient" class="form-label fw-bold"> </label> Créer un nouvel ingrédient
                </div>
                
                <form class="hiddenIngredients" method="POST" action="../controllers/addIngredient.php">
                <div class="mb-3">
                <label for="nomIngredient" class="form-label fw-bold">Nom de l'ingrédient</label>
                <input type="text" name="nomIngredient" id="nomIngredient" class="form-control">
                </div>
            <div class="mb-3">
                <label for="propriete" class="form-label fw-bold">Propriété de l'ingrédient</label>
                <input type="text" name="propriete" id="propriete" class="form-control">
            </div>
            <div class="mb-3">
                <label for="typeIngredient" class="form-label fw-bold">Type de l'ingrédient</label>
                <input type="text" name="typeIngredient" id="typeIngredient" class="form-control">
            </div>
            <div class="mb-3">
                <label for="rarete" class="form-label fw-bold">Rareté de l'ingrédient</label>
                <input type="text" name="rarete" id="rarete" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-dark px-3 py-2">Valider</button>
            </div>
            </form>
        </div>
           
    </div>
</div>
</section> 

<section class=create>
<div class="row mt-5">
    <div class="col-lg-12 col-md-12 col-12 bg-light m-auto border-top border-success-subtle border-5">
    <h2 class="mt-3 mb-4 text-center h3 ">Créer une potion</h2>
    <?php displayMessage(); ?>
        <form method="POST" action="../controllers/addPotion.php">
            <div class="mb-3">
                <label for="nomPotion" class="form-label fw-bold">Nom de la potion</label>
                <input type="text" name="nomPotion" id="nomPotion" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="descriptionPotion" class="form-label fw-bold">Description de la potion</label>
                <input type="text" name="descriptionPotion" id="descriptionPotion" class="form-control" >
            </div>
            <div class="mb-3">
            <?php displayEffets(); ?>
            </div>
            
            <div class="mb-3">
            <?php displayMagicalNiveau(); ?>
            </div>
            <div class="mb-3">
                <label for="tempsPrepa" class="form-label fw-bold">Temps de préparation (nombre et unité de temps)</label>
                <input type="text" name="tempsPrepa" id="tempsPrepa" class="form-control" >
            </div>
           
            <div class="mb-3">
            <?php displayIngredients(); ?>
            </div>
            
            <div class="mb-4">
                <label for="quantite" class="form-label fw-bold">Quantité</label>
                <input type="int" name="quantite" id="quantite" class="form-control">
            </div>
            <div class="mb-3">
            <?php displayMesure(); ?>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-dark px-3 py-2">Valider</button>
            </div>
            
        </form>
    </div>
</div>
</section>
<script src="../assets/js/main.js"></script>
<?php
  include '../partials/footer.php'; // Inclusion du fichier de pied de page