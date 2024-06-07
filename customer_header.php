<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>VetPass</title>
    <style>
        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="img/logo.jpg" alt="VetPass Logo">
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="customer_info.php">Profils</a></li>
                    <li><a href="doctor_profiles.php">Veterinārārsti</a></li>
                    <li><a href="customer_info.php">Medicīniskie dati</a></li>
                </ul>
            </nav>
            <div class="auth-buttons">
                    <a href="logout.php" class="button">Izrakstīties</a>

                <?php if (isset($_SESSION['doctor_id'])) : ?>
                    <a href="doctor_dashboard.php" class="button">Doctor Dashboard</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
</body>
</html>
