<?php

require_once 'db.php';
if (!isset($_POST['r'])) exit();
$route = $_POST['r'];
unset($_POST['r']);
switch ($route) {
    case 'get':
        getPlaces();
        break;
    case 'add':
        addPlaces();
        break;
    case 'edit':
        editPlaces();
        break;
    case 'remove':
        removePlaces();
        break;
    default:
        echo "It's Work!";
        break;
}

function getPlaces()
{
    $res = [];
    foreach (select('places', '*', 'true order by id desc') as $data) $res[] = $data;
    echo json_encode($res);
}

function addPlaces()
{
    unset($_POST['id']);
    $data = $_POST;
    if (insert('places', $data)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

function editPlaces()
{
    $data = $_POST;
    $id = $_POST['id'];
    if (update('places', $data, "id = $id")) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

function removePlaces()
{
    $id = $_POST['id'];
    if (delete('places', "id = $id")) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
