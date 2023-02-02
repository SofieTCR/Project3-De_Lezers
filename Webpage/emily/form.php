<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php  include("../Menu/menu.php"); ?>

<h1>HTML Forms</h1>

<form action="action_page.php" method="POST">
  <label for="usern">Username:</label><br>
  <input type="text" id="usern" name="usern" value="John"><br>
  <label for="pass">Password:</label><br>
  <input type="password" id="pwd" name="pwd" value="Doe" maxlength="5"><br><br>
  <input type="submit" value="Submit">
</form> 

 <p style="color: blue;">If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>