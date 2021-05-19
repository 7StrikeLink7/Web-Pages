<?php session_start();
if(!isset($_SESSION["loggedin"])) header("Location: session.php");
if($_SESSION["loggedin"]===FALSE) header("Location: session.php");
//Checks if user has logged in. For all users.
?> 

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Users.css">
<title>Single-Event Info Display Page</title>
</head>

<body>
<!--hyperlink to go back-->
<button type=“button”><a href="secret.php">Back to profile</a></button>
<button type=“button”><a href='list.php'>Go back to see the list of events</a></button>


<div class="header"> <h1> Detail of an Event: </h1></div>





<!-- LOADING EVENT DETAILS FOR ONE EVENT-->
<?php


$EventID = $_POST["EventID"];      //Used to know when to print file data - this is the row number of the file
//echo $EventID ;
$counter =1;                       //Keep track of what line the buffer reader is on
$error = true;                     //Display a message if it is on an ID that doesn't have details



$handle = fopen("events.csv","r+"); //Open file

//Read File until the end of file . Saved to buffer.
while(($buffer = fgets($handle)) !== false){
    
  //Spiltting buffer into separate variables for specific details
  $getEventName = explode(',',$buffer)[0];
  $getOrganiser = explode(',',$buffer)[1];
  $getlocation = explode(',',$buffer)[2];
  $getTime = explode(',',$buffer)[3];
  $getDetails = explode(',',$buffer)[4];
  //If the row number is equal to the line row the user has entered
  if ($counter == $EventID){
    $error = false;           //It is found, so no need for error message
    //echo ("counter: ". $counter );
     
      
    
?>
  <!--This is still in the if statement-->
  <!--output the details. h1,h2,h3 and p are used -->
  <span class= "Event">
  <h1><?=($getEventName);?><br></h1>
  <h2><?=("By ".$getOrganiser);?><br></h2>
  <h3><?= ($getlocation);?><br>
  <?=($getTime);?><br></h3>
  <p> <?= ($getDetails);  ;?><br> </p>
</span>
<?php
  } //End of IF 
$counter += 1;  //Next row
}//End of WHILE
fclose($handle);

if ($error == true){
  echo ("<h1>'Sorry, this event page has not been created yet'</h1>");
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