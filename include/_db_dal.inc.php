<?php
require('_db_config.inc.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function db_connect(){
    global $servername, $db_username, $db_password, $db_name;
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Verifica connessione
    if ($conn->connect_error) {
        die("Connction : " . $conn->connect_error);
    }
    return $conn;
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function signup_azienda($company_name, $address, $email, $phone, $password){
    $conn = db_connect();
}
function signup_privato(){
    $conn = db_connect();
}

function new_product($conn,$titolo,$descrizione,$prezzo,$tipo_prodotto,$altezza,$larghezza,$profondita,$spessore,$modello,$casa_produttrice,$indirizzo_magazzino,$forma,$tipo,$categoria,$azienda,$image){
    $oggi = date('Y-m-d H:i:s');

    $main_sql= "INSERT INTO `prodotto` (`id_p`, `titolo`, `descrizione`, `prezzo`,
    `data_inserimento`, `tipo_prodotto_finito`, `altezza`, `larghezza`,
    `profondita`, `spessore`, `modello`, `casa_produttrice`,
    `indirizzo_magazzino`, `forma`, `tipo`, `hidden`, `id_pc`, `id_cat`, `id_a`)
    VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, false, NULL, ?, ?)";

    $stmt = $conn->prepare($main_sql);
    $stmt->bind_param("ssdssddddsssssii", $titolo, $descrizione, $prezzo, $oggi,
    $tipo_prodotto,$altezza,$larghezza,$profondita,$spessore,$modello,
    $casa_produttrice,$indirizzo_magazzino,$forma,$tipo,$categoria, $azienda);
    $stmt->execute();
    $stmt->close();

    $last_element_sql="SELECT * FROM `prodotto` ORDER BY id_p DESC LIMIT 1;";
    $result = $conn->query($last_element_sql);

    $ultimo_record="pippo";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ultimo_record = $row;
        echo "La tabella non è vuota.";
    } else {
        echo "La tabella è vuota.";
    }

    try {
    $image_sql= "INSERT INTO `immagine` (`id_img`,`img`, `id_p`) VALUES (NULL, ?, ?)";
    $stmt = $conn->prepare($image_sql);
    $stmt->bind_param("si",$image,$ultimo_record);
    $stmt->execute();
    $stmt->close();
} catch (PDOException $e) {
    // handle the exception here
    // echo "Error: " . $e->getMessage();
    die("error .: " . $e->getMessage());
}
}

function imagefromblob($conn,$id_p){
// Query per selezionare l'immagine dal database
    $sql = "SELECT img FROM immagine WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$id_p);
    $stmt->execute();
    $stmt->close();
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // Leggi il contenuto del campo BLOB
    $row = $result->fetch_assoc();
    $image_data = $row["image_blob"];

    // Imposta l'header della risposta come un'immagine
    header("Content-Type: image/png");

    // Stampa il contenuto del campo BLOB
    echo $image_data;
    } else {
    echo "Nessuna immagine trovata";
    }

}
?>