<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}

require_once('db_connection.php');

$doctor_id = $_SESSION['doctor_id'];
$sql = "SELECT * FROM doctors_accepted WHERE id=$doctor_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Customer Dashboard</title>
</head>

<?php include('doctor_header.php'); ?>

<body>
    <div class="home_banner_content">
               <div class="f_profile">
                    <div class="f_profile_info">
                        <p><b>Vārds: </b><?php echo $first_name; ?></p>
                        <p><b>Uzvārds: </b><?php echo $last_name; ?></p>
                        <p><b>E-pasts: </b><?php echo $email; ?></p>
                        <div class="auth-buttons margin_top_10px">
                            <a href="edit_profile.php" class="button">Labot profilu</a>
                        </div>
                    </div>
               </div>
    </div>
</body>
</html>
