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
	echo '<table width="100%" class="table"><tr style="background-color:green;color:white;"><td>customer id<td>type<td>amount<td>account id';
	for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	echo <<<_END
	<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[3]<td><form method="post"><button class="btn btn-warning" value="$row[3]" name="del">deposit</button><input type="hidden" value="$row[2]" name="amount_early"></form>

	<td><form method="post"><button class="btn btn-warning" value="$row[3]" name="dela">withdraw</button>
	<input type="hidden" value="$row[2]" name="amount_early">
	</form>

	<td><form method="post"><button class="btn btn-warning" value="$row[0]" name="tran">transfer</button>
	<input type="hidden" value="$row[2]" name="amount_early">
	<input type="hidden" value="$row[3]" name="account_id">
	</form>

	<td><form method="post" ><button class="btn btn-default" name="statement" value="$row[3]">Statement</button></form>
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
	echo '<table width="100%" class="table"><tr style="background-color:green;color:white;"><td>customer id<td>type<td>amount<td>account id';
	for ($j = 0 ; $j < $rows ; ++$j)
	{
	$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_NUM);
	echo <<<_END
	<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[3]<td><form method="post"><button class="btn btn-warning" value="$row[3]" name="del">deposit</button>
	<input type="hidden" value="$row[2]" name="amount_early">
	</form>

	<td><form method="post"><button class="btn btn-warning" value="$row[3]" name="dela">withdraw</button>
	<input type="hidden" value="$row[2]" name="amount_early">
	</form>

	<td><form method="post"><button class="btn btn-warning" value="$row[0]" name="tran">transfer</button>
	<input type="hidden" value="$row[2]" name="amount_early">
	<input type="hidden" value="$row[3]" name="account_id">
	</form>

	<td><form method="post" ><button class="btn btn-default" name="statement" value="$row[3]">Statement</button></form>
_END;
	}
	echo '</table>';
	# code...
}
if (!empty($_POST['del'])) {

	$id = $_POST['del'];
	$amount_early = $_POST['amount_early'];
	echo <<<_END
	<form method="post">
	ENTER AMOUNT TO DEPOSIT:-<input type="text" name="deposit">
	<input type="hidden" value="$amount_early" name="amount_early">
	<input type="hidden" value="$id" name="id">

	<button class="btn btn-default">deposit</button>
	</form>
_END;
}

if (!empty($_POST['dela'])) {

	$id = $_POST['dela'];
	$amount_early = $_POST['amount_early'];
	echo <<<_END
	<form method="post">
	ENTER AMOUNT TO DEPOSIT:-<input type="text" name="withdraw">
	<input type="hidden" value="$amount_early" name="amount_early">
	<input type="hidden" value="$id" name="id">

	<button class="btn btn-default">withdraw</button>
	</form>
_END;
}

if(!empty($_POST['statement']))
{
	$id = $_POST['statement'];
	echo <<<_END
	<form method="post" >
	select N nos of last statements<select name="days" class="form-control">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
	</select>
	<input type="hidden" name="state_id" value="$id">
	<button class="btn btn-danger">SEE STATEMENT</button>
	</form>

_END;
}

