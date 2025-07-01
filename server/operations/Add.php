<?php
require_once(__DIR__ . '/../utils/goback.php');
require_once(__DIR__ . '/../services/TaskService.php');

$service = new TaskService();

$description = $_POST['task'];
$service->create_task($description);

go_back();
