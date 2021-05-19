<?php session_start();
if(!isset($_SESSION["loggedin"])) header("Location: session.php");
if($_SESSION["loggedin"]===FALSE) header("Location: session.php");
//Check if user has logged in
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Users.css">
<title>Secret Area</title>>
</head>

<body>

Welcome to the private message area for 
<?php echo $_SESSION['username']; 

//Admin only: add and delete users
if ($_SESSION['admin'] == 1) {
    //echo($_SESSION['admin']);
    echo ("<button type='button'><a href='admin.php'>User Management</a></button>") ; 
}
?>.


<div class="header">
<h1>For you: </h1>
</div>
<br>


<span class='menu'>
<?php
//Admin only actions. Covers the top links, so normal users wouldn't see it.
if ($_SESSION['admin'] == 1) {
    echo("<h2>Admin only</h2>");
?>


<ul><!--Admin only events-->
    <li><a href="submit.php">Update the events page for upcoming events at Keele University! </a></li>
    <li><a href='admin.php'>User Management</a></li>
<?php
}
?>
<!--For everyone:-->
</ul>

<h2>Events for Everyone:</h2>
<ul>
    <li><a href="list.php">Look at the events page!</a></li>
    <li><a href="Video.html">Take a look at a snippet of "Big Buck Bunny"!</a></li>
    <li><a href="Practical 2 CV.html">Have a look at a an amazing CV!</a></li>
</ul>
</span>
    
<!--Logout -->
<div class="footer">
<form action="logout.php" method="POST">
<input type="submit" name="logout" value="Log Out">
</form>
<p>&copy; 2020 Private Message Limited</p>
</div>

</body>


</html>