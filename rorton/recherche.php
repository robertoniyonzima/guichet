<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php
    include("menu.php");
    ?>
    <div class="container">
        <?php
        try {
            include("connect.php");

            if (isset($_GET['query'])) {
                $query = $_GET['query'];

                // Requête SQL corrigée avec sous-requête et tri
                $sql = "SELECT * FROM (
                            SELECT nom_banque AS result, 'banque' AS type FROM banque WHERE nom_banque LIKE :query
                            UNION 
                            SELECT loca AS result, 'emplacement' AS type FROM empla WHERE loca LIKE :query
                            UNION
                            SELECT loc_guichet AS result, 'guichet' AS type FROM guichet WHERE loc_guichet LIKE :query
                        ) AS results ORDER BY type";

                $stmt = $connect->prepare($sql);

                // Correction: Stocker la valeur dans une variable AVANT execute()
                $query_with_wildcards = '%' . $query . '%';
                $stmt->bindParam(':query', $query_with_wildcards, PDO::PARAM_STR); 

                $stmt->execute(); 

                // Afficher les résultats de la recherche
                if ($stmt->rowCount() > 0) {
                    echo "<h2>Résultats de la recherche</h2>";
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // Afficher les résultats selon la table 
                        if ($row['type'] == 'banque') {
                            echo "<p><strong>Banque:</strong> " . $row['result'] . "</p>";
                        } elseif ($row['type'] == 'emplacement') {
                            echo "<p><strong>Emplacement:</strong> " . $row['result'] . "</p>";
                        } else {
                            echo "<p><strong>Guichet:</strong> " . $row['result'] . "</p>";
                        }
                    }
                } else {
                    echo "<p>Aucun résultat trouvé.</p>";
                }
            } else {
                echo "<p>Veuillez entrer une requête de recherche.</p>";
            }
        } catch(PDOException $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
        }
        ?>
    </div>
</body>
</html>