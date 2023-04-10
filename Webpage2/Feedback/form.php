<?php
$hostName = "localhost";
$username = "root";
$password = "";
$databaseName = "de_lezers";

$conn = new PDO("mysql:host=$hostName;dbname=$databaseName", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // get data
  $naam = $_POST['naam'];
  $email = $_POST['email'];
  $onderwerp = $_POST['onderwerp'];
  $bericht = $_POST['bericht'];

  // check if bericht field is not empty
  if (!empty($bericht)) {
    // data in de database
    $stmt = $conn->prepare("INSERT INTO klachten (naam, email, onderwerp, bericht) VALUES (:naam, :email, :onderwerp, :bericht)");
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':onderwerp', $onderwerp);
    $stmt->bindParam(':bericht', $bericht);
    $stmt->execute();
  }

  header("Location: ../Homepage/home.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("../Library/head.html"); ?>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php include("../Library/menu.php"); ?>
  <h1 class="formh1">Laat alstublijft uw feedback achter, zodat we onze services kunnen verbeteren!</h1>
  <main id="Form_Main">
    <div id="Form_Div">
      <form method="POST"> <br> <br>
        <div class="Form_Row"><label for="naam">Naam:</label> <input type="text" name="naam" id="naam"></div><br> <br>
        <div class="Form_Row"><label for="email">Email:</label> <input type="email" name="email" id="email"></div><br> <br>
        <div class="Form_Row"><label for="onderwerp">Onderwerp:</label> <input type="text" name="onderwerp" id="onderwerp"></div><br> <br> <br>
        <div class="Form_Row"><label for="bericht">Bericht:</label> <textarea id="message" name="bericht" rows="5" required></textarea></div><br> <br>
        <div class="Form_Row"><input id="Form_Submit" type="submit" name="submit" value="Versturen">
      </form>
    </div>
  </main>
  <?php include("../Library/footer.html"); ?>
</body>

</html>
