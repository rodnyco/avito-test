<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Ad;

class AdService extends AbstractAdService
{
    public function createAd(array $input): int
    {
        $data = json_decode((string) json_encode($input), false);
        if(!isset($data->title)) {
            throw new \Exception("Invalid data: title is required.", 400);
        }

        $newAd = new Ad();
        $newAd->setTitle($data->title);
        $newAd->setDescription($data->decription ?? "");
        $newAd->setPhotos($data->photo ?? []);
        $newAd->setPrice(floatval($data->price) ?? 0.0);

        $createdAd = $this->adRepository->createAd($newAd);

        return $createdAd->getId();
    }

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