<?php
require('_db_config.inc.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

function db_connect()
{
    global $servername, $db_username, $db_password, $db_name;
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Verifica connessione
    if ($conn->connect_error) {
        die("Connection : " . $conn->connect_error);
    }
    return $conn;
}

// function get_flyers($conn, $id)
// {
//     $id = intval($id);
//     $sql = "SELECT *
//             FROM promozione
//             WHERE id_v = $id";
//     $result = $conn->query($sql);
//     $rows = $result->fetch_all(MYSQLI_ASSOC);
//     return $rows;
// }


function get_products_by_user($conn, $uid)
{
    $uid = intval($uid);
    $sql = "SELECT *
            FROM elemento_carrello AS ec
            INNER JOIN prodotto AS p ON ec.id_pr=p.id_p
            WHERE id_u = $uid";
    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}

function get_total_price($conn, $uid)
{
    $products = get_products_by_user($conn, $uid);
    $total_price = 0;
    foreach ($products as $product) {
        $total_price += $product["prezzo"] * (float)$product["quantita"];
    }
    return $total_price;
}

function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

function debug_to_json($data)
{
    $output = json_encode($data);
    echo "<script>console.log(JSON.stringify(" . $output . "));</script>";
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
    $data = [];
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
        $_SESSION["id"] = $stmt->insert_id;
        $_SESSION["tipo"] = "azienda";
        header("Location: ../index.php");
        exit();
    } else {
        return "&#8226 Errore durante la registrazione";
    }
}


function signup_privato($first_name, $last_name, $email, $address, $password, $type)
{
    $conn = db_connect();
    $data = [];

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
        $_SESSION["id"] = $stmt->insert_id;
        $_SESSION["tipo"] = "privato";
        header("Location: ../index.php");
        exit();
    } else {
        return "&#8226 Errore durante la registrazione";
    }
}

function login_user($email, $password)
{
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
function is_password_correct($password, $hash)
{
    return password_verify($password, $hash);
}


function new_product_semilavorato(
    $conn,
    $titolo,
    $descrizione,
    $prezzo,
    $altezza,
    $larghezza,
    $spessore,
    $casa_produttrice,
    $indirizzo_magazzino,
    $forma,
    $azienda,
    $materiale,
    $images) {
    $all_variables_not_empty = array_reduce([
        $titolo,
        $descrizione,
        $prezzo,
        $altezza,
        $larghezza,
        $spessore,
        $casa_produttrice,
        $indirizzo_magazzino,
        $forma,
        $azienda,
        $materiale,
        $images
    ], function ($carry, $item) {
        return $carry && !empty($item);
    }, true);

    if ($all_variables_not_empty) {

        $oggi = date('Y-m-d H:i:s');
        $main_sql = "INSERT INTO `prodotto` (`titolo`, `descrizione`, `prezzo`,
    `data_inserimento`, `altezza`, `larghezza`, `spessore`, `casa_produttrice`,
    `indirizzo_magazzino`, `forma`, `tipo`, `id_a`, `id_m`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'semilavorato', ?, ?)";

        $stmt = $conn->prepare($main_sql);
        $stmt->bind_param(
            "ssdsdddsssii",
            $titolo,
            $descrizione,
            $prezzo,
            $oggi,
            $altezza,
            $larghezza,
            $spessore,
            $casa_produttrice,
            $indirizzo_magazzino,
            $forma,
            $azienda,
            $materiale
        );

        $stmt->execute();
        $stmt->close();

        $last_element_sql = "SELECT id_p FROM `prodotto` ORDER BY id_p DESC LIMIT 1;";
        $result = $conn->query($last_element_sql);

        $ultimo_record = "";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ultimo_record = $row;
            // echo "La tabella non è vuota.";
        } else {
            // echo "La tabella è vuota.";
        }
        $image_sql = "INSERT INTO `immagine` (`id_img`,`img`, `id_p`) VALUES (NULL, ?, ?)";



        mkdir("../assets/img/products/" . implode($ultimo_record));
        for ($i = 0; $i < count($images['name']); $i++) {
            // $name = explode('.', $images['name'][$i]);
            $extension = 'png'; //end($name);
            $tmp_name = $images['tmp_name'][$i];
            move_uploaded_file($tmp_name, "../assets/img/products/" . $ultimo_record['id_p'] . "/" . $i . "." . $extension);
            $formedstring = implode($ultimo_record) . "/" . $i . "." . $extension;
            $stmt = $conn->prepare($image_sql);
            $stmt->bind_param("si", $formedstring, $ultimo_record['id_p']);
            $stmt->execute();
            $stmt->close();
            debug_to_console("formedstring: " . $formedstring);
            debug_to_console("ultimo_record: " . $ultimo_record['id_p']);
            // Header('Location: ../utente_azienda/dashboard.php');
        }
        // echo count($images['name']) . " immagini caricate con successo!";

    } else {
        return "&#8226 Compilare Tutti i Campi!";
    }
}
function new_product_finito(
    $conn,
    $titolo,
    $descrizione,
    $prezzo,
    $tipo_prodotto_finito,
    $altezza,
    $larghezza,
    $profondita,
    $modello,
    $casa_produttrice,
    $indirizzo_magazzino,
    $categoria,
    $azienda,
    $images
) {
        $oggi = date('Y-m-d H:i:s');
        $main_sql = "INSERT INTO `prodotto` (`titolo`, `descrizione`, `prezzo`,
    `data_inserimento`, `tipo_prodotto_finito`, `altezza`, `larghezza`,
    `profondita`, `modello`, `casa_produttrice`,
    `indirizzo_magazzino`, tipo, `id_cat`, `id_a`)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'finito', ?, ?)";

        $stmt = $conn->prepare($main_sql);
        $stmt->bind_param(
            "ssdssdddsssii",
            $titolo,
            $descrizione,
            $prezzo,
            $oggi,
            $tipo_prodotto_finito,
            $altezza,
            $larghezza,
            $profondita,
            $modello,
            $casa_produttrice,
            $indirizzo_magazzino,
            $categoria,
            $azienda
        );

        $stmt->execute();
        $stmt->close();

        $last_element_sql = "SELECT id_p FROM `prodotto` ORDER BY id_p DESC LIMIT 1;";
        $result = $conn->query($last_element_sql);

        $ultimo_record = "";
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ultimo_record = $row;
            // echo "La tabella non è vuota.";
        } else {
            // echo "La tabella è vuota.";
        }
        $image_sql = "INSERT INTO `immagine` (`img`, `id_p`) VALUES (?, ?)";


        mkdir("../assets/img/products/" . implode($ultimo_record));
        for ($i = 0; $i < count($images['name']); $i++) {
            // $name = explode('.', $images['name'][$i]);
            $extension = 'png'; //end($name);
            $tmp_name = $images['tmp_name'][$i];
            move_uploaded_file($tmp_name, "../assets/img/products/" . implode($ultimo_record) . "/" . $i . "." . $extension);
            $formedstring = implode($ultimo_record) . "/" . $i . "." . $extension;
            $stmt = $conn->prepare($image_sql);
            $stmt->bind_param("si", $formedstring, $ultimo_record);
            $stmt->execute();
            $stmt->close();
        }
        Header('Location: ../utente_azienda/dashboard.php');

}

