<?php
include('include/_db_dal.inc.php');
include('include/_header.inc.php');
$conn = db_connect();
//da sistemare le immagini
$type = isset($_GET["type"]) ? $_GET["type"] : NULL;
$search_query = isset($_GET["search_query"]) ? $_GET["search_query"] : NULL;
$category_id = isset($_GET["category"]) ? $_GET["category"] : NULL;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
// Rimuovi il parametro "page" solo se esiste
$url_parts = parse_url($url);
if (isset($url_parts['query'])) {
    parse_str($url_parts['query'], $query_params);
    if (isset($query_params['page'])) {
        unset($query_params['page']);
        $new_query_string = http_build_query($query_params);
        $url = $url_parts['path'] . '?' . $new_query_string;
    }
}

$products = search_products($conn, $page, $search_query, $type, $category_id);
// debug_to_json($products);

if($search_query != NULL){
    add_searched_word($conn, $search_query);
}
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
        <div class="product" id="<?= $product["id_p"] ?>">
            <div>
                <img src="./assets/img/products/<?= $product["id_p"] ?>/0.png" alt="">
                <!-- <img src="./assets/img/lampada.png" alt=""> -->
            </div>
            <img src="./assets/img/stars/star_<?= $stars ?>.png" alt="">
            <p><?= $product["titolo"] ?></p>
            <span><?= $product["prezzo"] ?> $</span>
        </div>
    <?php } ?>
</div>
<div class="change_page">
    <?php if ($page > 1) { ?>
        <a href="<?= $url ?>&page=<?= $page - 1 ?>" style="margin-right: 15px;">< Previous</a>
    <?php } ?>
    <?php if (!(count($products) < 10)) { ?>
        <a href="<?= $url ?>&page=<?= $page + 1 ?>" style="margin-left: 15px;">Next ></a>
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