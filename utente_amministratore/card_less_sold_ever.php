<div class="card-4">
    <span class="card-4-header">Less Sold Product</span>
    <?php $ls_product=get_less_sold_ever($conn);?>
    <div class="card-4-description">
        <?php if(get_images($conn,$ls_product['id_p'])) {?>
        <img class="card-4-image" src="../assets/img/products/<?=$ls_product['id_p']?>/<?php echo get_images($conn,$ls_product['id_p'])[0]['img']?>">
        <?php } else{ ?> 
        <div class="mp_img">Nessuna immagine inserita</div>
        <?php } list($pippo,$coca) = get_tot_rating_prodotto($conn,$ls_product['id_p']);?>
        <img class="card-4-feedback" src="../assets/img/stars/star_<?=$pippo?>.png" alt="">
        <span class="card-4-title"><?=$ls_product['titolo']?></span>
    </div>
</div>