if(!empty($_POST['days']))
{
	$days = $_POST['days'];
	$id = $_POST['state_id'];
	$query = "SELECT * FROM AccountHistory WHERE acc_id = $id order by date desc";
	$conn->query($query);
	$result = $conn->query($query);
	$rows = $result->num_rows;
	if($rows < $days){$days = $rows;}
	if($rows != 0){
	if (!$result) die ("Database access failed: " . $conn->error);
	echo '<table width="100%" class="table"><tr style="background-color:green;color:white;"><td>account id<td>type<td>amount<td>date';
	for ($j = 0 ; $j < $days ; ++$j)
	{	$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo <<<_END
		<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[3]
_END;

	}
	echo '</table>';}
	else{echo '<h4>no history yet</h4>';}

}
if(!empty($_POST['tran']))
{	
	$id = $_POST['tran'];
	$target_id = $_POST['account_id'];
	$target_amount = $_POST['amount_early'];
	$query = "SELECT * FROM accounts WHERE customer_id = '$id' AND acc_id != '$target_id'";
	$conn->query($query);
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
	echo '<h3>Choose Source account</h3><table class="table" width="100%" ><tr style="background-color:green;color:white;"><td>customer id<td>type<td>capital<td>account id';
	for ($j = 0 ; $j < $rows ; ++$j)
	{	$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_NUM);
		echo <<<_END
		<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[3]<td>
		<form method="post">
		<input type="hidden" value="$row[3]" name="src_id">
		<input type="hidden" value="$row[2]" name="src_amount">
		<input type="hidden" value="$target_amount" name="trg_amount">
		<input type="hidden" value="$target_id" name="trg_id">
		amount<input type="text" name="amount_tran">
		<button class="btn btn-default">Transfer</button>
		</form>
_END;
	}
	echo '</table>';
}
if(!empty($_POST['src_id'])){
	$src_id = $_POST['src_id'];
	$trg_id = $_POST['trg_id'];
	$src_amount = $_POST['src_amount'];
	$target_amount = $_POST['trg_amount'];
	$tran_amount = $_POST['amount_tran'];
	if($src_amount > $tran_amount)
	{
		$src_new_amount = $src_amount - $tran_amount;
		$target_new_amount = $target_amount + $tran_amount;
		$query = "UPDATE accounts SET amount = $src_new_amount WHERE acc_id = $src_id";
		$query2 = "UPDATE accounts SET amount = $target_new_amount WHERE acc_id = $trg_id";
		$conn->query($query);
		$conn->query($query2);
		$dateis = date('d:m:y-h:i:sa');
		$query3 = "INSERT INTO AccountHistory values($trg_id,'deposit',$target_new_amount,'$dateis')";
		$conn->query($query3);
		echo <<<_END
		<table width="80%" align="center" class="table">
		<tr><td style="background-color:green;color:white;">source id<td>$src_id<td style="background-color:green;color:white;">target id<td>$trg_id
		<tr><td style="background-color:green;color:white;">sorce balance before transfer<td>$src_amount<td style="background-color:green;color:white;">target balance before transfer<td>$target_amount
		<tr><td style="background-color:green;color:white;">sorce balance after transfer<td>$src_new_amount<td style="background-color:green;color:white;">target balance after transfer<td>$target_new_amount
		</table>

_END;

	}
	else{
		echo 'Not enough money in source account';
	}


}
if(!empty($_POST['deposit'])){
	$amount_early = $_POST['amount_early'];
	$amount_add = $_POST['deposit'];
	$final_amount = $amount_add + $amount_early;
	$id = $_POST['id'];
	$query = "UPDATE accounts SET amount = $final_amount WHERE acc_id = $id";
	$conn->query($query);
	echo 'earlier the amount was '.$amount_early.' and now the amount is '.$final_amount;
	$dateis = date('d:m:y-h:i:sa');
	$query3 = "INSERT INTO AccountHistory values($id,'deposit',$final_amount,'$dateis')";
	$conn->query($query3);

}

if(!empty($_POST['withdraw'])){
	$amount_early = $_POST['amount_early'];
	$amount_add = $_POST['withdraw'];
	if($amount_early > $amount_add){
	$final_amount = $amount_early - $amount_add;
	$id = $_POST['id'];
	$query = "UPDATE accounts SET amount = $final_amount WHERE acc_id = $id";
	$conn->query($query);
	echo 'earlier the amount was '.$amount_early.' and now the amount is '.$final_amount;
	}
	else{echo '<h3>Not Enough money please try smaller amount';}
	$dateis = date('d:m:y-h:i:sa');
	$query3 = "INSERT INTO AccountHistory values($id,'withdraw',$final_amount,'$dateis')";
	$conn->query($query3);
	

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