<?php
declare(strict_types=1);

use Slim\Routing\RouteCollectorProxy;

/** @var \Slim\Factory\AppFactory $app */

$app->group('/ads', function (RouteCollectorProxy $group) : void {
    $group->get('/', ['App\Controller\AdController', 'getByPage']);
});
