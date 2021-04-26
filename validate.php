<?php
ob_start();
session_start(); 


include("config.php");

	$username = $_POST['username'];
	$password = base64_encode ($_POST['password']);
	

	$sql = "SELECT * FROM super_admin_login WHERE email = '$username' AND password = '$password' Limit 1";

	$result= mysqli_query($db,$sql);
	$count=mysqli_num_rows($result);


	
	if($count>0)
	{
		
		while($row=mysqli_fetch_array($result,MYSQLI_BOTH)) 
		{
			$_SESSION['user_id'] = $row['user_id'];			
			$_SESSION['email'] = $row['email'];
			$_SESSION['phone'] = $row['phone'];
			$_SESSION['image_path'] = $row['image_path'];
			$_SESSION['name'] = $row['first_name']." ".$row['last_name'];
		
		}
		
		 header("Location: index.php".'?id='.$_SESSION['user_id'] );

		exit;	
		
	}
	else{
		echo "<script>alert('Wrong Credxential');window.location ='login.php'</script>";
				exit;

	}


ob_flush();

?>