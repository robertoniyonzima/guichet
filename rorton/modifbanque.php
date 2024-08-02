<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BANQUE</title>
    <link rel="stylesheet" href="banque.css">

<body>
<?php
//  $connect = mysqli_connect("localhost", "root", "", "guichetauto");
include("connect.php");

?>
<?php
include("menu.php");
?>
<?php
if(isset($_GET["modif"])){
    $backupmodif = $_GET["modif"];
    $afficher_banque = $connect->query("SELECT*FROM banque WHERE id_banque='$backupmodif'");
    $data_banque = $afficher_banque->fetch();
}
?>  
    <div class="box">
        <h2>AJOUTER BANQUE</h2>
        <form method="POST">
            <table>
                 <!-- <tr>
                    <td>ID BANQUE:</td>
                    <td><input type="number" placeholder="id_banque" name="id_banque" class="input"></td>
                 </tr> -->
                   
                 <tr>
                    <td>NOM DU BANQUE:</td>
                    <td><input type="text" placeholder="nom_banque" name="nom_banque" class="input" value="<?php echo $data_banque['nom_banque'];?>"/></td>
                 </tr>
                 <tr>
                    <td>ADRESSE_BANQUE: </td>
                    <td><input type="text" placeholder="adresse_banque" name="adresse_banque" class="input" value="<?php echo $data_banque['adresse_banque'];?>"/></td>
                 </tr>
                 <tr>
                    <td>TELEPHONE:</td>
                    <td><input type="number" placeholder="telephone" name="telephone" class="input" value="<?php echo $data_banque['telephone_banque'];?>"/></td>
                 </tr>
                 <tr>
                    <td>LOGO:</td>
                    <td><input type="file" placeholder="logo" name="logo" class="input" /></td>
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
             $backup_id_telephone=$_POST["telephone"];
             $backup_logo=$_post["logo"];
         
             // $insert = "insert into guichet(loc_guichet, type_guichet, id_banque) values ('$backup_loc_guichet', '$backup_type_guichet', '$backup_id_banquee')";
             
             // $execute = mysqli_query($connect, $insert);
             $modifbanque="update banque set nom_banque='$backup_nom_banque',adresse_banque='$backup_adresse_banque',telephone_banque='$backup_id_telephone',logo='$backup_logo'
             where id_banque='$backupmodif'";
             
             $connect->exec($modifbanque); 
             header("location:listebanque.php");
             if($connect)
                 echo"Modification avec succees";
             else
                 echo"non Modification effectuee";
         }

        ?>
    </div>
    <?php
    include ("footer.php");
    ?>


</body>
</html>