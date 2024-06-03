<?php
session_start();
require_once('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("location: admin_login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];
    $action = $_POST['action'];

    if ($action == 'accept') {
        // Move doctor information to doctors_accepted table
        $sql_move = "INSERT INTO doctors_accepted (username, first_name, last_name, certificate_number, email, phone_number, password) 
                     SELECT username, first_name, last_name, certificate_number, email, phone_number, password 
                     FROM doctors WHERE id=$doctor_id";
        mysqli_query($conn, $sql_move);

        // Update doctor's request status
        $sql_update = "UPDATE doctors SET request_status='accepted' WHERE id=$doctor_id";
        mysqli_query($conn, $sql_update);

        echo "Doctor request accepted. Doctor can now login.";
    } elseif ($action == 'reject') {
        // Update doctor's request status
        $sql_update = "UPDATE doctors SET request_status='rejected' WHERE id=$doctor_id";
        mysqli_query($conn, $sql_update);

        echo "Doctor request rejected.";
    }
}
?>
