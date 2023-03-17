<?php
require('_db_config.inc.php');

function db_connect(){
    global $servername, $db_username, $db_password, $db_name;
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Verifica connessione
    if ($conn->connect_error) {
        die("Connction : " . $conn->connect_error);
    }
    return $conn;
}

function signup_azienda($company_name, $address, $email, $phone, $password){
    $conn = db_connect();
}
function signup_privato(){
    $conn = db_connect();
}

?>