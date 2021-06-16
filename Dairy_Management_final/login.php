<?php
require_once("connection.php");
if (isset($_SESSION["is_login"]) && $_SESSION['is_login'] == true) {
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Page</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
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
			<div class="wrap-login100">

				<span class="login100-form-title-1">
					<b style="color:azure">Diary</b> <b style="color:#57b846">Management</b>
				</span>


				<div class="login100-pic js-tilte" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="" method="POST">
					<span class="login100-form-title">
						<b style="color:azure">Member</b><b style="color:#57b846"> Login</b>
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login" value="Login">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="index1.php">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-65">
						<a class="txt2" href="registeration.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<?php
				try {
					if (isset($_POST['login'])) {
						$username = $_POST["username"];
						$password = $_POST["password"];
						$stmt = $dbhandler->prepare("
                            SELECT * FROM table_user 
                            WHERE username=:username 
                            AND password=:password 
                            LIMIT 1
                        ");
						$stmt->bindParam(':username', $username);
						$stmt->bindParam(':password', $password);
						$stmt->execute();
						$row = $stmt->fetch();
						if ($row) {
							$id = $row['id'];
							$role = $row['role'];
							$name = $row['name'];
							$rate = $row['rate'];
							$_SESSION["is_login"] = true;
							$_SESSION["session_id"] = $id;
							$_SESSION["session_role"] = $role;
							$_SESSION["session_name"] = $name;
							$_SESSION["session_rate"] = $rate;
							header("Location: index.php");
							exit();
						} else {
							// ========================================================
							// ========================================================
							// echo "Invalid Credentials";
						?>
							<div class="login100-form-title">
								<div style="margin-top: -10%;">
								<br><br><br><hr>
								<!-- <br> -->
									<b style="color: #ff0707;">
										<?php
										echo "Invalid Credentials";
										?>
									</b>
									<i style="color:#57b846">
										<?php
										echo ", ";
										?>
										&nbsp
									</i>
									<b style="color:azure">
										<?php
										echo "Please Try Again";
										?>
									</b>
									<!-- <br><br> -->
									<hr>
								</div>
							</div>
						<?php
						}
					}
				} catch (PDOException $e) {
					echo $e->getMessage();
					die();
				}
				?>

			</div>
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