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
    <?php foreach ($products as $product) { ?>
        <div class="product">
            <div>
                <img src="./assets/img/lampada.png" alt="">
            </div>
            <img src="./assets/img/stars/star_4.png" alt="">
            <p><?=$product["titolo"]?></p>
            <span><?=$product["prezzo"]?> $</span>
        </div>
    <?php } ?>
</div>
<?php
include 'include/_footer.inc.php';
?>