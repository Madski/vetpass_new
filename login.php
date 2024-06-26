<?php
session_start();

require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql_customer = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
    $result_customer = mysqli_query($conn, $sql_customer);
    $row_customer = mysqli_fetch_assoc($result_customer);

    $sql_doctor = "SELECT * FROM doctors_accepted WHERE email='$email' AND password='$password'";
    $result_doctor = mysqli_query($conn, $sql_doctor);
    $row_doctor = mysqli_fetch_assoc($result_doctor);

    if ($row_customer) {
        $_SESSION['customer_id'] = $row_customer['id'];
        $_SESSION['customer_name'] = $row_customer['name'];
        header("Location: customer_info.php");
        exit();
    } elseif ($row_doctor) {
        $_SESSION['doctor_id'] = $row_doctor['id'];
        $_SESSION['doctor_name'] = $row_doctor['first_name'] . ' ' . $row_doctor['last_name'];
        header("Location: doctor_visit.php");
        exit();
    } else {
        $error_message = "Invalid email or password. Please try again.";
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
    <title>Login</title>
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
                <p style="margin-top: 15px;">epasts: marta@gmail.com</p>
                <p>Parole: marta123</p>
			</div>
			
			<form method="post" action="login.php">
            <?php if (isset($error_message)) { ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
            <?php } ?>
            <form action="login.php" method="post">
                <div class="input-group">
                    <label for="email">E-pasts:</label><br>
                    <input class="form-control" type="email" id="email" name="email" required><br>
                </div>
                <div class="input-group"> 
                    <label for="password">Parole:</label><br>
                    <input class="form-control" type="password" id="password" name="password" required><br>
                </div>
                <div class="input-group-button"> 
                    <button class="button" type="submit" name="login">Pieslēgties</button>
                </div>
            </form>
            <div class="center">
                <p>Neesi vel reģistrēties? <a href="customer_registration.php">Reģistrēties kā lietotājam</a>.</p>
                <p>Neesi vel reģistrējies? <a href="doctor_registration.php">Reģistrēties kā veterinārārstam</a>.</p>
                <p>Esmu administrators! <a href="admin_login.php">Administrators</a>.</p>
            </div>
			</form>
		</div>
	</div>

</body>
</html>
