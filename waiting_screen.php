<?php
session_start();
require_once('db_connection.php');

// Pārbauda vai ārsta reģistrācija ir pieņemts
if(isset($_GET['id'])) {
    $doctor_id = $_GET['id'];
    $sql_check_status = "SELECT request_status FROM doctors WHERE id = '$doctor_id'";
    $result_check_status = mysqli_query($conn, $sql_check_status);

    if (mysqli_num_rows($result_check_status) > 0) {
        $row = mysqli_fetch_assoc($result_check_status);
        if ($row['request_status'] === 'accepted') {
            header("Location: login.php?accepted=true");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting for Approval</title>
</head>
<body>
    <h2>Waiting for Approval</h2>
    <p>Your registration request has been submitted. Please wait for admin approval.</p>

    <script>
        // Function to periodically check the status and redirect if accepted
        function checkStatusAndRedirect(doctorId) {
            setInterval(function() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        if (response.status === 'accepted') {
                            window.location.href = 'login.php?accepted=true';
                        }
                    }
                };
                xhr.open('GET', 'check_status.php?id=' + doctorId, true);
                xhr.send();
            }, 5000); 
        }


        var doctorId = '<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>';
        if (doctorId !== '') {
            checkStatusAndRedirect(doctorId);
        }
    </script>
</body>
</html>
