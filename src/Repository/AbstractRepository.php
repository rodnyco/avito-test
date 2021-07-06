<?php
declare(strict_types=1);

namespace App\Repository;


abstract class AbstractRepository
{
    protected array $fieldsToReturn;

    public function __construct(
        public \PDO  $database
    ){}

    public function setFieldsToReturn(array $fieldsToReturn): AbstractRepository
    {
        $this->fieldsToReturn = $fieldsToReturn;

        return $this;
    }

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

    // TODO REFACTOR SETOFFSET!!
    protected function getResultByPage(string $query, int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        $query .= " LIMIT ${perPage} OFFSET ${offset}";

        return $this->fetchAll($query);
    }

    protected function fetchAll(string $query): array
    {
        $statement = $this->database->prepare($query);
        $statement->execute();
        $result = [];
        $fieldsToReturn = array_flip($this->fieldsToReturn);
        while ($row = $statement->fetch()) {
            $result[] = array_intersect_key($row, $fieldsToReturn);
        }

        return $result;
    }
}