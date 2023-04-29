<?php
require('../include/_db_dal.inc.php');
require('_header.php');
$conn = db_connect();
$azienda = 1;
//DA SISTEMARE, PRENDERE ID DELL' AZIENDA LOGGATA
$lista_prodotti=get_products($conn,$azienda);
debug_to_console($lista_prodotti[0]['id_p']);
?>
<span style="font-size:2em; font-weight:600;">My Products</span>
<div class="mp_contenitore_prodotti">
<?php foreach($lista_prodotti as $prod){?>
    <div class="mp_prodotto">
        <?php if(get_images($conn,$prod['id_p'])){ $daje_roma = get_images($conn,$prod['id_p'])[0]['img'];?>
        <img class="mp_img" src="../assets/img/products/<?=$daje_roma?>"> <?php }
        else{ ?>
            <div class="mp_img">Nessuna immagine inserita</div>
        <?php }?>
        <div class="mp_prodotto_description">
            <span class="mp_prodotto_title"><?=$prod['titolo']?></span> 
            <span class="mp__prodotto_descr"><?=$prod['descrizione']?></span> 
            <span class="mp__prodotto_prezzo"><?=$prod['prezzo']?>$</span> 
        </div>
        <div class="mp_prodotto_opzioni">
            <form action="product_page.php" method="post">
            <button type="submit" name="edit" id="edit">Edit</button>
            <button type="submit" name="delete" id="delete">Delete</button>
            </form>
        </div>
    </div>
    <hr>
    <?php }?>
</div>
<?php require('_footer.php'); ?>