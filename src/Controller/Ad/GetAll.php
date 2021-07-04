<?php
declare(strict_types=1);


namespace App\Controller\Ad;


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controller\AbstractController;

class GetAll extends AbstractController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $ads = $this->getAdService()->getAllAds();

        return $this->jsonResponse($response, 'success', $ads, 200);
    }
}