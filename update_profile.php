<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

require_once('db_connection.php');

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$customer_id = $_SESSION['customer_id'];

$sql = "UPDATE customers SET owner_name=?, owner_surname=?, email=?, phone_number=? WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssi", $name, $surname, $email, $phone, $customer_id);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    header("Location: customer_info.php?success=1");
    exit();
} else {
    die("Error occurred while updating customer information");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
