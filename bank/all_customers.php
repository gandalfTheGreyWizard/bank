<!DOCTYPE html>
<html>
<head>
	<title>
		all customers
	</title>
</head>
<link rel="stylesheet" type="text/css" href="requires/bootstrap.css">
<script type="text/javascript" src="requires/bootstrap.js"></script>
<?php
require_once "log.php";
$conn = new mysqli($hn, $un, $pw, $db);

	$query = "SELECT * FROM customer";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	echo '<table class="table">
		<tr style="background-color:green;"><td>customer name<td>dob<td>address<td>address2<td>city<td>state<td>status';

	for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);

	if($row[9] == 0)
	{
		$status = "dropped";

	}
	else
	{
		$status = "active";
	}

	echo <<<_END
		<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[7]<td>$row[3]<td>$row[4]<td>$status
_END;
	}
?>
<body>

</body>
</html>