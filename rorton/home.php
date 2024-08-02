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

    // Créer le répertoire "uploads" si nécessaire
    if (!is_dir('uploads')) {
        mkdir('uploads', 0755);
    }

    if (isset($_SESSION['username'])) {
        echo "<h1>Bienvenue, " . $_SESSION['username'] . "!</h1>";

        // Récupérer la photo de profil depuis la base de données
        $sql = "SELECT photo_profil FROM adminaute WHERE username = :username";
        $stmt = $connect->prepare($sql);
        $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $photo_profil = $row['photo_profil']; // Stockez la photo dans la variable $photo_profil

        // Affichage de la photo de profil
        if (!empty($photo_profil)) {
            echo "<div class='profile-picture'>";
            echo "<img src='" . $photo_profil . "' alt='Photo de profil'>";
            echo "<span class='online-indicator'></span>"; // Le rond
            echo "<span class='edit-profile-picture' onclick='afficherOptions()'>+</span>"; // Bouton "Modifier"
            echo "</div>";
        } else {
            // Affichage du bouton "Ajouter"
            echo "<div class='profile-picture empty' onclick='afficherOptions()'>";
            echo "<span class='edit-profile-picture'>+</span>";
            echo "</div>";
        }

        // Menu des options (caché par défaut)
        echo "<div id='profile-options' style='display: none;'>";
            echo "<button onclick='afficherFormulaire()'>Ajouter une photo</button>";
            echo "<button onclick='modifierPhoto()'>Modifier la photo</button>";
            echo "<button onclick='supprimerPhoto()'>Supprimer la photo</button>";
        echo "</div>";

        // Formulaire pour l'ajout de photo (caché par défaut)
        echo "<form method='POST' enctype='multipart/form-data' id='photo-form' style='display: none;'>";
        echo "<label for='photo_profil'>Ajouter une photo de profil:</label>";
        echo "<input type='file' id='photo_profil' name='photo_profil' accept='image/*'>";
        echo "<button type='submit' name='ajouter_photo'>Ajouter</button>";
        echo "</form>";

        // Traitement de l'ajout de la photo de profil
        if (isset($_POST['ajouter_photo'])) {
            $photo_profil = $_FILES['photo_profil'];
            // Valider la photo de profil (type de fichier, taille, etc.)
            if (isset($photo_profil['name']) && !empty($photo_profil['name'])) {
                $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
                $max_size = 1024 * 1024; // 1 Mo

                if (in_array($photo_profil['type'], $allowed_types) && $photo_profil['size'] <= $max_size) {
                    // Enregistrer la photo dans le répertoire "uploads"
                    $target_dir = "uploads/";
                    $target_file = $target_dir . basename($photo_profil["name"]);

                    if (move_uploaded_file($photo_profil["tmp_name"], $target_file)) {
                        // Enregistrer le chemin de la photo dans la base de données
                        $sql = "UPDATE adminaute SET photo_profil = :photo_profil WHERE username = :username";
                        $stmt = $connect->prepare($sql);
                        $stmt->bindParam(':photo_profil', $target_file, PDO::PARAM_STR);
                        $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
                        $stmt->execute();

                        // Mettre à jour la session
                        $_SESSION['photo_profil'] = $target_file;

                        // Rediriger vers la page actuelle pour rafraîchir
                        header('Location: ' . $_SERVER['PHP_SELF']); 
                        exit;
                    } else {
                        echo "Erreur lors de l'enregistrement de la photo.";
                    }
                } else {
                    echo "Le type de fichier ou la taille du fichier n'est pas valide.";
                }
            } else {
                echo "Veuillez sélectionner une photo.";
            }
        }

        // Traitement de la suppression de la photo de profil
        if (isset($_POST['supprimer_photo'])) {
            // Supprimer la photo du répertoire
            unlink($_SESSION['photo_profil']);

            // Mettre à jour la base de données
            $sql = "UPDATE adminaute SET photo_profil = NULL WHERE username = :username";
            $stmt = $connect->prepare($sql);
            $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
            $stmt->execute();

            // Mettre à jour la session
            unset($_SESSION['photo_profil']); 

            // Rediriger vers la page actuelle pour rafraîchir
            header('Location: ' . $_SERVER['PHP_SELF']); 
            exit;
        }

    } else {
        // Rediriger vers la page de connexion
        header("Location: connexion.php");
        exit;
    }
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

    <script>
        const editProfilePicture = document.querySelector('.edit-profile-picture');
        const profilePictureForm = document.getElementById('photo-form');
        const profileOptions = document.getElementById('profile-options');

        if (editProfilePicture) {
            editProfilePicture.addEventListener('click', function() {
                afficherOptions();
            });
        }

        // Fonction pour afficher le formulaire
        function afficherFormulaire() {
            profilePictureForm.style.display = 'block';
            profileOptions.style.display = 'none'; // Masquer le menu des options
        }

        // Fonction pour modifier la photo
        function modifierPhoto() {
            // ... (Code pour afficher le formulaire de modification) ... 
            profileOptions.style.display = 'none'; // Masquer le menu des options
        }

        // Fonction pour supprimer la photo
        function supprimerPhoto() {
            // Soumettez un formulaire POST pour supprimer la photo
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = ''; // Mettez l'URL de la page actuelle 
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'supprimer_photo';
            input.value = 'true';
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        // Fonction pour afficher les options de photo de profil
        function afficherOptions() {
            profileOptions.style.display = 'block';
        }
    </script>

</body>
<?php include("footer.php"); ?>
</html>