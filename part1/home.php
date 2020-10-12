<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
    <style>
    .error {color: #FF0000;}
    </style>
    
</head>
<body>
<?php
//require("connect.php");
$nameErr = $emailErr = $pass1Err = $pass2Err = $userErr=$phoneErr=$birthErr=$socialErr="";
$name = $email = $pass1 = $pass2 = $user=$phone=$birth=$social="";

if(isset($_POST["sub2"]) && $_SERVER["REQUEST_METHOD"] == "POST" )

{       function test_input($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
          } else {
            $name = test_input($_POST["name"]);
            $_SESSION["name"] = $name;
          }
          if (empty($_POST["email"])) {
            $emailErr = "email is required";
          } else {
            $email = test_input($_POST["email"]);
            $_SESSION["email"] = $email;
          }
          if (empty($_POST["pass1"])) {
            $pass1Err = "Pass is required";
          } else {
            $pass1 = test_input($_POST["pass1"]);
          }
          if (empty($_POST["pass2"])) {
            $pass2Err = "Pass is required";
          } else {
            $pass2 = test_input($_POST["pass2"]);
          }
          if (empty($_POST["user"])) {
            $userErr = "Username is required";
          } else {
            $user = test_input($_POST["user"]);
            $_SESSION["user"] = $user;
          }
          if (empty($_POST["phone"])) {
            $phoneErr = "Phone number is required";
          } else {
            $phone = test_input($_POST["phone"]);
            $_SESSION["phone"] = $phone;
          }
          if (empty($_POST["birth"])) {
            $birthErr = "Birthday date  is required";
          } else {
            $birth = test_input($_POST["birth"]);
            $_SESSION["birth"] = $birth;
          }
          if (empty($_POST["social"])) {
            $socialErr = "Social is required";
          } else {
            $social = test_input($_POST["social"]);
            $_SESSION["social"] = $social;
          }
         
          
    if($nameErr == "" && $emailErr =="" && $pass1Err ==""&& $pass2Err == "" && $userErr=="" && $phoneErr=="" && $birthErr=="" && $socialErr=="")
    {   
       
        if ($pass1==$pass2)
            {   $_SESSION["pass"] = $pass1;

                $sql = "SELECT * FROM users WHERE username='$user'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) 
                {
                  while($row = $result->fetch_assoc()) {
                    echo '<script> alert("Username already exist Try other username");</script>';}
                } 
         
                else
                {   
                    header("Location:safe.php");
                }
            }
        else 
        {
            
            echo "<script> alert('Passwords don\'t match' );
            </script>";
            
        }
    }

    }


    if(isset($_POST["sub"]) && $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        function test_input($data) 
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if (empty($_POST["username"])) {
            $userErr = "Username is required";
          } else {
            $user = test_input($_POST["username"]);
          }
          if (empty($_POST["pass"])) {
            $passErr = "Password is required";
          } else {
            $pass = test_input($_POST["pass"]);
          }

          if($userErr == "" && $passErr=="")
            {   

                
                if ($result->num_rows > 0) 
                {
                  while($row = $result->fetch_assoc()) {
                    echo ('Username already exist Try other username');}
                } 
                $hash_pass=md5($pass);

                $sql1="SELECT * FROM users WHERE username='$user' and password='$hash_pass'";
                $result1=$conn->query($sql1);
                if ($result1->num_rows > 0) 
                {
                    while($row = $result1->fetch_assoc()) {
                        $_SESSION["user"] = $row['username'];
                        $_SESSION["email"] = $row['email'];
                        $_SESSION["name"] = $row['Name'];
                        header("Location:safe.php");
                    }
                } 
           
                else
                {
                    echo " <script> 
                    alert('Username Or Password incorrect !');
                    </script>
                    ";
                }
             }   


    }



?>

    <div style="text-align:center;">
        <h1> Welcome To The Home Page </h1>
        <p> 
        Already have an account? <button style=" border: none; background: none;cursor: pointer;" onclick=funct1()> <b>Sign in</b></button>
        <br>
        New user? <button style=" border: none; background: none;cursor: pointer;" onclick=funct2()> <b>Sign up to create your account</b> </button>
        </p>
    </div>

    <!-- Start Grid1 !-->

    <div class="login-signup container" >
        <div class="login">
            <div class="title">
                <h2>
                Login To Our Site
                </h2>
                <p>
                Enter your username and password
                </p>
            </div>
            <img src="icon.svg" >

            <form class="login-form " action="" method="POST" >
                <input id="inputform1" type="text" placeholder="Type Username Here" name="username" required="required">
                <input type="password"name="pass" placeholder="Enter your pass" required="required" >
                <input type ="submit" name="sub">

            </form> 
            <p style="text-align:center ; margin-top:10%; margin-bottom:-5%;"> Or login With </p>
            <div class="button">
                <button type="button" required="required">Facebook</button>
                <button type="button" required="required">Google</button>
            </div>  
        </div>

        <div class="border">
            <p class="hidden">
                .
            </p>
        </div>

        <div class="signup">
            <div class="title">
                <h2>
                SignUp Now
                </h2>
                <p>
                Please fill the form below to register
                </p>
            </div>
            <img src="icon.svg" >

            <form class="login-form signup" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
             method="POST" name="form2">
                <input id="inputform2" type="text" placeholder="Full Name" name="name" required="required">
                <span class="error"> <?php echo $nameErr;?></span>
                <input type="email" placeholder="Email address" name="email" required="required">
                <span class="error"> <?php echo $emailErr;?></span>
                <input type="password" placeholder="Password" name="pass1" required="required">
                <span class="error"> <?php echo $pass1Err;?></span>
                <input type="password" placeholder="Confirm Password" name="pass2" required="required">
                <span class="error"> <?php echo $pass2Err;?></span>
                <input type="text" placeholder="Username" name="user" required="required">
                <span class="error"> <?php echo $userErr;?></span>
                <input type="tel" placeholder="Telephone number" pattern="[0-9]{0,14}" name="phone" required="required">
                <span class="error"> <?php echo $phoneErr;?></span>
                <input type="date" placeholder="Date of your birth" name="birth" required="required">
                <span class="error"> <?php echo $birthErr;?></span>
                <input type="number" placeholder="Social Security Number" name="social" required="required">
                <span class="error"> <?php echo $socialErr;?></span>
           
                <input type ="submit" name="sub2" style="height:50px;">

            </form> 
           
        </div>
    </div>

</body>
<script>
    function funct1()
    {   document.getElementsByClassName("signup")[0].style.display = "none";
        document.getElementsByClassName("border")[0].style.visibility = "hidden";
        document.getElementsByClassName("login")[0].style.visibility = "visible";
        
    }
    function funct2()
    {
        document.getElementsByClassName("login")[0].style.visibility = "hidden";
        document.getElementsByClassName("border")[0].style.visibility = "hidden";
        document.getElementsByClassName("signup")[0].style.display = "block";
    }
    </script>
</html>