function get_user($conn, $table, $email)
{
    $sql = "SELECT * FROM $table WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if ($data === NULL) {
        return 0;
    }
    return $data;
}

function get_products($conn, $azienda)
{
    $sql = "SELECT * FROM prodotto WHERE id_a = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $azienda);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if ($data === NULL) {
        return 0;
    }
    return $data;
}

function get_materials()
{
    $conn = db_connect();

    $query = "SELECT id_m, nome FROM materiale";
    $result = mysqli_query($conn, $query);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_tipi_prodotto_finito()
{
    $conn = db_connect();

    $query = "SELECT id_tipo, nome FROM tipo_prodotto_finito";
    $result = mysqli_query($conn, $query);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_categories()
{
    $conn = db_connect();

    $query = "SELECT id_cat, nome, descrizione FROM categoria";
    $result = mysqli_query($conn, $query);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function get_categories_perc($conn){
    $sql = "SELECT c.nome,COUNT(*) as conteggio
    FROM prodotto p 
    INNER JOIN categoria c ON p.id_cat=c.id_cat
    GROUP BY c.nome";

    $result = mysqli_query($conn, $sql);
    $data = $result->fetch_all(MYSQLI_ASSOC); 
    debug_to_json($data);
    return $data;
}



function get_product($conn, $id)
{
    $sql = "SELECT p.titolo, p.descrizione, p.prezzo, p.tipo, t.nome, p.altezza, p.larghezza, p.profondita, p.modello, p.casa_produttrice, c.nome as 'categoria', m.nome as 'materiale', a.nome as 'azienda' FROM prodotto p 
    INNER JOIN materiale m on m.id_m = p.id_m 
    INNER JOIN categoria c on c.id_cat = p.id_cat 
    INNER JOIN azienda a on a.id_a = p.id_a
    INNER JOIN tipo_prodotto_finito t on t.id_tipo = p.tipo_prodotto_finito
    WHERE p.id_p = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    debug_to_console($data);
}

function get_product_rating($conn, $id)
{
    $sql = "SELECT * FROM feedback WHERE id_p = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    return $data;
}


function delete_product($conn, $prodotto)
{
    $sql = "DELETE FROM prodotti WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $prodotto);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("products.php");
    } else {
        echo "Errore durante la cancellazione del prodotto.";
    }
    $stmt->close();
}

function total_sales($conn, $azienda,$day,$month,$year)
{
    $sql = "SELECT IFNULL(SUM(p.prezzo),0)
    FROM elemento_ordine eo 
    INNER JOIN prodotto p on eo.id_p=p.id_p
    INNER JOIN azienda a on p.id_a=a.id_a
    INNER JOIN ordine o ON eo.id_o=o.id_o 
    WHERE a.id_a=? and DAY(o.data_esecuzione) = ? AND MONTH(o.data_esecuzione) = ? AND YEAR(o.data_esecuzione) = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiii', $azienda,$day,$month,$year);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    return number_format(floatval(implode($data)),2);
}

function total_sales_ever($conn,$day,$month,$year){
    $sql = "SELECT IFNULL(SUM(p.prezzo),0)
    FROM elemento_ordine eo 
    INNER JOIN prodotto p on eo.id_p=p.id_p
    INNER JOIN azienda a on p.id_a=a.id_a
    INNER JOIN ordine o ON eo.id_o=o.id_o 
    WHERE DAY(o.data_esecuzione) = ? AND MONTH(o.data_esecuzione) = ? AND YEAR(o.data_esecuzione) = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii',$day,$month,$year);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return number_format(floatval(implode($data)),2);
}
function net_profit($conn, $azienda)
{
    $sql = "SELECT SUM(p.prezzo)
    FROM elemento_ordine eo 
    INNER JOIN prodotto p on eo.id_p=p.id_p
    INNER JOIN azienda a on p.id_a=a.id_a
    INNER JOIN ordine o ON eo.id_o=o.id_o 
    WHERE a.id_a=? and MONTH(o.data_esecuzione) = MONTH(DATE(NOW()));";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $azienda);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data === NULL) {
        return 0;
    }

    return number_format(floatval(implode($data)),2);
}

function net_profit_ever($conn, $day,$month,$year)
{
    $sql = "SELECT IFNULL(SUM(p.prezzo),0)
    FROM elemento_ordine eo 
    INNER JOIN prodotto p on eo.id_p=p.id_p
    INNER JOIN azienda a on p.id_a=a.id_a
    INNER JOIN ordine o ON eo.id_o=o.id_o 
    WHERE DAY(o.data_esecuzione) = ? AND MONTH(o.data_esecuzione) = ? AND YEAR(o.data_esecuzione) = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii',$day,$month,$year);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return number_format(floatval(implode($data))/100*85,2);
}

function sales_volume($conn, $azienda, $mese, $anno)
{
    $sql = "SELECT DATE_FORMAT(o.data_esecuzione, '%Y-%m-%d') AS giorno,SUM(p.prezzo) AS guadagno
    FROM ordine o
    INNER JOIN elemento_ordine eo ON eo.id_o=o.id_o
    INNER JOIN prodotto p ON p.id_p=eo.id_p
    WHERE 
    MONTH(o.data_esecuzione) = ? AND
    YEAR(o.data_esecuzione) = ? AND
    p.id_a = ?
    GROUP BY DAY(o.data_esecuzione), o.data_esecuzione
    ORDER BY o.data_esecuzione;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $mese, $anno, $azienda);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}
