<?php
require('../include/_db_dal.inc.php');
require('_header.php');
$conn = db_connect();
$azienda = 1;
//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA

$currentDate = new DateTime();
$day = $currentDate->format('d');
$month = $currentDate->format('m');
$year = $currentDate->format('Y');

?>

<br>
    <div class="quadrato1">
        <span class="titlee">Products</span>
        <div class="quadratino1">
            <?php require('grafico_productscategory.php');?>
        </div>
        <div class="quadratino2">
        <?php require('card_less_sold_ever.php');?>
        <div style="width:20px;"></div>
        <?php require('card_most_sold_ever.php');?>
        </div>
        
    </div>
    <br>
    <div class="quadrato1">
    <span class="titlee">Revenue</span>
    <div class="quadratino1">
            <?php require("grafico_totalsales_ever.php"); ?>
            <?php require("grafico_netprofit_ever.php"); ?>
        </div>
    <div class="quadratino1">
    </div>
    <div class="quadratino3">
    </div>
    </div>
</div>
<?php require('_footer.php'); ?>