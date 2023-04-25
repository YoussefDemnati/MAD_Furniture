<div class="card-4">
    <span class="card-4-header">Most Sold Product</span>
    <?php $ms_product=get_most_sold($conn,$azienda);?>
    <div class="card-4-description">
        <img class="card-4-image" src="../assets/img/products/<?=get_image($conn,$ms_product['id_p'])[1]['img']?>">
        <span class="card-4-feedback"></span>
        <span class="card-4-title"><?=$ms_product['titolo']?></span>
    </div>
</div>
