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

$owner_name = $row['owner_name'] . ' ' . $row['owner_surname'];
$animal_type = $row['animal_type'];
$email = $row['email'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
</head>

<?php include('customer_header.php'); ?>

<body>
    <h2>Welcome, <?php echo $owner_name; ?>!</h2>
    <p>Email: <?php echo $email; ?></p>
    <p>Animal Type: <?php echo $animal_type; ?></p>

    <h3>Customer Dashboard</h3>
    <ul>
        <li><a href="view_appointments.php">View Appointments</a></li>
        <li><a href="manage_pets.php">Manage Pets</a></li>
    </ul>
</body>
</html>
