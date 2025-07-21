<?php
require_once(__DIR__ . '/../utils/goback.php');
require_once(__DIR__ . '/../services/TaskService.php');

$service = new TaskService();

$id = $_POST['id'];
$service->check($id);

go_back();
