<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include './admin/constants.php';
include(base_app . "adminControllers/users.php");


function randNo($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = "";

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}


$id_number = "";

if (isset($_POST['reset-btn'])) {
    if (!empty($_POST['id_number'])) {
        $thisid = 'reset_id';
        $_SESSION['reset_id_number'] = $_POST['id_number'];
        $confirm = selectOne('users', ['id_number' => $_POST['id_number']]);
        if ($confirm) {
            $email_send = $confirm['email'];
            $firstname_send = $confirm['firstname'];
            $id_number_email = $_POST['id_number'];
            unset($_POST['reset-btn']);
            $randomNo = randNo(6);

            $_POST['code'] = $randomNo;

            $existing = selectOne('reset', ['id_number' => $_POST['id_number']]);

            if ($existing) {
                $id = $existing['reset_id'];
                $update_reset = update("reset", $id, $thisid, $_POST);

                require("PHPMailer/src/Exception.php");
                require("PHPMailer/src/PHPMailer.php");
                require("PHPMailer/src/SMTP.php");



                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'oluwaseyitimm02@gmail.com';                     //SMTP username
                    $mail->Password   = 'jizdzdhkwmvfyvya';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('oluwaseyitimm02@gmail.com', 'Book Lending System');
                    $mail->addAddress($email_send, $firstname_send);     //Add a recipient




                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML


                    $mail->Subject = 'Password Reset for ' . $id_number_email;
                    $mail->Body    = '<p>Your Password Reset Code is : <b style="font-size:30px;">' . $randomNo . '</b> It can only be used once <br /><br /> Ignore if you did not request for a password reset';




                    $mail->send();

                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

                $_SESSION['message'] = 'A Reset code has been sent to your mail';
                $_SESSION['type'] = 'success';


                header("location: " . './password.php');
                exit();
            } else {
                $create_reset = create('reset', $_POST);

                require("PHPMailer/src/Exception.php");
                require("PHPMailer/src/PHPMailer.php");
                require("PHPMailer/src/SMTP.php");



                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'oluwaseyitimm02@gmail.com';                     //SMTP username
                    $mail->Password   = 'jizdzdhkwmvfyvya';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('oluwaseyitimm02@gmail.com', 'Book Lending System');
                    $mail->addAddress($email_send, $firstname_send);     //Add a recipient




                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML


                    $mail->Subject = 'Password Reset for ' . $id_number_email;
                    $mail->Body    = '<p>Your Password Reset Code is : <b style="font-size:30px;">' . $randomNo . '</b> <br /><br /> Ignore if you did not request for a password reset';




                    $mail->send();

                    //echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                $_SESSION['message'] = 'A Reset code has been sent to your mail';
                $_SESSION['type'] = 'success';


                header("location: " . './password.php');
                exit();
            }
        } else {
            array_push($errors, 'No Data Found');
            $id_number = $_POST['id_number'];
        }
    } else {
        array_push($errors, 'You need to enter Matric ID or Staff ID');
    }
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

            <form action="forgot-password.php" method="post">
                <div class="input-group">
                    <label for="user_id">User ID:</label>
                    <input type="text" name="id_number" required value="<?= $id_number; ?>" placeholder="Enter Matric No. or Staff ID to reset">
                </div>
                <div>
                    <button type="submit" name="reset-btn" class="btn">Reset</button>
                </div>
                <div class="input-group">
                    <span class="text-muted">Not Registered?</span><a href="register.php">Register</a>
                </div>
                <div class="input-group">
                    <a href="login.php">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>