function sales_volume_ever($conn, $mese, $anno)
{
    $sql = "SELECT DATE_FORMAT(o.data_esecuzione, '%Y-%m-%d') AS giorno,SUM(p.prezzo) AS guadagno
    FROM ordine o
    INNER JOIN elemento_ordine eo ON eo.id_o=o.id_o
    INNER JOIN prodotto p ON p.id_p=eo.id_p
    WHERE 
    MONTH(o.data_esecuzione) = ? AND
    YEAR(o.data_esecuzione) = ?
    GROUP BY DAY(o.data_esecuzione), o.data_esecuzione
    ORDER BY o.data_esecuzione;";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $mese, $anno);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}
function get_sales_volume_per_5days($conn, $azienda, $mese, $anno)
{
    if ($mese == 0) {
        $mese = 12;
        $anno -= 1;
    }
    $array = sales_volume($conn, $azienda, $mese, $anno);
    $somma_mese = [0, 0, 0, 0, 0, 0];
    $media_mese = [0, 0, 0, 0, 0, 0];
    foreach ($array as $a) {
        for ($i = 0; $i < 6; $i++) {
            if (intval(substr($a["giorno"], 8, 10)) >= ($i * 5) && intval(substr($a["giorno"], 8, 10)) <= ($i + 1) * 5) {
                $somma_mese[$i] += intval($a["guadagno"]);
            }
        }
    }
    for ($i = 0; $i < count($somma_mese); $i++) {
        $media_mese[$i] = $somma_mese[$i] / 5;
    }

    return $media_mese;
}

function get_sales_volume_per_5days_ever($conn, $mese, $anno){
    if ($mese == 0) {
        $mese = 12;
        $anno -= 1;
    }
    $array = sales_volume_ever($conn, $mese, $anno);
    $somma_mese = [0, 0, 0, 0, 0, 0];
    $media_mese = [0, 0, 0, 0, 0, 0];
    foreach ($array as $a) {
        for ($i = 0; $i < 6; $i++) {
            if (intval(substr($a["giorno"], 8, 10)) >= ($i * 5) && intval(substr($a["giorno"], 8, 10)) <= ($i + 1) * 5) {
                $somma_mese[$i] += intval($a["guadagno"]);
            }
        }
    }
    for ($i = 0; $i < count($somma_mese); $i++) {
        $media_mese[$i] = $somma_mese[$i] / 5;
    }

    return $media_mese;
}

function getMonthName($monthNum)
{
    $months = array(
        1 => 'Gennaio',
        2 => 'Febbraio',
        3 => 'Marzo',
        4 => 'Aprile',
        5 => 'Maggio',
        6 => 'Giugno',
        7 => 'Luglio',
        8 => 'Agosto',
        9 => 'Settembre',
        10 => 'Ottobre',
        11 => 'Novembre',
        12 => 'Dicembre'
    );
    return $months[$monthNum];
}

function get_avg_orders($conn, $azienda, $mese, $anno)
{
    if ($mese == 0) {
        $mese = 12;
        $anno -= 1;
    }
    $sql = "SELECT AVG(p.prezzo)
            FROM ordine o 
            INNER JOIN elemento_ordine eo ON eo.id_o=o.id_o
            INNER JOIN prodotto p ON p.id_p=eo.id_p
            WHERE MONTH(o.data_esecuzione) = ?
            AND YEAR(o.data_esecuzione) = ?
            AND p.id_a = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $mese, $anno, $azienda);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data === NULL) {
        return 0;
    }

    return number_format(floatval(implode($data)),2);
}

