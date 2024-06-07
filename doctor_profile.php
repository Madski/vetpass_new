<?php
session_start();
require_once 'db_connection.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $doctor_id = $_GET['id'];
    $sql = "SELECT * FROM doctors_accepted WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $doctor_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $doctor = mysqli_fetch_assoc($result);

    if (!$doctor) {
        echo "Doctor not found.";
        exit();
    }
} else {
    header("Location: doctor_profiles.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $animal_problem = $_POST['animal_problem'];

    if (isset($_SESSION['customer_id'])) {
        $customer_id = $_SESSION['customer_id'];

        $insert_sql = "INSERT INTO visit_requests (doctor_id, customer_id, request_text) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($stmt, "iis", $doctor_id, $customer_id, $animal_problem);
        if (mysqli_stmt_execute($stmt)) {
            echo "Visit request submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Visit Request</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="container">
        <h2>Make Visit Request</h2>
        <div class="profile-details">
            <div class="profile">
                <h3><?php echo htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']); ?></h3>
                <?php if (!empty($doctor['profile_photo'])): ?>
                    <img src="<?php echo htmlspecialchars($doctor['profile_photo']); ?>" alt="Profile Photo">
                <?php else: ?>
                    <img src="uploads/default_profile_photo.jpg" alt="Default Profile Photo">
                <?php endif; ?>
                <p>Email: <?php echo htmlspecialchars($doctor['email']); ?></p>
                <p>Phone Number: <?php echo htmlspecialchars($doctor['phone_number']); ?></p>


                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . htmlspecialchars($doctor_id); ?>" method="post">
                    <label for="animal_problem">Animal Problem:</label><br>
                    <textarea id="animal_problem" name="animal_problem" rows="4" cols="50" required></textarea><br>
                    <button type="submit">Make a Visit</button>
                    <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>">
                </form>
            </div>
        </div>
    </section>
</body>
</html>
