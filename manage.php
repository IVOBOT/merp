<?php
    $code = $_GET['c'];
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

$result = mysqli_query($conn, "SELECT * FROM reservations WHERE code=$code"); // WHERE to be added
$n = mysqli_num_rows($result);

if ($n>=1)
{
echo<<<END
<table width="900" align="center" border="1" bordercolor="#d5d5d5" cellpadding="0" cellspacing="0">
<tr>
<td width="100" align="center" bgcolor="e5e5e5">Event Id</td>
<td width="100" align="center" bgcolor="e5e5e5">Name</td>
<td width="100" align="center" bgcolor="e5e5e5">Surname</td>
<td width="100" align="center" bgcolor="e5e5e5">Code</td>
<td width="100" align="center" bgcolor="e5e5e5">Action</td>
</tr><tr>
END;
}
else {
  echo<<<END
  <div align="center"><h3><b>Wrong code!</b></h3></div>
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

    $sql = mysqli_query($conn, "SELECT * FROM events WHERE id=$ei");

  if ($sql->num_rows > 0) {
      while($row = $sql->fetch_assoc()) {
          $regEventTitle = $row["title"];
          $regEventStart = $row["start"];
          $regEventEnd = $row["end"];
          $regEventThumbnail = $row["thumbnail"];
          $formattedStart = strtotime($regEventStart);
          $formattedEnd = strtotime($regEventEnd);
      }
  }
	echo<<<END
	<td width="100" height="50" align="center">$regEventTitle</td>
	<td width="100" height="50" align="center">$na</td>
	<td width="100" height="50" align="center">$sn</td><td width="100" align="center"><b>$cd</b></td><td width="100" align="center"><a href="/cancelled.php?id=$id"><button type="button" id="cancel">Cancel!</button></a></td>
	</tr><tr>
	END;//Do not touch html directly above as some of the tags are somehow vulnerable to tabs and enters (?)
  }
  $conn->close();

?>
<p id="demo">

</p>
<script>

var now = Math.floor( Date.now() / 1000 );
var eventTime = <?php echo $formattedStart ?>;
var eventEnd = <?php echo $formattedEnd ?>;

document.getElementById("demo").innerHTML = (eventEnd-eventTime)/(3600*24);

if(((eventTime - now)/(3600*24))<2 || (eventEnd-eventTime)/(3600*24)>2)
{
  document.getElementById('cancel').setAttribute('disabled','');
}

</script>

</tr></table>
<p>
<div align="center">
  <a href="/index.php"><button>Go back to events!</button></a>
</div>
</body>
</html>
