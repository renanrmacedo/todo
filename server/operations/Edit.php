<?php
require_once(__DIR__ . '/../utils/goback.php');
require_once(__DIR__ . '/../services/TaskService.php');

$service = new TaskService();

$task = $service->get_task($_POST['id']);
$task->description = $_POST['task'];

$service->update($task);

go_back();
