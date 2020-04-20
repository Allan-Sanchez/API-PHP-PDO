<?php

// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../model/Post.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

//get raw posted data
$data = json_decode(file_get_contents("php://input"));

//set id to update
$post->id = $data->id;

// delete post
if ($post->deletePost()) {
    echo json_encode(array('message'=>'Post Delated'));
} else {
    echo json_encode(array('message'=>'Post Not Delated'));
}
