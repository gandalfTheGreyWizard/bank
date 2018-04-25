<!DOCTYPE html>
<html>
<head>
	<title>
		all accounts
	</title>
</head>
<link rel="stylesheet" type="text/css" href="requires/bootstrap.css">
<script type="text/javascript" src="requires/bootstrap.js"></script>
<body>
<?php
require_once "log.php";
$conn = new mysqli($hn, $un, $pw, $db);


$query = "SELECT * FROM accounts";
	$conn->query($query);
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	echo '<table width="100%" ><tr style="background-color:green;color:white;"><td>customer id<td>type<td>amount<td>account id';
	for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	echo <<<_END
	<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[3]
_END;
	}
	echo '</table>';


?>

</body>
</html>