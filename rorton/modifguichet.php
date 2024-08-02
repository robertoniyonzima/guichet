<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUICHET</title>
    <link rel="stylesheet" href="guichet.css">
</head>
<body>
<?php
include("menu.php");
?>

<?php
 include("connect.php");
?>
<?php
if(isset($_GET["modif"])){
    $backupmodif = $_GET["modif"];
    $afficher_guichet = $connect->query("SELECT*FROM guichet WHERE id_guichet='$backupmodif'");
    $data_guichet = $afficher_guichet->fetch();
}
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
                    <td>LOCALISATION DU GICHET:</td>
                    <td><input type="text" placeholder="loc_guichet" name="loc_guichet"class="input" value="<?php echo $data_guichet['loc_guichet'];?>"></td>
                 </tr>
                 <tr>
                    <td>TYPE DE GUICHET: </td>
                    <td><input type="text" placeholder="type_guichet" name="type_guichet"class="input" value="<?php echo $data_guichet['type_guichet'];?>"></td>
                 </tr>
                 <tr>
                    <td>ID BANQUE</td>
                    <td>
                        <select name="id_banque">
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
            
                // $insert = "insert into guichet(loc_guichet, type_guichet, id_banque) values ('$backup_loc_guichet', '$backup_type_guichet', '$backup_id_banquee')";
                
                // $execute = mysqli_query($connect, $insert);
                $modifguichet="update guichet set loc_guichet='".$backup_loc_guichet."',type_guichet='".$backup_type_guichet."',id_banque='".$backup_id_banquee."'
                where id_guichet='".$_GET["modif"]."'";
                
                $connect->exec($modifguichet); 
                header("location:liste_guichet.php");
                if($connect)
                    echo"Modification avec succees";
                else
                    echo"non Modification effectuee";
            }


        ?>



    <?php
    
    //  include("footer.php");
    ?>
    
</body>
</html>