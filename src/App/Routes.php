<?php
declare(strict_types=1);

use Slim\Routing\RouteCollectorProxy;
use App\Middleware\NewAdValidator;

/** @var \Slim\Factory\AppFactory $app */

$app->group('/ad', function (RouteCollectorProxy $group) : void {
    $group->get('/{id}', ['App\Controller\AdController', 'getById']);
    $group->post('', ['App\Controller\AdController', 'createAd']);
});

$app->get('/ads', ['App\Controller\AdController', 'getAllByPage']);