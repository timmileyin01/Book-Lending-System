<?php

function validateCategory($category){
    $errors = array();

    if (empty($category['name'])) {
        array_push($errors, 'Category name is required');
    }

    $existingCategory = selectOne('categories', ['name' => $category['name']]);
    if($existingCategory) {
        array_push($errors, 'Category already exists');
    }
    return $errors;
}


function validateCategoryUpdate($category){
    $errors = array();

    if (empty($category['name'])) {
        array_push($errors, 'Category name is required');
    }


    $existingCategory = selectOne('categories', ['name' => $category['name']]);
    
    
    if($existingCategory && $existingCategory['category_id'] != $category['category_id']){
        array_push($errors, 'Category already exists');
        
    }
    return $errors;
}
