<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <?php
     include("menu.php");
    // session_start(); // Démarrer la session au début de la page

    // if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') { // Vérifier si un admin est connecté
    //     // Le code suivant sera exécuté uniquement si un administrateur est connecté
    ?>
<div class="shoot">
    <div class="container">
        <h3>FOR ADMINISTRATOR</h3>

        <div class="category">
            <h4>Ajouts</h4>
            <ul>
                <li><a href="banque.php">AJOUTER UNE BANQUE</a></li>
                <li><a href="guichet.php">AJOUTER UN GUICHE</a></li>
                <li><a href="emplacement.php">AJOUTER UNE EMPLACEMENT</a></li>
            </ul>
        </div>

        <div class="category">
            <h4>Affichages</h4>
            <ul>
                <li><a href="listebanque.php">AFFICHAGE DES BANQUES</a></li>
                <li><a href="liste_guichet.php">AFICHAGE DES GUICHETS</a></li>
                <li><a href="liste_emplacement.php">AFFICHAGE DES EMPLACEMENTS</a></li>
            </ul>
        </div>

        <div class="category admin-section">
            <h4>Gestion des Admins</h4>
            <ul>
                <li><a href="manageadmin.php">GERER LES ADMINS</a></li>
            </ul>
            <ul>
                <li>
                    <a href="admintime.php">HISTORIQUE DE CONNECTION ET DE DECONNECTION</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="register.php">CREER UN COMPTE ADMIN</a>
                </li>
            </ul>
        </div>


        <div class="category">
            <h4> Gestion des Utilisateurs</h4>
            <ul>
                <li>
                    <a href="manageuser.php">GESTION DES UTILISATEURS</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="usertime.php">HISTORIQUE DE CONNECTION ET DE DECONNECTION</a>
                </li>
            </ul>
            
        </div>
    </div>
    </div>
   
</body>
<?php
include("footer.php");
// } else {
//     // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté ou s'il n'est pas un administrateur
//     // header("Location: index.php");
//     // exit;
// }
?>
</html>