<?php include("_header.php") ?>
<div class="cart-container">
    <div class="cart-left">
        <div>
            <h1>Shopping Cart</h1>
        </div>
        <div class="cart-item">
            <img src="../assets/img/table_lamp.png" alt="">
            <div class="cart-item-info">
                <h3>Vintage Table Lamp in Wood and Metal</h3>
                <div class="quantity">
                    <input type="number" min="1" max="9" step="1" value="1">
                </div>
                <div class="cart-item-price">
                    <h1>36,98$</h1>
                </div>
            </div>
            <button class="cart-item-delete">Delete</button>
        </div>
        <div class="cart-item">
            <img src="../assets/img/kitchen.png" alt="">
            <div class="cart-item-info">
                <h3>Vintage Table Lamp in Wood and Metal</h3>
                <div class="quantity">
                    <input type="number" min="1" max="9" step="1" value="1">
                </div>
                <div class="cart-item-price">
                    <h1>56,90$</h1>
                </div>
            </div>
            <button class="cart-item-delete">Delete</button>
        </div>
    </div>
    <div class="cart-right">
        <div class="subtotal">
            <h2>Subtotal (2 items):</h2>
            <h1>93,88$</h1>
            <button class="cart-buy-button">Buy Now</button>
            <button class="cart-delete-all">Delete Cart</button>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
        jQuery('.quantity').each(function() {
            var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

            btnUp.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

            btnDown.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });
        });
    });
</script>
<?php include("_footer.php") ?>