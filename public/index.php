<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';

// require '../src/config/db.php';

require_once '../src/config/mysqlDB.php';


$app = new \Slim\App;

//Get text msg
$app->get('/hello/{name}', function (Request $request, Response $response, array $args)
{
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

//db all  routes
require_once '../src/routes/users.php';

$app->run();