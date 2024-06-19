<?php
// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the customer is logged in, if not, redirect to the login page
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

// Connect to the database
require_once('db_connection.php');

// Get user information from the database
$customer_id = $_SESSION['customer_id'];
$sql = "SELECT * FROM customers WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $customer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if the query was successful
if (!$result) {
    // Handle error (e.g., log it, display an error message)
    die("Error occurred while fetching customer information");
}

// Fetch user data
$row = mysqli_fetch_assoc($result);

// Close statement and connection
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
<div class="home_banner_content">
    <div class="edit_profile_content">
        <h2>Labot profilu</h2>
        <form action="update_profile.php" method="POST">
            <div class="input-group">
                <label for="name">Vārds:</label><br>
                <input class="form-control" type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['owner_name']); ?>"><br>
            </div>

            <div class="input-group_edit">
                <label for="surname">Uzvārds:</label><br>
                <input class="form-control" type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($row['owner_surname']); ?>"><br>
            </div>

            <div class="input-group_edit">
                <label for="email">E-pasts:</label><br>
                <input class="form-control" type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"><br>
            </div>

            <div class="input-group_edit">
                <label for="phone">Telefona numurs:</label><br>
                <input class="form-control" type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($row['phone_number']); ?>"><br><br>
            </div>

            <div class="input-group">
                <div class="auth-buttons">
                <input type="submit" class="button" value="Saglabāt">
            </div>
        </form>
    </div>
</div>
</body>
</html>
