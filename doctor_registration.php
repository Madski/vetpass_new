<?php
session_start();
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $certificate_number = $_POST['certificate_number'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Insert data into the doctors table with request status pending
    $sql = "INSERT INTO doctors (username, first_name, last_name, certificate_number, email, phone_number, password, request_status)
            VALUES ('$username', '$first_name', '$last_name', '$certificate_number', '$email', '$phone_number', '$password', 'pending')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to waiting screen
        header("Location: waiting_screen.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
</head>
<body>
    <h2>Doctor Registration</h2>
    <form id="registrationForm" action="doctor_registration.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>

        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="certificate_number">Certificate Number:</label><br>
        <input type="text" id="certificate_number" name="certificate_number" required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="tel" id="phone_number" name="phone_number" required><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>

        <button type="submit" id="submitButton">Register as Doctor</button>
    </form>

    <div id="approvalMessage" style="display: none;">
        <p id="countdownText">You have been accepted! Please log in.</p>
        <p id="countdown"></p>
    </div>

    <script>
        // Function to start countdown
        function startCountdown(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    window.location.href = 'login.php';
                }
            }, 1000);
        }

        // Function to show approval message and start countdown
        function showApprovalMessage() {
            document.getElementById("registrationForm").style.display = "none";
            document.getElementById("approvalMessage").style.display = "block";
            var countdownDisplay = document.getElementById("countdown");
            var fiveMinutes = 60 * 5;
            startCountdown(fiveMinutes, countdownDisplay);
        }

        // Check if approval message needs to be shown (You can adjust the condition based on your implementation)
        <?php if (isset($_GET['accepted']) && $_GET['accepted'] == 'true') { ?>
            showApprovalMessage();
        <?php } ?>
    </script>
</body>
</html>