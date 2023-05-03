<?php
include("assets/include/_db_dal.inc.php");
$_SESSION = [];
session_unset();
session_destroy();
header("Location: index.php");
?>