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

//echo "Connected successfully";

/*
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["id"]. " - Name: ". $row["title"]. " " . $row["start"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();

*/

$result = mysqli_query($conn, "SELECT * FROM events");
$n = mysqli_num_rows($result);

if ($n>=1)
{
echo<<<END
<td width="50" align="center" bgcolor="e5e5e5">id</td>
<td width="100" align="center" bgcolor="e5e5e5">title</td>
<td width="100" align="center" bgcolor="e5e5e5">start</td>
<td width="100" align="center" bgcolor="e5e5e5">end</td>
<td width="100" align="center" bgcolor="e5e5e5">thumbnail</td>
<td width="100" align="center" bgcolor="e5e5e5">register</td>
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
	<td width="100" align="center"><img width="100" src="/$id/$thumbnail"></td>
	<td width="100" align="center"><a href="/register.php?eventId=$id"><button>Join!</button></a></td>
	</tr><tr>
	END;
	}
	$conn->close();

?>


</tr></table>
</body>
</html>
