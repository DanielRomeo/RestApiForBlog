<?php
	
	// add headers coz we gonna access this through http:
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/post.php';


	// instatiate:
	$database = new Database();
	$db = $database->connect();

	// instatiate blog post:
	$post = new Post($db);

	//get id:
	$post->id = isset($_GET['id']) ? $_GET['id'] : die();

	// get post and put it inside the array:
	$result = $post->read_single();

	$post_arr = array(
		'id' => $post->id,
		'image' => $post->image,
		'title' => $post->title,
		'body' => $post->body,
		'uploaddate' => $post->uploaddate,
		'uploadedby' => $post->uploadedby,
		'page_views' => $post->page_views,
	);

	print_r(json_encode($post_arr));



?>







