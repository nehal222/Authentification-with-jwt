<?php

// use \Psr\Http\Message\ServerRequestInterface as Request;
// use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/getall', function ($Request,$Response) {
 require '../connect_db.php';

$result = $conn->query('select * from departments');
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$data2[] = $row;
	}


    $Response->getBody()->write(json_encode($data2));


});
