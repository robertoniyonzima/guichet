<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE_DES_GUICHETS</title>

    <style>
        table{
            border-collapse: collapse;    
            margin-left: 10px;
        }
        tr th{
            background: yellowgreen;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    include("menu.php");
    ?>

    <?php
       include("connect.php");

       $liste_guichet=$connect->query("select*from guichet");

    ?>



    <div class="box">
          <h2>LISTE DES GUICHETS</h2>

          <table border="3">
            <tr>
                <th>
                    LOCALISATION DE GUICHET
                </th>

                <th>
                    TYPE DE GUICHET
                </th>

                <th>
                    ID BANQUE
                </th>
                 <th>

                 </th>
                 <th>
                    
                 </th>
            </tr>
            
            <?php
            while($take_from_db= $liste_guichet->fetch())
         {
            ?>
            <tr>
                <td>
                    <?php
                         echo $take_from_db["loc_guichet"];
                    ?>
                </td>
                <td>
                    <?php
                        echo $take_from_db["type_guichet"];
                    ?>
                </td>
                <td>
                    <?php
                        echo $take_from_db["id_banque"];
                    ?>
                </td>
                <td>
                <a text-decoration="none" background="yellowgreen" href="liste_guichet.php?supp=<?php echo $take_from_db['id_guichet'];?>">SUPRIMER</a>
                </td>
                <td>
                    <a href="modifguichet.php?modif=<?php echo $take_from_db['id_guichet'];?>">MODIFIER</a>
                </td>
                
               <?php
                 if(isset($_GET["supp"]))
                 {
                  $backup_del=$_GET["supp"];
                  $delete_banque= $connect->query("DELETE FROM guichet WHERE id_guichet='$backup_del'");
                 }
               ?>
            </tr>
              
           <?php
        }
               ?>

          </table>
    </div>

</body>
</html>