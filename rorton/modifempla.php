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
    ?>

    <?php

        include("connect.php");
        // $connect=new PDO("mysql:host=localhost;dbname=guichetauto;charset=utf8","root","");
    
    ?>
    <?php
if(isset($_GET["modif"])){
    $backupmodif = $_GET["modif"];
    $afficher_emplacement = $connect->query("SELECT*FROM empla WHERE id_emplacement='$backupmodif'");
    $data_emplacement = $afficher_emplacement->fetch();
}
?>

<div class="box">
        <h2> AJOUTER UN EMPLACEMENT</h2>
        <form method="POST">
            <table>
                   
                 <tr>
                    <td>BANQUE:</td>
                    <td>
                    <select name="id_banque">
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
                    <select name="id_guichet">
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
                    <input type="text" placeholder="localisation" name="loc" class="input" class="wee" value="<?php echo $data_emplacement['loca'];?>">
                 </tr> 
            </table>
                 <input type="submit" value="SEND" name="envoyer" class="boutonn">
                 <input type="reset" value="DELETE" name="effacer" class="boutonn">
        </form>
        <?php
        if(isset($_POST["envoyer"]))
        {
            $backup_id_banque=$_POST["id_banque"];
            $backup_id_guichet=$_post["id_guichet"];
            $backup_localisation=$_POST["loc"];
            //d_banquee, id_guichet,
            //'$backup_id_banque', '$backup_id_guichet',
            $modifempla="update empla set loca='$backup_localisation' where id_emplacement='$backupmodif'";
            
            $connect->exec($modifempla); 
            header("location:liste_emplacement.php");
            if($connect)
                echo"Modification avec succees";
            else
                echo"non Modification effectuee";
            
        }

        ?>
        

    <?php
    // include("footer.php");
    ?> 


</body>
</html>