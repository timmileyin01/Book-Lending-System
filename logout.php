<?php
include "./admin/adminDatabase/db.php";


unset($_SESSION['book_user_id']);
unset($_SESSION['book_id_number']);
unset($_SESSION['book_user_role']);

session_destroy();

header('location: ' . "./login.php");
