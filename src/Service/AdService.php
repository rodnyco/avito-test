<?php
declare(strict_types=1);

namespace App\Service;

//TODO: Rename To GetAllAddService
class AdService extends AbstractAdService
{
    private int   $perPage = 10;
    private array $selectedFields = ['title', 'photo', 'price'];

    public function getAdsByPage(int $page, array $sorting): array
    {
        return $this->adRepository
            ->setFieldsToReturn($this->selectedFields)
            ->getAdsByPage(
            $page,
            $this->perPage,
            $sorting,
        );
    }
}