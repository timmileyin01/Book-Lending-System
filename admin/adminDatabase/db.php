<?php

session_start();
require('connect.php');


function dd($value){
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}


function executeQuery($sql, $data){
    global $conn;
    $stmt = $conn->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}


function selectAll($table, $conditions = []){
    global $conn;
    $sql = "SELECT * FROM $table ";
    if (empty($conditions)) {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }else{
        //return only records that match conditions
        // $sql = "SELECT * FROM $table WHERE id_number=? OR email=? AND admin=1";
        
        $i = 0;

        foreach ($conditions as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            }else{
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        
        $stmt = executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
   
}



function selectOne($table, $conditions){
    global $conn;
    $sql = "SELECT * FROM $table ";
   
        
    $i = 0;

    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        }else{
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $sql = $sql . " LIMIT 1";
    
    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;   
}



function create($table, $data){
    global $conn;
    
    $sql = "INSERT INTO $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        }else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}



function update($table, $id, $thisid, $data){
    global $conn;
    
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        }else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $sql = $sql . " WHERE $thisid=?";
    $data[$thisid] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}

function updateCat($table, $id, $data){
    global $conn;
    
    $sql = "UPDATE $table SET ";
    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        }else{
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    $sql = $sql . " WHERE category_id=?";
    $data['category_id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}


function delete($table, $id, $thisid){
    global $conn;
    
    $sql = "DELETE FROM $table WHERE $thisid=? ";
   
    $stmt = executeQuery($sql, [$thisid => $id]);
    return $stmt->affected_rows;
}

function deleteCat($table, $id){
    global $conn;
    
    $sql = "DELETE FROM $table WHERE category_id=? ";
   
    $stmt = executeQuery($sql, ['category_id' => $id]);
    return $stmt->affected_rows;
}

