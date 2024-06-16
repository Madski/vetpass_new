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

$animal_type = $row['animal_type'];
$breed = $row['breed'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Animal</title>
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
                    <div class="f_profile_info">
                        <p><b>Dzīvienka tips: </b><?php echo $animal_type; ?></p>
                        <p><b>Šķirne: </b><?php echo $breed; ?></p>
                        <p><b>Vecums: </b></p>
                        <p><b>Dzimums: </b></p>
                        <div class="auth-buttons margin_top_10px">
                            <a href="edit_animal_profile.php" class="button">Labot profilu</a>
                        </div>
                    </div>
               </div>
            </div>
</body>
</html>
