<?php session_start();
if(!isset($_SESSION["loggedin"])) header("Location: session.php");
if($_SESSION["loggedin"]===FALSE) header("Location: session.php");
?>

<!DOCTYPE html>
<!--Page to display success of adding a new user-->
<html>
<head>
<link rel="stylesheet" href="Users.css">
<title>ADD USER Area</title>></head>



<?php echo $_SESSION['username'] ?>.
<button type=“button”><a href="admin.php">Back to user management</a></button>
<button type=“button”><a href="secret.php">Back to profile</a></button>
<br>
<body>
<div class="header">
<h1>Add user: </h1>
</div>
<br><br>

The name submitted was:
<?php 
    //print back what was entered
    echo $_POST['name'];
    echo ("\n");
    echo $_POST['password'];
    echo ("\n");
    echo $_POST['adminStatus'];
    echo ("\n");
?>

<br>

<?php

    $save = TRUE;
  
    if(isset($_POST["name"], $_POST["password"],$_POST["adminStatus"] )){
        //Storing the name, password and admin number to see if it has passed correctly
        $name = $_POST["name"];
        $password = $_POST["password"];
        $admin = $_POST['adminStatus'];
        
        //Read user.csv file to compare names from file to name given. 
        //If there is a name that is the same, it is not stored
        $file = fopen('users.csv', "r") or die("Unable to open file!");
        while (($buffer = fgets($file, 4096)) !== false) {
            $getName = explode(',',$buffer)[0];
            if ($getName == $name){
                $save = FALSE;
            }
        }
    
        fclose($file);
        

        //Save values into users.csv
        if ($save == TRUE){
            $file = fopen('users.csv', "a") or die("Unable to open file!");

            $current = $name;
            $current .= ",";
            $current .= sha1($password);
            $current .= ",";
            $current .= $admin;
            $current .= ", \n";
        
            fwrite($file, $current);
            fclose($file);
        }
        else{
            
            echo ('<p style="color:red">"Name already used."</p>');
        }
    }

?>

<br>

<!--Logout -->
<div class="footer">
<form action="logout.php" method="POST">
<input type="submit" name="logout" value="Log Out">
</form>
<p>&copy; 2020 Private Message Limited</p>
</div>
</body>
</html>