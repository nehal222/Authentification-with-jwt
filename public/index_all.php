<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

require 'connect_db.php';


$app = new \Slim\App;
// $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
 
//     $name = $args['name'];
//     $response->getBody()->write("Hello worlllld, $name");

//     return $response;
// });



//map to deal with get row and update row 
$app->map(['PUT','GET'],'/get_put_with_id[/{id}]', function ($Request,$Response,$args) {
 	
 	require 'connect_db.php';

    $id = @$args['id'];
    if(is_null($id))
    {
    	$Response->getBody->write("please add the id you want");

    }
    else
    {
    	if($Request->isGet())
    {

    $result = $conn->query('select * from departments where id = ' . $id);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$data2[] = $row;
	}

    $Response->getBody()->write(json_encode($data2[0]));

    }
    if($Request->isPut())
	    {
		    $data = $Request->getParsedBody();
    		$inputdata=[];
		    $inputdata['title']=filter_var($data['title'],FILTER_SANITIZE_STRING);
		    $inputdata['content']=filter_var($data['content'],FILTER_SANITIZE_STRING);


			$sql = "UPDATE  departments SET `title` = '" . $inputdata['title'] . "' ,`content` = '" . $inputdata['content'] . "' where id =  " . $id . "";


			$conn->query($sql);

	       
	    	$Response->getBody()->write("Updated to db of id " . $id . "- Title  : " . $inputdata['title'] . ' content is : ' . $inputdata['content']);



	    	//return $response3;
    }

    }
    
//return $response3;
	

});



// $app->get('/getsomeid/{id}', function ($Request,$Response,$args) {
//  require 'connect_db.php';

//     $id = $args['id'];

// $result = $conn->query('select * from departments where id = ' . $id);
// 	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
// 		$data2[] = $row;
// 	}
// // $data2=[];
// // $data2['ggg']='ddd';
	

//     $Response->getBody()->write(json_encode($data2[0]));

//     // return $response;
// });





// $app->put('/putdata', function (Request $request3, Response $response3) {
//  require 'connect_db.php';

//     $data = $request3->getParsedBody();
//     $inputdata=[];
//     $inputdata['id']=filter_var($data['id'],FILTER_SANITIZE_NUMBER_INT);
//     $inputdata['title']=filter_var($data['title'],FILTER_SANITIZE_STRING);
//     $inputdata['content']=filter_var($data['content'],FILTER_SANITIZE_STRING);


// $sql = "UPDATE  departments SET `title` = '" . $inputdata['title'] . "' ,`content` = '" . $inputdata['content'] . "' where id =  " . $inputdata['id'] . "";


// $conn->query($sql);

       
//     $response3->getBody()->write("Updated to db of id " . $inputdata['id'] . "- Title  : " . $inputdata['title'] . ' content is : ' . $inputdata['content']);



//     return $response3;
// });




$app->get('/getall', function ($Request,$Response) {
 require 'connect_db.php';

$result = $conn->query('select * from departments');
	while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
		$data2[] = $row;
	}
// $data2=[];
// $data2['ggg']='ddd';
	

    $Response->getBody()->write(json_encode($data2));

    // return $response;
});


$app->post('/test/demo', function (Request $request1, Response $response2) {
 require 'connect_db.php';

    $data = $request1->getParsedBody();
    $inputdata=[];
    $inputdata['title']=filter_var($data['title'],FILTER_SANITIZE_STRING);
    $inputdata['content']=filter_var($data['content'],FILTER_SANITIZE_STRING);

$sql = "INSERT INTO departments(`title`,`content`) Values('" . $inputdata['title'] ."'," . $inputdata['content'] . ")";

$conn->query($sql);

       
    $response2->getBody()->write("Inserted to db - Title  : " . $inputdata['title'] . ' content is : ' . $inputdata['content']);



    return $response2;
});






$app->delete('/deletesomeid/{id}', function ($Request,$Response,$args) {
 require 'connect_db.php';

    $id = $args['id'];

$conn->query('delete from departments where id = ' . $id);
	
	

    $Response->getBody()->write("row deleted of id " . $id);

    // return $response;
});



$app->run();

