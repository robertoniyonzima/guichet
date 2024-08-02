<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUICHET</title>
    <!-- <link rel="stylesheet" href="guichet.css"> -->
    <style>
        .success-message {
    color: green;
    text-align: center;
  }
    </style>
</head>
<body>
<?php
 include("menu.php");
 session_start(); // Démarrer la session au début de la page

 if (isset($_SESSION['username'])) { // Vérifier si un utilisateur est connecté
    include("connect.php");
    ?>
    <div class="box">
        <h2>AJOUTER UN GUICHET</h2>
        <form method="POST">
            <table>
                 <!-- <tr>
                    <td>ID GUICHET:</td>
                    <td><input type="number" placeholder="id_guichet" name="id_guichet" class="input"></td>
                 </tr> -->
                   
                 <tr>
                    <td>LOCALISATION DU GUICHET:</td>
                    <td><input type="text" placeholder="loc_guichet" name="loc_guichet"class="input"></td>
                 </tr>
                 <tr>
                    <td>TYPE DE GUICHET: </td>
                    <td><input type="text" placeholder="type_guichet" name="type_guichet"class="input"></td>
                 </tr>
                 <tr>
                    <td>BANQUE</td>
                    <td>
                        <select name="id_banque" class="input">
                            <?php
                            $sel=$connect->query("SELECT*FROM banque");
                            while($data=$sel->fetch())
                            {
                                ?>
                            <option value="<?php echo $data["id_banque"]; ?>">
                            <?php
                              echo $data['nom_banque'];
                            ?>
                            </option>
                            <?php
                            }
                            ?>

                        </select>
                    </td>
                 </tr>
            </table>
                 <input type="submit" value="SEND" name="envoyer" class="boutonn">
                 <input type="reset" value="DELETE" name="effacer" class="boutonn">
        </form>
        <?php
            if(isset($_POST["envoyer"]))
            {
                $backup_loc_guichet=$_POST["loc_guichet"];
                $backup_type_guichet=$_POST["type_guichet"];
                $backup_id_banquee=$_POST["id_banque"];
            
                $insert = "insert into guichet(loc_guichet, type_guichet, id_banque) values ('$backup_loc_guichet', '$backup_type_guichet', '$backup_id_banquee')";
                
                // $execute = mysqli_query($connect, $insert);
                
                $connect->exec($insert); 
                if($connect)
                echo "<p class='success-message'>Enregistrement avec succès</p>";
                else
                    echo"non Enregistre ";
            }


        ?>



    <?php
    //  include("footer.php");
    ?>
    </div>
<?php
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: index.php");
    exit;
}
?>
    
</body>
</html>