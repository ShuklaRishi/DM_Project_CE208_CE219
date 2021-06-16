<?php
	session_start();
	if(isset($_GET['token'])){
		$_SESSION['token']=$_GET['token'];
	}
	else{
		echo " done!!";
			if($_POST['Password']!=$_POST['Confirm_Password']){
				echo "Paswords are not matched";
			}
			else{
				require_once "config.php";
				$Password = $_POST['Password'];
				$token =  $_SESSION['token'];
				$query = "UPDATE table_user SET password='$Password' WHERE token = '$token'";
				$result = mysqli_query($conn,$query);
				//redirect to log in page 
				header('Location:login1.php');
			}
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<div>
	<center><h2>Reset your Password</h2>
	<input type="text" name="Password" placeholder="New Password"><br><br>
	<input type="text" name="Confirm_Password" placeholder="Confirm New Password"><br><br>
	<input type="submit" name="submit">
	</center>
	</div>
	</form>
</body>
</html>