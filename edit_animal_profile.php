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
$sql = "SELECT * FROM customers WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $customer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Error occurred while fetching customer information");
}

$row = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Edit Profile</title>
</head>

<?php include('customer_header.php'); ?>

<body>
    <div class="edit_profile_content">
        <h2>Edit Profile</h2>
        <form action="update_profile.php" method="POST">
            <label for="name">Dzīvienka tips:</label><br>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['animal_type']); ?>"><br>
        
            
            <input type="submit" value="Save Changes">
        </form>
    </div>
</body>
</html>
