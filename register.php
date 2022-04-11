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

    <link rel="stylesheet" href="style.css">

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
<td width="100" align="center" bgcolor="e5e5e5">Title</td>
<td width="100" align="center" bgcolor="e5e5e5">Start date</td>
<td width="100" align="center" bgcolor="e5e5e5">End date</td>
<td width="100" align="center" bgcolor="e5e5e5">Thumbnail</td>
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
	<td width="100" align="center">$title</td>
	<td width="100" align="center">$start</td>
	<td width="100" align="center">$end</td>
	<td width="100" align="center"><img width="100" src="/$id/$thumbnail"></td>
	</tr><tr>
	END;
	}
  $conn->close();

?>
</tr></table>

<form action="/done.php" align="center">
  <h3>Put your registration data here:</h3>
<?php
  echo<<<END
  <input type="hidden" id="eventId" name="eventId" value=$ei>
  END;
?>
  <label for="name">Name:</label>
  <input type="text" name="n"><br><br>
  <label for="surname">Surname:</label>
  <input type="text" name="s"><br><br>
  <input type="submit" value="Register!">

</form>

</body>
</html>
