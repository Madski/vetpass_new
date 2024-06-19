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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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
                    if (!empty($row['profile_image'])) {  // Izmanto 'profile_image' kolonnas nosaukumu
                        echo '<img class="image-doctor" src="' . $row['profile_image'] . '" alt="Profile Photo">';
                    } else {
                        echo '<img class="image-doctor" src="img/default_photo.png" alt="Default Profile Photo">';
                    }
                    echo '<h3>' . $row['first_name'] . ' ' . $row['last_name'] . '</h3>';
                    echo '<div class="auth-buttons button-container">
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
