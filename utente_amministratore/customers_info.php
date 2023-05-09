<?php
require('../include/_db_dal.inc.php');
require('_header.php');
$conn = db_connect();
?>
<br>
    <div class="quadrato1" style="height: 95vh;">
        <span class="titlee">Customers</span>
        <div class="rettangolo1" style="padding-top:20px;">
            <?php require('card_users_number.php');?> <br> <br> <br>
            <?php require('grafico_used_device.php');?> <br> <br> <br>
            <?php require('grafico_feedback.php');?>
        </div>
        <div class="rettangolo2">
            <?php require('grafico_daily_users.php');?> <br><br>
            <span style="display:inline-block; width:90%; text-align:center;">All Registred Users:</span> 
            <?php require('grafico_mappa.php');?>
        </div>
    </div>
<?php
require('_footer.php');
?>
