<?php
session_start();
if (isset($_SESSION["loggedin"])) header("Location: secret.php");
//Goes to secret.php if user HAS logged in
?>


<!DOCTYPE html>
<!--This is the login page where users enter their username and password (practical 6), 
and access the 'online repository'-->
<html>
<head>
<link rel="stylesheet" href="Users.css">
<title>Log-in page</title>
</head>

<body>
<div class="header">
<h1>Welcome! Please log in: </h1>
</div>
<br>

<!--Form to enter username and password. Passes to login.php which redirects back to here or secret.php.-->
<form action= "login.php" method="POST">
Login name: <input type="text" name="username"><br>
Password: <input type="password" name="password"><br>
<!--admin: <input type="number" name="admin"><br>-->
<button type="submit">Submit</button>
</form>








<!--Form to access the csv file for users and display name, password and admin status if you enter their name-->

<!--
<form action= "session.php" method="POST">
Forgot password? Enter your name here: <input type="text" name="forgotName"><br>
<button type="submit">Submit</button>
</form>
-->


<!--This is the lookup of names, passwords and admin status. Now a bit redundant due to the hashing of passwords-->
<!--Obviously not kept on an offical wepage for anyone to see. It would be more like 'forget password'-->
<?php 

/*
$inArray = FALSE;   //Used to check if should print details
if(isset($_POST["forgotName"]) and !empty($_POST["forgotName"])){      //If something has been entered:
    $givenName = $_POST["forgotName"];
    $handle = fopen("users.csv","r+");              //Read file and store details into variables
    while (($buffer = fgets($handle)) !== false){
        //loads details into variables
        $getName = explode(',',$buffer)[0];
        $getpassword = explode(',',$buffer)[1];
        $getAdmin = explode(',',$buffer)[2];

        //Saves into array if it is the name given
        if ($_POST["forgotName"] == $getName){
            $inArray = TRUE;
            $user = array(
                "$getName"=> array (
                    "password"=> "$getpassword",
                    "Admin"=> "$getAdmin"
                )
            );
        } 
    }
    //Reading array
    //echo "<pre>";
        //print_r($user);
    //echo "</pre>";
    
    //output details bacl to page
    if($inArray == TRUE){
        echo("Name: ". $givenName);
        echo "<br>";
        echo "password:";
        echo $user[$givenName]["password"];
        echo "<br>";
        if ($user[$givenName]["Admin"] == 0){
            echo ("Not ");
        }
        echo ("admin");
    } else{
        echo ("Name not found");
    };
}
*/
?>
    
<br>
<div class="footer">
<p>&copy; 2020 Private Message Limited</p>
</div>
</body>

</html>
