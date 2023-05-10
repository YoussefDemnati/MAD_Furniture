<?php
include("include/_db_dal.inc.php");
include 'include/_header.inc.php';
$conn = db_connect();

$flyers = get_flyers($conn);
$categories = get_categories($conn);
$trending = get_hompeage_trending($conn);
?>
<div class="big_mama">
    <div>
        <span id="big_mama_sub">NEW ARRIVAL</span>
        <span id="big_mama_title">MINIMAL CHAIR</span>
        <span id="big_mama_desc">Take a look to some new minimal products.</span>
        <button id="btn_shopnow">SHOP NOW</button>
    </div>
    <img src="./assets/img/minimal_chair.png" alt="">
</div>
<div class="home_volantino">
    <?php foreach ($flyers as $flyer) { ?>
        <div class="promo">
            <div>
                <h2><?= $flyer["nome"] ?></h2>
                <span>-<?= $flyer["sconto"] ?>% On New <?= $flyer["descrizione"] ?> </span>
                <a href="./product_page.php?prod_id=<?=$flyer["id_p"]?>">View Product</a>
            </div>
            <img src="./assets/img/products/<?=$flyer["id_p"]?>/0.png" alt="">
        </div>
    <?php } ?>
</div>
<p class="subtitle">Most Bought Products of The Week</p>
<h1 class="title">TRENDING PRODUCTS</h1>
<div class="home_trending">
    <?php foreach($trending as $tp) { 
        $feedbacks = get_product_rating($conn, $tp["id_p"]);
        $sum = 0;
        $count = count($feedbacks);
        if ($count != 0) {
            foreach ($feedbacks as $feedback) {
                $sum += intval($feedback["valutazione"]);
            }
            $stars = intdiv($sum, $count);
        }
        ?>
        <div class="home_trending_product" id="<?=$tp["id_p"]?>">
            <div>
                <img src="./assets/img/products/<?=$tp["id_p"]?>/0.png" alt="">
            </div>
            <img src="./assets/img/stars/star_<?=$stars?>.png" alt="">
            <p><?=$tp["titolo"]?></p>
            <span><?=$tp["prezzo"]?> $</span>
        </div>
    <?php } ?>
</div>
<a id="home_see_more_trending" href="products.php?type=trending">See More...</a>
<p class="subtitle">Take a look to all the available categories</p>
<h1 class="title" id="categories">CATEGORIES</h1>
<div class="home_categories_container">
    <button id="go-left"> </button>
    <div class="home_categories">
        <div class="carousell-wrapper">
            <?php foreach ($categories as $category) { ?>
                <div class="home_category">
                    <div>
                        <?php debug_to_console($category["nome"]);?>
                        <h2><?= $category["nome"] ?></h2>
                        <span><?= $category["descrizione"] ?></span>
                        <a href="products.php?category=<?=$category["id_cat"]?>">View Category</a>
                    </div>
                    <img src="./assets/img/<?= $category["nome"] ?>" alt="">
                </div>
            <?php } ?>
        </div>
    </div>
    <button id="go-right"></button>
</div>
<script>
    var container = document.querySelector('.home_categories');
    var buttonLeft = document.querySelector('#go-left');
    var buttonRight = document.querySelector('#go-right');

    buttonLeft.addEventListener('click', function() {
        sideScroll(container, 'left', 25, 200, 20);
    });

    buttonRight.addEventListener('click', function() {
        sideScroll(container, 'right', 25, 200, 20);
    });

    function sideScroll(element, direction, speed, distance, step) {
        var scrollAmount = 0;
        var slideTimer = setInterval(function() {
            if (direction == 'left') {
                element.scrollLeft -= step;
            } else {
                element.scrollLeft += step;
            }
            scrollAmount += step;
            if (scrollAmount >= distance) {
                window.clearInterval(slideTimer);
            }
        }, speed);
    }

    $("#btn_shopnow").click(function() {
      window.location.href = "products.php?type=new";
    });
    
    $(".home_trending_product").click(function() {
        var idP = $(this).attr("id");
      window.location.href = `./product_page.php?prod_id=${idP}`;
    });
</script>
<?php
include 'include/_footer.inc.php';
?>