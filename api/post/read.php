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

	$result = $post->read();


	// row count is an inbuilt function:
	$num = $result->rowCount();

	//cc check if any posts:
	if($num > 0){
		// this is where i can do absolute anything:

		$post_arr = array();
		$posts_arr['data']  = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$post_item = array(
				'id' => $id,
				'image' => $image,
				'title' => $title,
				'body' => html_entity_decode($body),
				'uploaddate' => $uploaddate,
				'uploadedby' => $uploadedby
			);

			// push to the "data":
			array_push($posts_arr['data'], $post_item);
		}

		// turn to JSON and output:
		echo json_encode($posts_arr);

	}else{ // if tehres no posts:

		echo json_encode(
			array('message' => 'no message found')
		);
	}
	
	


