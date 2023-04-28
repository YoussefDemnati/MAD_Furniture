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
        <span class="titlee">Earings</span>
        <div class="quadratino1">
            <?php require("grafico_totalsales.php"); ?>
            <?php require("grafico_netprofit.php"); ?>
        </div>
        <div class="quadratino2">
        <?php require("grafico_salesvolume.php"); ?>
        </div>
    </div>
    <div class="quadrato1">
    <div class="quadratino1">
        <?php require("grafico_avgorders.php"); ?>
        <?php require("grafico_totalsales.php"); ?>
        <?php require("grafico_totalsales.php"); ?>
    </div>
    <div class="quadratino2">
        <?php require("card_most_sold.php"); ?>
        <?php require("card_less_sold.php"); ?>
    </div>
    </div>
    <br><br>
    <?php require("grafico_avgorders.php"); ?>
    <br><br>
    <?php require("card_most_sold.php"); ?>
    <br><br>
    <?php require("card_less_sold.php"); ?>
</div>
<?php require('_footer.php'); ?>