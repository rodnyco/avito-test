<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\AdRepository;

abstract class AbstractAdService
{
    public function __construct(
        public adRepository $adRepository
    ){}

    protected function getAdRepository(): AdRepository
    {
        return $this->adRepository;
    }
}