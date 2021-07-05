<?php
declare(strict_types=1);


namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AdController extends AbstractController
{
    public function create(): Response
    {
        //
    }
    public function getAll(Request $request, Response $response): Response
    {
        $ads = $this->getAdService()->getAllAds();

        return $this->jsonResponse($response, 'success', $ads, 200);
    }

    public function getById(Request $request, Response $response): Response
    {
        //
    }
}