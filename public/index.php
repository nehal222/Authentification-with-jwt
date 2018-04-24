<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


$conf=[
'settings'=>[
'displayErrorDetails'=>true,
],
];

$c= new \Slim\Container($conf);
$app = new \Slim\App($c);
 
 

 require '../src/middleware.php';
  require '../src/DI.php';
 // require '../Api/BasicAuth.php';

 require '../Api/JWTToken.php';
 //require '../Api/CallServices.php';
 // require '../APi/CallServices.php';

require '../Api/postt.php';
require '../Api/get_put.php';
require '../Api/gett.php';
require '../Api/deletee.php';
require '../Api/test_middleware.php';

$app->run();

