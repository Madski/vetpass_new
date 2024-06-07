<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['doctor_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visit_request_id = $_POST['visit_request_id'];
    $action = $_POST['action'];

    $sql = "SELECT vr.*, c.id AS customer_id
            FROM visit_requests vr
            INNER JOIN customers c ON vr.customer_id = c.id
            WHERE vr.id = ? AND vr.doctor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $visit_request_id, $doctor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $visit_request = mysqli_fetch_assoc($result);
        $customer_id = $visit_request['customer_id'];

        if ($action == 'accept') {
            $animal_problem = $visit_request['request_text'];
            $status = 'accepted';
            $insert_sql = "INSERT INTO visits_accepted (visit_request_id, doctor_id, customer_id, animal_problem, status, created_at) 
                           VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = mysqli_prepare($conn, $insert_sql);
            mysqli_stmt_bind_param($stmt, "iiiss", $visit_request_id, $doctor_id, $customer_id, $animal_problem, $status);
            mysqli_stmt_execute($stmt);

            $update_sql = "UPDATE visit_requests SET status = 'accepted' WHERE id = ?";
            $stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($stmt, "i", $visit_request_id);
            mysqli_stmt_execute($stmt);
        } elseif ($action == 'deny') {
            $update_sql = "UPDATE visit_requests SET status = 'denied' WHERE id = ?";
            $stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($stmt, "i", $visit_request_id);
            mysqli_stmt_execute($stmt);
        }
    }
}

header("Location: doctor_dashboard.php");
exit();
?>