function get_most_sold($conn, $azienda)
{
    $sql = "SELECT * FROM prodotto p WHERE p.id_p =(SELECT p.id_p 
    FROM ordine o 
    INNER JOIN elemento_ordine eo on eo.id_o=o.id_o 
    INNER JOIN prodotto p ON p.id_p=eo.id_p 
    WHERE p.id_a = ?
    GROUP BY p.id_p 
    ORDER BY count(p.id_p) DESC 
    LIMIT 1);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $azienda);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data === NULL) {
        return 0;
    }
    return $data;
}

function get_images($conn, $prodotto)
{
    $sql = "SELECT * FROM immagine i WHERE i.id_p = ?;";
    $stmt = $conn->prepare($sql);
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $prodotto);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    return $rows;
}

function get_less_sold($conn, $azienda)
{
    $sql = "SELECT * FROM prodotto p WHERE p.id_p =(SELECT p.id_p 
    FROM ordine o 
    INNER JOIN elemento_ordine eo on eo.id_o=o.id_o 
    INNER JOIN prodotto p ON p.id_p=eo.id_p 
    WHERE p.id_a = ?
    GROUP BY p.id_p 
    ORDER BY count(p.id_p) ASC 
    LIMIT 1);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $azienda);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data === NULL) {
        return 0;
    }
    return $data;
}

