<?php
session_start();

// Check if the doctor is logged in, if not, redirect to login page
if (!isset($_SESSION['doctor_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
require_once('db_connection.php');

// Check if customer_id is set
if (!isset($_GET['customer_id'])) {
    echo "Customer ID is missing.";
    exit();
}

$customer_id = intval($_GET['customer_id']);

// Fetch customer details from the database
$sql = "SELECT * FROM customers WHERE id=$customer_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    $customer = mysqli_fetch_assoc($result);
} else {
    echo "Error fetching customer details: " . mysqli_error($conn);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Customer Information</h2>
        <?php if ($customer): ?>
            <p><strong>Owner Name:</strong> <?php echo htmlspecialchars($customer['owner_name']); ?></p>
            <p><strong>Owner Surname:</strong> <?php echo htmlspecialchars($customer['owner_surname']); ?></p>
            <p><strong>Animal Type:</strong> <?php echo htmlspecialchars($customer['animal_type']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($customer['phone_number']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['email']); ?></p>
        <?php else: ?>
            <p>Customer details not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
