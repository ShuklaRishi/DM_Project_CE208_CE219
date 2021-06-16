<?php
session_start();
include_once 'config.php';
if(isset($_POST['submit']))
{
  isset($cOTLdata['char_data']);
  $len = isset($cOTLdata['char_data']) ? count($cOTLdata['char_data']) : 0;

  $username = $_POST['username'];
  $result = mysqli_query($conn,"SELECT * FROM table_user where username='" . $_POST['username'] . "'");
  $row = mysqli_fetch_assoc($result); 

	$username=$row['username'];
	$email=$row['email'];
  $token = $row['token'];
  if($username==$username) {
    $to = $email;
    $txt = "Hi, $username. Click http://localhost/DM/PHP/CE208_Lab11_KEVAL_DM/Dairy_Management/reset_password.php?token=$token to reset the password";
    $headers = "From: kvpatel1682001@gmail.com";
    $subject = "Reset Password";
    
    $msg=mail($to,$subject,$txt,$headers);
    if($msg){
      // header("Location: index1.php?message=Password link sent ");
      $_SESSION['msg'] = 'Password link sent';
    }
    else{
    echo "Mail was not sent!!";			
  }
  } 
		else{
			echo 'Invalid Username';
		}
}
//echo phpinfo();
?>
<!DOCTYPE HTML>
<html>
<head>
<style type="text/css">
 input{
 border:1px solid olive;
 border-radius:5px;
 }
 h1{
  color:darkgreen;
  font-size:22px;
  text-align:center;
 }

</style>
</head>
<body><br><br>
<h1>Reset Password<h1>
<form action='' method='post'>
<table cellspacing='5' align='center'>
<tr><td>Username:</td><td><input type='text' name='username'/></td></tr>
<tr><td></td><td><input type='submit' name='submit' value='Submit'/></td></tr>
</table>
</form>
</body>