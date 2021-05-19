
<?php session_start();

if(!isset($_SESSION["loggedin"])) header("Location: session.php");
if($_SESSION["loggedin"]===FALSE) header("Location: session.php");
//Check if user has logged in. For both admins and non-admins

?>


<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Users.css">
<title>All Event-Names Display Page</title>
</head>


<body>
><?php 
  echo $_SESSION['username']; ?>
  <button type=“button”><a href="secret.php">Back to profile</a></button>



<div class="header"> <h1> List of Events: </h1></div>



<!--Form to enter the event they wish to see-->
<!--Stored as a number, so it can be used to read the row in the event.csv file-->
<form id = "displayForm" method="POST"  action= "display.php">
<h3>Enter the Number for the event you wish to see more details of: </h3> 
<p id="info"> </p> <!--Display range for user to input-->
<input type="number" name="EventID" min="1"  value="1">
<button type="submit">Submit</button>
</form>


<!--Table to display events. Will get added via the function addEventTable-->
<table id="eventTable">
</table>


<script>
//Open the events.csv file, and passes the name to addEventTable to add it to the table. 
var txtFile = new XMLHttpRequest();
txtFile.onload = function() {
    allText = txtFile.responseText;
    allTextLines = allText.split(",");

    for(var i = 0; i < allTextLines.length -1; i++) {
        //5 data values in file. So the first in every 5 is the name of the event. (i.e. column 1 of events.csv)
        if (i % 5 == 0){
          var eventName =  allTextLines[i] + "</p>" //Stores event name

          //Call function passing the loop number and the event name
          addEventTable(i,eventName)
          
          //Changes 'info' to display the new range the user should input
          document.getElementById("info").innerHTML = "Please enter a number between 1 and " + ((i/5)+1);
        }
    }
}
//Get the events.csv file - asynchronously
txtFile.open("get", "events.csv", true);
txtFile.send();    
</script>

<script> 
//Had planned on doing an onclick function on the event names to hyperlink to list.php
//But, could figure out how to pass something like id so  it would know which line of the file to print

//Function is called when page is loaded - Ajax
//gets the name of an event, adds new row to a table, and insets it.
function addEventTable(id,eventName) {
  var table = document.getElementById("eventTable");
  var row = table.insertRow(0);
  var cell1 = row.insertCell(0);
  var rowNumber = ((id/5)+1);       //this is to get it to start at one, since the id passed is a multiple of 5
  var link =  "<p>" + rowNumber + ") " +  eventName;
  cell1.innerHTML = link;
}
</script>

<!--Logout -->

<div class="footer">
<form action="logout.php" method="POST">
<input type="submit" name="logout" value="Log Out">
</form>

<p>&copy; 2020 Private Message Limited</p>
</div>

</body>
</html>