<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE_BANQUE</title>

    <style>
        table{
            border-collapse: collapse;
            margin-left: 0;
        }
        tr th{
            background: yellowgreen;
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    include("menu.php");
    ?>

    <?php
       include("connect.php");

       $listebanque=$connect->query("select*from banque");

       
       
    ?>



    <div class="box">
          <h2>LISTE DES BANQUES</h2>

          <table border="3">
            <tr>
                <th>
                    LOGO
                </th> 
                <th>
                    NOM DU BANQUE
                </th>

                <th>
                    ADRESS DU BANQUE
                </th>

                <th>
                    TELEPHONE
                </th>
                <th>
                       
                </th>
                <th>

                
                </th>
            </tr>
            
            <?php
            while($take_from_db= $listebanque->fetch())
         {
            ?>
            <tr>
                <td>
                    <img width="60px" border-radius="20px"src="data:image/jpeg;base64, <?php echo base64_encode($take_from_db["logo"]);?>" alt="">
                </td>
                <td>
                    <?php
                         echo $take_from_db["nom_banque"];
                    ?>
                </td>
                <td>
                    <?php
                        echo $take_from_db["adresse_banque"];
                    ?>
                </td>
                <td>
                    <?php
                        echo $take_from_db["telephone_banque"];
                    ?>
                </td>

                <td>
                <a text-decoration="none" background="yellowgreen" href="listebanque.php?supp=<?php echo $take_from_db['id_banque'];?>">SUPRIMER</a>
                </td>

                
               <?php
                 if(isset($_GET["supp"]))
                 {
                  $backup_del=$_GET["supp"];
                  $delete_banque= $connect->query("DELETE FROM banque WHERE id_banque='$backup_del'");
                 }
               ?>

                <td>
                    <a href="modifbanque.php?modif=<?php echo $take_from_db['id_banque'];?>">MODIFIER</a>
                </td>

            </tr>
              
           <?php
        }
               ?>


          </table>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const buttonsActiver = document.querySelectorAll('.btn-activer');
    const buttonsDesactiver = document.querySelectorAll('.btn-desactiver');
    const buttonsSupprimer = document.querySelectorAll('.btn-supprimer');

    // Gestion des boutons Activer/Désactiver
    buttonsActiver.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            if (confirm("Voulez-vous vraiment activer cet utilisateur ?")) {
                // Envoyer une requête AJAX pour activer l'utilisateur
                fetch('action.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'action=activer&id=' + userId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recharger la page après l'activation
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de l\'activation de l\'utilisateur:', error);
                    alert('Une erreur est survenue. Veuillez réessayer.');
                });
            }
        });
    });

    buttonsDesactiver.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            if (confirm("Voulez-vous vraiment désactiver cet utilisateur ?")) {
                // Envoyer une requête AJAX pour désactiver l'utilisateur
                fetch('action.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'action=desactiver&id=' + userId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recharger la page après la désactivation
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la désactivation de l\'utilisateur:', error);
                    alert('Une erreur est survenue. Veuillez réessayer.');
                });
            }
        });
    });

    // Gestion des boutons Supprimer
    buttonsSupprimer.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
                // Envoyer une requête AJAX pour supprimer l'utilisateur
                fetch('action.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'action=supprimer&id=' + userId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recharger la page après la suppression
                    } else {
                        alert(data.error);
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la suppression de l\'utilisateur:', error);
                    alert('Une erreur est survenue. Veuillez réessayer.');
                });
            }
        });
    });
});
</script>
</body>
<?php
include("footer.php");
?>
</html>