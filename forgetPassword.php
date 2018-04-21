<?php
	$ID = $Email = $Email_Change = $ID_Change = "";
	$IDErr = $EmailErr = "";
	
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(empty($_POST["ID_Check"])){
			$IDErr = "ID is Required";
		}
		else{
			$ID = test_input($_POST["ID_Check"]);
		}
		if(empty($_POST["EMAIL_Check"])){
			$EmailErr = "ID is Required";
		}
		else{
			$Email = test_input($_POST["EMAIL_Check"]);
		}
	}else{
		echo '<script>
			alert("Fields are Empty");
		</script>';
	}
	
	//Validation method
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	//Connection to database
	$database = 'karachireservationclub';
	$host = "localhost";
	$user="root";
	$pass = "";
	//Checking of Fields
	if(empty($ID) || empty($Email)){
		echo '<script type="text/javascript">
			alert("Fields are Empty");
		</script>';
	}
	else{
	//mysqli_connect
		$conn = new mysqli($host,$user,$pass,$database) or die("Unable to Connect");
		
		if($conn == true){
		echo "Connection Successfully <br>";
	}
	else{
		echo "no Connection ";
	}
	
	$sql = "SELECT ID,EMAIL FROM users WHERE ID = '$ID' AND EMAIL = '$Email'";
	$result = $conn->query($sql);	
	
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$ID_Change = $row["ID"];
		$Email_Change = $row["EMAIL"];
		}
	}
	//There are Error in this part
	if($ID == $ID_Change && $Email == $Email_Change){
		?>
		<a href="ResetPassword.php?data=<?php echo $ID ?>">Reset Password</a>
	<?php 
		}
	$conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forget Password</title>
</head>
<body>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		<table>
			<tr>
				<td>Write ID</td>
				<td><input type="number" name="ID_Check"></td>
			</tr>
			<tr>
				<td>Write Email</td>
				<td><input type="text" name="EMAIL_Check"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit"/></td>
			</tr>
		</table>
	</form>
</body>
</html>