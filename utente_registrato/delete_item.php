<?php
include("../include/_db_dal.inc.php");
$conn = db_connect();

$idEc = $_GET["idEc"];

$sql = "DELETE
        FROM elemento_carrello
        WHERE idEc = $idEc";
debug_to_console("updated");
$conn->query($sql);
echo "updated";
?>