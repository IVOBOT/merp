<?php
    // Retrieve the URL variables (using PHP).
    $regName = $_GET['name'];
    $regSurname = $_GET['surnname'];
    $eventId = $_GET['eventId'];
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

$regCode = rand(100000,999999);

$sql = "INSERT INTO reservations (event_id, name, surname, code) VALUES ('$eventId','$regName', 'regSurname', '$regCode') "

$result = mysqli_query($conn, "SELECT * FROM reservations WHERE code = $regCode ");
$n = mysqli_num_rows($result);

if ($n>=1)
{
echo<<<END
<td width="50" align="center" bgcolor="e5e5e5">id</td>
<td width="100" align="center" bgcolor="e5e5e5">eventId</td>
<td width="100" align="center" bgcolor="e5e5e5">Name</td>
<td width="100" align="center" bgcolor="e5e5e5">Surname</td>
<td width="100" align="center" bgcolor="e5e5e5">Code</td>
</tr><tr>
END;
}
	for ($i = 1; $i <= $n; $i++)
	{

		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		$ei = $row['event_id'];
		$na = $row['name'];
		$sn = $row['surname'];
		$cd = $row['code'];

	echo<<<END
	<td width="50" align="center">$id</td>
	<td width="100" align="center">$ei</td>
	<td width="100" align="center">$na</td>
	<td width="100" align="center">$sn</td>
	<td width="100" align="center">$cd</td>
	</tr><tr>
	END;
	}

?>
</tr></table>

<p>

  <a href="/index.php"><button align="center">Go back to events!</button></a>

</body>
</html>
