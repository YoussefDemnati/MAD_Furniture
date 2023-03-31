<?php
require('_db_config.inc.php');

function db_connect(){
    global $servername, $db_username, $db_password, $db_name;
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Verifica connessione
    if ($conn->connect_error) {
        die("Connection : " . $conn->connect_error);
    }
    return $conn;
}

function get_flyers($conn, $id){
    $id = intval($id);
    $sql = "SELECT *
            FROM promozione
            WHERE id_v = $id";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}

function get_categories($conn){
    $sql = "SELECT *
            FROM categoria";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}
?>