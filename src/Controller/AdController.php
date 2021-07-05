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
    public function getByPage(Request $request, Response $response): Response
    {
        $page = intval($request->getQueryParams()['page']);
        //TODO: this filtered in middleware
        if($page < 1) $page = 1;
        $ads = $this->getAdService()->getAdsByPage($page);

        return $this->jsonResponse($response, 'success', $ads, 200);
    }

    public function getById(Request $request, Response $response): Response
    {
        //
    }
}