<?php
include("_header.php");
include("../include/_db_dal.inc.php");
$conn = db_connect();

if (isset($_SESSION["id"]) && isset($_SESSION["tipo"])) {
    if ($_SESSION["tipo"] != "privato") {
        header("Location: ../index.php");
    } else {
        $id = intval($_SESSION["id"]);
        $cart_list = get_products_by_user($conn, $id);
        $result = mysqli_query($conn, "SELECT * FROM utente WHERE id_u = $id AND `hidden` = 0");
        $user = mysqli_fetch_assoc($result);
        if (isset($_GET["action"]) && isset($_GET["prodId"])) {
            if ($_GET["action"] == "add_item") {
                $prodId = intval($_GET["prodId"]);
                $user_items = mysqli_query($conn, "SELECT * FROM elemento_carrello WHERE id_u=$id")->fetch_all(MYSQLI_ASSOC);
                if (item_in_cart($user_items, $prodId)) {
                    mysqli_query($conn, "UPDATE elemento_carrello SET quantita=quantita+1 WHERE id_u=$id AND id_pr=$prodId");
                    header("Location: cart.php");
                } else {
                    mysqli_query($conn, "INSERT INTO elemento_carrello(quantita, id_pc, id_u, id_pr) VALUES (1, NULL, $id, $prodId)");
                    header("Location: cart.php");
                }
            }
        }
    }
} else {
    header("Location: ../auth/login.php");
}
?>
<div class="cart-container">
    <div class="cart-left">
        <div>
            <h1><?= $user["nome"] ?>'s Shopping Cart</h1>
        </div>
        <?php
        if (count($cart_list) > 0) {
            foreach ($cart_list as $cart_item) {
        ?>
                <div class="cart-item">
                    <img src="../assets/img/table_lamp.png" alt="">
                    <div class="cart-item-info">
                        <h3><?= $cart_item["titolo"] ?></h3>
                        <div class="quantity">
                            <input readonly id="<?= $cart_item["idEc"] ?>" type="number" min="1" max="90" step="1" value="<?= $cart_item["quantita"] ?>">
                        </div>
                        <div class="cart-item-price" data-price="<?= $cart_item["prezzo"] ?>">
                            <h1><?= str_replace(',', '', number_format($cart_item["prezzo"] * $cart_item["quantita"], 2)) ?>$</h1>
                        </div>
                    </div>
                    <button class="cart-item-delete">Delete</button>
                </div>
            <?php }
        } else { ?>
            <h1>You've got no items in your cart <a style="display: inline;" href="../index.php">Shop now!</a></h1>
        <?php } ?>
    </div>
    <div class="cart-right">
        <?php if (count($cart_list) > 0) { ?>
            <div class="subtotal">
                <h2>Subtotal - <?= count($cart_list) ?> item(s):</h2>
                <h1><?php echo str_replace(',', '', number_format(get_total_price($conn, $id), 2)) . "$" ?></h1>
                <button class="cart-buy-button">Buy Now</button>
                <button class="cart-delete-all">Delete Cart</button>
            </div>
        <?php } ?>
    </div>
