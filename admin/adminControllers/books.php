<?php




include(base_app . "adminDatabase/db.php");
include(base_app . "adminHelpers/validateBook.php");


$table = 'books';

$books = selectAll($table);




$errors = array();

$book_id = "";
$title = "";
$author = "";
$description = "";
$publisher = "";
$category_id = "";
$isbn = "";
$quantity = "";

if (isset($_GET['book_id'])) {
    $book = selectOne($table, ['book_id' => $_GET['book_id']]);

    $book_id = $book['book_id'];
    $title = $book['title'];
    $description = $book['description'];
    $author = $book['author'];
    $publisher = $book['publisher'];
    $category_id = $book['category_id'];
    $isbn = $book['isbn'];
    $quantity = $book['quantity'];
    $cover = $book['cover'];
}


if (isset($_POST['add-book'])) {

    $errors = validateBook($_POST);

    $formIndex1 = 'cover';

    $filetype1 = ['jpg', 'jpeg', 'png', 'webp'];



    $file_s = selectOne('settings', ['setting_id' => 1]);
    $filesize = $file_s['max_upload'];



    if (count($errors) == 0) {
        unset($_POST['add-book']);
        if (!empty($_FILES['cover']['name'])) {
            $file_name = time() . '_' . $_FILES['cover']['name'];
            $destination = base_app . "uploads/" . $file_name;
            $errors = validateBookFile($_FILES, $formIndex1, $filetype1, $filesize);
            if (count($errors) == 0) {
                $result = move_uploaded_file($_FILES['cover']['tmp_name'], $destination);

                if ($result) {
                    $_POST['cover'] = $file_name;
                    $_POST['user_id'] = $_SESSION['book_user_id'];
                    $_POST['created_on'] = date('Y-m-d');
                    $book_id = create($table, $_POST);

                    $_SESSION['message'] = 'Book created successfully';
                    $_SESSION['type'] = 'text-success';
                    header("location: " . "./manage-books.php");
                    exit();
                } else {
                    array_push($errors, "Failed to Upload Book Cover");
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $author = $_POST['author'];
                    $publisher = $_POST['publisher'];
                    $category_id = $_POST['category_id'];
                    $isbn = $_POST['isbn'];
                    $quantity = $_POST['quantity'];
                }
            }
        } else {
            array_push($errors, "Book Cover Required");
            $title = $_POST['title'];
            $description = $_POST['description'];
            $author = $_POST['author'];
            $publisher = $_POST['publisher'];
            $category_id = $_POST['category_id'];
            $isbn = $_POST['isbn'];
            $quantity = $_POST['quantity'];
        }
    } else {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $category_id = $_POST['category_id'];
        $isbn = $_POST['isbn'];
        $quantity = $_POST['quantity'];
    }
}













