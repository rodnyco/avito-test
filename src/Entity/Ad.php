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

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPhotos(array $photos): void
    {
        $this->photos = $photos;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}