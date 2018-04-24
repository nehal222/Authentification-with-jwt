<?php

use \Firebase\JWT\JWT;


$app->add(function($req,$res,$next){

	$res->getBody()->write("before external -- ");
	$res=$next($req,$res);
	$res->getBody()->write(" ---after external");
	return $res;



});


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
