<?php
require('../include/_db_dal.inc.php');
require('_header.php');
$conn = db_connect();
$azienda = 1;
//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA
?>
<div class="quadrato1">
    <?php require("grafico_totalsales.php"); ?>
    <br><br>
    <?php require("grafico_netprofit.php"); ?>
    <br><br>
    <?php require("grafico_salesvolume.php"); ?>
</div>