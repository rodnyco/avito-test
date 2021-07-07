<?php
declare(strict_types=1);

namespace App\Service;

class AdService extends AbstractAdService
{
    public function getAdsByPage(int $page, array $sorting): array
    {
        $perPage = 10;
        $selectedFields = ['title', 'photo', 'price'];

        return $this->adRepository
            ->setFieldsToReturn($selectedFields)
            ->getAdsByPage(
            $page,
            $perPage,
            $sorting,
        );
    }

    /**
     * @throws \Exception
     */
    public function getById(int $adId): array
    {
        $selectedFields = ['title', 'photo', 'price', 'description', 'id'];
        $ad = $this->adRepository
            ->setFieldsToReturn($selectedFields)
            ->getById($adId);
        
        if(empty($ad)) {
            throw new \Exception("Ad not found", 404);
        }

        return $ad;
    }
}