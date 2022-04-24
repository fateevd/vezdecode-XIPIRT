<?php

header('Content-type: json/application');
require 'connect.php';
require 'utils.php';
$method = $_SERVER['REQUEST_METHOD'];
$store = array();

$q = $_GET['q'];

$params = explode('/', $q);

$type = $params[0];
if ($method === 'GET') {
    if ($type === 'tables') {
        getTableInfo($connect);
    } else if ($type === 'table') {
        getCurrentTableInfo($connect, $_POST['id']);
    } else {
        error_request('not found request');
    }
} else if ($method === "POST") {
    if ($type === 'createTask') {
        createTask($connect, $_POST);
    } else {
        error_request('not found request');
    }
} else if ($method === 'DELETE') {
    if ($type === 'createTask') {
        deleteTask($connect, $_POST);
    } else {

    }
} else if ($method === 'PUT') {
    if ($type === 'updateTask') {
        updateTask($connect, $_POST);
    } else {
        error_request('not found request');
    }
} else {
    error_request('not found method');
}

