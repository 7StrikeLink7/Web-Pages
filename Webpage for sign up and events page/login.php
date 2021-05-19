
<?php
//Process data entered from session.php form, and redirects the user to the appropriate page

session_start();
if(isset($_SESSION['loggedin'])) header("Location: secret.php");
/*Process login data*/
if(!isset($_POST["username"]) || !isset($_POST['password'])){
    header("Location: session.php");
}

/* Run through the CSV and pull in the data: */
if(($handle = fopen("users.csv", "r")) !== FALSE){
    while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
     $users[$data[0]] = array("password"=>$data[1], "admin"=>$data[2]); 
    }
fclose($handle);
}
/* Get the data entered on the form: */
$u = $_POST['username']; 
$p = $_POST['password'];



/* Check it against our 'database':
If the user's name is not in the file, or the password is incorrect, it asks them to try again. 
Admin has a status of 1; so if the user is an admin, it will take them to admin.php to add new users.
Otherwise sends them to secret.php, which is their 'profile' page.
*/


if(isset($users[$u]) and $users[$u]['password'] == sha1($p)) {
     $_SESSION['loggedin']=TRUE; 
     $_SESSION['username']=$u;
     $_SESSION['admin'] = $users[$u]['admin'];
    header("Location: secret.php"); 
}
else{
    header("Location: session.php"); 
}
?>

