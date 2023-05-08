<?php
include("../include/_db_dal.inc.php");
$_SESSION = array();
session_unset();
session_destroy();
header("Location: ../index.php");
?>