function get_less_sold_ever($conn){
    $sql = "SELECT * FROM prodotto p WHERE p.id_p =(SELECT p.id_p 
    FROM ordine o 
    INNER JOIN elemento_ordine eo on eo.id_o=o.id_o 
    INNER JOIN prodotto p ON p.id_p=eo.id_p 
    GROUP BY p.id_p 
    ORDER BY count(p.id_p) ASC 
    LIMIT 1);";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    if ($data === NULL) {
        return 0;
    }
    return $data;
}
function get_tot_rating_prodotto($conn,$prodotto){
    $feedbacks = get_product_rating($conn, $prodotto);
    $sum = 0;
    debug_to_json($feedbacks);
    $count = count($feedbacks);
    if ($count != 0) {
        foreach ($feedbacks as $feedback) {
            $sum += intval($feedback["valutazione"]);
        }
        $stars = intdiv($sum, $count);
        $stars_count = array_count_values(array_column($feedbacks, 'valutazione'));
        $total = count($feedbacks);
        $percentuali = array();
        $all_stars = array(1, 2, 3, 4, 5);

        foreach ($all_stars as $voto) {
            if (isset($stars_count[$voto])) {
                $num = $stars_count[$voto];
                $percentuale = round(($num / $total) * 100, 2);
            } else {
                $percentuale = 0;
            }
        
            $percentuali[] = array(
                'titolo' => $voto,
                'percentuale' => $percentuale
            );
        }
        debug_to_json($percentuali);

    }
    else{
        $stars = 0;
        $percentuali = 0;
    }
    debug_to_console($stars);
    return array($stars,$percentuali);
}
function get_tot_rating_azienda($conn,$azienda){
    $albero=1;
    $sql = 'SELECT *
    FROM feedback d
    INNER JOIN prodotto p ON d.id_p=p.id_p 
    WHERE p.id_a = ?;';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $albero);
    $stmt->execute();
    $result = $stmt->get_result();
    $feedbacks = $result->fetch_all(MYSQLI_ASSOC);
    $sum = 0;
    debug_to_console("get_tot_rating_azienda");
    // debug_to_console($feedbacks);
    $count = count($feedbacks);
    if ($count != 0) {
        foreach ($feedbacks as $feedback) {
            $sum += intval($feedback["valutazione"]);
        }
        $stars = intdiv($sum, $count);
        $stars_count = array_count_values(array_column($feedbacks, 'valutazione'));
        $total = count($feedbacks);
        $percentuali = array();
        $all_stars = array(1, 2, 3, 4, 5);

        foreach ($all_stars as $voto) {
            if (isset($stars_count[$voto])) {
                $num = $stars_count[$voto];
                $percentuale = round(($num / $total) * 100, 2);
            } else {
                $percentuale = 0;
            }
        
            $percentuali[] = array(
                'titolo' => $voto,
                'percentuale' => $percentuale
            );
        }
        // debug_to_json($percentuali);

    }
    else{
        $stars = 0;
    }
    // debug_to_console($stars);
    return array($stars,$percentuali);
}

function item_in_cart($array, $targetId)
{
    foreach ($array as $element) {
        if ($element["id_pr"] == $targetId) {
            return true;
        }
    }
    return false;
}

function search_products($conn, $page, $search_query, $type, $category_id)
{
    $search_query = $search_query !== NULL ? '%' . $search_query . '%' : '';
    debug_to_console($search_query);
    $page = intval($page);
    debug_to_console($type);
    if ($type == "new") {
        $sql = 'SELECT * FROM prodotto ORDER BY data_inserimento DESC LIMIT ' . $page * 100 . ', 100';
        debug_to_console($sql);

        $stmt = $conn->prepare($sql);
    } else if ($type == "trending") {
        $sql = 'SELECT p.* , COUNT(*) AS num_ordini FROM elemento_ordine eo INNER JOIN prodotto p ON p.id_p = eo.id_p GROUP BY eo.id_p ORDER BY num_ordini DESC LIMIT ' . $page * 100 . ', 100';
        debug_to_console($sql);

        $stmt = $conn->prepare($sql);
    } else if ($category_id !== NULL) {
        $sql = 'SELECT * FROM prodotto 
        WHERE id_cat = ? 
        ORDER BY RAND()
        LIMIT ' . $page * 100 . ', 100';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $category_id);
    } else if ($search_query !== NULL) {
        $sql = 'SELECT * FROM prodotto WHERE titolo LIKE ? ORDER BY RAND() LIMIT ' . $page * 100 . ', 100';
        debug_to_console($sql);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $search_query);
    }

    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_all(MYSQLI_ASSOC);
}

function get_hompeage_trending($conn)
{
    $sql = 'SELECT p.* , COUNT(*) AS num_ordini FROM elemento_ordine eo INNER JOIN prodotto p ON p.id_p = eo.id_p GROUP BY eo.id_p ORDER BY num_ordini DESC LIMIT 6;';
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

function get_flyers($conn)
{
    $sql = "SELECT p.nome, p.descrizione, pr.id_p, p.sconto FROM volantino v
    INNER JOIN promozione p on p.id_v = v.id_v
    INNER JOIN prodotto pr on p.id_prodotto = pr.id_p
    ORDER BY v.data_inizio
    LIMIT 4;";
    return $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
}

