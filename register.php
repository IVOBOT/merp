<?php
    // Retrieve the URL variables (using PHP).
    $ei = $_GET['eventId'];
?>
<?php
	session_start();
?>

<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"pl-PL\">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>MERP</title>


</head>

<body>

<table width="900" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">
<tr>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MERP";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = mysqli_query($conn, "SELECT * FROM events WHERE id = $ei ");
$n = mysqli_num_rows($result);

if ($n>=1)
{
echo<<<END
<td width="50" align="center" bgcolor="e5e5e5">id</td>
<td width="100" align="center" bgcolor="e5e5e5">title</td>
<td width="100" align="center" bgcolor="e5e5e5">start</td>
<td width="100" align="center" bgcolor="e5e5e5">end</td>
<td width="100" align="center" bgcolor="e5e5e5">thumbnail</td>
</tr><tr>
END;
}
	for ($i = 1; $i <= $n; $i++)
	{

		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		$title = $row['title'];
		$start = $row['start'];
		$end = $row['end'];
		$thumbnail = $row['thumbnail'];

	echo<<<END
	<td width="50" align="center">$id</td>
	<td width="100" align="center">$title</td>
	<td width="100" align="center">$start</td>
	<td width="100" align="center">$end</td>
	<td width="100" align="center">$thumbnail</td>
	</tr><tr>
	END;
	}

?>
</tr></table>

<p>

<form action="/done.php?eventId=$ei" align="center">

  <label for="fname">Name:</label>
  <input type="text" id="name" name="name"><br><br>
  <label for="lname">Surname:</label>
  <input type="text" id="surname" name="surname"><br><br>
  <input type="submit" value="Register!">

</form>

</body>
</html>
