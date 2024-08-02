
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE_EMPLACEMENT</title>

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
h3{
    text-align: center;
}

th {
  background-color: #f0f0f0; /* Gris clair pour les en-têtes */
}
    </style>
</head>

<body>
    <?php
    include("menu.php");
    ?>

    <?php
     include("connect.php");  
     $liste_emplacement=$connect->query("SELECT empla.loca, banque.nom_banque AS nom_banque, guichet.loc_guichet
FROM empla
JOIN banque ON empla.id_banque = banque.id_banque
JOIN guichet ON empla.id_guichet = guichet.id_guichet");
    ?>

          <h3> LISTE DES EMPLACEMENTS </h3>

          <table border="3">
            <tr>
                <th>
                    BANQUE
                </th>

                <th>
                      ADRESSE GUICHET
                </th>
                <th>
                      LOCALISATION
                </th>
            </tr>
            
            <?php
            while($take_from_db= $liste_emplacement->fetch())
         {
            ?>
            <tr>
                <td>
                    <?php
                
                        echo $take_from_db["nom_banque"];
                    ?>
                 </td>
                 <td>
                    <?php
                          echo $take_from_db["loc_guichet"];
                    ?>
                 </td>
                <td>
                    <?php
                         echo $take_from_db["loca"];
                    ?>
                </td>   
            </tr>
           

            <?php
                //  if(isset($_GET["supp"]))
                //  {
                //   $backup_del=$_GET["supp"];
                //   $delete_banque= $connect->query("DELETE FROM empla WHERE id_emplacement='$backup_del'");
                //  }
               ?>
              
           <?php
        }  
               ?>

          </table>

          <!-- Bouton pour télécharger en PDF -->
          <!-- <br><button onclick="generatePDF()">Télécharger en PDF</button> -->

</body>
</html>
    
</body>
<?php
include("footer.php");
?>
</html>