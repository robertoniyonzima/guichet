<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSSESSION</title>
    <link rel="stylesheet" href="possession.css">
</head>
<body>
    <?php
    include("menu.php");
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

    <div class="box">
        <h2>AJOUTER UNE POSSESSION POSSESSION</h2>
        <form method="POST">
            <table>
                 <tr>
                    <td>ID_POSSESSION:</td>
                    <td><input type="number" placeholder="id_possession" name="id_possession" class="input"></td>
                 </tr>
                   
                 <tr>
                    <td>ID_BANQUE:</td>
                    <td><input type="number" placeholder="id_banque" name="id_banque" class="input"></td>
                 </tr>
                 <tr>
                    <td>ID_GUICHET: </td>
                    <td><input type="number" placeholder="id_guichet" name="id_guichet" class="input"></td>
                 </tr>
                 <tr>
                    <td>DATE_POSSESSION</td>
                    <td><input type="date" placeholder="date" name="date" class="input"></td>
                 </tr>
            </table>
                 <input type="submit" value="SEND" name="envoyer" class="boutonn">
                 <input type="reset" value="DELETE" name="effacer" class="boutonn">
        </form>
        <?php
        if(isset($_POST["envoyer"]))
        {
            $backup_id_possession=$_POST["id_possession"];
            $backup_id_banque=$_POST["id_banque"];
            $backup_id_guichet=$_POST["id_guichet"];
            $backup_date_possession=$_POST["date"];
        ?>
        <table>
            <tr>
                <td>
                    ID DU POSSESSION:
                </td>
                <td>
                    <?php
                    echo"$$backup_id_possession";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                   ID DU BANQUE:
                </td>
                <td>
                    <?php
                    echo"$backup_id_banque";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                   ID DU GUICHET:
                </td>
                <td>
                    <?php
                    echo"$backup_id_guichet";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                   DATE DE POSSESSION:
                </td>
                <td>
                    <?php
                    echo"$backup_date_possession";
                    ?>
                </td>
            </tr>

        </table>
       <?php
       }
       ?>

    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>