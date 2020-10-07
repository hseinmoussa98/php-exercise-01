<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
  echo"
  <div style='text-align:center;'>
      <h1> Welcome To The Safe Page  </h1>
      <p> 
      Your Name :".$_SESSION['name']." <br/>
      Your Username: ".$_SESSION["user"]." <br/>
      Your Email:".$_SESSION["email"].".<br/>
      Your Phone number:". $_SESSION['phone']." <br/>
      Your Birthday :". $_SESSION["birth"] ."<br/>
      Your Social : ".$_SESSION["social"].". <br/>
          
      </p>
  </div>
";
?>

</body>
</html>