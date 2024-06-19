<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}

require_once('db_connection.php');

$doctor_id = $_SESSION['doctor_id'];
$sql = "SELECT * FROM doctors_accepted WHERE id=$doctor_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$profile_image = isset($row['profile_image']) ? $row['profile_image'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_image'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['profile_image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES['profile_image']['tmp_name']);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['profile_image']['size'] > 10000000) { // 500KB
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            // Save the file path to the database
            $sql = "UPDATE doctors_accepted SET profile_image='$target_file' WHERE id=$doctor_id";
            if (mysqli_query($conn, $sql)) {
                // Update profile image variable
                $profile_image = $target_file;
                echo "The file " . htmlspecialchars(basename($_FILES['profile_image']['name'])) . " has been uploaded.<br>";
            } else {
                echo "Sorry, there was an error updating your profile.<br>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Customer Dashboard</title>
</head>

<?php include('doctor_header.php'); ?>

<body>
    <div class="home_banner_content">
        <div class="f_profile">
            <div class="f_profile_info">
                <p><b>Vārds: </b><?php echo $first_name; ?></p>
                <p><b>Uzvārds: </b><?php echo $last_name; ?></p>
                <p><b>E-pasts: </b><?php echo $email; ?></p>
                <p><b>Profila attēls: </b></p>
                <?php if ($profile_image): ?>
                    <img src="<?php echo $profile_image; ?>" alt="Profila attēls" style="max-width: 150px;">
                <?php else: ?>
                    <p>Profila attēls nav pievienots.</p>
                <?php endif; ?>
            </div>
            <div class="f_profile_upload">
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="profile_image">Augšupielādēt profila attēlu:</label>
                    <input type="file" name="profile_image" id="profile_image">
                    <input type="submit" value="Augšupielādēt attēlu" name="submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
