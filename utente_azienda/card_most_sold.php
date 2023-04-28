<div class="card-4">
    <span class="card-4-header">Most Sold Product</span>
    <?php $ms_product=get_most_sold($conn,$azienda);?>
    <div class="card-4-description">
        <img class="card-4-image" src="../assets/img/products/<?=get_images($conn,$ms_product['id_p'])[0]['img']?>">
        <span class="card-4-feedback">stelle</span>
        <span class="card-4-title"><?=$ms_product['titolo']?></span>
    </div>
</div>
