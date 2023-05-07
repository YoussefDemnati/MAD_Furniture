<?php
include("../include/_db_dal.inc.php");
$conn = db_connect();

$id_u = $_POST["id_u"];
$name = $_POST["name"];
$surname = $_POST["surname"];
$email = $_POST["email"];
$address = $_POST["address"];
$province = $_POST["province"];
if ($province == "Province") {
    $p = NULL;
}else{
    $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id_pv FROM provincia WHERE nome = $province"));
}
$sql = "UPDATE utente
        SET nome = $name,
            cognome = $surname,
            email = $email,
            indirizzo = $address,
            id_p = $p
        WHERE id_u = $id_u";
$conn->query($sql);

echo $name;
