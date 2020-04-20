<?php

// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog Category object
$category = new Category($db);


//get raw posted data
$data = json_decode(file_get_contents("php://input"));

//set id to update
$category->id = $data->id;

// delete Category
if ($category->deleteCategory()) {
    echo json_encode(array('message'=>'Category Delated'));
} else {
    echo json_encode(array('message'=>'Category Not Delated'));
}
