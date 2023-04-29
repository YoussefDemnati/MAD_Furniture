<?php
include("../include/_db_dal.inc.php");
$conn = db_connect();

$idEc = $_GET["idEc"];
$qty = intval($_GET["qty"]);
$curval = intval($_GET["curval"]);
$total = $qty + $curval;

$sql = "UPDATE elemento_carrello
        SET quantita = $total
        WHERE idEc = $idEc";
$conn->query($sql);

echo "updated";
?>