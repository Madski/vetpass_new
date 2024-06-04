<?php
session_start();
require_once('db_connection.php');

// Pārbauda vai ārsta reģistrācija ir pieņemta
if(isset($_GET['id'])) {
    $doctor_id = $_GET['id'];
    $sql_check_status = "SELECT request_status FROM doctors WHERE id = '$doctor_id'";
    $result_check_status = mysqli_query($conn, $sql_check_status);

    if ($result_check_status) {
        $row = mysqli_fetch_assoc($result_check_status);
        if ($row['request_status'] === 'accepted') {
            // Redirect the doctor to the login page
            header("Location: login.php?accepted=true");
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
