<?php
declare(strict_types=1);

namespace App\Repository;


final class AdRepository extends AbstractRepository
{
    public function getAds(): array
    {
        $query = "SELECT * FROM `test`";
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }
}