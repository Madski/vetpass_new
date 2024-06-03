<?php
// Include database connection file
require_once 'db_connection.php';

// Fetch doctors from the doctors_accepted table
$sql = "SELECT * FROM doctors_accepted";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profiles</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Include the header -->
    <?php include 'header.php'; ?>

    <section class="container">
        <h2>Doctor Profiles</h2>
        <div class="profile-list">
            <!-- Display doctor profiles fetched from the database -->
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="profile">';
                echo '<h3>' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>';
                // Display profile photo if available
                if (!empty($row['profile_photo'])) {
                    echo '<img src="' . $row['profile_photo'] . '" alt="Profile Photo">';
                } else {
                    echo '<img src="uploads/doctordefault.webp" alt="Default Profile Photo">';
                }
                echo '<a href="doctor_profile.php?id=' . $row['id'] . '">See Profile</a>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <!-- Footer or additional content can be added here -->

</body>
</html>
