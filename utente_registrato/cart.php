<?php 
    include("_header.php");
    include("../include/_db_dal.inc.php");
    $conn = db_connect();
    if(!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $cart_list = get_products_by_user($conn, $id);
        $result = mysqli_query($conn, "SELECT * FROM utente WHERE id_u = $id");
        $user = $row = mysqli_fetch_assoc($result);
        //echo print_r($cart_list);
    } else {
        $_SESSION["login"] = false;
        $_SESSION["id"] = 0;
        header("Location: ../auth/login.php");
    }
    /*
    $action = isset($_GET["action"]) ? $_GET["action"] : "none";
    $id = isset($_GET["code"]) ? $_GET["code"] : "none";
    $cart_list = [];
    $quantity = isset($_POST["quantity"]) ? $_POST["quantity"] : 0;
    $total_quantity = 0;
    if($action == "add"){
        $sql = "SELECT * FROM prodotto WHERE id_p='" . $id . "'";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();
        debug_to_console($product);
        $sql_add = "INSERT INTO elemento_carrello(quantita, id_pc, id_u, id_pr)
                    VALUES ($quantity, NULL, 1, $id)";
        //$conn->query($sql_add);
        array_push($cart_list, $product);
    }*/
?>
<div class="cart-container">
    <div class="cart-left">
        <div>
            <h1><?=$user["nome"]?>'s Shopping Cart</h1>
        </div>
        <?php foreach ($cart_list as $cart_item) { ?>
        <div class="cart-item">
            <img src="../assets/img/table_lamp.png" alt="">
            <div class="cart-item-info">
                <h3><?=$cart_item["titolo"]?></h3>
                <div class="quantity">
                    <input readonly id="<?=$cart_item["idEc"]?>" type="number" min="1" max="90" step="1" value="<?=$cart_item["quantita"]?>">
                </div>
                <div class="cart-item-price" data-price="<?=$cart_item["prezzo"]?>">
                    <h1><?=($cart_item["prezzo"]*$cart_item["quantita"])?>$</h1>
                </div>
            </div>
            <button class="cart-item-delete">Delete</button>
        </div>
        <?php } ?>
    </div>
    <div class="cart-right">
        <div class="subtotal">
            <h2>Subtotal (<?=count($cart_list)?> items):</h2>
            <h1><?=get_total_price($conn, $id)?>$</h1>
            <button class="cart-buy-button">Buy Now</button>
            <button class="cart-delete-all">Delete Cart</button>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var subtotal = 0;
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
                //console.log(spinner.next().text());
                //console.log($(".subtotal").find("h1").text());
                subtotal += parseFloat(spinner.next().attr("data-price")) * oldValue;
                console.log(subtotal);

            btnUp.click(function() {
                oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log(this.responseText);
                }
                xhttp.open("GET", `update_prod_qty.php?idEc=${idEc}&curval=${newVal-1}&qty=1`);
                xhttp.send();
                spinner.next().html(`<h1>${newVal*spinner.next().attr("data-price")}$</h1>`);
                subtotal += parseFloat(spinner.next().attr("data-price"));
                console.log(subtotal);
                $(".subtotal").find("h1").html(`${subtotal}` + "$");
            });

            btnDown.click(function() {
                oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log(this.responseText);
                }
                xhttp.open("GET", `update_prod_qty.php?idEc=${idEc}&curval=${newVal+1}&qty=-1`, true);
                xhttp.send();
                spinner.next().html(`<h1>${newVal*spinner.next().attr("data-price")}$</h1>`);
                subtotal -= parseFloat(spinner.next().attr("data-price"));
                $(".subtotal").find("h1").html(`${subtotal}` + "$");
            });
        });

        $("button.cart-delete-all").click(function() {
            $(".cart-left > .cart-item").remove();
        });
        
        $(".cart-item").each(function(){
            var cartItem = jQuery(this),
                input = cartItem.find('input[type="number"]'),
                btnDelete = cartItem.find(".cart-item-delete"),
                idEc = input.attr('id'),
                oldValue = parseFloat(input.val());
            console.log(idEc);
            btnDelete.click(function() {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log(this.responseText);
                }
                xhttp.open("GET", `delete_item.php?idEc=${idEc}`);
                xhttp.send();
                subtotal = jQuery(".quantity").each(function(){
                    subtotal += parseFloat(cartItem.next().attr("data-price")) * oldValue
                });
                $(".subtotal").find("h1").html(`${subtotal}` + "$"); //DA FARE
                cartItem.remove();
            });
        });
        
    });
</script>
<?php include("_footer.php") ?>