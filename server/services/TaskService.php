<?php
require_once(__DIR__ . '/../db/Connection.php');
require_once(__DIR__ . '/../PDO/TaskPDO.php');
require_once(__DIR__ . '/../models/Task.php');

class TaskService
{
    private $pdo;
    private $task_pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::connect();
        $this->task_pdo = new TaskPDO($this->pdo);
    }

    public function create_task(string $description): void
    {
        $task = new Task($description, 0);

        $this->task_pdo->create($task);
    }

    public function get_all(): array
    {
        return $this->task_pdo->get_all();
    }

    public function get_task(int $id): ?Task
    {
        $task = $this->task_pdo->get_id($id);

        return $task;
    }

    public function update(Task $task): void
    {
        $this->task_pdo->update($task);
    }

    public function remove(int $id): void
    {
        $this->task_pdo->delete($id);
    }
}
