<?php
declare(strict_types=1);

namespace App\Service;

class AdService extends AbstractAdService
{
    public function getAllAds(): array
    {
        return $this->adRepository->getAds();
    }
}