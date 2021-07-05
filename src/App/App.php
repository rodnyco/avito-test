<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use App\ContainerBuilder;

require __DIR__ . '../../../vendor/autoload.php';

$settings = require __DIR__ . '/Settings.php';
$container = (new ContainerBuilder($settings))
    ->createContainer();

AppFactory::setContainer($container);
$app = AppFactory::create();

require __DIR__ . '/Routes.php';