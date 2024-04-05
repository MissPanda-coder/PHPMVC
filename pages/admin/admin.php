<?php
session_start(); // Démarrage de la session
$title = 'Admin'; // Déclaration du titre de la page
require '../../core/functions.php'; // Inclusion du fichier de fonctions
require '../../config/db.php'; // Inclusion du fichier de connexion à la base de données
$user = $_SESSION['profil']; // Récupération des données de l'utilisateur
logedIn(); // Appel de la fonction de connexion
include '../partials/head.php'; // Inclusion du fichier d'en-tête
include '../partials/menu.php'; // Inclusion du fichier du menu d'administration
?>

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-6 m-auto">
        <h1 class="my-3">Bonjour Administrateur <?= $user['nom'] ?></h1>
        <?php displayMessage(); // Appel de la fonction pour afficher les messages $_SESSION['flash'] ?>
        </div>
    </div>
    <div class="row">
        <div class="text-start col-6 m-auto">
            
            <pre>id user : <?= $user['idutilisateur'] ?></pre>
            <p>Mon email: <?= $user['email'] ?></p>
            <a class="btn btn-danger" href="../controllers/logout.php">Déconnexion</a>
        </div>
    </div>
    <div class="row mt-5">
    <div class="col-lg-4 col-md-6 col-10 bg-light m-auto border border-1 rounded shadow p-3">
    <h1 class="mt-3 mb-4 text-center h3">Inscription nouveau membre</h1>
    <?php displayMessage(); ?>
        <form method="POST" action="../controllers/addUser.php">
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Username</label>
                <input type="text" name="name" id="name" class="form-control" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" name="email" id="email" class="form-control" >
            </div>
            <div class="mb-3">
            <?php displayMagicalNiveau(); ?>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-dark px-3 py-2">Valider</button>
            </div>
            
        </form>
    </div>
</div>
</div>

<?php
include '../partials/footer.php'; // Inclusion du fichier de pied de page