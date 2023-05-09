<div class="card-4">
    <span class="card-4-header">Most Sold Product</span>
    <?php $ms_product=get_most_sold_ever($conn);
    // print_r(get_images($conn,$ms_product['id_p'])[0]['img']);?>
    <div class="card-4-description">
        <?php if(get_images($conn,$ms_product['id_p'])) {?>
        <img class="card-4-image" src="../assets/img/products/<?=$ms_product['id_p']?>/<?php echo get_images($conn,$ms_product['id_p'])[0]['img']?>">
        <?php } else{ ?> 
        <div class="mp_img">Nessuna immagine inserita</div>
        
        <?php } list($pippo,$coca) = get_tot_rating_prodotto($conn,$ms_product['id_p']);?>
        <img class="card-4-feedback" src="../assets/img/stars/star_<?=$pippo?>.png" alt="">
        <span class="card-4-title"><?=$ms_product['titolo']?></span>
    </div>
</div>
