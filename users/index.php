<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include("menu.php");
    ?>
    
    <?php
    session_start();
    include("connect.php"); // Connexion à la base de données
   
    ?>
    <!-- <nav>
        <div class="bar">
            <div class="tete">
                 <h1 id="tete1">GESTION DES QUICHIERS AU BURUNDI</h1>
            </div>
            <div class="onglet">
                <a href="home.php">HOME</a>
                <a href="banque.php">BANQUE</a>
                <a href="guichet.php">GUICHER</a>
                <a href="possession.php">POSSESSION</a>
                <a href="emplacement.php">EMPLACEMENT</a>
           </div>
        </div>
    </nav> -->
    <main>


      <p></p>
    <div class="bienvenue">

        <!-- <p>welcome guys this is the beautifull web page helping peaple to have an access from our database<br>
        actualy our database have tree tables bank, guichet and possession we will manage every  automatic<br>
        guichet from every Burundi's BAnk will give you a legistrer that will help you to insert the datas<br>
        our website is develped in html css javascript and php, php is languague of programme it will  us<br>
        to query our data base any data from it and it will give us the result queried, this is how site <br>
        the site web work this, so thank you keep trying do the query and insertion of datas </p> -->

    </div>
    <p></p>
    </main>

    <div class="mainbox">
        
        <div class="container">
            <div class="box1 onee">

            </div>
            <div class="box2 onee">

            </div>
            <div class="box3 onee">

            </div>
            <div class="box4 onee">

            </div>
            <div class="box6 onee">
            </div>
            

        </div>
        <div class="container2">

            <div class="box7 onee">

            </div>
            <div class="box8 onee">

            </div>
            <div class="box9 onee">

            </div>
            <div class="box10 onee">

            </div>
            <div class="box11 onee">
            </div>
        </div>


    </div>


</body>
<?php include("footer.php"); ?>
</html>