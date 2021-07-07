<?php
declare(strict_types=1);

namespace App\Repository;


final class AdRepository extends AbstractRepository
{
    private string $order;

    public function getAdsByPage(int $page, int $perPage, array $order): array
    {
        $this->setOrder($order);
        $query = "SELECT * FROM `ads` ";
        $query .= $this->order;
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

    private function setOrder(array $order): void
    {
        $orderString = "ORDER BY ";
        foreach ($order as $field => $value) {
            $orderString .= $field . " " . $value . ",";
        }
        $this->order = rtrim($orderString, ", ");
    }
}