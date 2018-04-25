<!DOCTYPE html>
<html>
<head>
	<title>
		accounts
	</title>
</head>
<link rel="stylesheet" type="text/css" href="requires/bootstrap.css">
<script type="text/javascript" src="requires/bootstrap.js"></script>
<?php
require_once "log.php";
$conn = new mysqli($hn, $un, $pw, $db);

if (!empty($_POST['id'])) {
	$id = $_POST['id'];
	$type = $_POST['type'];
	
	$amount = $_POST['amount'];
	

	$query = "SELECT acc_id FROM accounts order by acc_id";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	$acc_id = $row[0];
	}

	$acc_id += 1;
	$query = "INSERT INTO accounts values('$id','$type',$amount,$acc_id)";
	$conn->query($query);

	echo 'ACCOUNT CREATED SUCCESSFULLY';
	# code...
}
?>
<body>
	<div class="container-fluid">
		<table width="80%" align="center">
			<form method="post">
			<tr><td>customer id:-<td><input type="text" name="id" class="form-control">
			<tr><td>account type:-<td><select name="type" class="form-control">
				<option value="current">current</option>
				<option value="savings">savings</option>
			</select>
			<tr><td>amount:-<td><input type="text" name="amount" class="form-control">
			<tr><td colspan="2"><button class="btn btn-default">submit</button>

		</table>
	</div>

</body>
</html>