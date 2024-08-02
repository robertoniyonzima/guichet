<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BANQUE</title>
    <link rel="stylesheet" href="banque.css">
    <style>
        .success-message {
    color: green;
    text-align: center;
  }
    </style>

<body>
<?php
 $connect = mysqli_connect("localhost", "root", "", "guichetauto");
// include("connect.php");

?>
<?php
include("menu.php");
?>
    
    <div class="box">
        <h2>AJOUTER BANQUE</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <table>
                 <!-- <tr>
                    <td>ID BANQUE:</td>
                    <td><input type="number" placeholder="id_banque" name="id_banque" class="input"></td>
                 </tr> -->
                   
                 <tr>
                    <td>NOM DU BANQUE:</td>
                    <td><input type="text" placeholder="nom_banque" name="nom_banque" class="input"></td>
                 </tr>
                 <tr>
                    <td>ADRESSE_BANQUE: </td>
                    <td><input type="text" placeholder="adresse_banque" name="adresse_banque" class="input"></td>
                 </tr>
                 <tr>
                    <td>TELEPHONE:</td>
                    <td><input type="number" placeholder="telephone" name="telephone" class="input"></td>
                 </tr>
                 <tr>
                    <td>LOGO:</td>
                    <td><input type="file" placeholder="logo" name="logo" class="input"></td>
                 </tr>
            </table>
                 <input type="submit" value="SEND" name="envoyer" class="bouton">
                 <input type="reset" value="DELETE" name="effacer" class="bouton">
        </form>

        <?php
        if(isset($_POST["envoyer"]))
        {
            $backup_nom_banque=$_POST["nom_banque"];
            $backup_adresse_banque=$_POST["adresse_banque"];
            $backup_telephone=$_POST["telephone"];
            $backup_logo=file_get_contents($_FILES["logo"]["tmp_name"]);
            
            $insert = "insert into banque(nom_banque, adresse_banque, telephone_banque, logo) values ('$backup_nom_banque', '$backup_adresse_banque', '$backup_telephone', '". $connect->real_escape_string($backup_logo) ."')";
            // $connect->exec($insert); 
            $connect=mysqli_query($connect, $insert);
            if($connect)
            echo "<p class='success-message'>Enregistrement avec succès</p>";
            else
                echo"non Enregistre";
        }
        ?>

        <?php
        // if(isset($_POST["envoyer"]))
        // {
        //     $nom_banque = mysqli_real_escape_string($connect, $_POST["nom_banque"]);
        //     $adresse_banque = mysqli_real_escape_string($connect, $_POST["adresse_banque"]);
        //     $telephone = mysqli_real_escape_string($connect, $_POST["telephone"]);

        //     // Vérifier si un fichier a été uploadé
        //     if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK) {
        //         $tmp_name = $_FILES["logo"]["tmp_name"];
        //         $logo = file_get_contents($tmp_name);  // Lire le contenu du fichier
        //         $logo = mysqli_real_escape_string($connect, $logo); // Échapper le contenu du logo

        //         // Enregistrement en base de données
        //         $insert = "insert into banque(nom_banque, adresse_banque, telephone_banque, logo) values ('$nom_banque', '$adresse_banque', '$telephone', '$logo')";
        //         $execute = mysqli_query($connect, $insert);

        //         if($execute) {
        //             echo "Enregistrement avec succès";
        //         } else {
        //             echo "Erreur d'enregistrement: " . mysqli_error($connect); 
        //         }
        //     } else {
        //         echo "Aucun fichier uploadé";
        //     }
        // }
        ?>
    </div>
    <?php
    include ("footer.php");
    ?>


</body>
</html>