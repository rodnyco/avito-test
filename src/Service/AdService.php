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
}