<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admintime</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .user-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-details {
            margin-left: 20px;
        }

        .user-details h2 {
            margin-bottom: 5px;
        }

        .user-details p {
            margin-bottom: 0;
            color: #777;
        }

        .activity-log {
            margin-bottom: 20px;
        }

        .activity-log h3 {
            margin-bottom: 10px;
        }

        .activity-entry {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .activity-entry:last-child {
            border-bottom: none;
        }

        .activity-entry .time {
            font-weight: bold;
            color: #555;
        }

        .activity-entry .event {
            margin-left: 10px;
        }

        .activity-entry .event .status {
            font-style: italic;
        }

        /* Style pour le rond "en ligne" */
        .online-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: green;
            display: inline-block; /* Pour le positionnement dans le texte */
            margin-right: 5px;
        }

        /* Style pour le rond "hors ligne" */
        .offline-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: red;
            display: inline-block; /* Pour le positionnement dans le texte */
            margin-right: 5px;
        }
    </style>
</head>
<?php
session_start();
include("menu.php");
include("connect.php");
// Affichages des erreurs
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if (isset($_SESSION['username'])) {

    // Récupération de la photo de profil depuis la base de données (si nécessaire)
    // $sql = "SELECT photo_profil FROM useraute WHERE username = :username";
    // $stmt = $connect->prepare($sql);
    // $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    // $stmt->execute();
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // $photo_profil = $row['photo_profil'];

    // Enregistrer la date et l'heure de connexion dans la base de données (une seule fois par session)
    // if (!isset($_SESSION['connexion_enregistree'])) {
    //     $sql = "INSERT INTO activity_log (username, event, timestamp) VALUES (:username, :event, :timestamp)";
    //     $stmt = $connect->prepare($sql);
    //     $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);

    //     // Correction: Utiliser bindValue() pour "Connexion" 
    //     $stmt->bindValue(':event', 'Connexion', PDO::PARAM_STR);

    //     // Stocker la date dans une variable AVANT execute()
    //     $timestamp = date("Y-m-d H:i:s");
    //     $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_STR); 

    //     $stmt->execute(); // Exécutez la requête maintenant

    //     $_SESSION['connexion_enregistree'] = true; 
    // }

    // Afficher les informations de l'utilisateur
    echo "<div class='container'>";
    echo "<div class='user-info'>";
    if (!empty($photo_profil)) {
        echo "<img src='" . $photo_profil . "' alt='Photo de profil'>";
    } else {
        echo "<img src='placeholder.png' alt='Photo de profil'>";
    }
    echo "<div class='user-details'>";
    echo "<h2>" . $_SESSION['username'] . "</h2>";
    echo "<p>Connecté le : " . date("Y-m-d H:i:s") . "</p>"; // Affiche la date et l'heure courantes
    echo "</div>";
    echo "</div>";

    // Afficher le journal des activités
    echo "<div class='activity-log'>";
    echo "<h3>Journal des activités</h3>";

    // Récupérer les entrées du journal des activités depuis la base de données
    $sql = "SELECT * FROM activity_loger ORDER BY timestamp DESC";
    $stmt = $connect->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='activity-entry'>";
        echo "<span class='time'>" . $row['timestamp'] . "</span>";
        echo "<span class='event'>" . $row['username'] . " " . $row['event'] . "</span>";
        echo "</div>";
    }

    echo "</div>";

    echo "</div>";
} else {
    // Rediriger vers la page de connexion
    header("Location: user/index.php");
    exit;
}
?>

<body>
    <script>
        // Définir la date et l'heure de déconnexion
        window.onbeforeunload = function() {
            // Envoyer une requête AJAX pour enregistrer la date et l'heure de déconnexion dans la base de données
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "user/logout.php", true); 
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("username=<?php echo $_SESSION['username']; ?>&event=Déconnexion");
        };
    </script>
</body>
</html>