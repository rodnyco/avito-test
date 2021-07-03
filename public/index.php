<?php
declare(strict_types=1);

require __DIR__ . '../../src/App/App.php';

/** @var \Slim\Factory\AppFactory $app */
try {
    $app->run();
} catch (Exception $e) {
    // We display a error message
    die( json_encode(array("status" => "failed", "message" => "This action is not allowed")));
}