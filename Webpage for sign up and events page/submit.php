<?php session_start();
//Checks if user has logged in and is admin
if(!isset($_SESSION["loggedin"])) header("Location: session.php");
if($_SESSION["loggedin"]===FALSE) header("Location: session.php");
if ($_SESSION['admin'] != 1)  header("Location: secret.php");
?>



<!DOCTYPE html>
<!--Form to add an event.-->
<html>
<head>
  <!--Make the form look pretty by making it in the middle. Some fonts and a nice pink background-->
<style>
.form-style {
	margin:10px auto;
	max-width: 400px;
	padding: 20px 12px 10px 20px;
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
<title>Submit Event</title>>

<?php 
//Same as the other pages. Prints name on top and a button link to go back. 
echo $_SESSION['username']; 
echo ("\n<button type='button'><a href='secret.php'>Back to profile</a></button>"); 

?>

</head>
<body>


<form action= "submit.php" method="POST" autocomplete="on">
<ul class="form-style">
<fieldset>
<!--Legend is part o the fieldset; adds a nice border-->
<legend>Add An Event:</legend>
    <!--Information to be entered with matching data types-->
    <!--Also limitation on size, to add validation.-->
    <li>Name of event: <input type="text" name="eventName"  minlength="4" size="30" placeholder="e.g.Keele Hackathon" required></li>
    <li>Head Organiser:<input type="text" name="organiser" minlength="3" size="30" placeholder="e.g.Professor John Doe" required></li>
    <li>Location/Building:<input type="text" name="location" minlength="2" size="40" placeholder="e.g. Colin Reeves" required></li>
    <li>Day of Event:<input type="Date" name="date" required></li>
    
    <!--Admins enter the event details here. Calls a function 'noCommas' where it uses regular expression. See bottom of page-->
    <li>Details:<textarea id = "eventDetails" name="eventDetails" style="width:200px; height:200px;"  oninput="noCommas(value)"
    placeholder="A brief description of what is going on. Sorry no commas allowed. e.g. All weekend coding starting from Saturaday at 9AM. Prizes in store. Pancakes and drinks available."></textarea></li>

    <p id="msg">Thank you.</p>
    <li><button type="submit" >Submit</button></li>

</ul>
</fieldset>
</form>
<a href= "list.php"> Go to events page! </a><br>

<?php
    //Saving to file
    $save = TRUE; //Not Saving if event name is used. Don't want to have two events of with the same name
    if(isset($_POST["eventName"], $_POST["organiser"],$_POST["location"], $_POST["date"],$_POST["eventDetails"] )){
        //Storing the nam, password and admin number to see if it has passed correctly
        $name = $_POST["eventName"];
        $organiser = $_POST["organiser"];
        $location = $_POST['location'];
        $date = $_POST["date"];
        $details = $_POST["eventDetails"];

        //Read user.csv file to compare names from file to name given. 
        //If there is a name that is the same, it is not stored
        $file = fopen('events.csv', "r") or die("Unable to open file!");
        while (($buffer = fgets($file, 4096)) !== false) {
            $getName = explode(',',$buffer)[0];
            if ($getName == $name){
                $save = FALSE;
            }
        }
        fclose($file);
        
     
        if ($save == TRUE){
            $file = fopen('events.csv', "a") or die("Unable to open file!");
            $current = $name;
            $current .= ",";
            $current .= $organiser;
            $current .= ",";
            $current .= $location;
            $current .= ",";
            $current .= $date;
            $current .= ",";
            $current .= $details;
            $current .= ", \n";
            fwrite($file, $current);
            fclose($file);
            echo("Thank you. Successfully saved.");
           

        }
        else{
          echo("Name already used. Try another name.");
  
        }
    }
?>



<script>
  //For the "details" part of the form
  //Used to make user unable to enter commas. This is so it will read nicely on the list/display pages.
  //Able to read the csv files easier, and for validation purposes.
function noCommas(inputVal) {
  var patt= /^[a-zA-Z0-9. !?]+$/;
  if(patt.test(inputVal)){  //if the text has any of the values in patt, then it will update 'eventDetails'
    document.getElementById('eventDetails').value = inputVal;
  }
  else{
    var txt = inputVal.slice(0, -1);
    document.getElementById('eventDetails').value = txt;
  }
}


//document.getElementById("msg").innerHTML = " Thank you. Successfully saved.";
//document.getElementById("msg").innerHTML = " \nEvent name already used. Try another name.";
//Perhaps store the post values, and  use the same getElementbyID to change values, to keep the values.

</script>
</body>

</html>