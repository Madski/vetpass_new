<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

require_once('db_connection.php');

$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * FROM customers WHERE id=$customer_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$name = $row['owner_name'];
$owner_surname = $row['owner_surname'];
$animal_type = $row['animal_type'];
$email = $row['email'];
$number = $row['phone_number'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Customer Dashboard</title>
</head>

<?php include('customer_header.php'); ?>

<body>
    <div class="home_banner_content">
               <div class="f_profile">
                    <nav class="navigation">
                    <ul>
                        <li><a href="customer_info.php" class="f_profile_nav-link">Lietotājs</a></li>
                        <li><a href="animal_info.php"  class="f_profile_nav-link">Dzīvnieks</a></li>
                    </ul>
            </nav>
                    <div class="f_profile_info">
                        <p><b>Vārds: </b><?php echo $name; ?></p>
                        <p><b>Uzvārds: </b><?php echo $owner_surname; ?></p>
                        <p><b>Email: </b><?php echo $email; ?></p>
                        <p><b>Telefona numurs: </b><?php echo $number; ?></p>
                        <div class="auth-buttons margin_top_10px">
                            <a href="edit_profile.php" class="button">Labot profilu</a>
                        </div>
                    </div>
               </div>
    </div>
</body>
</html>
