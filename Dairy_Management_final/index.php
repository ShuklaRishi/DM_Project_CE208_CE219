<?php
require_once("connection.php");
if (!isset($_SESSION["is_login"]) || $_SESSION['is_login'] != true) {
	header("Location: login.php");
} else {
	$id = $_SESSION['session_id'];
	$role = $_SESSION['session_role'];
	$name = $_SESSION['session_name'];
	$rate = $_SESSION['session_rate'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>My Diary</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/book-solid.svg" />
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
			<div class="wrap-login100-2">

				<span class="login100-form-title-1">
					Welcome<i style="color: #57b846">,</i> <b style="color:#57b846"><?php echo $name; ?> </b>
					<hr />
				</span>

				<div class="sixth">
					<?php
					if ($role == 0) {
					?>
						<div class="eighth">
							<div class="hr-1"></div>
							<table class="login100-form-title" style="color:grey; width:min-content;">
								<thead>
									<tr>
										<th style="text-align:center; color:azure">Name</th>
										<th style=" text-align:center; color:azure">Email</th>
										<th style="text-align:center; color:azure">Mobile</th>
										<th style=" text-align:center; color:azure">Address</th>
										<th style="text-align:center; color:#47abb3">View</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$role = 1;
									$stmt = $dbhandler->prepare("
            				SELECT * FROM table_user 
            				WHERE role=:role
            			");
									$stmt->bindParam(':role', $role);
									$stmt->execute();
									$data = $stmt->fetchAll();
									foreach ($data as $row) {
										echo '<tr>';
										echo '<td style="text-align:center; color: #47abb3; ">' . $row['name'] . '</td>';
										echo '<td>' . $row['email'] . '</td>';
										echo '<td>' . $row['mobile'] . '</td>';
										echo '<td>' . $row['address'] . '</td>';
										echo '<td style="color:red ">';
										echo '<a href="add_ledger.php?id=' . $row['id'] . '&name=' . $row['name'] . '&rate=' . $row['rate'] . '">Add</a> ';
										echo '<a href="view_ledger.php?id=' . $row['id'] . '&name=' . $row['name'] . '&rate=' . $row['rate'] . '">View</a> ';
										echo '</td>';
										echo '</tr>';
										// <i style="color: lightgrey">
									}
									?>
								</tbody>
							</table>
							<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
						</div>
					<?php
					} else {
						echo header("Location: view_ledger.php");
					}
					?>
					<div class=" fourth-1">
						<a href="logout.php">
							<button class="login100-form-btn">
								Log Out
							</button>
						</a>
					</div>
				</div>
				<!-- ///////////////////////////////////////////////////////////////////////////////////////////// -->
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