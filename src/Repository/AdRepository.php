<?php
declare(strict_types=1);

namespace App\Repository;


use App\Entity\Ad;

final class AdRepository extends AbstractRepository
{
    private string $order;

    public function createAd(Ad $ad): Ad
    {
        $query = "
            INSERT INTO `ads` 
                (`title`, `description`, `photo`, `price`)
            VALUES 
                (:title, :description, :photo, :price)
        ";
        $statement = $this->database->prepare($query);

        $title = $ad->getTitle();
        $description = $ad->getDescription();
        $photos = $ad->getPhotos();
        $mainPhoto = $photos[0] ?? null;
        $price = $ad->getPrice();

        $statement->bindParam(':title', $title);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':photo', $mainPhoto);
        $statement->bindParam(':price', $price);

        $statement->execute();
        $adId = (int) $this->database->lastInsertId();
        $ad->setId($adId);

        if(count($photos) > 1) {
            unset($photos[0]);
            $this->createAdditionalPhotos($adId, $photos);
        }

        return $ad;
    }

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

    private function createAdditionalPhotos(int $adId, array $photos): void
    {
        $query = "";
        $insertQuery = " INSERT INTO `photos` (`photo`, `adId`) VALUES ";
        foreach ($photos as $photo) {
            $query = "INSERT INTO `photos` (`photo`, `adId`) VALUES (:photo, :adId)";
            $statement = $this->database->prepare($query);
            $statement->bindParam(':photo', $photo);
            $statement->bindParam(':adId', $adId);
            $statement->execute();
        }
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