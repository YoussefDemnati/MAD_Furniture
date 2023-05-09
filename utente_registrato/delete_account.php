<?php
include("../include/_db_dal.inc.php");
$conn = db_connect();

$id_u = $_POST["id_u"];

$sql = "UPDATE utente SET `hidden` = 1 WHERE id_u = $id_u";

$conn->query($sql);
?>