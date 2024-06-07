<?php
session_start();
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['admin_id'] = $row['id'];
        header("location: admin_panel.php");
    } else {
        echo "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Admin Login</title>
</head>
<body>
<div class="login-back">
		<div class="login">
			<div class="home_navigation_logo-arrow">
				<span>
					<a class="material-symbols-outlined arrow" href="index.php">arrow_back</a>
				</span>
				<div class="arrow-text">
					<a class="arrow-href  login-text" href="index.php"> Uz sākumu</a>
				</div>
			</div>

			<div class="login-title">
				<h2>Pieslēgties</h2>
			</div>
    <form action="admin_login.php" method="post">
        <div class="input-group">
            <label for="email">E-pasts:</label><br>
            <input class="form-control" type="email" id="email" name="email" required><br>
        </div>
        
        <div class="input-group">
            <label for="password">Parole:</label><br>
            <input class="form-control" type="password" id="password" name="password" required><br>
        </div>

        <div class="input-group-button">
            <button class="button" type="submit">Pieslēgties</button>
        </div>
    </form>
</div>
</div>
</body>
</html>
