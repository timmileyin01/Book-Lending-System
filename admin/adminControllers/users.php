<?php

include(base_app . "adminDatabase/db.php");
include(base_app . "adminHelpers/validateUser.php");

$errors = array();

$lastname = "";
$firstname = "";
$email = "";
$user_role = "";
$phonenumber = "";

$id_number = "";
$password = "";
$passwordConf = "";

$table = 'users';

$users = selectAll($table);


if (isset($_GET['user_id'])) {
    $user = selectOne($table, ['user_id' => $_GET['user_id']]);
    $user_id = $user['user_id'];
    $lastname = $user['lastname'];
    $firstname = $user['firstname'];
    $email = $user['email'];
    $phonenumber = $user['phonenumber'];
    $user_role = $user['user_role'];

    $id_number = $user['id_number'];
}

if (isset($_POST['edit-account'])) {
    $_SESSION['update_my_profile'] = $_POST['user_id'];
    $user = selectOne($table, ['user_id' => $_SESSION['update_my_profile']]);
    $lastname = $user['lastname'];
    $firstname = $user['firstname'];
    $email = $user['email'];
    $phonenumber = $user['phonenumber'];
    $user_role = $user['user_role'];

    $id_number = $user['id_number'];
}


if (isset($_GET['del_user_id'])) {
    $user_id = $_GET['del_user_id'];
    $thisid = 'user_id';


    $user = selectOne($table, ['user_id' => $user_id]);


    $count = delete($table, $user_id, $thisid);

    if ($count) {
        $_SESSION['message'] = 'User Deleted successfully';
        $_SESSION['type'] = 'text-success';


        header("location: " . './manage-users.php');
        exit();
    } else {
        $_SESSION['message'] = 'User not Deleted';
        $_SESSION['type'] = 'text-danger';


        header("location: " . './manage-users.php');
        exit();
    }
}



function loginUser($user)
{
    $_SESSION['book_user_id'] = $user['user_id'];
    $_SESSION['book_id_number'] = $user['id_number'];

    if ($user['user_role'] == 'admin') {
        $_SESSION['book_user_role'] = 'admin';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'text-success';


        header('location: ' . './admin/');

        exit();
    } elseif ($user['user_role'] == 'student') {
        $_SESSION['book_user_role'] = 'student';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'text-success';


        header('location: ' . './');

        exit();
    }elseif ($user['user_role'] == 'super_admin') {
        $_SESSION['book_user_role'] = 'super_admin';
        $_SESSION['message'] = 'Welcome, ' . $user['firstname'];
        $_SESSION['type'] = 'text-success';


        header('location: ' . './admin');

        exit();
    }
}

if (isset($_POST['login-btn'])) {
    $errors = validateLogin($_POST);

    if (count($errors) === 0) {
        $user = selectOne($table, ['id_number' => $_POST['id_number']]);


        if ($user && password_verify($_POST['password'], $user['password'])) {
            loginUser($user);
        } else {
            array_push($errors, 'wrong credentials');
        }
    }

    $id_number = $_POST['id_number'];
    $password = $_POST['password'];
}










if (isset($_POST['register'])) {
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $verify =  selectOne('users', ['id_number' => $id_number]);
    $verify1 =  selectOne('users', ['email' => $email]);
    $verify2 =  selectOne('users', ['phonenumber' => $phonenumber]);
    $password1 = $_POST['password'];
    $password1_hash = $_POST['passwordConf'];
    if (!$verify && !$verify1 && !$verify2) {
        $errors = validateRegister($_POST);
        unset($_POST['register'], $_POST['passwordConf']);
        if (count($errors) === 0) {
            $password_hash = $_POST['password'];
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user_id = create($table, $_POST);



            $login = selectOne($table, ['id_number' => $id_number]);
            loginUser($login);
        } else {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $phonenumber = $_POST['phonenumber'];
            $id_number = $_POST['id_number'];
            $password = $password1;
            $passwordConf = $password1_hash;
        }
    } else {
        array_push($errors, "You have already Registered");
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $id_number = $_POST['id_number'];
        $password = $password1;
        $passwordConf = $password1_hash;
    }
}






if (isset($_POST['add-user'])) {
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $verify =  selectOne('users', ['id_number' => $id_number]);
    $verify1 =  selectOne('users', ['email' => $email]);
    $verify2 =  selectOne('users', ['phonenumber' => $phonenumber]);
    $password1 = $_POST['password'];
    $password1_hash = $_POST['passwordConf'];
    if (!$verify && !$verify1 && !$verify2) {
        $errors = validateUser($_POST);
        unset($_POST['add-user'], $_POST['passwordConf']);
        if (count($errors) === 0) {
            $password_hash = $_POST['password'];
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user_id = create($table, $_POST);
            if ($user_id) {
                $_SESSION['message'] = 'User added Successfully';
                $_SESSION['type'] = 'text-success';


                header('location: ' . './manage-users.php');

                exit();
            } else {
                array_push($errors, "Something went wrong!");
                $lastname = $_POST['lastname'];
                $firstname = $_POST['firstname'];
                $email = $_POST['email'];
                $phonenumber = $_POST['phonenumber'];
                $id_number = $_POST['id_number'];
                $password = $password1;
                $passwordConf = $password1_hash;
            }
        } else {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $phonenumber = $_POST['phonenumber'];
            $id_number = $_POST['id_number'];
            $password = $password1;
            $passwordConf = $password1_hash;
        }
    } else {
        array_push($errors, "User exists!");
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $id_number = $_POST['id_number'];
        $password = $password1;
        $passwordConf = $password1_hash;
    }
}







