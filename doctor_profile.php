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
            echo "Pieraksts pievienots!";
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
    <title>Doctor Appointment</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <?php include 'customer_header.php'; ?>

    <section class="profile_container">
        <h2 class="profile_title">Pieteikt pierakstu</h2>
        <div class="profile-details">
            <div class="profile">
                <?php if (!empty($doctor['profile_image'])): ?>
                    <img src="<?php echo htmlspecialchars($doctor['profile_image']); ?>" alt="Profile Photo">
                <?php else: ?>
                    <img src="img/default_photo.png" alt="Default Profile Photo">
                <?php endif; ?>
                <h3><?php echo htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']); ?></h3>
                <p>E-pasts: <?php echo htmlspecialchars($doctor['email']); ?></p>
                <p>Telefona numurs: <?php echo htmlspecialchars($doctor['phone_number']); ?></p>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . htmlspecialchars($doctor_id); ?>" method="post">
                <label for="animal_problem">Pieraksta iemesls:</label>
                <textarea id="animal_problem" name="animal_problem" rows="4" required></textarea>
                <div class="auth-buttons">
                    <button class="button" type="submit">Pieteikt pierakstu</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