</div>
<div class="confirm">
    <div></div>
    <div>
        <div id="confirmMessage">Confirm text</div>
        <div>
            <input id="confirmYes" type="button" value="Yes" />
            <input id="confirmNo" type="button" value="No" />
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(".cart-buy-button").click(function() {
            window.location.href = "checkout.php";
        });
        var subtotal = 0;
        //create counter and initialize variables
        jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
        jQuery('.quantity').each(function() {
            var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max'),
                idEc = input.attr('id'),
                oldValue = parseFloat(input.val());
            //get total price
            subtotal += parseFloat(spinner.next().attr("data-price")) * oldValue;
            //increment qty
            btnUp.click(function() {
                if (btnUp.attr("disabled") != "disabled") {
                    $(".quantity-button").css("cursor", "not-allowed");
                    btnUp.attr("disabled", true);
                    btnDown.attr("disabled", true);
                    //update input counter
                    oldValue = parseFloat(input.val());
                    if (oldValue >= max) {
                        var newVal = oldValue;
                    } else {
                        var newVal = oldValue + 1;
                    }
                    spinner.find("input").val(newVal);
                    spinner.find("input").trigger("change");
                    //prepare AJAX request
                    const xhttp = new XMLHttpRequest();
                    xhttp.onload = function() {
                        btnUp.attr("disabled", false);
                        btnDown.attr("disabled", false);
                        $(".quantity-button").css("cursor", "pointer");
                    }
                    xhttp.open("GET", `update_prod_qty.php?idEc=${idEc}&curval=${newVal-1}&qty=1`);
                    xhttp.send();
                    //update price display
                    spinner.next().html(`<h1>${parseFloat(newVal*spinner.next().attr("data-price")).toFixed(2)}$</h1>`);
                    subtotal += parseFloat(spinner.next().attr("data-price"));
                    $(".subtotal").find("h1").html(`${subtotal.toFixed(2)}` + "$");
                }
            });
            //decrement qty
            btnDown.click(function() {
                if (btnDown.attr("disabled") != "disabled") {
                    $(".quantity-button").css("cursor", "not-allowed");
                    btnUp.attr("disabled", true);
                    btnDown.attr("disabled", true);
                    //update input counter
                    oldValue = parseFloat(input.val());
                    if (oldValue <= min) {
                        var newVal = oldValue;
                        btnUp.attr("disabled", false);
                        btnDown.attr("disabled", false);
                        $(".quantity-button").css("cursor", "pointer");
                    } else {
                        var newVal = oldValue - 1;
                        spinner.find("input").val(newVal);
                        spinner.find("input").trigger("change");
                        //prepare AJAX request
                        const xhttp = new XMLHttpRequest();
                        xhttp.onload = function() {
                            btnUp.attr("disabled", false);
                            btnDown.attr("disabled", false);
                            $(".quantity-button").css("cursor", "pointer");
                        }
                        xhttp.open("GET", `update_prod_qty.php?idEc=${idEc}&curval=${newVal+1}&qty=-1`);
                        xhttp.send();
                        //update price display
                        spinner.next().html(`<h1>${parseFloat(newVal*spinner.next().attr("data-price")).toFixed(2)}$</h1>`);
                        subtotal -= parseFloat(spinner.next().attr("data-price"));
                        $(".subtotal").find("h1").html(`${subtotal.toFixed(2)}` + "$");
                    }
                }
            });
        });
        //removes all items
        $("button.cart-delete-all").click(function() {
            //initialize variables
            var cartItem = jQuery(this),
                input = cartItem.find('input[type="number"]'),
                idEc = input.attr('id');
            if (confirm("Do you want to remove all items?")) {
                $(".subtotal").find("h1").text(`Updating...`);
                $(".subtotal").find("h2").text(`Subtotal - Updating...`);
                //prepare AJAX request
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    var result = JSON.parse(this.responseText);
                    subtotal = result.prezzo_tot;
                    num_items = result.num_items;
                    $(".subtotal").find("h1").text(`${subtotal}$`);
                    $(".subtotal").find("h2").text(`Subtotal - ${num_items} item(s):`);
                    window.location.reload();
                }
                xhttp.open("GET", `delete_item.php?idEc=${idEc}&uId=${<?= $id ?>}&action=delete_all`);
                xhttp.send();
                $(".cart-left > .cart-item").remove();
            } else {
                console.log("cancelled");
            }
        });
        //removes one item
        $(".cart-item").each(function() {
            //initialize variables
            var cartItem = jQuery(this),
                input = cartItem.find('input[type="number"]'),
                btnDelete = cartItem.find(".cart-item-delete"),
                idEc = input.attr('id');
            //removes one item
            btnDelete.click(function() {
                $(".subtotal").find("h1").text(`Updating...`);
                $(".subtotal").find("h2").text(`Subtotal - Updating...`);
                //prepare AJAX request
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    var result = JSON.parse(this.responseText);
                    subtotal = result.prezzo_tot;
                    num_items = result.num_items;
                    if (num_items == 0) {
                        window.location.reload();
                    }
                    $(".subtotal").find("h1").text(`${subtotal}$`);
                    $(".subtotal").find("h2").text(`Subtotal - ${num_items} item(s):`);
                }
                xhttp.open("GET", `delete_item.php?idEc=${idEc}&uId=${<?= $id ?>}&action=delete_one`);
                xhttp.send();
                cartItem.remove();
            });
        });

    });
</script>
<?php include("_footer.php") ?>