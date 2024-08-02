<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emplacement</title>
    <link rel="stylesheet" href="emplacement.css">
</head>
<body>
    <?php
    include("menu.php");
    session_start(); // Démarrer la session au début de la page

    if (isset($_SESSION['username'])) { // Vérifier si un utilisateur est connecté
    ?>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    ?>

    <?php
    include("connect.php");
    // $connect=new PDO("mysql:host=localhost;dbname=guichetauto;charset=utf8","root","");

    ?>

<div class="box">
        <h2> AJOUTER UN EMPLACEMENT</h2>
        <form method="POST">
            <table>
                   
                 <tr>
                    <td>BANQUE:</td>
                    <td>
                    <select name="id_banque" class="input">
                            <?php
                            $sel=$connect->query("SELECT*FROM banque");
                            while($data=$sel->fetch())
                            {
                                ?>
                            <option value="<?php echo $data['id_banque']; ?>">
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
                 <tr>
                    <td>GUICHET: </td>
                    <td>
                    <select name="id_guichet" class="input">
                            <?php
                            $sel=$connect->query("SELECT*FROM guichet");
                            while($data=$sel->fetch())
                            {
                                ?>
                            <option value="<?php echo $data["id_guichet"]; ?>">
                            <?php
                              echo $data['loc_guichet'];
                            ?>
                            </option>
                            <?php
                            }
                            ?>

                        </select>
                           
                    </td>
                 </tr>
        
                 <tr>
                    <td>LOCALISATION<td>
                    <input type="text" placeholder="localisation" name="loc" class="input" class="wee">
                 </tr> 
            </table>
                 <input type="submit" value="SEND" name="envoyer" class="boutonn">
                 <input type="reset" value="DELETE" name="effacer" class="boutonn">
        </form>
        <?php
        if(isset($_POST["envoyer"]))
        {
            $backup_id_banque=$_POST["id_banque"];
            $backup_id_guichet=$_POST["id_guichet"]; // Correction: Utiliser $_POST
            $backup_localisation=$_POST["loc"];

            // Vérification de la valeur de $backup_id_guichet
            if (!empty($backup_id_guichet)) {
                //reguete preparer pour l'insertion
                $insert="insert into empla(id_banque, id_guichet, loca)values('$backup_id_banque','$backup_id_guichet','$backup_localisation')";
                
                //si tu te connect executer le requete preparer
                // $execute = mysqli_query($connect, $insert);  
                try {
                    $connect->exec($insert); 
                    echo "Enregistrement avec succès";
                } catch(PDOException $e) {
                    echo "Erreur d'enregistrement: " . $e->getMessage();
                }
            } else {
                echo "Veuillez sélectionner un guichet.";
            }
        }
        ?>
        

    <?php
    // include("footer.php");
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