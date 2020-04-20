<?php

// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/Category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$category = new Category($db);

//get id
$category->id = isset($_GET['id']) ? $_GET['id']: die() ;

//get category
$category->getCategorySingle();

    $category_arr = array(
        'id' => $category->id,
        'name' => $category->name
    );

// make json
echo (json_encode($category_arr));