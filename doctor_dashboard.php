<?php
session_start();

if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}

require_once('db_connection.php');

$doctor_id = $_SESSION['doctor_id'];
$sql = "SELECT * FROM doctors_accepted WHERE id=$doctor_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$doctor_name = $row['first_name'] . ' ' . $row['last_name'];
$email = $row['email'];
$profile_photo = $row['profile_photo'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_first_name = $_POST['first_name'];
    $new_last_name = $_POST['last_name'];
    $new_email = $_POST['email'];
    
    if ($_FILES['profile_photo']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
        move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file);
        $new_profile_photo = $target_file;
    } else {
        $new_profile_photo = $profile_photo;
    }
    
    $update_sql = "UPDATE doctors_accepted SET first_name='$new_first_name', last_name='$new_last_name', email='$new_email', profile_photo='$new_profile_photo' WHERE id=$doctor_id";
    mysqli_query($conn, $update_sql);
    
    header("Location: doctor_dashboard.php");
    exit();
}

$visit_requests_sql = "SELECT * FROM visit_requests WHERE doctor_id = $doctor_id";
$visit_requests_result = mysqli_query($conn, $visit_requests_sql);

if (!$visit_requests_result) {
    die('Invalid query: ' . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Doctor Dashboard</title>
</head>
<body>
<?php include 'doctor_header.php'; ?>
    <div class="container">
        <h3>Edit Your Information</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="first_name">First Name:</label><br>
            <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>"><br>

            <label for="last_name">Last Name:</label><br>
            <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>"><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"><br>

            <!-- Add more fields for additional information -->

            <label for="profile_photo">Profile Photo:</label><br>
            <input type="file" id="profile_photo" name="profile_photo" onchange="previewProfilePhoto(event)"><br>
            <img id="profile_photo_preview" src="<?php echo $profile_photo; ?>" alt="Profile Photo"><br>

            <button type="submit">Update Information</button>
        </form>

        <!-- Visit Requests section -->
        <h3>Visit Requests</h3>
        <?php
// Display visit requests
if (mysqli_num_rows($visit_requests_result) > 0) {
    echo '<ul>';
    while ($visit_request_row = mysqli_fetch_assoc($visit_requests_result)) {
        echo '<li>';
        echo '<strong>Request:</strong> ' . $visit_request_row['request_text'];
        echo '<br>';
        // Check if the request has already been accepted
        if ($visit_request_row['status'] == 'accepted') {
            echo '<p>Request has been accepted!</p>';
        } else {
            // Add accept and deny buttons
            echo '<form action="process_visit_request.php" method="post">';
            echo '<input type="hidden" name="visit_request_id" value="' . $visit_request_row['id'] . '">';
            echo '<button type="submit" name="action" value="accept">Accept</button>';
            echo '<button type="submit" name="action" value="deny">Deny</button>';
            echo '</form>';
        }
        // Button to view more information about the customer
        echo '<form action="customer_info.php" method="get">';
        echo '<input type="hidden" name="customer_id" value="' . $visit_request_row['customer_id'] . '">';
        echo '<button type="submit">View Customer</button>';
        echo '</form>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No visit requests.</p>';
}
        ?>
    </div>


    <script>
        // Function to preview profile photo
        function previewProfilePhoto(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('profile_photo_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>
