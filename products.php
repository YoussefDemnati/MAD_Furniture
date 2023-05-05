<?php
include('include/_db_dal.inc.php');
include('include/_header.inc.php');
$conn = db_connect();
//da sistemare le immagini
$type = isset($_GET["type"]) ? $_GET["type"] : NULL;
$search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : NULL;
$category_id = isset($_GET["category"]) ? $_GET["category"] : NULL;

$products = search_products($conn, 0, $search_query, $type, $category_id);
debug_to_json($products);
?>
<div class="products_list">
    <?php foreach ($products as $product) {
        $feedbacks = get_product_rating($conn, $product["id_p"]);
        $sum = 0;
        $count = count($feedbacks);
        if ($count != 0) {
            foreach ($feedbacks as $feedback) {
                $sum += intval($feedback["valutazione"]);
            }
            $stars = intdiv($sum, $count);
        }
    ?>
        <div class="product" id="<?=$product["id_p"]?>">
            <div>
                <img src="./assets/img/products/<?= $product["id_p"] ?>/0.png" alt="">
                <!-- <img src="./assets/img/lampada.png" alt=""> -->
            </div>
            <img src="./assets/img/stars/star_<?=$stars?>.png" alt="">
            <p><?= $product["titolo"] ?></p>
            <span><?= $product["prezzo"] ?> $</span>
        </div>
    <?php } ?>
</div>
<script>
        $(".product").click(function() {
        var idP = $(this).attr("id");
      window.location.href = `./product_page.php?prod_id=${idP}`;
    });
</script>
<?php
include 'include/_footer.inc.php';
?>