<?php

function validateMessage($message){
    $errors = array();

    if (empty($message['message'])) {
        array_push($errors, 'Message is required');
    }

    if (empty($message['receiver_id'])) {
        array_push($errors, 'Select Receiver');
    }

    return $errors;
}



