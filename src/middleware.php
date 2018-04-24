<?php

use \Firebase\JWT\JWT;
use \Slim\Middleware\HttpBasicAuthentication\AuthenticatorInterface;

//basic auth 

// class AuthenticatorClass implements AuthenticatorInterface{

// public function __invoke(array $arguments){
// $user=$arguments['user'];
// $password=$arguments['password'];

// if($user=='nehal'&&$password=="12345"){

//     return true;
// }
// else{

//     return false;
// }

// }


// }



// $app->add(new \Slim\Middleware\HttpBasicAuthentication(
// [
// 'path'=>'/token','authenticator'=> new AuthenticatorClass()
// ]

// ));


// use \Slim\Middleware\JwtAuthentication;

// $app->add(function($req,$res,$next){

//     $res->getBody()->write("before external -- ");
//     $res=$next($req,$res);
//     $res->getBody()->write(" ---after external");
//     return $res;



// });


$app->add(new \Slim\Middleware\JwtAuthentication([
	 "path" => ["/"],
    "passthrough" => ["/JWTToken"],
    "secret" => "supersecretkeyyoushouldnotcommittogithub",
    "error" => function ($request, $response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));
