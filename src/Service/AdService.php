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
    public function getAdById(int $adId): array
    {
        $selectedFields = ['title', 'photo', 'price'];
        $ad = $this->adRepository
            ->setFieldsToReturn($selectedFields)
            ->getAdById($adId);

        if(empty($ad)) {
            throw new \Exception("Ad not found", 404);
        }

        return $ad;
    }

    public function getFullAdById(int $adId): array
    {
        $selectedFields = ['title', 'price', 'description', 'photo', 'aditionalPhotos'];
        $ad = $this->adRepository
            ->setFieldsToReturn($selectedFields)
            ->getFullAdById($adId);

        if(empty($ad)) {
            throw new \Exception("Ad not found", 404);
        }

        return $ad;
    }
}