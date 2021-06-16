<?php
require_once("connection.php");
if (isset($_SESSION["is_login"]) && $_SESSION['is_login'] == true) {
	header("Location: index.php");
} else {
    try
    {
        if(isset($_POST['submit']))
        {
            $name=$_POST["name"];
            $username=$_POST["username"];
            $password=$_POST["password"];
            $email=$_POST["email"];
            $mobile=$_POST["mobile"];
            $address=$_POST["address"];
            $role=$_POST["role"];
            $rate=$_POST["rate"];
            $stmt = $dbhandler->prepare("
                                        SELECT * FROM table_user 
                                        WHERE username=:username 
                                        LIMIT 1
            ");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $row = $stmt->fetch();
            if($row)
            {
                header("Location: registeration.php?message=Username Already Taken Please Resubmit Form");
            }
            else{				
				$str=rand();
				$token = md5($str);
				echo $token;
				
                $stmt = $dbhandler->prepare("
                    INSERT INTO table_user (name, username, password, email, mobile, address, role, rate, token) 
                    VALUES (:name, :username, :password, :email, :mobile, :address, :role, :rate, :token)
                ");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':mobile', $mobile);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':rate', $rate);
                $stmt->bindParam(':token', $token);
				
                $stmt->execute();
                echo "<br><br>";
                // echo "You are registered Now you can login ";
                header("Location: registration.php?message=You are registered Now you can login ");
                // echo "<a href='login.php'>Login</a>";
            }             
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
        die();
    }
}

?>
<?php
if (isset($_REQUEST['message'])) {
	echo $_REQUEST["message"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Registration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<script src="https://kit.fontawesome.com/8ae5744161.js" crossorigin="anonymous"></script>
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/register_icon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<form class="wrap-login100-1 validate-form" action="" method="POST">


				<span class="login100-form-title" style="color:darkgray">
					<h2><b style="color:azure">Sign</b> <b style="color:#57b846">Up</b></h2>
				</span>

				<!-- ============================================================== -->

				<div class="login100-pic-1 js-tilte" data-tilt>
					<img src="images/registration.png" alt="IMG">
				</div>

				<div class="login100-form validate-form" >
					<div class="wrap-input100 validate-input" data-validate="Please enter your Name">
						<input class="input100" type="text" name="name" placeholder="Name" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-signature" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<input class="input100" type="text" name="username" placeholder="Username"  value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password"  value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" placeholder="Email"  value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter valid number">
						<input class="input100" type="number" name="mobile" placeholder="Mobile Number"  value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-phone-alt" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Address is required">
						<input class="input100" type="text" name="address" placeholder="Address"  value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-map-marker" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter valid Rate">
						<input class="input100" type="number" name="rate" placeholder="Rate"  value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fas fa-dollar-sign" aria-hidden="true"></i>
						</span>
					</div>
				</div>
				<hr /><br><br><br>

				<!-- ============================================================== -->

				<!-- <table> -->
				<div class="container-login100-form-btn">
					<div class="nine" style="color:grey; font-family: Poppins-Bold;">
						<label class="container">Admin
							<input type="radio" name="role" id="admin" value="0">
							<span class="checkmark"></span>
						</label>
					</div>
					<div class="ten" style="color:grey ; font-family: Poppins-Bold;">
						<label class="container">User
							<input type="radio" name="role" id="user" value="1" checked=checked>
							<span class="checkmark"></span>
						</label>
					</div>
				</div>

				<!-- ============================================================== -->

				<table>
					<tr>
							<div class="container-login100-form-btn">
								<button class="login100-form-btn" name="submit" value="Register">
									Register
								</button>
							</div>

							<div class="text-center p-t-10" style="padding-left: 310px;">
								<a class="txt2" href="login.php">
									Go Back to Login
									<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
								</a>
							</div>
					</tr>
				</table>
			</form>
		</div>
	</div>


	

	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>