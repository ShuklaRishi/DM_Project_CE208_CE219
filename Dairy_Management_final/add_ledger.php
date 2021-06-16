<?php
require_once("connection.php");
if (!isset($_SESSION["is_login"]) || $_SESSION['is_login'] != true) {
    header("Location: login.php");
} else {
try {
    if (isset($_POST['submit'])) {
        $id = $_POST["user_id"];
        $rate = $_POST["rate"];
        $o_date = $_POST["o_date"];
        $qty = $_POST["qty"];
        $stmt = $dbhandler->prepare("
                INSERT INTO table_ledger (user_id, o_date, qty, rate) 
                VALUES (:user_id, :o_date, :qty, :rate)
            ");
        $stmt->bindParam(':user_id', $id);
        $stmt->bindParam(':o_date', $o_date);
        $stmt->bindParam(':qty', $qty);
        $stmt->bindParam(':rate', $rate);
        $stmt->execute();
        echo header("Location: view_ledger.php?id=" . $id . "&name=" . $name . "&rate=" . $rate);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
}
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $rate = $_REQUEST['rate'];
}
// else if($_SESSION['role'] = 1)
// {
// 	$id = $_SESSION['session_id'];
// 	$name = $_SESSION['session_name'];
// 	$rate = $_SESSION['session_rate'];
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Diary</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/plus.svg" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <script src="https://kit.fontawesome.com/8ae5744161.js" crossorigin="anonymous"></script>
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
                    <b style="color:azure">Add Ledger for</b> <b style="color:#57b846"> <?php echo $name ?> </b>
                    <hr />
                </span>

                <?php
                if (!isset($id)) {
                    echo 'Please Select User <a href="index.php"><button class="login100-form-btn">Home</button></a>';
                } else {
                ?>
                    <div class="sixth">
                        <div class="login100-form">
                            <form action="" method="POST">
                                <div class="first-1">
                                    <!-- Date: -->
                                    <input  type="hidden" name="user_id" value="<?php echo  $id ?>">
                                    <input  type="hidden" name="rate" value="<?php echo  $rate ?>">
                                    <div class="wrap-input100 validate-input" data-validate="Please Select a Date">
                                        <input class="input100" type="date" name="o_date" placeholder="Select Date">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fas fa-calendar-day" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <!-- <input type="date" name="o_date" required /> -->
                                    <!-- Quantity: -->
                                    <div class="wrap-input100 validate-input" data-validate="Please Enter Quantity">
                                        <input class="input100" type="number" name="qty" placeholder="Enter Quantity">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fas fa-layer-group" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <!-- <input type="number" name="qty" required /> -->
                                </div>
                                <div class="sixth-1">
                                    <a href="#">
                                        <input type="submit" name="submit" value="Submit" style="background-color: #57b846; color:floralwhite; " class="login100-form-btn" />
                                    </a>
                                </div>
                            </form>
                        <?php
                    }
                    
                        ?>

                        <div class="fourth">
                            <a href="logout.php">
                                <button class="login100-form-btn">
                                    Log Out
                                </button>
                            </a>
                        </div>
                        <div class="fifth">
                            <a href="index.php">
                                <button class="login100-form-btn">
                                    Home
                                </button>
                            </a>
                        </div>
                    </div>
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