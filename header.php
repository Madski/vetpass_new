<?php
// Check if session is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetPass</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="uploads/vetpass.png" alt="VetPass Logo">
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="doctor_profiles.php">Doctors</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <!-- Add more navigation items as needed -->
                </ul>
            </nav>
            <div class="auth-buttons">
                <?php
                if (isset($_SESSION['customer_name']) || isset($_SESSION['doctor_name'])) {
                    // If a customer or doctor is logged in, display their name and logout button
                    $username = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : $_SESSION['doctor_name'];
                    echo '<p>Welcome, ' . $username . '</p>';
                    echo '<a href="logout.php" class="button">Logout</a>';
                } else {
                    // If no user is logged in, display login and registration buttons
                    echo '<a href="login.php" class="button">Login</a>';
                    echo '<a href="doctor_registration.php" class="button">Register as a doctor</a>';
                    echo '<a href="customer_registration.php" class="button">Register as a customer</a>';
                }

                // Check if the user is logged in as a doctor from doctors_accepted table
                if (isset($_SESSION['doctor_id'])) {
                    // If logged in as a doctor, display a button to doctor_dashboard.php
                    echo '<a href="doctor_dashboard.php" class="button">Doctor Dashboard</a>';
                }
                ?>
            </div>
        </div>
    </header>
</body>
</html>
