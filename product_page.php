<?php
include("include/_header.inc.php");
include("include/_db_dal.inc.php");

if (isset($_GET["prod_id"])) {
    $conn = db_connect();
    $product = get_product($conn, $_GET["prod_id"]);
    debug_to_json($product);
    $feedbacks = get_product_rating($conn, $_GET["prod_id"]);
    $sum = 0;
    debug_to_json($feedbacks);
    $count = count($feedbacks);
    if ($count != 0) {
        foreach ($feedbacks as $feedback) {
            $sum += intval($feedback["valutazione"]);
        }
        $stars = intdiv($sum, $count);
        
        // Conta il numero di recensioni per ogni voto
        $stars_count = array_count_values(array_column($feedbacks, 'valutazione'));
        // Calcola la percentuale di ogni recensione
        $total = count($feedbacks);
        $percentuali = array();
        // Inizializza un array con tutte le valutazioni possibili
        $all_stars = array(1, 2, 3, 4, 5);

        foreach ($all_stars as $voto) {
            // Se l'array di conteggio delle valutazioni include questo voto, calcola la percentuale
            if (isset($stars_count[$voto])) {
                $num = $stars_count[$voto];
                $percentuale = round(($num / $total) * 100, 2);
            } else {
                // Se l'array di conteggio delle valutazioni non include questo voto, imposta la percentuale a 0
                $percentuale = 0;
            }
        
            $percentuali[] = array(
                'titolo' => $voto,
                'percentuale' => $percentuale
            );
        }
        debug_to_json($percentuali);

    }
    else{
        $stars = 0;
    }
    debug_to_console($stars);
} else {
    header("Location: ./index.php");
}
?>
<button class="back-button">Back</button>
<div class="product-desc">
    <div class="product-image">
        <div id="image-slider" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <img src="assets/img/Table.png">
                    </li>
                    <li class="splide__slide">
                        <img src="assets/img/Table.png">
                    </li>
                    <li class="splide__slide">
                        <img src="assets/img/Table.png">
                    </li>
                </ul>
            </div>
        </div>
        <!--<img src="assets/img/Table.png" alt="">-->
    </div>
    <div class="product-name">
        <?= $product["titolo"] ?>
    </div>
    <div class="product-rating">
        <img src="assets/img/stars/star_<?= $stars ?>.png" alt="">
    </div>
    <div class="product-price">
        <?= $product["prezzo"] ?>$
    </div>
    <div class="product-specs">
        <div class="product-specs-key">
            <ul>
                <?php if ($product["tipo"] == "finito") { ?>
                    <li><b>Altezza</b></li>
                    <li><b>Larghezza</b></li>
                    <li><b>Profondità</b></li>
                    <li><b>Modello</b></li>
                    <li><b>Casa Produttrice</b></li>
                    <li><b>Tipo</b></li>
                    <li><b>Categoria</b></li>
                <?php } else { ?>
                    <li><b>Altezza</b></li>
                    <li><b>Larghezza</b></li>
                    <li><b>Spessore</b></li>
                    <li><b>Forma</b></li>
                    <li><b>Materiale</b></li>
                <?php } ?>
            </ul>
        </div>
        <div class="product-specs-value">
            <ul>
            <?php if ($product["tipo"] == "finito") { ?>
                <li><b><?= $product["altezza"] ?></b></li>
                <li><b><?= $product["larghezza"] ?></b></li>
                <li><b><?= $product["profondita"] ?></b></li>
                <li><b><?= $product["modello"] ?></b></li>
                <li><b><?= $product["casa_produttrice"] ?></b></li>
                <li><b><?= $product["tipo_prodotto_finito"] ?></b></li>
                <li><b><?= $product["categoria"] ?></b></li>
            <?php } else { ?> 
                <li><b><?= $product["altezza"] ?></b></li>
                <li><b><?= $product["larghezza"] ?></b></li>
                <li><b><?= $product["spessore"] ?></b></li>
                <li><b><?= $product["forma"] ?></b></li>
                <li><b><?= $product["materiale"] ?></b></li>
            <?php } ?>
            </ul>
        </div>
    </div>
    <button class="product-buy">
        Buy Now
    </button>
    <button class="product-add" >
        Add to Cart
    </button>
</div>
<div class="product-about">
    <p>About this item</p>
    <ul>
        <?= $product["descrizione"] ?>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.12/dist/js/splide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Splide('#image-slider').mount();
    });
</script>

<div class="card-4">
    <span class="class-text-1">Feedbacks</span> <br>
    <div class="stars">
        <img src="./assets/img/stars/star_<?= $stars_num ?>.png" alt="">
    </div>
    <div class="feedback_row">5 stars ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_5" style="width: <?=$percentuali[4]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[4]["percentuale"])?>%</b></div>
    <div class="feedback_row">4 stars ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_4" style="width: <?=$percentuali[3]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[3]["percentuale"])?>%</b></div>
    <div class="feedback_row">3 stars ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_3"style="width: <?=$percentuali[2]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[2]["percentuale"])?>%</b></div>
    <div class="feedback_row">2 stars ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_2"style="width: <?=$percentuali[1]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[1]["percentuale"])?>%</b></div>
    <div class="feedback_row">1 star&nbsp&nbsp ‎ <span class="feedback_row_white"> ‎<span class="feedback_row_coloured stars_1" style="width: <?=$percentuali[0]["percentuale"]?>%">‎</span></span> ‎ <b><?=round($percentuali[0]["percentuale"])?>%</b></div>
    <br>
</div>

<?php include("include/_footer.inc.php"); ?>