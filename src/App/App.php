<?php
declare(strict_types=1);


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use App\ContainerBuilder;

require __DIR__ . '../../../vendor/autoload.php';

$settings = require __DIR__ . '/Settings.php';
$container = (new ContainerBuilder($settings))
    ->createContainer();

AppFactory::setContainer($container);
$app = AppFactory::create();
$c = $app->getContainer();

$pdo = $c->get('db');
$query = $pdo->query('SELECT * FROM test');

while ($line = $query->fetch()) {
    print_r($line);
}


$app->get('/foo', function (Request $request, Response $response, array $args) {
    $payload = json_encode(['hello' => 'world'], JSON_PRETTY_PRINT);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
});