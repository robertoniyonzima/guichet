<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu</title>
    <link rel="stylesheet" href="menu.css">
    <style>
        /* Styles pour la barre de recherche */
        .search-bar {
            display: flex;
            align-items: center;
            justify-content: center; /* Alignement au centre */
            background-color: #f0f0f0; /* Couleur de fond */
            padding: 10px;
            margin-top: 10px; /* Espacement du haut */
            border-radius: 5px;
        }

        .search-bar input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 200px; /* Largeur de la barre de recherche */
        }

        .search-bar button {
            padding: 8px 12px;
            border: none;
            background-color: #4CAF50; /* Couleur du bouton */
            color: white;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-left: 5px;
        }
    </style>
</head>
<body>

<nav>
    <div class="bar">
        <div class="tete">
            <h1 id="tete1">GESTION DES GUICHIERS AU BURUNDI</h1>
        </div>
        <div class="onglet">
            <a href="home.php"><img src="icons/home.svg" width="30px">HOME</a> 
            <a href="banque.php"><img src="icons/building.svg"width="30px" >BANQUE</a>
            <a href="guichet.php"><img src="icons/atm.svg"width="30px" >GUICHET</a>
            <!-- <a href="possession.php">POSSESSION</a> -->
            <a href="emplacement.php"><img src="icons/location.svg" width="25px">EMPLACEMENT</a>
            <a href="admin.php"><img src="icons/superuser.svg" width="30px"></a> 
            <a href="message.php" id="sms"><img src="icons/message.svg" width="30px"></a>
            <a href="logout.php" ><img src="icons/logout.svg" width="30px"></a>
        </div>
    </div>
</nav>

<div class="search-bar">
    <form action="recherche.php" method="GET">
        <input type="text" name="query" placeholder="Rechercher...">
        <button type="submit"><img src="icons/search.svg" width="20px"></button>
    </form>
</div>

<script>
    // JavaScript pour gérer la barre de recherche (facultatif)
    // Vous pouvez ajouter des fonctionnalités comme la suggestion automatique ici.
</script>

</body>
</html>