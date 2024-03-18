<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

// require '../src/config/db.php';

require '../src/config/mysqlDB.php';


$app = new \Slim\App;

//Get text msg
$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

//db all  routes
require '../src/routes/users.php';

$app->run();