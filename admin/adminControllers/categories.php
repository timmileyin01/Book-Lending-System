<?php


include (base_app . "adminDatabase/db.php");
include (base_app . "adminHelpers/validateCategory.php");



$table = 'categories';

$errors = array();
$id = '';
$name = '';
$description = '';



$categories = selectAll($table);



if (isset($_POST['add-category'])) {
    $errors = validateCategory($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-category']);
        $category_id = create($table, $_POST);
        $_SESSION['message'] = 'Category created successfully';
        $_SESSION['type'] = 'text-success';
        header('location: ' . './category.php');
        exit();
    }else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
    
}



if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];
    $category = selectOne($table, ['category_id' => $id]);

    $category_id = $category['category_id'];
    $name = $category['name'];
    $description = $category['description'];
}

if (isset($_GET['del_category_id'])) {
    $id = $_GET['del_category_id'];


    $count = deleteCat($table, $id);

    if ($count) {
      

        $_SESSION['message'] = 'Category Deleted successfully';
        $_SESSION['type'] = 'text-success';


        header("location: " . './category.php');
        exit();
    } else {
        $_SESSION['message'] = 'Category not Deleted';
        $_SESSION['type'] = 'text-danger';


        header("location: " . './category.php');
        exit();
    }
}




if (isset($_POST['update-category'])) {
    $errors = validateCategoryUpdate($_POST);

    if (count($errors) === 0) {
        $id = $_POST['category_id'];
        unset($_POST['update-category'], $_POST['category_id']);
        updateCat($table, $id, $_POST);
        
        $_SESSION['message'] = 'Category Updated successfully';
        $_SESSION['type'] = 'text-success';
        header('location: ' . './category.php');
        exit();
    }else {
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
   
}

