<html>
<head>
<title>Infotiv Car Rental</title>
</head>
<body>

<h4>Fill out the form below to register a new car</h4>

<FORM NAME ="form1" METHOD ="POST" ACTION = "/infotivCarRental/html/admin/insertInCarIndex.php">

<!--Simple HTML form with fields for each input. The submit button 
calls "insertInCarIndex.php" script that inputs the data in SQL db-->

License Number <INPUT TYPE = "TEXT" required="required" style="text-transform:uppercase" pattern="[A-Za-z]{3}[0-9]{3}$" title="ABC123" maxlength="6" NAME="lcnsNr"><br \>
Make <INPUT TYPE = "TEXT" required="required" NAME="make"><br \>
Model <INPUT TYPE = "TEXT" required="required" NAME="model"><br \>
Passengers <select NAME="passengers" required="required">
  <option value="" selected disabled hidden>Select your option</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
</select></br>
Available <select NAME="avail" required="required">
  <option value="" selected disabled hidden>Select your option</option>
  <option value="yes">Yes</option>
  <option value="no">No</option>
</select></br>
<INPUT TYPE = "submit" Name = "Submit1" VALUE = "Add">
<button id="input" type="button" value="addCar" onclick="location.href='../gui/myPage.php'">Back</button>
</FORM>

</body>
</html>