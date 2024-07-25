<?php
include './admin/constants.php';
include(base_app . "adminControllers/users.php");


$setting = selectOne('settings', ['setting_id' => 1]);

$websiteTitle = $setting['title'];
$websiteAbout = $setting['about'];
$websiteMax_upload = $setting['max_upload'];
$websiteFine = $setting['fine'];

function passwordReset($reset){
    $errors = array();
    
    if (empty($reset['code'])) {
        array_push($errors, 'You have not provided a reset code');
    }
    if (empty($reset['password'])) {
        array_push($errors, 'You have not entered a password');
    }
    if (empty($reset['confirmpassword'])) {
        array_push($errors, 'You need to confirm password');
    }

    if($reset['confirmpassword'] !== $reset['password']){
        array_push($errors, 'Passwords do not match');
    }

    if(strlen($reset['password']) < 6){
        array_push($errors, 'Password is too short (6+)');
    }


    return $errors;
}


$code = "";
$password = "";
$confirmpassword = "";



if (isset($_POST['update-btn'])) {
    $errors = passwordReset($_POST);


    if (count($errors) === 0) {
        $confirmCode = selectOne('reset', ['id_number' => $_SESSION['reset_id_number']]);
        $confirm_id = $confirmCode['reset_id'];
        if ($confirmCode) {
            $codedata = $confirmCode['code'];
            if ($_POST['code'] == $codedata) {
                unset($_POST['update-btn'], $_POST['confirmpassword'], $_POST['code']);
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $get_id = selectOne('users', ['id_number' => $_SESSION['reset_id_number']]);

                $id = $get_id['user_id'];
                $thisid = 'user_id';
                $thisid1 = 'reset_id';



                $user_id = update('users', $id, $thisid, $_POST);
                $delete_reset = delete('reset', $confirm_id, $thisid1);

                unset($_SESSION['reset_id_number']);

                $_SESSION['message'] = 'Password Updated successfully';
                $_SESSION['type'] = 'success';


                header("location: " . './login.php');
                exit();
            } else {
                array_push($errors, 'Invalid reset code ppp');
                $code = $_POST['code'];
                $password = $_POST['password'];
                $confirmpassword = $_POST['confirmpassword'];
            }
        } else {
            array_push($errors, 'Kindly request for reset code');
            $code = $_POST['code'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];
        }
    } else {
        $code = $_POST['code'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
    }
}







?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $websiteTitle ?> Reset Password</title>
    <link rel="stylesheet" href="./css/lstyles.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-container register-container">

            <h2>Reset Password</h2>

            <?php include "./admin/adminHelpers/formErrors.php"; ?>
            <?php include "./admin/adminIncludes/messages.php"; ?>

            <form action="password.php" method="post">
                <div class="input-group">
                    <label for="user_id">Reset Code <?= $_SESSION['reset_id_number'] ?></label>
                    <input type="text" name="code" value="<?= $code; ?>" placeholder="Enter Reset Code" required>
                </div>
                <div class="input-group">
                    <label for="user_id">Reset Code</label>
                    <input type="password" name="password" value="<?= $password; ?>" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <label for="user_id">Reset Code</label>
                    <input type="password" name="confirmpassword" value="<?= $confirmpassword; ?>" placeholder="Confirm Password" required>
                </div>
                <div>
                    <button type="submit" name="update-btn" class="btn">Reset</button>
                </div>
                <div class="input-group">
                    <span class="text-muted">Not Registered?</span><a href="register.php">Register</a>
                </div>
                <div class="input-group">
                    <span class="text-muted">Forgot Password?</span><a href="forgot-password.php">Reset</a>
                </div>
                <div class="input-group">
                    <a href="login.php">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>