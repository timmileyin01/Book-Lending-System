<?php


function validateSettingUpdate($setting){
    $errors = array();

    if (empty($setting['title'])) {
        array_push($errors, 'Title is required');
    }

    if (empty($setting['about'])) {
        array_push($errors, 'About is required');
    }
    if (empty($setting['max_upload'])) {
        array_push($errors, 'Max Upload is required');
    }
    if (empty($setting['fine'])) {
        array_push($errors, 'Fine is required');
    }


    
    return $errors;
}


function validateLogoFile($file, $formIndex, $filetype, $filesize){
    $errors = array();

    $thumbnail = $file[$formIndex];
    
    $time = time(); //to make each image name unique
    $thumbnail_name = $time . $thumbnail['name'];
    $thumbnail_tmp_name = $thumbnail['tmp_name'];
    
    

    $allowed_files = $filetype;
    $extension = explode('.', $thumbnail_name);
    
    $extension = end($extension);

    if(!in_array($extension, $allowed_files)) {
        array_push($errors, 'Only JPG, JPEG, PNG, WEBP files allowed');
    }

    if ($thumbnail['size'] > $filesize) {
        array_push($errors, 'file is too large');
    }

    return $errors;
}
