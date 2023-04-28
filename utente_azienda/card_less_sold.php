<div class="card-4">
    <span class="card-4-header">Less Sold Product</span>
    <?php $ls_product=get_less_sold($conn,$azienda);?>
    <div class="card-4-description">
        <img class="card-4-image" src="../assets/img/products/<?=get_images($conn,$ms_product['id_p'])[1]['img']?>">
        <span class="card-4-feedback">stelle</span>
        <span class="card-4-title"><?=$ms_product['titolo']?></span>
    </div>
</div>
