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

    public function getAdById(int $adId): array
    {
        $query = "SELECT * FROM `ads` WHERE `id` = :id";
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $adId);
        $statement->execute();

        return $this->returnSelected($statement);
    }

    public function getFullAdById(int $adId): array
    {
        $query = "SELECT ad.`title`, ad.`price`, ad.`description`, ad.`photo`,
                         GROUP_CONCAT(photo.`photo` SEPARATOR ';') as aditionalPhotos
                FROM `ads` ad
                LEFT JOIN `photos` photo ON photo.`adId` = ad.`id`
                WHERE ad.`id` = :id";;
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $adId);
        $statement->execute();

        $qResult = $this->returnSelected($statement);
        $ad = [];

        if($qResult[0]['title'] != null) {
            $ad = $qResult[0];
        }

        if($qResult[0]['aditionalPhotos'] != null) {
            $ad['aditionalPhotos'] = explode(';', $qResult[0]['aditionalPhotos']);
        }

        return $ad;
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