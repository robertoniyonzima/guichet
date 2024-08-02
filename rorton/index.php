<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SE CONNECTER</title>
    <link rel="stylesheet" href="./authentification.css">
</head>
<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
    <?php
    include("connect.php"); // Une connexion à la base de données
    ?>
   
    <div class="bigdiv">
        <div class="box">
        <h1>LOGIN FOR ADMIN</h1>

        <form method="POST">
            <input type="text" name="username" placeholder="Administrator" class="user one"><br>
            <input type="password" name="password" placeholder="Password" class="pass one"><img src=""><br>
            <input type="submit" value="se connecter" name="envoyer" class="bouton"><br>
            <p>don't have an acount <a href="register.php">Register</a></p>
        </form>

        <?php

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"]; // Récupération du nom d'utilisateur
    $password = $_POST["password"]; // Récupération du mot de passe

    // Vérification si le nom d'utilisateur existe dans la base de données
    $verif = $connect->prepare("SELECT * FROM adminaute WHERE username = :username"); // Utilisez un marqueur nommé
    $verif->bindParam(':username', $username, PDO::PARAM_STR); // Liez le paramètre avec bindParam()
    $verif->execute();
    $result = $verif->fetchAll(PDO::FETCH_ASSOC); // Utilisez fetchAll() pour récupérer tous les résultats

    if (count($result) > 0) {
        // Le nom d'utilisateur existe, on vérifie le mot de passe
        $row = $result[0];
        if (password_verify($password, $row['password'])) {
            // Le mot de passe est correct, redirection vers home.php
            session_start(); // Démarrer la session
            $_SESSION['username'] = $row['username']; // Remplacez 'nom_utilisateur' par le nom du champ dans votre base de données
            $_SESSION['photo_profil'] = $row['photo_profil']; // Remplacez 'photo_profil' par le nom du champ dans votre base de données

            // Enregistrer la connexion dans la base de données
            $sql = "INSERT INTO activity_log (username, event, timestamp) VALUES (:username, :event, :timestamp)";
            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
            $stmt->bindValue(':event', 'Connexion', PDO::PARAM_STR);
            $timestamp = date("Y-m-d H:i:s");
            $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR); 
            $stmt->execute(); 

            header("Location: home.php");
            exit;
        } else {
            // Mot de passe incorrect
            echo "<p style='color:red;'>Mot de passe ou Username incorrect</p>";
        }
    } else {
        // Nom d'utilisateur incorrect
        echo "<p style='color:red;'>Nom d'utilisateur incorrect</p>";
    }
}
?>
    </div>
         
</body>
</html>