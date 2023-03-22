<?php
require('_db_config.inc.php');

function db_connect(){
    global $servername, $db_username, $db_password, $db_name;
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Verifica connessione
    if($conn->connect_error){
        $error = $conn->connect_error;
        $error_date = date('Y-m-d H:i:s');
        $message = "{$error_date} | {$error} \r\n";
        file_put_contents("db_log.txt", $message, FILE_APPEND);
        return false;
    }
    else{
        return $conn;
    }
}

function signup_azienda($company_name, $address, $email, $phone, $password){
    $conn = db_connect();
    $company_name = mysqli_real_escape_string($conn, $company_name);
    $address = mysqli_real_escape_string($conn, $address);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserimento dei dati nel database con prepared statements
    $stmt = $conn->prepare("INSERT INTO azienda (nome, indirizzo, email, telefono, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $company_name, $address, $email, $phone, $hashed_password);
    $stmt->execute();
}

function signup_privato($first_name, $last_name, $email, $address, $password, $type){
    $conn = db_connect();
    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $address);
    $type = mysqli_real_escape_string($conn, $type);
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserimento dei dati nel database con prepared statements
    $stmt = $conn->prepare("INSERT INTO utente (nome, cognome, email, address, password, tipo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $address, $hashed_password, $type);
    $stmt->execute();
}

?>