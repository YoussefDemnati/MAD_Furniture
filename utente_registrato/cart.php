<?php include("_header.php") ?>
<div class="cart-container">
    <div class="cart-left">
        <div>
            <h1>Shopping Cart</h1>
        </div>
        <div class="cart-item">
            <img src="" alt="">
            <div class="cart-item-info">
                <h3>Vintage Table Lamp in Wood and Metal</h3>
                <div class="cart-item-counter">
                    <button id="decrement">-</button>
                    <h2 id="counter">1</h2>
                    <button id="increment">+</button>
                </div>
            </div>
        </div>
        <div class="cart-item">
        <img src="" alt="">
            <div class="cart-item-info">
                <h3>Vintage Table Lamp in Wood and Metal</h3>
                <div class="cart-item-counter">
                    <button id="decrement">-</button>
                    <h2 id="counter">1</h2>
                    <button id="increment">+</button>
                </div>
            </div>
        </div>
        <div class="cart-item">
        <img src="" alt="">
            <div class="cart-item-info">
                <h3>Vintage Table Lamp in Wood and Metal</h3>
                <div class="cart-item-counter">
                    <button id="decrement">-</button>
                    <h2 id="counter">1</h2>
                    <button id="increment">+</button>
                </div>
            </div>
        </div>
        <div class="cart-item">
        <img src="" alt="">
            <div class="cart-item-info">
                <h3>Vintage Table Lamp in Wood and Metal</h3>
                <div class="cart-item-counter">
                    <button id="decrement">-</button>
                    <h2 id="counter">1</h2>
                    <button id="increment">+</button>
                </div>
            </div>
        </div>
        <div class="cart-item">
        <img src="" alt="">
            <div class="cart-item-info">
                <h3>Vintage Table Lamp in Wood and Metal</h3>
                <div class="cart-item-counter">
                    <button id="decrement">-</button>
                    <h2 id="counter">1</h2>
                    <button id="increment">+</button>
                </div>
            </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
    $(document).ready(function(){
        if($("#counter").text() <= 1){
            $("#decrement").prop("disabled", true);
        }
        $("#decrement").click(function(){
            var currentValue = parseInt($("#counter").text());
            $("#counter").text(currentValue - 1);
        })
    })
</script>
<?php include("_footer.php") ?>