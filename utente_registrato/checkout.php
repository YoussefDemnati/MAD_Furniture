<?php include("_header.php") ?>
<div class="checkout-container">
    <div class="checkout-left">
        <div class="checkout-info-row">
            <div class="address">
                <label style="display: block;" for="adress">Address</label>
                <input type="text" placeholder="Address, Street number, City">
            </div>
            <div class="province">
                <select>
                    <option selected>Province</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>
        </div>
        <div class="checkout-info-row">
            
        </div>
    </div>
    <div class="checkout-right">
        <div class="checkout-summary">
            <h1>Order Summary</h1>
            <div class="summary-row">
                <div>
                    Items (2):
                </div>
                <div>
                    93,88$
                </div>
            </div>
            <div class="summary-row">
                <div>
                    Shipping:
                </div>
                <div>
                    12,00$
                </div>
            </div>
            <hr style="width: 100%;">
            <div class="summary-row">
                <div>
                    Total:
                </div>
                <div>
                    105,88$
                </div>
            </div>
            <button class="cart-buy-button">Checkout</button>
        </div>
    </div>
</div>
<?php include("_footer.php"); ?>