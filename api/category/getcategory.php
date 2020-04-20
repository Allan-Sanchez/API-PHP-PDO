<?php

// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../api/category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// instantiate blog category object
$categories = new Category($db);

$result = $categories->getCategory();

$num = $result->rowCount();

if ($num > 0) {
    //category array
    $categories_arr = array();
    $categories_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $categories_item = array(
            'id' => $id,
            'name' => $name
        );

        //push data
        array_push($categories_arr['data'],$categories_item);
    }
        // turn to json & output
        echo json_encode($categories_arr);
}else {
    echo json_encode(
        array('message'=> 'no categories found')
    );
}