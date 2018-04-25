<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
</head>
<link rel="stylesheet" type="text/css" href="requires/bootstrap.css">
<script type="text/javascript" src="requires/bootstrap.js"></script>
<style type="text/css">
	.font-left{color: grey;font-size: 20px;font-weight: 2;}
</style>
<?php
require_once "log.php";
$conn = new mysqli($hn, $un, $pw, $db);

$query = "SELECT sr_no FROM customer order by sr_no";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j)
{
$result->data_seek($j);
$row = $result->fetch_array(MYSQLI_NUM);
$sr_no = $row[0];
}

if (!empty($_POST['name']) && !empty($_POST['dob']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['password'])) {
	$name = $_POST['name'];
	$dob = $_POST['dob'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$password = $_POST['password'];
	$pass = $password;
	$status = $_POST['status'];
	$sr_no += 1;
	$customer_id = "cus".$sr_no;
	echo $name."|".$dob."|".$address."|".$city."|".$state."|".$pass;
	$query = "INSERT INTO customer values('$name','$dob','$address','$city','$state','$pass',$sr_no,'$address2','$customer_id',$status)";
	$result = $conn->query($query);
	echo '<h3>Customer Create successfully and customer id is '.$customer_id."</h3> ";



	# code...
}
else{
	echo 'Please insert the create form with all valid details';
}

if(!empty($_POST['user']) && !empty($_POST['passw']))
{
	$user = $_POST['user'];
	$passw = $_POST['passw'];
	$pass = $passw;

	$query = "SELECT * FROM customer WHERE customer_name = '$user'";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	for ($j = 0 ; $j < $rows ; ++$j)
	{
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		$useridis = $row[6];
		echo " ".$pass." ".$row[5]." ";
		$c_name = "userid";
		$useridis = $useridis;
		if($pass == $row[5])
		{
			echo 'login successfull';
			setcookie($c_name,$useridis,time()+3600,'/');
		}
		else
		{
			echo 'no user logged in';
		}
	}

}

?>

<body >
<div class="container-fluid">
	<div class="well">
		<h1 class="text-center" style="color: blue;">LOGIN / SIGN UP PAGE</h1>
	</div>
	<table width="80%" align="center" class="well" >
		<tr><td align="center" colspan="2"><h3 style="color: red;font-weight: 3;">CREATE NEW ACCOUNT</h3>
		<form method="post" action="create_acc.php">
		<tr>	
			<td class="font-left">NAME:-<td><input type="text" name="name" class="form-control" required="required">
		<tr>	<td class="font-left">DOB:-<td><input type="date" name="dob" class="form-control" required="required">
		<tr>	<td class="font-left">ADDRESS:-<td><input type="text" name="address" class="form-control" required="required">
		<tr>	<td class="font-left">ADDRESS LINE 2:-<td><input type="text" name="address2" class="form-control" placeholder="optional">
		<tr>	<td class="font-left">CITY:-<td><input type="text" name="city" class="form-control" required="required">
		<tr>	<td class="font-left">STATE:-<td><input type="text" name="state" class="form-control" required="required">
		<tr>	<td class="font-left">PASSWORD:-<td><input type="text" name="password" class="form-control" required="required">
		<tr><td class="font-left">STATUS:-<td><select name="status">
												<option value="0">dropped</option>
												<option value="1">active</option>


											</select>
			<tr><td align="center" colspan="2"><button class="btn btn-danger" value="submit">CREATE</button>
		</form>
	</table>
	
</div>
</body>
</html>