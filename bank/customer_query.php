<!DOCTYPE html>
<html>
<head>
	<title>
		customer query
	</title>
</head>
<link rel="stylesheet" type="text/css" href="requires/bootstrap.css">
<script type="text/javascript" src="requires/bootstrap.js"></script>
<?php

require_once "log.php";
$conn = new mysqli($hn, $un, $pw, $db);


if (!empty($_POST['del'])) {
	$id_del = $_POST['del'];
	$query = "DELETE FROM customer WHERE sr_no = $id_del";
	$conn->query($query);
	# code...
}

if(!empty($_POST['id']))
{   $id = $_POST['id'];
	echo $id;
	$query = "SELECT * FROM customer WHERE customer_id = '$id'";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	if($rows < 1)
	{
		echo '<h3>NO SUCH CUSTOER EXISTS';
	}
	echo '<table class="table">
		<tr style="background-color:green;"><td>customer name<td>dob<td>address<td>address2<td>city<td>state<td>';
	for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	echo <<<_END
		<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[7]<td>$row[3]<td>$row[4]<td><form method="post"><button class="btn btn-default" value="$row[6]" name="edit">edit</button></form>

_END;

if($row[9] == 0)
	{
		echo <<<_END
		<td><form method="post"><button class="btn btn-warning" value="$row[6]" name="del">DELETE</button>
_END;
	}
	}
	echo '</table>';

}
if (!empty($_POST['name'])) {
	$name = $_POST['name'];
	$dob = $_POST['dob'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$id_set = $_POST['id_set'];
	echo $id_set;
	$query = "UPDATE customer set customer_name = '$name',dob = '$dob',address = '$address',address2 = '$address2',city='$city',state='$state' WHERE sr_no = $id_set";
	$conn->query($query);
	# code...
}

if (!empty($_POST['ssn'])) {


	$ssn = $_POST['ssn'];
	echo $ssn;
	$query = "SELECT * FROM customer WHERE sr_no = $ssn";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	if($rows < 1)
	{
		echo '<h3>NO SUCH CUSTOER EXISTS';
	}
	echo '<table class="table">
		<tr style="background-color:green;"><td>customer name<td>dob<td>address<td>address2<td>city<td>state';
	for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	echo <<<_END
		<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[7]<td>$row[3]<td>$row[4]<td><form method="post"><button class="btn btn-default" value="$row[6]" name="edit">edit</button></form>
_END;
	if($row[9] == 0)
	{
		echo <<<_END
		<td><form method="post"><button class="btn btn-warning" value="$row[6]" name="del">DELETE</button>
_END;
	}
	}
	echo '</table>';
	
}
if(isset($_POST['edit']))
{
	$id = $_POST['edit'];
	$query = "SELECT * FROM customer WHERE sr_no = $id";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	if($rows < 1)
	{
		echo '<h3>NO SUCH CUSTOER EXISTS';
	}
	echo '<table class="table">';
	for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	echo <<<_END
		<form method="post">
		<tr><td>Customer name:-<td><input type="text" name="name" value="$row[0]">
		<tr><td>Dob:-<td><input type="date" name="dob" value="$row[1]">
		<tr><td>address:-<td><input type="text" name="address" value="$row[2]">
		<tr><td>address2:-<td><input type="text" name="address2" value="$row[7]">
		<tr><td>city:-<td><input type="text" name="city" value="$row[3]">
		<tr><td>state:-<td><input type="text" name="state" value="$row[4]">
		<input type="hidden" value=$id name="id_set">
		<tr><td>
		<button class="btn btn-default">submit</button>
		</form>
_END;
	}
	echo '</table>';
	


}
?>
<body>
<div class="container-fluid">
	<table width="80%" class="well" align="center">
		<tr><td colspan="2"><h1>Customer Query Page</h1>
		<form method="post">
		<tr><td>CUSTOMER ID:-<td><input type="text" name="id" class="form-control">
		<tr><td>CUSTOMER SSN:-<td><input type="text" name="ssn" class="form-control">
		<tr><td colspan="2">	<button class="btn btn-warning">SUBMIT</button>
		</form>
	</table>
	
</div>

</body>
</html>