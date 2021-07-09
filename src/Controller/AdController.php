<?php
declare(strict_types=1);


namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AdController extends AbstractController
{
    public function createAd(Request $request, Response $response): Response
    {
        $rq = $request->getParsedBody();
        $adId = $this->getAdService()->createAd($rq);

        return $this->jsonResponse($response, 'success', ['id' => $adId], 200);
    }

    public function getAllByPage(Request $request, Response $response): Response
    {
        $sorting = ['id' => 'asc'];
        $page = 1;

        if(isset($request->getQueryParams()['sort'])) {
            $sorting = $this->getSortingFields(
                $request->getQueryParams()['sort']
            );
        }

        if(isset($request->getQueryParams()['page'])) {
            $page = intval($request->getQueryParams()['page']);
            $page = ($page > 0 ? $page : 1);
        }

        $ads = $this->getAdService()->getAdsByPage($page, $sorting);

        return $this->jsonResponse($response, 'success', $ads, 200);
    }

    public function getById(Request $request, Response $response, array $args): Response
    {
        if(isset($request->getQueryParams()['fields'])) {
            $ad = $this->getAdService()->getFullAdById(intval($args['id']));
        } else {
            $ad = $this->getAdService()->getAdById(intval($args['id']));
        }

        return $this->jsonResponse($response, 'success', $ad, 200);
    }
}