<?php
include("connect.php"); 

// Démarrez la session AVANT d'accéder à $_SESSION['username']
session_start(); 

// Vérifiez si la session est active
if (isset($_SESSION['username'])) {
    // Enregistrez la déconnexion dans la base de données
    $username = $_SESSION['username']; // Récupérer le nom d'utilisateur de la session
    $event = "logout"; 

    $sql = "INSERT INTO activity_log (username, event, timestamp) VALUES (:username, :event, :timestamp)";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':event', $event, PDO::PARAM_STR);
    $timestamp = date("Y-m-d H:i:s");
    $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR); 
    $stmt->execute(); 

    // Désactivez les tampons de sortie
    ob_end_clean();

    // Détruisez la session
    session_destroy(); 

    // Redirigez vers index.php
    header("Location: index.php");
    exit;
} else {
    // La session n'est pas active, vous pouvez rediriger vers la page de connexion ou afficher un message d'erreur
    header("Location: index.php");
    exit;
}
?>