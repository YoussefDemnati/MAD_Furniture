<?php
require('../include/_db_dal.inc.php');
require('_header.php');
$conn = db_connect();
$azienda = 1;
//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA

$currentDate = new DateTime();
$month = $currentDate->format('m');
$year = $currentDate->format('Y');

?>
<div class="quadrato1">
    <?php require("grafico_totalsales.php"); ?>
    <br><br>
    <?php require("grafico_netprofit.php"); ?>
    <br><br>
    <?php require("grafico_salesvolume.php"); ?>
    <br><br>
    <?php require("grafico_avgorders.php"); ?>
    <br><br>
    <?php require("card_most_sold.php"); ?>
    <br><br>
    <?php require("card_less_sold.php"); ?>
</div>
<?php require('_footer.php'); ?>