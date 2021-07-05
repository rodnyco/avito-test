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

    protected function getResultsWithPagination(string $query, int $page, int $perPage, int $total): array
    {
        $countPages = intval(ceil($total / $perPage));
        $page = ($page <= $countPages ? $page : $countPages);

        return [
            'pagination' => [
                'count'       => $total,
                'countPages'  => $countPages,
                'currentPage' => $page,
                'perPage'     => $perPage
            ],
            'data' => $this->getResultByPage($query, $page, $perPage)
        ];
    }

    protected function getResultByPage(string $query, int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $query .= " LIMIT ${perPage} OFFSET ${offset}";
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }
}