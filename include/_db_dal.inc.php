<?php
require('_db_config.inc.php');

function db_connect(){
    global $servername, $db_username, $db_password, $db_name;
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Verifica connessione
    if ($conn->connect_error) {
        die("Connction failed: " . $conn->connect_error);
    }
    return $conn;
}

function signup_azienda($company_name, $address, $email, $phone, $password){
    $conn = db_connect();
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserimento dei dati nel database con prepared statements
    $stmt = $conn->prepare("INSERT INTO azienda (nome, indirizzo, email, telefono, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $company_name, $address, $email, $phone, $hashed_password);
    $stmt->execute();
}
function signup_privato(){
    $conn = db_connect();
}

?>