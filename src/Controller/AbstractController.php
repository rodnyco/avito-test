<?php
declare(strict_types=1);


namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Service\AdService;
use DI\Container;

abstract class AbstractController
{
    public function __construct(
        public Container $container
    )
    {}

    /**
     * @param array|object|null $message
     */
    protected function jsonResponse(
        Response $response,
        string $status,
        $message,
        int $code
    ): Response {
        $result = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
        ];

        return $response->withJson($result, $code, JSON_PRETTY_PRINT);
    }

    protected function getAdService(): AdService
    {
        return $this->container->get('ad_service');
    }

    protected function getSortingFields(string $fields): array
    {
        $fields = explode(',', $fields);
        $sortingFields = [];
        foreach ($fields as $field) {
            $sortingList = explode(':', $field);
            $sortingFields[$sortingList[0]] = $sortingList[1];
        }

        return $sortingFields;
    }
}