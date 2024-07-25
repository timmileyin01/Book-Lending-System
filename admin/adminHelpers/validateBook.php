<?php

function validateBook($book){
    $errors = array();

    if (empty($book['title'])) {
        array_push($errors, 'Title is required');
    }

    if (empty($book['description'])) {
        array_push($errors, 'Description is required');
    }
    if (empty($book['author'])) {
        array_push($errors, 'Author is required');
    }
    if (empty($book['publisher'])) {
        array_push($errors, 'Publisher is required');
    }
    if (empty($book['isbn'])) {
        array_push($errors, 'ISBN is required');
    }

    if (empty($book['category_id'])) {
        array_push($errors, 'Select the Category');
    }

    if (empty($book['quantity'])) {
        array_push($errors, 'Quatity is required');
    }


    $existingBook = selectOne('books', ['isbn' => $book['isbn']]);
   
    if($existingBook) {
        array_push($errors, 'Book already exists');
    }
    return $errors;
}

function validateBookUpdate($book){
    $errors = array();

    if (empty($book['title'])) {
        array_push($errors, 'Title is required');
    }

    if (empty($book['description'])) {
        array_push($errors, 'Description is required');
    }
    if (empty($book['author'])) {
        array_push($errors, 'Author is required');
    }
    if (empty($book['publisher'])) {
        array_push($errors, 'Publisher is required');
    }
    if (empty($book['isbn'])) {
        array_push($errors, 'ISBN is required');
    }

    if (empty($book['category_id'])) {
        array_push($errors, 'Select the Category');
    }

    if (empty($book['quantity'])) {
        array_push($errors, 'Quatity is required');
    }


    $existingBook = selectOne('books', ['isbn' => $book['isbn']]);
   
    if($existingBook && $existingBook['book_id'] != $book['book_id']) {
        array_push($errors, 'Book already exists');
    }
    return $errors;
}

function validateBookFile($file, $formIndex, $filetype, $filesize){
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








