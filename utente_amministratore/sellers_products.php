<?php 
require('../include/_db_dal.inc.php');
require('_header.php');
$conn = db_connect();
// DA INSERIRE
if($_SESSION["tipo"] != " admin"){
    header("Location: ../index.php");
}
// DA INSERIRE
if(isset($_POST['delete'])){
    delete_product_2($conn,$_POST['id_p']);
    header("Location: ".$_SERVER['PHP_SELF']."?id_a=".$_POST['id_a']);
    exit;
}
if(isset($_GET['id_a'])){
$lista_prodotti = get_all_products_azienda($conn,$_GET['id_a']);
?>
<span style="font-size:2em; font-weight:600;"><?=get_azienda_name($conn,$_GET['id_a'])['nome']?></span>
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
            <form action="sellers_products.php" method="post">
            <input type="hidden" name="id_a" id="id_a" value=<?=$_GET['id_a']?>></input>
            <input type="hidden" name="id_p" id="id_p" value=<?=$prod['id_p']?>></input>
            <button type="submit" name="delete" id="delete">Delete</button>
            </form>
        </div>
    </div>
    <hr>
    <?php }?>
</div>
<?php } require('_footer.php'); ?>