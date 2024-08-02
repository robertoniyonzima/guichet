<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <link rel="stylesheet" href="message.css">
</head>
<body>
    <?php
    include("menu.php");
    include("connect.php");
    $message= $connect->query("select*from contacter");
    ?>
    
    <div class="continer">
        <table> 
            <?php
            while($take_from_db= $message->fetch())
            {
            ?>
            <div class="message">
                <?php echo $take_from_db["username"];?><br>
                <?php echo $take_from_db["nom"]; ?> 
                <?php echo $take_from_db["prenom"]; ?><br>
                <?php echo $take_from_db["email"]; ?><br>
                <?php echo $take_from_db["time"]; ?><br>
                <?php echo $take_from_db["message"]; ?> 
            </div> 
            <?php
            }
            ?>          
        </table>
    </div>
</body>
</html>