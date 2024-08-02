<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTE_BANQUE</title>
    <style>
        body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
  color: #333;
}

h2 {
  text-align: center;
  margin-top: 20px;
  color: black;
}

.banque-container {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff4;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
}

.banque-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 1rem;
  margin-bottom: 20px;
}

.banque-table th {
  background-color: #f0f0f0;
  padding: 12px;
  text-align: left;
  font-weight: bold;
}

.banque-table td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  text-align: left;
  color: black;
}

.banque-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.banque-logo {
  max-width: 60px;
  max-height: 60px;
  border-radius: 5px;
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

    <div class="banque-container">
          <h2>LISTE DES BANQUES</h2>

          <table class="banque-table">
            <thead>
                <tr>
                    <th>LOGO</th> 
                    <th>NOM DU BANQUE</th>
                    <th>ADRESS DU BANQUE</th>
                    <th>TELEPHONE</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($take_from_db= $listebanque->fetch())
         {
            ?>
            <tr>
                <td>
                    <img class="banque-logo" src="data:image/jpeg;base64, <?php echo base64_encode($take_from_db["logo"]);?>" alt="">
                </td>
                <td>
                    <?php echo $take_from_db["nom_banque"]; ?>
                </td>
                <td>
                    <?php echo $take_from_db["adresse_banque"]; ?>
                </td>
                <td>
                    <?php echo $take_from_db["telephone_banque"]; ?>
                </td>
            </tr>
            <?php
        }
               ?>
            </tbody>
          </table>
    </div>

</body>
<?php
include("footer.php");
?>
</html>