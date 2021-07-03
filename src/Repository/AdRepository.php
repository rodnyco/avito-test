<?php
declare(strict_types=1);

namespace App\Repository;


final class AdRepository extends AbstractRepository
{
    public function getAds(): array
    {
        $query = "SELECT * `test` ORDER_BY `id`";
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }
}