if (isset($_POST['update-book'])) {

    $errors = validateBookUpdate($_POST);
    $id = $_POST['book_id'];
    $formIndex1 = 'cover';

    $filetype1 = ['jpg', 'jpeg', 'png', 'webp'];



    $file_s = selectOne('settings', ['setting_id' => 1]);
    $filesize = $file_s['max_upload'];

    if (!empty($_FILES['cover']['name'])) {
        $file_name = time() . '_' . $_FILES['cover']['name'];
        $destination = base_app . "uploads/" . $file_name;
        $errors = validateBookFile($_FILES, $formIndex1, $filetype1, $filesize);
        if (count($errors) == 0) {
            $result1 = move_uploaded_file($_FILES['cover']['tmp_name'], $destination);

            if ($result1) {
                $_POST['cover'] = $file_name;
                if (count($errors) == 0) {

                    $thisid = 'book_id';

                    $post = selectOne($table, ['book_id' => $id]);
                    $file1 = $post['cover'];
                    $path1 = (base_app . 'uploads/') . $file1;
                    if (file_exists($path1)) {
                        unlink($path1);
                    }

                    unset($_POST['update-book'], $_POST['book_id']);
                    $_POST['user_id'] = $_SESSION['book_user_id'];

                    $department_id = update($table, $id, $thisid, $_POST);
                    $_SESSION['message'] = 'Book Updated successfully';
                    $_SESSION['type'] = 'text-success';
                    header("location: " . "./manage-books.php");
                    exit();
                } else {
                    $book_id = $_POST['book_id'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $author = $_POST['author'];
                    $publisher = $_POST['publisher'];
                    $category_id = $_POST['category_id'];
                    $isbn = $_POST['isbn'];
                    $quantity = $_POST['quantity'];
                }
            } else {
                array_push($errors, "Failed to Upload book File");
                $book_id = $_POST['book_id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $author = $_POST['author'];
                $publisher = $_POST['publisher'];
                $category_id = $_POST['category_id'];
                $isbn = $_POST['isbn'];
                $quantity = $_POST['quantity'];
            }
        }
    } else if (empty($_FILES['cover']['name'])) {
        if (count($errors) == 0) {

            $thisid = 'book_id';

            unset($_POST['update-book'], $_POST['book_id']);
            $_POST['user_id'] = $_SESSION['book_user_id'];

            $department_id = update($table, $id, $thisid, $_POST);
            $_SESSION['message'] = 'Book Updated successfully';
            $_SESSION['type'] = 'text-success';
            header("location: " . "./manage-books.php");
            exit();
        } else {
            $book_id = $_POST['book_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $author = $_POST['author'];
            $publisher = $_POST['publisher'];
            $category_id = $_POST['category_id'];
            $isbn = $_POST['isbn'];
            $quantity = $_POST['quantity'];
        }
    }
}


if (isset($_GET['borrow_book_id'])) {
    $book_id = $_GET['borrow_book_id'];
    $user_id = $_SESSION['book_user_id'];
    $data['book_id'] = $book_id;
    $data['user_id'] = $user_id;

    $borrow = selectOne('borrow', ['book_id' => $book_id, 'user_id' => $user_id, 'returned' => 0]);

    if ($borrow) {
        
        $_SESSION['message'] = 'You have already borrowed the book';
        $_SESSION['type'] = 'text-danger';
        header("location: " . "./catalog.php");
        exit();
    } else {
        $book_id = create('borrow', $data);

        $_SESSION['message'] = 'Book borrowed successfully! wait for admin approval';
        $_SESSION['type'] = 'text-success';
        header("location: " . "./borrowindex.php");
        exit();
    }
}
if (isset($_GET['approve_book_id'])) {
    $borrow_id = $_GET['approve_book_id'];
    $borrow = selectOne('borrow', ['borrow_id' => $borrow_id]);
    $book = selectOne('books', ['book_id' => $borrow['book_id']]);
    $quantity = $book['quantity'];
    $data['quantity'] = $quantity - 1;
  
    $thisid = 'borrow_id';
    $thisid1 = 'book_id';
    $_POST['borrow_date'] = date('Y-m-d');

    $days = selectOne('settings', ['setting_id' => 1]);

    $date = new DateTime($_POST['borrow_date']);
    $date->modify('+8 days');


    $_POST['return_date'] = $date->format('Y-m-d');


    $_POST['status'] = 1;
    $_POST['is_borrow'] = 0;


    $book_id = update('borrow', $borrow_id, $thisid, $_POST);
    $quantity_id = update('books', $borrow['book_id'], $thisid1, $data);

    if ($book_id) {
        # code...
        $_SESSION['message'] = 'Borrow Request approved successfully';
        $_SESSION['type'] = 'text-success';
        header("location: " . "./book-request.php");
        exit();
    }
}

if (isset($_GET['return_book_id'])) {
    $borrow_id = $_GET['return_book_id'];
    $thisid = 'borrow_id';
    

    $_POST['is_return'] = 1;
    $_POST['returned_on'] = date("Y-m-d");


    update('borrow', $borrow_id, $thisid, $_POST);

    $_SESSION['message'] = 'Return Request sent successfully';
    $_SESSION['type'] = 'text-success';
    header("location: " . "./borrowindex.php");
    exit();
}

if (isset($_GET['approve_return_book_id'])) {
    $borrow_id = $_GET['approve_return_book_id'];
    $thisid = 'borrow_id';
    

    $_POST['returned'] = 1;

    $borrow = selectOne('borrow', ['borrow_id' => $borrow_id]);
    $book = selectOne('books', ['book_id' => $borrow['book_id']]);
    $quantity = $book['quantity'];
    $data['quantity'] = $quantity + 1;
  

    $thisid1 = 'book_id';


    $borrow_update = update('borrow', $borrow_id, $thisid, $_POST);
    $book_id = update('books', $borrow['book_id'], $thisid1, $data);

    $_SESSION['message'] = 'Book Returned successfully';
    $_SESSION['type'] = 'text-success';
    header("location: " . "./book-request.php");
    exit();
}





if (isset($_GET['del_book_id'])) {
    $id = $_GET['del_book_id'];
    $thisid = 'book_id';

    $post = selectOne($table, ['book_id' => $id]);

    $file1 = $post['cover'];
    $path1 = (base_app . 'uploads/') . $file1;

    if (file_exists($path1)) {
        unlink($path1);
        unlink($path2);

        $count = delete($table, $id, $thisid);

        $_SESSION['message'] = 'Book Deleted successfully';
        $_SESSION['type'] = 'text-success';


        header("location: " . './manage-books.php');
        exit();
    } else {
        $_SESSION['message'] = 'Book not Deleted';
        $_SESSION['type'] = 'text-danger';


        header("location: " . './manage-books.php');
        exit();
    }
}
