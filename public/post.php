<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->post('/test/demo', function (Request $request1, Response $response2) {
 require '../public/connect_db.php';

    $data = $request1->getParsedBody();
    $inputdata=[];
    $inputdata['title']=filter_var($data['title'],FILTER_SANITIZE_STRING);
    $inputdata['content']=filter_var($data['content'],FILTER_SANITIZE_STRING);

$sql = "INSERT INTO departments(`title`,`content`) Values('" . $inputdata['title'] ."'," . $inputdata['content'] . ")";

$conn->query($sql);

       
    $response2->getBody()->write("Inserted to db - Title  : " . $inputdata['title'] . ' content is : ' . $inputdata['content']);



    return $response2;
});
