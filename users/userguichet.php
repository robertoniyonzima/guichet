<!DOCTYPE html>
<html lang="en">
<head>
<?php 
    include("menu.php"); 
?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listes des Guichets au Burundi</title>

</head>
<style>
    table {
  width: 80%; /* Largeur du tableau */
  margin: 20px auto; /* Centrer le tableau */
  border-collapse: collapse; /* Supprimer l'espacement entre les cellules */
}

th, td {
  padding: 10px; /* Rembourrage des cellules */
  text-align: left; /* Alignement à gauche */
  border-bottom: 1px solid #ddd; /* Ligne de séparation entre les lignes */
  background: #ab3356;
}
h1{
    text-align: center;
}

th {
  background-color: #f0f0f0; /* Gris clair pour les en-têtes */
}
</style>


<body>
   <h1>Listes Des guichets </h1>

    <?php
       include("connect.php");

       $liste_guichet=$connect->query("select*from guichet");

    ?>


          <table border="3">
            <tr>
                <th>
                    LOCALISATION DE GUICHET
                </th>

                <th>
                    TYPE DE GUICHET
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

</body>

<?php 
    include("footer.php"); 
?>

</html>