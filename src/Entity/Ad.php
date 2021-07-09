<?php
declare(strict_types=1);

namespace App\Entity;

class Ad
{
    private int    $id;
    private string $title;
    private string $description;
    private array  $photos;
    private float  $price;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPhotos(): array
    {
        return $this->photos;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        if(iconv_strlen($title) > 200) {
            throw new \Exception("The number of characters in the title must be no more than 200", 401);
        }
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        if(iconv_strlen($description) > 1000) {
            throw new \Exception("The number of characters in the description must be no more than 1000", 401);
        }
        $this->description = $description;
    }

    public function setPhotos(array $photos): void
    {
        if(count($photos) > 3) {
            throw new \Exception("The number of photos should not be more than 3", 401);
        }
        $this->photos = $photos;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}