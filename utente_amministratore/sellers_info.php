<?php 
require('../include/_db_dal.inc.php');
require('_header.php');
$conn = db_connect();
$lista_aziende = get_aziende($conn);
?>
<span style="font-size:2em; font-weight:600;">Sellers</span>
<div class="si_contenitore_prodotti">
<?php foreach($lista_aziende as $azienda){?>
    <div class="si_azienda">
        <?php list($stars, $percentuali) = get_tot_rating_azienda($conn,$azienda);?>
        <span class="si_sellers_name"><?=$azienda['nome']?></span>   
        <span class="si_sellers_info1">P.IVA: <?=$azienda['partita_iva']?></span> 
        <span class="si_sellers_info">N° Selling Products: <?=count(get_all_products_azienda($conn,$azienda['id_a']))?></span> 
        <span class="si_sellers_info1">Registered office: <?=$azienda['indirizzo']?></span>  
        <span class="si_sellers_info">Avg Feedback: <img src="../assets/img/stars/star_<?=$stars?>.png" alt=""></span> 
        <span class=""></span> 
        <span class="si_sellers_info1">N° Sold Products: <?=count(get_products_selled($conn,$azienda['id_a']))?></span> 
        <span class="si_sellers_info1"></span>
        <a href="./sellers_products.php?id_a=<?=$azienda['id_a']?>">see all products</a>
    </div>
    <hr>
    <?php }?>
</div>
<?php require('_footer.php'); ?>