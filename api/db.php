<?php
$servername = "localhost";
$database = "postesgis";
$username = "root";
$password = "";


$conn = mysqli_connect($servername, $username, $password, $database);

function insert($table, $arr)
{
    global $conn;
    $field = '';
    $value = '';
    foreach ($arr as $key => $val) {
        $field .= $key . ",";
        $value .= "'$val',";
    }
    $field = substr($field, 0, -1);
    $value = substr($value, 0, -1);

    $sql = "INSERT INTO $table ($field) VALUES ($value)";

    return mysqli_query($conn, $sql);
}

function update($table, $arr, $where)
{
    global $conn;
    $update = '';
    foreach ($arr as $key => $val) {
        $update .= "$key = '$val',";
    }
    $update = substr($update, 0, -1);

    $sql = "UPDATE $table SET $update WHERE $where";

    return mysqli_query($conn, $sql);
}

function select($table, $value, $where)
{
    global $conn;
    $sql = "SELECT $value FROM $table WHERE $where";

    return mysqli_query($conn, $sql);
}

function delete($table, $where)
{
    global $conn;
    $sql = "DELETE FROM $table WHERE $where";

    $exec = mysqli_query($conn, $sql);
    if (!$exec) {
        $sql = "UPDATE $table WHERE $where";
        $exec = mysqli_query($conn, $sql);
    }

    return $exec;
}

function validateParam($arr, $method = 'post')
{
    $method = $method == 'post' ? $_POST : $_GET;
    foreach ($arr as $item) {
        if (!isset($method[$item]) && empty($methods[$item])) return false;
    }
    return true;
}
