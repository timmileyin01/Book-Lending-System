<?php

if (!isset($_SESSION['book_user_id'])) {
    header('location: ' . '../login.php');
} elseif (isset($_SESSION['book_user_id']) && $_SESSION['book_user_role'] == 'student') {
    header('location: ' . '../index.php');
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
    <title><?= $websiteTitle ?> Admin Dashboard</title>
    <link rel="stylesheet" href="./css/admin-dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">