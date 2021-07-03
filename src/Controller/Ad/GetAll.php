<?php
declare(strict_types=1);


namespace App\Controller;


use Slim\Http\Response;
use Slim\Psr7\Request;

class GetAll extends AbstractController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $ads = $this->getAdService()->getAllAds();

        return $this->jsonResponse($response, 'success', $ads, 200);
    }
}