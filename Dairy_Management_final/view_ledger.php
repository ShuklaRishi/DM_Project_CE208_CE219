<?php
require_once("connection.php");
if (!isset($_SESSION["is_login"]) || $_SESSION['is_login'] != true) {
    header("Location: login.php");
}
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $rate = $_REQUEST['rate'];
} else if ($_SESSION['role'] = 1) {
    $id = $_SESSION['session_id'];
    $name = $_SESSION['session_name'];
    $rate = $_SESSION['session_rate'];
}

if (isset($_POST['search'])) {
    $o_month = $_POST["o_month"];
    $o_year = $_POST["o_year"];
} else {
    $o_month = date('m');
    $o_year = date('Y');
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
            <div class="wrap-login100">

                <span class="login100-form-title-1">
                    <b style="color:azure">Ledger for</b> <b style="color:#57b846"> <?php echo $name ?> </b>
                    <hr />
                </span>

                <div class="sixth">
                    <form class="login100-form">
                        <form action="" method="POST">
                            <div class="first">
                                &nbsp&nbsp&nbsp Select Month
                                <select id="o_month" name="o_month">
                                    <option value="01" <?php echo $o_month == '01' ? ' selected' : ''; ?>>January</option>
                                    <option value="02" <?php echo $o_month == '02' ? ' selected' : ''; ?>>February</option>
                                    <option value="03" <?php echo $o_month == '03' ? ' selected' : ''; ?>>March</option>
                                    <option value="04" <?php echo $o_month == '04' ? ' selected' : ''; ?>>April</option>
                                    <option value="05" <?php echo $o_month == '05' ? ' selected' : ''; ?>>May</option>
                                    <option value="06" <?php echo $o_month == '06' ? ' selected' : ''; ?>>June</option>
                                    <option value="07" <?php echo $o_month == '07' ? ' selected' : ''; ?>>July</option>
                                    <option value="08" <?php echo $o_month == '08' ? ' selected' : ''; ?>>August</option>
                                    <option value="09" <?php echo $o_month == '09' ? ' selected' : ''; ?>>September</option>
                                    <option value="10" <?php echo $o_month == '10' ? ' selected' : ''; ?>>October</option>
                                    <option value="11" <?php echo $o_month == '11' ? ' selected' : ''; ?>>November</option>
                                    <option value="12" <?php echo $o_month == '12' ? ' selected' : ''; ?>>December</option>
                                </select>
                                &nbsp&nbsp&nbsp Select Year
                                <select id="o_year" name="o_year">
                                    <option value="2021" <?php echo $o_year == '2021' ? ' selected' : ''; ?>>2021</option>
                                    <option value="2022" <?php echo $o_year == '2022' ? ' selected' : ''; ?>>2022</option>
                                    <option value="2023" <?php echo $o_year == '2023' ? ' selected' : ''; ?>>2023 </option>
                                    <option value="2024" <?php echo $o_year == '2024' ? ' selected' : ''; ?>>2024</option>
                                    <option value="2025" <?php echo $o_year == '2025' ? ' selected' : ''; ?>>2025</option>
                                </select>
                            </div><br>
                            <div class="second">
                                <input type="submit" name="search" value="Search" style="background-color: #57b846; color:floralwhite;" class="login100-form-btn" />
                            </div>
                        </form>

                        <div class="seventh">
                            <div class="hr-1"></div>
                            <table class="login100-form-title" style="color:grey ;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center; color:gainsboro">Date</th>
                                        <th style="text-align:center; color:gainsboro">Qty</th>
                                        <th style="text-align:center; color:gainsboro">Rate</th>
                                        <th style="text-align:center; color:gainsboro">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $dbhandler->prepare("
                                    	SELECT * FROM table_ledger 
                                    	WHERE user_id=:user_id 
                                    	AND MONTH(o_date) = :o_month 
                                    	AND YEAR(o_date) = :o_year 
                                    	ORDER BY o_date DESC
                                    ");
                                    $stmt->bindParam(':user_id', $id);
                                    $stmt->bindParam(':o_month', $o_month);
                                    $stmt->bindParam(':o_year', $o_year);
                                    $stmt->execute();
                                    $data = $stmt->fetchAll();
                                    $total_qty = 0;
                                    $total_rate = 0;

                                    foreach ($data as $row) {
                                        echo '<tr>';
                                        echo '<td>' . $row['o_date'] . '</td>';
                                        echo '<td>' . $row['qty'] . '</td>';
                                        echo '<td>' . $row['rate'] . '</td>';
                                        echo '<td>' . $row['qty'] * $row['rate'] . '</td>';
                                        echo '</tr>';
                                        $total_qty += $row['qty'];
                                        $total_rate += $row['qty'] * $row['rate'];
                                    }
                                    ?>
                                </tbody>
                                </tfoot>
                                <tr>
                                    <th style="text-align:center; color:azure"><b> TOTAL </b></th>
                                    <th style="text-align:center; color:azure"><?php echo $total_qty; ?></th>
                                    <th style="text-align:center; color:azure"><?php echo $rate; ?></th>
                                    <th style="text-align:center; color:azure"><?php echo $total_rate; ?></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <br>
                        <!-- <br><br><br> -->
                        <?php
                        if (!isset($id)) {
                            echo 'Please Select User <a href="index.php"><button class="login100-form-btn">HOME</button></a>';
                        } else {
                            echo '                            
                        <div class="container-login100-form-btn">
                            <div class="third">                                  
                                <a href="add_ledger.php?id=' . $id . '&name=' . $name . '&rate=' . $rate . '">
                                    <button class="login100-form-btn">
                                        Add
                                    </button>
                                </a>
                            </div>
                        </div> <br>'
                        ?>

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