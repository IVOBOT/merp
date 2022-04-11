<?php
    // Retrieve the URL variables (using PHP).
    $regName = $_GET['n'];
    $regSurname = $_GET['s'];
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

$regCode = rand(100000,999999);

$sql = "INSERT INTO reservations VALUES (NULL, '$eventId','$regName', '$regSurname', '$regCode')";

if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$result = mysqli_query($conn, "SELECT * FROM reservations WHERE code=$regCode"); // WHERE to be added
$n = mysqli_num_rows($result);

if ($n>=1)
{
echo<<<END
<td width="100" align="center" bgcolor="e5e5e5">Event Id</td>
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
	<td width="100" align="center">$ei</td>
	<td width="100" align="center">$na</td>
	<td width="100" align="center">$sn</td>
	<td width="100" align="center"><b>$cd</b></td>
	</tr><tr>
	END;
	}
  $conn->close();

?>
</tr></table>
<p>
<div align="center">
  <a href="/index.php"><button>Go back to events!</button></a>
</div>
</body>
</html>
