<?php

// header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../model/Post.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

$post = new Post($db);

// get it
$post->id =isset($_GET['id']) ? $_GET['id'] : die();

// get post
$post->getPostSingle();

    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'author' => $post->author,
        'body' => html_entity_decode($post->body),
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );
    // make json
    print_r(json_encode($post_arr));
    // echo(json_encode($post_arr));


