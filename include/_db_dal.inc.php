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

<<<<<<< HEAD
function new_product($conn,$titolo,$descrizione,$prezzo,$tipo_prodotto,$altezza,$larghezza,$profondita,$spessore,$modello,$casa_produttrice,$indirizzo_magazzino,$forma,$tipo,$image){
    $oggi = date('d/m/Y H:i:s');

}
=======
>>>>>>> fe1931db6d7f05e48e93ae3235299bcee018e379
?>