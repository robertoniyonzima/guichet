<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>

<?php
// Démarrez la session AVANT d'accéder à $_SESSION['username']
// session_start(); 

include("menu.php");
include("connect.php");

// Vérifiez si la session est active
// if (isset($_SESSION['username'])) {
//     $username = $_SESSION['username']; 
// } else {
//     $username = "Anonyme"; // Si la session n'est pas active, utilisez "Anonyme"
// }

?>

    <div class="box">
        <h2>CONTACT NOUS</h2>
        <form method="POST">
            <table>
                 <tr>
                    <td>NOM</td>
                    <td><input type="text" placeholder="votre nom" name="nom" class="input" required></td>
                 </tr>
                   
                 <tr>
                    <td>PRENOM</td>
                    <td><input type="text" placeholder="votre prenom" name="prenom" class="input" required></td>
                 </tr>
                 <tr>
                    <td>EMAIL</td>
                    <td><input type="email" placeholder="john.doe@example.com" name="email" class="input"></td>
                 </tr>
                 <tr>
                    <td>MESSAGE</td>
                    <td><textarea name="message" placeholder="ecrivez votre message"></textarea></td>
                 </tr>
            </table>
                 <input type="submit" value="SEND" name="envoyer" class="boutonn">
                 <input type="reset" value="DELETE" name="effacer" class="boutonn">
        </form>
        <?php
        if(isset($_POST["envoyer"]))
        {
            $backup_nom = $_POST["nom"];
            $backup_prenom = $_POST["prenom"];
            $backup_email = $_POST["email"];
            $backup_message = $_POST["message"];
            
            // Enregistrement dans la base de données avec une requête préparée
            $insert = $connect->prepare("INSERT INTO contacter(nom, prenom, email, message) VALUES (:nom, :prenom, :email, :message)");
            $insert->bindParam(':nom', $backup_nom, PDO::PARAM_STR);
            $insert->bindParam(':prenom', $backup_prenom, PDO::PARAM_STR);
            $insert->bindParam(':email', $backup_email, PDO::PARAM_STR);
            $insert->bindParam(':message', $backup_message, PDO::PARAM_STR);
            // $insert->bindParam(':username', $username, PDO::PARAM_STR); // Envoyer le username de la session
            $insert->execute();

            if($insert->rowCount() > 0) {
               echo "Votre message a été envoyé avec succès"; 
            } else {
                echo "Votre message n'a pas pu être envoyé !";
            }
         }
      ?>
    </div>
</body>
<?php
include("footer.php");
?>
</html>