if (isset($_POST['edit-user'])) {
    $user_id = $_POST['user_id'];
    $thisid = 'user_id';
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password1 = $_POST['password'];
    $password1_hash = $_POST['passwordConf'];
    
  
        $errors = validateUserUpdate($_POST);
        if (count($errors) === 0) {
            if (!empty($_POST['password'])) {
                unset($_POST['edit-user'], $_POST['passwordConf'], $_POST['user_id']);
                $password_hash = $_POST['password'];
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $user_id = update($table, $user_id, $thisid, $_POST);
                if ($user_id) {
                    $_SESSION['message'] = 'User updated Successfully';
                    $_SESSION['type'] = 'text-success';


                    header('location: ' . './manage-users.php');

                    exit();
                } else {
                    array_push($errors, "Something went wrong!");
                    $lastname = $_POST['lastname'];
                    $firstname = $_POST['firstname'];
                    $email = $_POST['email'];
                    $phonenumber = $_POST['phonenumber'];
                    $user_role = $_POST['user_role'];
                    $user_id = $_POST['user_id'];
                    $id_number = $_POST['id_number'];
                    $password = $password1;
                    $passwordConf = $password1_hash;
                }
            } else {
                unset($_POST['edit-user'], $_POST['passwordConf'], $_POST['password'], $_POST['user_id']);
                /* dd($_POST); */
                $user_id = update($table, $user_id, $thisid, $_POST);
                if ($user_id) {
                    $_SESSION['message'] = 'User updated Successfully';
                    $_SESSION['type'] = 'text-success';


                    header('location: ' . './manage-users.php');

                    exit();
                } else {
                    array_push($errors, "Something went wrong!");
                    $user_id = $_POST['user_id'];
                    $lastname = $_POST['lastname'];
                    $firstname = $_POST['firstname'];
                    $email = $_POST['email'];
                    $phonenumber = $_POST['phonenumber'];
                    $user_role = $_POST['user_role'];
                    $id_number = $_POST['id_number'];
                    $password = $password1;
                    $passwordConf = $password1_hash;
                }
            }
        } else {
            $user_id = $_POST['user_id'];
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $phonenumber = $_POST['phonenumber'];
            $user_role = $_POST['user_role'];
            $id_number = $_POST['id_number'];
            $password = $password1;
            $passwordConf = $password1_hash;
        }
}




if (isset($_POST['update-profile'])) {
    $user_id = $_SESSION['update_my_profile'];
    $thisid = 'user_id';
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $password1 = $_POST['password'];
    $password1_hash = $_POST['passwordConf'];
    
  
        $errors = validateUserUpdate($_POST);
        if (count($errors) === 0) {
            if (!empty($_POST['password'])) {
                unset($_POST['update-profile'], $_POST['passwordConf'], $_POST['user_id'], $_SESSION['update_my_profile']);
                $password_hash = $_POST['password'];
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $user_id = update($table, $user_id, $thisid, $_POST);
                if ($user_id) {
                    $_SESSION['message'] = 'Profile updated Successfully';
                    $_SESSION['type'] = 'text-success';


                    header('location: ' . './user-dashboard.php');

                    exit();
                } else {
                    array_push($errors, "Something went wrong!");
                    $lastname = $_POST['lastname'];
                    $firstname = $_POST['firstname'];
                    $email = $_POST['email'];
                    $phonenumber = $_POST['phonenumber'];
                    $user_role = $_POST['user_role'];
                   
                    $id_number = $_POST['id_number'];
                    $password = $password1;
                    $passwordConf = $password1_hash;
                }
            } else {
                unset($_POST['update-profile'], $_POST['passwordConf'], $_POST['password'], $_POST['user_id'], $_SESSION['update_my_profile']);
            
                $user_id = update($table, $user_id, $thisid, $_POST);
                if ($user_id) {
                    $_SESSION['message'] = 'Profile updated Successfully';
                    $_SESSION['type'] = 'text-success';


                    header('location: ' . './user-dashboard.php');

                    exit();
                } else {
                    array_push($errors, "Something went wrong!");
                    $lastname = $_POST['lastname'];
                    $firstname = $_POST['firstname'];
                    $email = $_POST['email'];
                    $phonenumber = $_POST['phonenumber'];
                    $user_role = $_POST['user_role'];
                    $id_number = $_POST['id_number'];
                    $password = $password1;
                    $passwordConf = $password1_hash;
                }
            }
        } else {
            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $phonenumber = $_POST['phonenumber'];
            $user_role = $_POST['user_role'];
            $id_number = $_POST['id_number'];
            $password = $password1;
            $passwordConf = $password1_hash;
        }
}
