<?php
require_once 'db_connection.php';

$sql = "SELECT * FROM doctors_accepted";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profiles</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include 'customer_header.php'; ?>

    <section class="container"> 
        <div class="container_profiles">
            <div>
                <h2>Veterinārārsti</h2>
            </div>

            <div class="profile_list">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="profile">';
                    if (!empty($row['profile_photo'])) {
                        echo '<img class="image-doctor" src="' . $row['profile_photo'] . '" alt="Profile Photo">';
                    } else {
                        echo '<img src="uploads/doctordefault.webp" alt="Default Profile Photo">';
                    }
                    echo '<h3>' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>';
                    echo '<div class="auth-buttons">
                        <a class="button" href="doctor_profile.php?id=' . $row['id'] . '">Skatīt profilu</a>
                        </div>';
                    echo '</div>';
                }
                ?>
            </div>

        </div>
    </section>

</body>
</html>
