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

function new_product($conn,$titolo,$descrizione,$prezzo,$tipo_prodotto,$altezza,$larghezza,$profondita,$spessore,$modello,$casa_produttrice,$indirizzo_magazzino,$forma,$tipo,$categoria,$azienda,$images){
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

    $last_element_sql="SELECT id_p FROM `prodotto` ORDER BY id_p DESC LIMIT 1;";
    $result = $conn->query($last_element_sql);

    $ultimo_record="pippo";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ultimo_record = $row;
        // echo "La tabella non è vuota.";
    } else {
        // echo "La tabella è vuota.";
    }
    $image_sql= "INSERT INTO `immagine` (`id_img`,`img`, `id_p`) VALUES (NULL, ?, ?)";

  if (isset($images) && !empty($images)) {
    mkdir("../assets/img/products/" . implode($ultimo_record));
    for ($i = 0; $i < count($images['name']); $i++) {
    $name = explode('.', $images['name'][$i]);
      $extension = end($name);
      $tmp_name = $images['tmp_name'][$i];
      move_uploaded_file($tmp_name, "../assets/img/products/" . implode($ultimo_record) . "/" . $i . "." . $extension);
      $formedstring = implode($ultimo_record) . "/" . $i . "." . $extension;
      $stmt = $conn->prepare($image_sql);
      $stmt->bind_param("si",$formedstring,$ultimo_record);
      $stmt->execute();
      $stmt->close();
    }
    // echo count($images['name']) . " immagini caricate con successo!";

  } else {
    // echo "Nessuna immagine selezionata!";
  }

}
?>