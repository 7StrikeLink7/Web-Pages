<?php session_start();
if(!isset($_SESSION["loggedin"])) header("Location: session.php");
if($_SESSION["loggedin"]===FALSE) header("Location: session.php");
?>

<!DOCTYPE html>
<html>
<head>
</head>


<body>

 
<div class="header"> <h1> List of Events: </h1></div>
<p id="demo">Click me.</p>

<table id="eventTable">

</table>

<button type="button" onclick="myFunction3()">Try it</button>

<script> //plan: remove hyperlink - onlick instead to pass id value as session and take to event page.
function myFunction3(id,link2) {
  var table = document.getElementById("eventTable");
  var row = table.insertRow(0);
  var cell1 = row.insertCell(0);
  var link1 = "<p id=";
  var link = link1 + id + link2;

  //document.write(link);
  cell1.innerHTML = link;
}
</script>






<script>
//Open file and split text. 
var txtFile = new XMLHttpRequest();
txtFile.onload = function() {
    allText = txtFile.responseText;
    allTextLines = allText.split(",");

    for(var i = 0; i < allTextLines.length; i++) {
        if (i % 5 == 0){
            
            var link2 = "><a href=display.php>" + allTextLines[i] + "</a></p>"
            
            //document.body.innerHTML += ("<p><a href=display.php>" + allTextLines[i] + "</a></p>");
            myFunction3(i,link2)

        }
    }
}


txtFile.open("get", "events.csv", true);
txtFile.send();    


//Making the id demo have an onclick function
document.getElementById("demo").addEventListener("click", myFunction);
function myFunction() {
  document.getElementById("demo").innerHTML = "YOU CLICKED ME!";
}

</script>
</body>
</html>