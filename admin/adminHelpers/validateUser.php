<?php



function validateLogin($user){
    $errors = array();

    if (empty($user['id_number'])) {
        array_push($errors, 'Matric no. or Staff id. is required');
    }

    if (empty($user['password'])) {
        array_push($errors, 'Password required');
    }
    return $errors;
}





function validateUser($user){

    $errors = array();

    if (empty($user['lastname'])) {
        array_push($errors, 'Lastname is required');
    }

    if(empty($user['firstname'])){
        array_push($errors, 'Firstname is required');
    }
    if(empty($user['user_role'])){
        array_push($errors, 'User role is required');
    }

    if(strlen($user['id_number']) > 10){
        array_push($errors, 'Username must not be more 10 Characters');
    }

    if(empty($user['phonenumber'])){
        array_push($errors, 'Phone Number is required');
    }

    if(empty($user['email'])){
        array_push($errors, 'Email is required');
    }

    if(empty($user['password'])){
        array_push($errors, 'Password is required');
    }


    if(strlen($user['password']) < 6){
        array_push($errors, 'Password is too short (6+)');
    }

    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $user['email'])){
        array_push($errors, 'Invalid Email');
    }

    if($user['passwordConf'] !== $user['password']){
        array_push($errors, 'Passwords do not match');
    }

    

    return $errors;
}

function validateUserUpdate($user){

    $errors = array();

    if (empty($user['lastname'])) {
        array_push($errors, 'Lastname is required');
    }

    if(empty($user['firstname'])){
        array_push($errors, 'Firstname is required');
    }
    if(empty($user['user_role'])){
        array_push($errors, 'User role is required');
    }

    if(strlen($user['id_number']) > 10){
        array_push($errors, 'Username must not be more 10 Characters');
    }

    if(empty($user['phonenumber'])){
        array_push($errors, 'Phone Number is required');
    }

    if(empty($user['email'])){
        array_push($errors, 'Email is required');
    }

    if(!empty($user['password'])){
        if(strlen($user['password']) < 6){
            array_push($errors, 'Password is too short (6+)');
        }

        if($user['passwordConf'] !== $user['password']){
            array_push($errors, 'Passwords do not match');
        }
    }

    $verify =  selectOne('users', ['id_number' => $user['id_number']]);
    $verify1 =  selectOne('users', ['email' => $user['email']]);
    $verify2 =  selectOne('users', ['phonenumber' => $user['phonenumber']]);

   
    if($verify && $verify['user_id'] != $user['user_id']) {
        array_push($errors, 'User already exists');
    }elseif($verify1 && $verify1['user_id'] != $user['user_id']) {
        array_push($errors, 'User already exists');
    }elseif($verify2 && $verify2['user_id'] != $user['user_id']) {
        array_push($errors, 'User already exists');
    }


    

    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $user['email'])){
        array_push($errors, 'Invalid Email');
    }

    

    return $errors;
}

function validateRegister($user){

    $errors = array();

    if (empty($user['lastname'])) {
        array_push($errors, 'Lastname is required');
    }

    if(empty($user['firstname'])){
        array_push($errors, 'Firstname is required');
    }

    if(strlen($user['id_number']) > 10){
        array_push($errors, 'Username must not be more 10 Characters');
    }

    if(empty($user['phonenumber'])){
        array_push($errors, 'Phone Number is required');
    }

    if(empty($user['email'])){
        array_push($errors, 'Email is required');
    }

    if(empty($user['password'])){
        array_push($errors, 'Password is required');
    }


    if(strlen($user['password']) < 6){
        array_push($errors, 'Password is too short (6+)');
    }

    if(!preg_match("/^[\w\-]+@[\w\-]+.[\w\-]+$/", $user['email'])){
        array_push($errors, 'Invalid Email');
    }

    if($user['passwordConf'] !== $user['password']){
        array_push($errors, 'Passwords do not match');
    }

    

    return $errors;
}






function validateFile($file, $formIndex, $filetype, $filesize){
    $errors = array();

    $thumbnail = $file[$formIndex];
    
    $time = time(); //to make each image name unique
    $thumbnail_name = $time . $thumbnail['name'];
    $thumbnail_tmp_name = $thumbnail['tmp_name'];
    
    

    $allowed_files = $filetype;
    $extension = explode('.', $thumbnail_name);
    
    $extension = end($extension);

    if(!in_array($extension, $allowed_files)) {
        array_push($errors, 'Only jpg, jpeg, webp, png files allowed');
    }

    if ($thumbnail['size'] > $filesize) {
        array_push($errors, 'file is too large');
    }

    return $errors;
}