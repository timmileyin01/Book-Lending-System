<?php
include './admin/constants.php';
include(base_app . "adminControllers/users.php");

$setting = selectOne('settings', ['setting_id' => 1]);

$websiteTitle = $setting['title'];
$websiteAbout = $setting['about'];
$websiteMax_upload = $setting['max_upload'];
$websiteFine = $setting['fine'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $websiteTitle ?> Login</title>
    <link rel="stylesheet" href="./css/lstyles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="nav-container">
            <a href="index.php" class="logo">
                <img src="./admin/uploads/<?= $setting['logo'] ?>" alt="Library Logo">
            </a>
            <ul>
                <li><a href="./index.php">Home</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="form-container register-container">
            <form action="login.php" method="POST">
                <h2>User Login</h2>
                <?php include("./admin/adminHelpers/formErrors.php"); ?>
                <?php include "./admin/adminIncludes/messages.php"; ?>
                <div class="input-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" name="id_number" value="<?= $id_number; ?>" placeholder="Matric No. or Staff ID">
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" value="<?= $password; ?>" placeholder="Password">
                </div>
                <div class="input-group">
                    <button type="submit" name="login-btn" class="btn">Login</button>
                </div>
                <div class="input-group">
                    <span class="text-muted">Not Registered?</span><a href="register.php">Register</a>
                </div>
                <div class="input-group">
                    <span class="text-muted">Forgot Password?</span><a href="forgot-password.php">Reset</a>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="./index.html">Home</a></li>
                    <li><a href="./login.html">About Us</a></li>
                    <li><a href="./register.html">Register</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Contact Us</h3>
                <p>Email: support@library.com</p>
                <p>Phone: +1 234 567 890</p>
                <p>Address: 123 Library St, Booktown</p>
            </div>
            <div class="footer-column">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><img src="./images/Facebook Icon Social Media PNG & SVG Design For T-Shirts.jpg" alt="Facebook"></a>
                    <a href="#"><img src="./images/Premium PSD _ Social media icon twitter 3d.jpg" alt="Twitter"></a>
                    <a href="#"><img src="./images/Instagram PNG - Free Download.jpg" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Library Book Lending System. All rights reserved.</p>
        </div>
    </footer>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>