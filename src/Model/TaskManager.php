<?php

namespace App\Model;

class TaskManager extends AbstractManager
{
    public const TABLE = 'todo';

    public function insert(array $task): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `create_date`) VALUES (:name, NOW())");
        $statement->bindValue(':name', $task['task'], \PDO::PARAM_STR);
        $statement->execute();
        // return (int)$this->pdo->lastInsertId();
    }

    // public function getAll(): array
    // {
    //     $statement = $this->pdo->query('SELECT * FROM ' . self::TABLE);
    // }
}