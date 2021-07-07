<?php
declare(strict_types=1);

use Slim\Routing\RouteCollectorProxy;

/** @var \Slim\Factory\AppFactory $app */

$app->group('/ad', function (RouteCollectorProxy $group) : void {
    $group->get('/{id}', ['App\Controller\AdController', 'getById']);
});

$app->get('/ads', ['App\Controller\AdController', 'getAllByPage']);