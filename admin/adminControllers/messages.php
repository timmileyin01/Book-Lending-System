<?php

include(base_app . "adminDatabase/db.php");
include(base_app . "adminHelpers/validateMessage.php");


$table = 'messages';

$messages = selectAll($table);




$errors = array();

$message_id = "";
$sender_id = "";
$receiver_id = "";
$message = "";

if (isset($_GET['message_id'])) {
    $message = selectOne($table, ['message_id' => $_GET['message_id']]);

    $message_id = $message['message_id'];
    $sender_id = $message['sender_id'];
    $receiver_id = $message['receiver_id'];
    $message = $message['message'];
    $date = $message['date'];
}


if (isset($_POST['add-message'])) {

    $errors = validateMessage($_POST);


    if (count($errors) == 0) {
        unset($_POST['add-message']);

        if (count($errors) == 0) {


           
            $_POST['sender_id'] = $_SESSION['book_user_id'];
            $book_id = create($table, $_POST);

            if ($book_id) {
                # code...
                $_SESSION['message'] = 'Message sent successfully';
                $_SESSION['type'] = 'text-success';
                header("location: " . "./notification.php");
                exit();
            }
        }
    } else {
        $message = $_POST['message'];
        $receiver_id = $_POST['receiver_id'];
    }
}
















if (isset($_GET['del_message_id'])) {
    $message_id = $_GET['del_message_id'];
    $thisid = 'message_id';

    
        

        $count = delete($table, $id, $thisid);
    if ($count) {
        $_SESSION['message'] = 'Message Deleted successfully';
        $_SESSION['type'] = 'text-success';

        header("location: " . './notification.php');
        exit();
    } else {
        $_SESSION['message'] = 'Message not Deleted';
        $_SESSION['type'] = 'text-danger';


        header("location: " . './notification.php');
        exit();
    }
}
