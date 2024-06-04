<?php
session_start();
require_once('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_name = $_POST['owner_name'];
    $owner_surname = $_POST['owner_surname'];
    $animal_type = $_POST['animal_type'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO customers (owner_name, owner_surname, animal_type, phone_number, email, password)
            VALUES ('$owner_name', '$owner_surname', '$animal_type', '$phone_number', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to customer dashboard after successful registration
        header("Location: customer_dashboard.php");
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Customer Registration</title>
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
				<h2> Reģistrēties kā lietotājam </h2>
			</div>
			<form action="customer_registration.php" method="post">

                <div class="input-group">
                    <label for="owner_name">Saimnieka vārds:</label><br>
                    <input class="form-control" type="text" id="owner_name" name="owner_name" required><br>	
                </div>
        
                <div class="input-group">
                    <label for="owner_surname">Saimnieka uzvdārds:</label><br>
                    <input class="form-control" type="text" id="owner_surname" name="owner_surname" required><br>
                </div>
        
                <div class="input-group">
                    <label for="animal_type">Dzīvnieka tips:</label><br>
                    <select class="form-control" id="animal_type" name="animal_type" required>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Hamster">Hamster</option>
                    </select><br>
                </div>

                <div class="input-group">
                    <label for="phone_number">Telefona numurs:</label><br>
                    <input class="form-control" type="tel" id="phone_number" name="phone_number" required><br>
                </div>
                <div class="input-group">
                    <label for="email">E-pasts:</label><br>
                    <input class="form-control" type="email" id="email" name="email" required><br>
                </div>
                
                <div class="input-group">
                    <label for="password">Parole:</label><br>
                    <input class="form-control" type="password" id="password" name="password" required><br>
                </div>

                <div class="input-group-button">
                    <button class="button" type="submit">Reģistrēties</button>  
                </div>
                <div class="center">
                    <p>Esi jau reģistrējies? <a href="login.php">Pieslēgties</a>.</p>
                </div>
            
            </form>
        </div>
	</div>
</body>
</html>
