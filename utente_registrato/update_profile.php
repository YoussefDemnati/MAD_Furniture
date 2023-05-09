<?php
include("../include/_db_dal.inc.php");
$conn = db_connect();

$id_u = $_POST["id_u"];
$name = strval($_POST["name"]);
$surname = strval($_POST["surname"]);
$email = strval($_POST["email"]);
$address = strval($_POST["address"]);
$province = strval($_POST["province"]);
if ($province == "Province") {
    $p = NULL;
}else{
    $stmt = $conn->prepare("SELECT id_pv FROM provincia WHERE nome = ?");
    $stmt->bind_param("s", $province);
    $stmt->execute();
    $result = $stmt->get_result();
    $p = $result->fetch_assoc();
    $stmt->close();
}

$stmt = $conn->prepare("UPDATE utente
                        SET nome = ?, cognome = ?, email = ?, indirizzo = ?, id_p = ?
                        WHERE id_u = ?");
$stmt->bind_param("ssssii", $name, $surname, $email, $address, $p["id_pv"], $id_u);
$stmt->execute();
$stmt->close();

echo $name;
?>