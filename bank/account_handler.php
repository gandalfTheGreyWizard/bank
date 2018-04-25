<!DOCTYPE html>
<html>
<head>
	<title>
		accounts handler
	</title>
</head>
<link rel="stylesheet" type="text/css" href="requires/bootstrap.css">
<script type="text/javascript" src="requires/bootstrap.js"></script>
<?php
require_once "log.php";
$conn = new mysqli($hn, $un, $pw, $db);

if (!empty($_POST['cus-id'])) {
	$cus_id = $_POST['cus-id'];
	$query = "SELECT * FROM accounts WHERE customer_id = '$cus_id'";
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
	<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[3]<td><form method="post"><button class="btn btn-warning" value="$row[3]" name="del">delete</button></form>
_END;
	}
	echo '</table>';
	# code...
}

if (!empty($_POST['acc-id'])) {
	$acc_id = $_POST['acc-id'];
	$query = "SELECT * FROM accounts WHERE acc_id = '$acc_id'";
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
	<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[3]<td><form method="post"><button class="btn btn-warning" value="$row[3]" name="del">delete</button></form>
_END;
	}
	echo '</table>';
	# code...
}

if(!empty($_POST['del']))
{	$acc_id = $_POST['del'];
	$query = "DELETE FROM accounts where acc_id = $acc_id";
	$conn->query($query);
	echo "account successfully deleted";
}
?>
<body>
	<table width="80%" align="center">
		
		<form method="post">
			<tr><td>customer id:-<td><input type="text" class="form-control" name="cus-id">
			<tr><td>account id:-<td><input type="text" class="form-control" name="acc-id">
				<tr><td colspan="2"><button class="btn btn-default">submit</button>
		</form>
	</table>

</body>
</html>