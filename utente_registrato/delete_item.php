<?php
include("../include/_db_dal.inc.php");
$conn = db_connect();

$idEc = $_GET["idEc"];
$uId = $_GET["uId"];
$action = $_GET["action"];

if($action == "delete_one"){
        $sql = "DELETE
                FROM elemento_carrello
                WHERE idEc = $idEc";
        $conn->query($sql);
}
if($action == "delete_all"){
        $sql = "DELETE
                FROM elemento_carrello
                WHERE id_u = $uId";
        $conn->query($sql);
}

$tot = "SELECT SUM(p.prezzo*ec.quantita) AS prezzo_tot, COUNT(*) AS num_items
        FROM elemento_carrello AS ec
        INNER JOIN prodotto AS p ON ec.id_pr=p.id_p
        WHERE ec.id_u = $uId";
echo json_encode($conn->query($tot)->fetch_assoc());
