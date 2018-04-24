<?php


$test=function($req,$res,$next){

	$res->getBody()->write(" -- before internal --");
	$res=$next($req,$res);
	// $res->getBody()->write("last");
	return $res;



};


$app->get('/test_middlewaree', function ($Request,$Response) {
 

    $Response->getBody()->write("hello test_middleware");


});

$app->get('/test_middlewaree2', function ($Request,$Response) {
 

    $Response->getBody()->write(" hello test_middleware 2 ");


})->add($test);
