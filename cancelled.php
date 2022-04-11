<?php
    // Retrieve the URL variables (using PHP).
    $regId = $_GET['id'];
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
<link rel="stylesheet" href="style.css">

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

$sql = "DELETE FROM reservations WHERE id=$regId";

if ($conn->query($sql) === TRUE) {
  echo<<<END
  <div align="center"><b><h3>Registration cancelled successfully!</h3></b></div>
  END;
} else {
  echo "Error deleting record: " . $conn->error;
}

  $conn->close();

?>
<p>
<div align="center">
  <a href="/index.php"><button>Go back to events!</button></a>
</div>
</body>
</html>
