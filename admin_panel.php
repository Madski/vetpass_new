<?php
session_start();
require_once('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("location: admin_login.php");
}

// Fetch and display doctor requests
$sql = "SELECT * FROM doctors WHERE request_status='pending'";
$result = mysqli_query($conn, $sql);

echo "<h2>Doctor Requests</h2>";
echo "<table border='1'>";
echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Certificate Number</th><th>Email</th><th>Phone Number</th><th>Action</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['username']."</td>";
    echo "<td>".$row['first_name']."</td>";
    echo "<td>".$row['last_name']."</td>";
    echo "<td>".$row['certificate_number']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['phone_number']."</td>";
    echo "<td><form action='admin_response.php' method='post'>";
    echo "<input type='hidden' name='doctor_id' value='".$row['id']."'>";
    echo "<button type='submit' name='action' value='accept'>Accept</button>";
    echo "<button type='submit' name='action' value='reject'>Reject</button>";
    echo "</form></td>";
    echo "</tr>";
}

echo "</table>";
?>
