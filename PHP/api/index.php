<?php

header('Content-type: json/application');
require 'connect.php';
require 'utils.php';
$method = $_SERVER['REQUEST_METHOD'];
$store = array();

$q = $_GET['q'];

$params = explode('/', $q);

$type = $params[0];

switch ($method) {
    case 'GET':
        switch ($type) {
            case 'tables':
                getTableInfo($connect);
                break;
            case 'table':
                getCurrentTableInfo($connect, $_POST['id']);
                break;
            default:
                error_request('not found request');
        }
    case 'POST':
        switch ($type) {
            case 'createTask':
                createTask($connect, $_POST);
                break;
            default:
                error_request('not found request');
        }
    case "DELETE":
        switch ($type) {
            case 'deleteTask':
                deleteTask($connect, $_POST);
                break;
            default:
                error_request('not found request');
        }
    case 'PUT':
        switch ($type) {
            case 'updateTask':
                updateTask($connect, $_POST);
        }
    default:
        error_request('not found method');
}

print_r(json_encode($store));
