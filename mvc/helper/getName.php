<?php

function getNameCate($id){
    $conn = new DB();

    $sql = "SELECT name FROM category WHERE id = $id";
    return $conn->pdo_query_one($sql);
}

function getNameUser($id){
    $conn = new DB();

    $sql = "SELECT name FROM user WHERE id = $id";
    return $conn->pdo_query_one($sql);
}

function getNameUserGroup($group_id)
{
    $name = '';
    switch ($group_id) {
        case 1:
            $name = 'Admin';
            break;

        default:
            $name = 'Client';
            break;
    }
    return $name;
}