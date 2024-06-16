<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title>Document</title>
</head>
<body>
<p><a href="logout.php">Logout</a></p>
</body>
</html>
<?php
session_start();
require_once('db_connection.php');

if (!isset($_SESSION['admin_id'])) {
    header("location: admin_login.php");
}

$sql = "SELECT * FROM doctors WHERE request_status='pending'";
$result = mysqli_query($conn, $sql);

echo "<h2 class='admin-panel_h2' >Veterinārārstu pietikumi</h2>";
echo "<div class='table-container'>";
echo "<table border='1'>";
echo "<tr>
        <th>Lietotājvārds</th>
        <th>Vārds</th>
        <th>Uzvārds</th>
        <th>Sertifikāta numurs</th>
        <th>E-pasts</th>
        <th>Telefona numurs</th>
        <th>Akceptēt/Noraidīt</th>
    </tr>";

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
    echo "<button class='admin_button' type='submit' name='action' value='accept'>Akceptēt</button>";
    echo "<button class='admin_button' type='submit' name='action' value='reject'>Noraidīt</button>";
    echo "</form></td>";
    echo "</tr>";
}

echo "</table>";
echo "</div>";
?>
