<?php

// use \Psr\Http\Message\ServerRequestInterface as Request;
// use \Psr\Http\Message\ResponseInterface as Response;

$app->delete('/deletesomeid/{id}', function ($Request,$Response,$args) {
 require '../connect_db.php';

    $id = $args['id'];

$conn->query('delete from departments where id = ' . $id);
	
	

    $Response->getBody()->write("row deleted of id " . $id);

    // return $response;
});


