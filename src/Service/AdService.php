<?php
declare(strict_types=1);

namespace App\Service;

class AdService extends AbstractAdService
{
    private int $perPage = 10;

    public function getAdsByPage(int $page, array $sorting): array
    {
        return $this->adRepository->getAdsByPage($page, $this->perPage, $sorting);
    }
}