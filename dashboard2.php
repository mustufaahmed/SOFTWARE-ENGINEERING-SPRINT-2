<?php
	session_start();
	$user_ID = $_SESSION['user_ID'];
	
	$password = "";
	$passErr = "";
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(empty($_POST['user_PASSWORD'])){
			$passErr = "Field is Required";
		}else{
			$password = test_input($_POST['user_PASSWORD']);
		}
	}
	
	//Validation method
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	//Connection to Database
	$database = 'karachireservationclub';
	$host = "localhost";
	$user="root";
	$pass = "";
		//mysqli_connect
	if(empty($_POST['user_PASSWORD'])){
		echo '<script type="text/javascript">
			alert("Fields are Empty");
		</script>';
	}else{
		$db = new mysqli($host,$user,$pass,$database) or die("Unable to Connect");
	
	if($db == true){
		echo "Connection Successfully <br>";
	}
	else{
			echo "no Connection ";
		}
		
		//Sending to database
	$sql = "UPDATE users SET PASSWORD = '$password' WHERE ID = '$user_ID' ";
	
	if($db->query($sql)=== TRUE){
		//echo "New Record Created Successfully";
			echo  "<script>alert('Record Inserted Successfully');</script>";
	}
	else{
		echo  "<script>alert('Error');</script>";
	}
	//database connection closed
	$db->close();
	}	
?>