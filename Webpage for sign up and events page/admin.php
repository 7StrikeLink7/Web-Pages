<?php session_start();
//Checks if user has logged in
if(!isset($_SESSION["loggedin"])) header("Location: session.php");
if($_SESSION["loggedin"]===FALSE) header("Location: session.php");
?>

<!DOCTYPE html>
<!--This page is for admins, to add new users to the users.css file -->
<html>
<head>

<head>
<link rel="stylesheet" href="Users.css">
<style>
  .form-style {
    margin:10px auto;
    max-width: 400px;
    padding: 20px;
    font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
  }
  ul {
    background: #FFC0CB;
    padding: 20px;
  }
  
  li {
    padding: 0;
    display: block;
    list-style: none;
    margin: 10px 0 0 0;
  }
</style>
<title>ADMIN Area</title>>
</head>

<body>
Welcome to the private message area for 
<?php echo $_SESSION['username'];
?>

<button type=“button”><a href="secret.php">Back to profile</a></button>

<div class="header">
<h1>ADMIN: </h1>
</div>

<h2>Create user: </h2>
<!--Form to take in a name, password and a number for admin -->
<form method = "post" action="adduser.php">
<ul class="form-style">
    <h2>Add New User:</h2>
    <p>Want the user to be an admin? Enter 1 for admin, or 0 for casual user. </p>
    <li>Name: <input type="text" name="name" placeholder="Name" minlength="3" size="20"required>
    <li>Password: <input type="text" name="password" placeholder="4+ character Password" minlength="4"required>
    <li>Admin: <input type="number" name="adminStatus" min="0" max="1" value="0">
    <li><button type="submit">Submit</button>
</ul>
</form>

<h2>Removing a user:</h2>
<!--Form to take a ame and delete the user from the files - sends it back to the same page-->
<form action= "admin.php" method="POST">
<ul class="form-style">
<h2>Delete User:</h2>
<li>Name of user that you wish to delete: <input type="text" name="deleteName" required><br>
<button type="submit">Submit</button>
</ul>
</form>
<br>

<?php
    //DELETE USER
    //Variable used to store all the file contents except for the row of the name the admin has entered
    $newFileContent = "";
    $deleted = False;
    if(isset($_POST["deleteName"]) and $_POST["deleteName"] != $_SESSION['username']){
        $name = $_POST["deleteName"];
        echo($name);

        $file = fopen('users.csv', "r") or die("Unable to open file!");
        while (($buffer = fgets($file, 4096)) !== false) {
            //Gets the namesfrom the file and stors it to getName
            $getName = explode(',',$buffer)[0];
            if ($getName != $name){
                //Store file content into newFileContent if it is not the name given
                $newFileContent .= $buffer;
                
           }
           //Inform user,that the name is found and deletes it
            elseif ($getName == $name){
                echo (" is in file. Deleting user.");
                $deleted = TRUE;
            } 
        }
        if ($deleted == FALSE){
            echo (" is not found.");
        }    
        fclose($file);
        
        //Open and rewrites file with contents of the newFileContents variable
        $newfile = fopen("users.csv", "w");
        fwrite($newfile,$newFileContent);
        fclose($newfile);

    }
?>


<!--Logout -->

<div class="footer">
<form action="logout.php" method="POST">
<input type="submit" name="logout" value="Log Out">
</form>

<p>&copy; 2020 Private Message Limited</p>
</div>

</body>
</html>