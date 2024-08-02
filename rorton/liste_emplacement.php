      
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE_EMPLACEMENT</title>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>

<body>
    <?php
    include("menu.php");
    ?>

    <?php
     include("connect.php");  
     $liste_emplacement=$connect->query("select*from empla");
    ?>



    <div class="box">
          <h2>LISTE DES EMPLACEMENTS</h2>

          <table border="3">
            <tr>
                <th>
                    ID DU BANQUE
                </th>

                <th>
                     LOCALISATION
                </th>
                <th>

                </th>
                <th>
                    
                </th>
            </tr>
            
            <?php
            while($take_from_db= $liste_emplacement->fetch())
         {
            ?>
            <tr>
                <td>
                    <?php
                
                        echo $take_from_db["id_banque"];
                    ?>
                 </td>
                <td>
                    <?php
                         echo $take_from_db["loca"];
                    ?>
                </td> 
                      
                <td>
                <a text-decoration="none" background="yellowgreen" href="liste_emplacement.php?supp=<?php echo $take_from_db['id_emplacement'];?>">SUPRIMER</a>
                </td>
                <td>
                    <a href="modifempla.php?modif=<?php echo $take_from_db['id_emplacement'];?>">MODIFIER</a>
                </td>
               
            </tr>
           

            <?php
                 if(isset($_GET["supp"]))
                 {
                  $backup_del=$_GET["supp"];
                  $delete_banque= $connect->query("DELETE FROM empla WHERE id_emplacement='$backup_del'");
                 }
               ?>
              
           <?php
        }  
               ?>

          </table>

          <!-- Bouton pour télécharger en PDF -->
          <br><button onclick="generatePDF()">Télécharger en PDF</button>

          <script>
            function generatePDF() {
                // Utilisez une librairie JavaScript comme jsPDF pour générer le PDF
                // https://www.npmjs.com/package/jspdf

                // Exemple avec jsPDF (vous devrez installer la librairie)
                const doc = new jsPDF();

                // Récupérer le contenu de la table HTML
                const tableHTML = document.querySelector('table').outerHTML;

                // Ajouter le contenu HTML au PDF
                doc.html(tableHTML, {
                    callback: (doc) => {
                        // Enregistrer le PDF
                        doc.save('liste_emplacement.pdf');
                    }
                });
            }
          </script>
    </div>

</body>
</html>

    