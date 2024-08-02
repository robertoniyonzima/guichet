<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Administrateurs</title>
    <link rel="stylesheet" href="manageadmin.css">
</head>
<body>
    <?php
    include("menu.php");
    ?>
    <h1>Gestion des Administrateurs</h1>

    <?php
    // Inclure la connexion à la base de données
    include("connect.php");

    // Vérifier si une action a été soumise
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $userId = $_POST['id'];

        switch ($action) {
            case 'activer':
                $sql = "UPDATE adminaute SET status = 1 WHERE id = :id";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo "<script>alert('Utilisateur activé avec succès.');</script>";
                } else {
                    echo "<script>alert('Erreur lors de l\'activation de l\'utilisateur.');</script>";
                }
                break;

            case 'desactiver':
                $sql = "UPDATE adminaute SET status = 0 WHERE id = :id";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo "<script>alert('Utilisateur désactivé avec succès.');</script>";
                } else {
                    echo "<script>alert('Erreur lors de la désactivation de l\'utilisateur.');</script>";
                }
                break;

            case 'supprimer':
                $sql = "DELETE FROM adminaute WHERE id = :id";
                $stmt = $connect->prepare($sql);
                $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    echo "<script>alert('Utilisateur supprimé avec succès.');</script>";
                } else {
                    echo "<script>alert('Erreur lors de la suppression de l\'utilisateur.');</script>";
                }
                break;
        }

        // Rediriger vers la page actuelle pour rafraîchir l'affichage
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    // Requête SQL pour récupérer les utilisateurs
    $sql = "SELECT id, username, status FROM adminaute";
    $stmt = $connect->prepare($sql);
    $stmt->execute();

    // Afficher le tableau des utilisateurs
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Nom d'Admin</th>";
    echo "<th>Statut</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Boucle pour afficher chaque utilisateur
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . ($row['status'] == 1 ? 'Actif' : 'Désactivé') . "</td>";
        echo "<th>";

        // Bouton Activer/Désactiver
        if ($row['status'] == 1) {
            echo "<button class='btn-desactiver' data-id='" . $row['id'] . "'>Désactiver</button>";
        } else {
            echo "<button class='btn-activer' data-id='" . $row['id'] . "'>Activer</button>";
        }

        // Bouton Supprimer
        echo "<button class='btn-supprimer' data-id='" . $row['id'] . "'>Supprimer</button>";

        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";

    ?>

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
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = ''; // Envoi à la même page
                form.innerHTML = `
                    <input type="hidden" name="action" value="activer">
                    <input type="hidden" name="id" value="${userId}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });

    buttonsDesactiver.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            if (confirm("Voulez-vous vraiment désactiver cet utilisateur ?")) {
                // Envoyer une requête AJAX pour désactiver l'utilisateur
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = ''; // Envoi à la même page
                form.innerHTML = `
                    <input type="hidden" name="action" value="desactiver">
                    <input type="hidden" name="id" value="${userId}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });

    // Gestion des boutons Supprimer
    buttonsSupprimer.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.id;
            if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
                // Envoyer une requête AJAX pour supprimer l'utilisateur
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = ''; // Envoi à la même page
                form.innerHTML = `
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="id" value="${userId}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
    </script>
</body>
</html>