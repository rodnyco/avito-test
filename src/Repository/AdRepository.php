<?php
declare(strict_types=1);

namespace App\Repository;


final class AdRepository extends AbstractRepository
{
    public function getAdsByPage(int $page, int $perPage): array
    {
        //TODO: select fields from parameter
        $query = "SELECT `title`, `photo`, `price` FROM `ads`";
        $statement = $this->database->prepare($query);
        $statement->execute();
        $total = $statement->rowCount();
        return $this->getResultsWithPagination(
            $query,
            $page,
            $perPage,
            $total
        );
    }
}