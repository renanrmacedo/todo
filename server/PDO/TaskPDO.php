<?php
require_once(__DIR__ . '/../models/Task.php');

class TaskPDO
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function create(Task $task): void
    {
        $sql = "INSERT INTO tasks (description, done) VALUES (:description, :done)";
        $command = $this->pdo->prepare($sql);

        $command->execute([
            'description' => $task->description,
            'done'        => $task->done
        ]);
    }

    public function get_all(): array
    {
        $sql = 'SELECT id, description, done FROM tasks';
        $command = $this->pdo->query($sql);

        return $command->fetchAll();
    }

    public function get_id(int $id)
    {
        $sql = 'SELECT id, description, done FROM tasks WHERE id = :id';
        $command = $this->pdo->prepare($sql);

        $command->execute(['id' => $id]);
        $task = $command->fetch();

        if ($task) {
            return new Task($task['description'], $task['done'], $task['id']);
        } else {
            return null;
        }
    }

    public function update(Task $task): void
    {
        $sql = "UPDATE tasks SET description = :description, done = :done WHERE id = :id";
        $command = $this->pdo->prepare($sql);

        $command->execute([
            'description' => $task->description,
            'done'        => $task->done,
            'id'          => $task->id
        ]);
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM tasks WHERE id = :id';
        $command = $this->pdo->prepare($sql);

        $command->execute(['id' => $id]);
    }
}
