<?php
declare(strict_types=1);

namespace App\Repository;


abstract class AbstractRepository
{
    public function __construct(
        public \PDO $database
    ){}

    protected function getDb(): \PDO
    {
        return $this->database;
    }
}