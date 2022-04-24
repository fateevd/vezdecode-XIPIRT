<?php

function error_request($message)
{
    http_response_code(404);
    $res = [
        'status' => false,
        'message' => $message
    ];
    echo json_encode($res);
}

function getTableInfo($connect)
{
    $sql = mysqli_query($connect, query: 'select * from Tasks');

    $sqlList = [];

    foreach (mysqli_fetch_assoc($sql) as $value) {
        $sqlList[] = $value;
    }
    echo json_encode($sqlList);
}

function getCurrentTableInfo($connect, $id)
{
    $sql = mysqli_query($connect, query: 'select * from Tasks where id = ' . $id);

    if (mysqli_field_count($sql, PDO::FETCH_ASSOC) > 0) {
        error_request('not info');
    } else {
        $sqlList = [];

        foreach (mysqli_fetch_assoc($sql, PDO::FETCH_ASSOC) as $value) {
            $sqlList[] = $value;
        }
        echo json_encode($sqlList);
    }

}

function createTask($connect, $post_data)
{
    $title = $post_data['title'];
    $start_date = $post_data['start_date'];
    $due_date = $post_data['due_date'];
    $estimate = $post_data['estimate'];
    $description = $post_data['description'];
    mysqli_query($connect, 'insert into Tasks(Title,Start_date,Due_date,Estimate,Description) 
value( ' . $title, $start_date, $due_date, $estimate, $description . ')');

    http_response_code(201);

    $res = [
        'status' => true,
        'message' => 'Task create success'
    ];
    echo json_encode($res);
}


function updateTask($connect, $post_data)
{
    $id = $post_data['id'];
    $title = $post_data['title'];
    $start_date = $post_data['start_date'];
    $due_date = $post_data['due_date'];
    $estimate = $post_data['estimate'];
    $description = $post_data['description'];
    mysqli_query($connect, 'update Tasks Title = ', $title .
        ',Start_date = ' . $start_date . ',Due_date =' . $due_date . ',Estimate = ' . $estimate .
        ',Description = ' . $description . 'where id = ' . $id);

    http_response_code(200);

    $res = [
        'status' => true,
        'message' => 'Task update success'
    ];
    echo json_encode($res);

}

function deleteTask($connect, $post_data)
{
    $id = $post_data['id'];
    mysqli_query($connect, 'Delete Tasks where id = ' . $id);
    http_response_code(200);

    $res = [
        'status' => true,
        'message' => 'delete Task success'
    ];
    echo json_encode($res);

}
