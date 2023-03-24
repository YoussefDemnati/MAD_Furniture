<?php
require('_db_config.inc.php');

function db_connect()
{
    global $servername, $db_username, $db_password, $db_name;
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Verifica connessione
    if ($conn->connect_error) {
        $error = $conn->connect_error;
        $error_date = date('Y-m-d H:i:s');
        $message = "{$error_date} | {$error} \r\n";
        file_put_contents("db_log.txt", $message, FILE_APPEND);
        return false;
    } else {
        return $conn;
    }
}
/* DA FARE: Aggiungere controllo se una email esiste già */
function signup_azienda($company_name, $address, $email, $phone, $password)
{
    $conn = db_connect();
    $company_name = mysqli_real_escape_string($conn, $company_name);
    $address = mysqli_real_escape_string($conn, $address);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //controllo se l'account (email) già esiste
    if (check_account_exists($conn, "utente", $email) == 0) {
        return 0;
    }
    if (check_account_exists($conn, "azienda", $email) == 0) {
        return 0;
    }

    // Inserimento dei dati nel database con prepared statements
    $stmt = $conn->prepare("INSERT INTO azienda (nome, indirizzo, email, telefono, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $company_name, $address, $email, $phone, $hashed_password);
    $stmt->execute();
}

function signup_privato($first_name, $last_name, $email, $address, $password, $type)
{
    $conn = db_connect();
    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $address);
    $type = mysqli_real_escape_string($conn, $type);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //controllo se l'account (email) già esiste
    if (check_account_exists($conn, "utente", $email) == 0) {
        return 0;
    }
    if (check_account_exists($conn, "azienda", $email) == 0) {
        return 0;
    }

    // Inserimento dei dati nel database con prepared statements
    $stmt = $conn->prepare("INSERT INTO utente (nome, cognome, email, indirizzo, password, tipo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $address, $hashed_password, $type);
    $stmt->execute();
}

function check_account_exists($conn, $table, $email)
{
    $stmt = $conn->prepare("SELECT email FROM $table WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data != NULL) {
        return 0;
    } else {
        return 1;
    }
}
