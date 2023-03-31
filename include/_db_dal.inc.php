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


function signup_azienda($company_name, $address, $email, $phone, $password)
{
    $conn = db_connect();
    $data=[];
    $company_name = mysqli_real_escape_string($conn, $company_name);
    $address = mysqli_real_escape_string($conn, $address);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //controllo se l'account (email) già esiste
    if (check_account_exists($conn, "utente", $email) == 0 || check_account_exists($conn, "azienda", $email) == 0) {
        return "&#8226 Email già esistente";
    }

    // Inserimento dei dati nel database con prepared statements
    $stmt = $conn->prepare("INSERT INTO azienda (nome, indirizzo, email, telefono, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $company_name, $address, $email, $phone, $hashed_password);
    
    // Esecuzione della query
    if ($stmt->execute()) {
        $_SESSION["id"] = $data['id_a'];
        header("Location: ../index.php");
        exit();
    } else {
        return "&#8226 Errore durante la registrazione";
    }   
}


function signup_privato($first_name, $last_name, $email, $address, $password, $type)
{
    $conn = db_connect();
    $data=[];

    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $last_name);
    $email = mysqli_real_escape_string($conn, $email);
    $address = mysqli_real_escape_string($conn, $address);
    $type = mysqli_real_escape_string($conn, $type);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //controllo se l'account (email) già esiste
    if (check_account_exists($conn, "utente", $email) == 0 || check_account_exists($conn, "azienda", $email) == 0) {
        return "&#8226 Email già esistente";
    }

    // Inserimento dei dati nel database con prepared statements
    $stmt = $conn->prepare("INSERT INTO utente (nome, cognome, email, indirizzo, password, tipo) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $address, $hashed_password, $type);
    
    // Esecuzione della query
    if ($stmt->execute()) {
        $_SESSION["id"] = $data['id_u'];
        header("Location: ../index.php");
        exit();
    } else {
        return "&#8226 Errore durante la registrazione";
    }  
}

function login_user($email, $password){
    $conn = db_connect();

    $email = trim($email);
    $password = trim($password);

    if ($email === '' || $password === '') {
        return "&#8226 Compilare tutti i campi";
    }

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Check if email belongs to an existing user
    $res = get_user($conn, "utente", $email);
    if ($res !== 0) {
        // Check if password is correct
        if (is_password_correct($password, $res['password'])) {
            $_SESSION["id"] = $res['id_u'];
            $_SESSION["tipo"] = $res['tipo'];
            header("Location: ../index.php");
            exit();
        } else {
            return "&#8226 Password errata";
        }
    }

    // Check if email belongs to an existing company
    $res = get_user($conn, "azienda", $email);
    if ($res !== 0) {
        // Check if password is correct
        if (is_password_correct($password, $res['password'])) {
            $_SESSION["id"] = $res['id_a'];
            $_SESSION["tipo"] = "azienda";
            header("Location: ../index.php");
            exit();
        } else {
            return "&#8226 Password errata";
        }
    }

    return "&#8226 Email non esistente";

}
function is_password_correct($password, $hash) {
    return password_verify($password, $hash);
}

function get_user($conn, $table, $email){
    $sql = "SELECT * FROM $table WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if($data === NULL){
        0;
    }
    return $data;
}