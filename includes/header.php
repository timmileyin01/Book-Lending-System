<?php

if (!isset($_SESSION['book_user_id'])) {
    header('location: ' . './login.php');
} elseif (isset($_SESSION['book_user_id']) && $_SESSION['book_user_role'] == 'admin') {
    header('location: ' . './admin/');
}elseif (isset($_SESSION['book_user_id']) && $_SESSION['book_user_role'] == 'super_admin') {
    header('location: ' . './super_admin/');
}

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $websiteTitle ?></title>
    
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/catalog.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/cstyles.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="./css/font-awesome.min.css">

</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="welcome.html" class="logo">
                <img src="./admin/uploads/<?= $setting['logo'] ?>" alt="Library Logo">
            </a>
            <ul class="nav-links">
                <li><a href="./">Home</a></li>
                <li><a href="./catalog.php">Books</a></li> 
                <li><a href="./borrowindex.php">Borrowed-Books</a></li> 
                <li><a href="./notification.php">Messages</a></li> 
                <?php if (isset($_SESSION['book_user_id'])) {
                    
                ?>               
                <li><a href="./user-dashboard.php">Dashboard</a></li>                
                <li><a href="./logout.php">Logout</a></li>  
                <?php }else{ ?>              
                <li><a href="./login.php">login</a></li>                
                <li><a href="./register.php">SignUp</a></li>     
                <?php } ?>           
            </ul>
        </div>
    </nav>