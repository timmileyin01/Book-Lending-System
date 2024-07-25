<?php


include(base_app . "adminDatabase/db.php");
include(base_app . "adminHelpers/validateSetting.php");



$table = 'settings';

$errors = array();
$setting_id = '';
$websiteTitle = '';
$websiteAbout = '';
$websiteMax_upload = '';
$websiteFine = '';









if (isset($_POST['update-setting'])) {

    $errors = validateSettingUpdate($_POST);
    $setting_id = $_POST['setting_id'];
    $formIndex1 = 'logo';

    $filetype1 = ['jpg', 'jpeg', 'png', 'webp'];



    $file_s = selectOne('settings', ['setting_id' => 1]);
    $filesize = $file_s['max_upload'];

    if (!empty($_FILES['logo']['name'])) {
        $file_name = time() . '_' . $_FILES['logo']['name'];
        $destination = base_app . "uploads/" . $file_name;
        $errors = validateLogoFile($_FILES, $formIndex1, $filetype1, $filesize);
        if (count($errors) == 0) {
            $result1 = move_uploaded_file($_FILES['logo']['tmp_name'], $destination);

            if ($result1) {
                $_POST['logo'] = $file_name;
                if (count($errors) == 0) {

                    $thisid = 'setting_id';

                    $post = selectOne($table, ['setting_id' => $setting_id]);
                    $file1 = $post['logo'];
                    $path1 = (base_app . 'uploads/') . $file1;
                    if (file_exists($path1)) {
                        unlink($path1);
                    }

                    unset($_POST['update-setting'], $_POST['setting_id']);

                    $department_id = update($table, $setting_id, $thisid, $_POST);
                    $_SESSION['message'] = 'Setting Updated successfully';
                    $_SESSION['type'] = 'text-success';
                    header("location: " . "./");
                    exit();
                } else {
                    $setting_id = $_POST['setting_id'];
                    $websiteTitle = $_POST['title'];
                    $websiteAbout = $_POST['about'];
                    $websiteMax_upload = $_POST['max_upload'];
                    $websiteFine = $_POST['fine'];
                }
            } else {
                array_push($errors, "Failed to Upload book File");
                $setting_id = $_POST['setting_id'];
                $websiteTitle = $_POST['title'];
                $websiteAbout = $_POST['about'];
                $websiteMax_upload = $_POST['max_upload'];
                $websiteFine = $_POST['fine'];
            }
        }
    } else if (empty($_FILES['cover']['name'])) {
        if (count($errors) == 0) {

            $thisid = 'setting_id';

            unset($_POST['update-setting'], $_POST['setting_id']);


            $department_id = update($table, $setting_id, $thisid, $_POST);
            $_SESSION['message'] = 'Setting Updated successfully';
            $_SESSION['type'] = 'text-success';
            header("location: " . "./");
            exit();
        } else {
            $setting_id = $_POST['setting_id'];
            $websiteTitle = $_POST['title'];
            $websiteAbout = $_POST['about'];
            $websiteMax_upload = $_POST['max_upload'];
            $websiteFine = $_POST['fine'];
        }
    }
}
