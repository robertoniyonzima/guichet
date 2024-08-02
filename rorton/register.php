<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="register.css">
</head>

<?php
// Inclusion de la connexion à la base de données
include("connect.php");

// Affichages des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Vérification de la validation JavaScript
    if (isset($_POST['isValid']) && $_POST['isValid'] === 'true') {

        // Vérification de l'existence du nom d'utilisateur
        $checkUsernameQuery = "SELECT 1 FROM adminaute WHERE username = :username";
        $stmt = $connect->prepare($checkUsernameQuery); // Requête préparée
        $stmt->bindParam(':username', $username); // Liaison du paramètre
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Récupération des résultats

        // Si le nom d'utilisateur existe déjà
        if ($result) {
            echo "Le nom d'utilisateur est déjà utilisé. Choisissez un autre.";
            $connect = null; // Fermer la connexion PDO
            exit; // Arrêter l'exécution du script
        } else {
            // Hachage du mot de passe avec l'algorithme bcrypt (recommandé)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insertion des données dans la base de données
            $insert = "INSERT INTO adminaute (username, password) VALUES (:username, :password)";
            $stmt = $connect->prepare($insert);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            if ($stmt->execute()) { // Vérifiez si l'insertion a réussi
                echo "Utilisateur enregistré avec succès";
            } else {
                echo "Erreur lors de l'enregistrement de l'utilisateur : " . $connect->errorInfo()[2]; // Utilisez errorInfo() pour PDO
            }

            $connect = null; // Fermer la connexion PDO
        }
    } else {
        echo "La validation a échoué. Veuillez corriger les erreurs.";
    }
}
?>

<body>
    <div class="container">
        <div class="form-wrapper">
            <h2>Créer un compte</h2>
            <form method="POST">
                <input type="hidden" name="isValid" value=""> 
                <div class="form-group">
                    <label for="username">Nom d'utilisateur:</label>
                    <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required>
                    <span class="error" id="usernameError"></span>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                    <span class="error" id="passwordError"></span>
                </div>
                <button type="submit">Créer un compte</button>
            </form>
            <p>Déjà inscrit ? <a href="index.php">Connectez-vous</a></p>
        </div>
    </div>

    <script>
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');
        const usernameError = document.getElementById('usernameError');
        const passwordError = document.getElementById('passwordError');

        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            let usernameValid = validateUsername(usernameInput.value);
            let passwordValid = validatePassword(passwordInput.value);

            // Définir isValid à true si les deux validations sont réussies
            let isValid = usernameValid && passwordValid;

            // Affecter la valeur à l'input caché
            document.querySelector('input[name="isValid"]').value = isValid;

            if (!isValid) {
                event.preventDefault(); // Empêche la soumission du formulaire
            }
        });

        function validateUsername(username) {
            const regex = /^(?=.*[a-zA-Z]{6})(?=.*[0-9]{3}).+$/; // Au moins 6 lettres, au moins 3 chiffres
            if (regex.test(username)) {
                usernameError.textContent = "";
                return true;
            } else {
                usernameError.textContent = "Le nom d'utilisateur doit contenir au moins 6 lettres et au moins 3 chiffres.";
                return false;
            }
        }

        function validatePassword(password) {
            const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/; // Au moins 8 caractères, au moins une majuscule, au moins une minuscule, au moins un caractère spécial
            if (regex.test(password)) {
                passwordError.textContent = "";
                return true;
            } else {
                passwordError.textContent = "Le mot de passe doit contenir au moins 8 caractères, au moins une majuscule, au moins une minuscule et au moins un caractère spécial.";
                return false;
            }
        }
    </script>

</body>
</html>