<?php
include("_header.php");
include("../include/_db_dal.inc.php");
$conn = db_connect();

if (isset($_SESSION["id"]) && isset($_SESSION["tipo"])) {
    if ($_SESSION["tipo"] != "privato") {
        header("Location: ../index.php");
    } else {
        //user data
        $id = intval($_SESSION["id"]);
        $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM utente WHERE id_u = $id"));
        $name = $user["nome"];
        $surname = $user["cognome"];
        $email = $user["email"];
        $address = $user["indirizzo"];

        //cart list
        $cart_list = get_products_by_user($conn, $id);
        $total_price = 0;
    }
} else {
    header("Location: ../auth/login.php");
}
?>
<button class="back-button">Back</button>
<div class="checkout-row">
    <div class="checkout-col-75">
        <div class="checkout-container">
            <form action="/action_page.php">

                <div class="checkout-row">
                    <div class="checkout-col-50">
                        <h3>Billing Address</h3>
                        <label class="checkout-label" for="fname"><i class="fa-solid fa-user"></i> Full Name</label>
                        <input class="checkout-input" type="text" id="fname" name="firstname" placeholder="John M. Doe" value="<?= $name . " " . $surname ?>">
                        <label class="checkout-label" for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                        <input class="checkout-input" type="text" id="email" name="email" placeholder="john@example.com" value="<?= $email ?>">
                        <label class="checkout-label" for="adr"><i class="fa-solid fa-address-card"></i> Address</label>
                        <input class="checkout-input" type="text" id="adr" name="address" placeholder="542 W. 15th Street" value="<?= $address ?>">
                        <label class="checkout-label" for="city"><i class="fa-solid fa-building-columns"></i> City</label>
                        <input class="checkout-input" type="text" id="city" name="city" placeholder="New York">

                        <div class="checkout-row">
                            <div class="checkout-col-50">
                                <label class="checkout-label" for="state">State</label>
                                <input class="checkout-input" type="text" id="state" name="state" placeholder="NY">
                            </div>
                            <div class="checkout-col-50">
                                <label class="checkout-label" for="zip">Zip</label>
                                <input class="checkout-input" type="text" id="zip" name="zip" placeholder="10001">
                            </div>
                        </div>
                    </div>

                    <div class="checkout-col-50">
                        <h3>Payment</h3>
                        <label class="checkout-label" for="fname">Accepted Cards</label>
                        <div class="checkout-icon-container">
                            <i class="fa-brands fa-cc-paypal" style="color:blue;"></i>
                        </div>
                        <label class="checkout-label" for="cname">Name on Card</label>
                        <input class="checkout-input" type="text" id="cname" name="cardname" placeholder="John More Doe">
                        <label class="checkout-label" for="ccnum">Credit card number</label>
                        <input class="checkout-input" type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                        <label class="checkout-label" for="expmonth">Exp Month</label>
                        <input class="checkout-input" type="text" id="expmonth" name="expmonth" placeholder="September">
                        <div class="checkout-row">
                            <div class="checkout-col-50">
                                <label class="checkout-label" for="expyear">Exp Year</label>
                                <input class="checkout-input" type="text" id="expyear" name="expyear" placeholder="2018">
                            </div>
                            <div class="checkout-col-50">
                                <label class="checkout-label" for="cvv">CVV</label>
                                <input class="checkout-input" type="text" id="cvv" name="cvv" placeholder="352">
                            </div>
                        </div>
                    </div>

                </div>
                <label class="checkout-label">
                    <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                </label>
                <div class="checkout-row">
                    <div class="checkout-col-50">
                        <input type="submit" value="Continue to checkout" class="checkout-btn-submit">
                    </div>
                    <div class="checkout-col-50">
                        <input type="reset" value="Reset form" class="checkout-btn-reset">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="checkout-col-25">
        <div class="checkout-container">
            <h2>Order summary <span class="checkout-price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?=count($cart_list)?></b></span></h2>
            <?php
            foreach ($cart_list as $cart_item) {
                $total_price += $cart_item["prezzo"]*$cart_item["quantita"];
            ?>
                <p>(x<?= $cart_item["quantita"] ?>) <a class="checkout-a" href="../product_page.php?prod_id=<?= $cart_item["id_pr"] ?>"><?= $cart_item["titolo"] ?></a> <span class="checkout-price">$<?= $cart_item["prezzo"] ?></span></p>
            <?php } ?>
            <hr class="checkout-hr">
            <p>Total <span class="checkout-price" style="color:black"><b>$<?= str_replace(',', '', number_format($total_price, 2)) ?></b></span></p>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".checkout-btn-submit").click(function() {
            // Get the values entered by the user
            var name = $("#fname").val();
            var email = $("#email").val();
            var address = $("#adr").val();
            var city = $("#city").val();
            var state = $("#state").val();
            var zip = $("#zip").val();
            var cardname = $("#cname").val();
            var cardnumber = $("#ccnum").val();
            var expmonth = $("#expmonth").val();
            var expyear = $("#expyear").val();
            var cvv = $("#cvv").val();

            // Define regular expression patterns to validate input
            var namePattern = /^[a-zA-Z ]+$/;
            var emailPattern = /^\S+@\S+\.\S+$/;
            var addressPattern = /^[a-zA-Z0-9\s,'-]*$/;
            var cityPattern = /^[a-zA-Z ]+$/;
            var statePattern = /^[a-zA-Z]{2}$/;
            var zipPattern = /^\d{5}$/;
            var cardNamePattern = /^[a-zA-Z ]+$/;
            var cardNumberPattern = /^\d{4}-\d{4}-\d{4}-\d{4}$/;
            var expMonthPattern = /^(0?[1-9]|1[012])$/;
            var expYearPattern = /^\d{4}$/;
            var cvvPattern = /^\d{3}$/;

            // Check if each field is valid
            if (!name.match(namePattern)) {
                alert("Please enter a valid name.");
                return false;
            }
            if (!email.match(emailPattern)) {
                alert("Please enter a valid email address.");
                return false;
            }
            if (!address.match(addressPattern)) {
                alert("Please enter a valid address.");
                return false;
            }
            if (!city.match(cityPattern)) {
                alert("Please enter a valid city name.");
                return false;
            }
            if (!state.match(statePattern)) {
                alert("Please enter a valid state abbreviation (e.g. NY).");
                return false;
            }
            if (!zip.match(zipPattern)) {
                alert("Please enter a valid ZIP code.");
                return false;
            }
            if (!cardname.match(cardNamePattern)) {
                alert("Please enter a valid name on card.");
                return false;
            }
            if (!cardnumber.match(cardNumberPattern)) {
                alert("Please enter a valid credit card number in the format XXXX-XXXX-XXXX-XXXX.");
                return false;
            }
            if (!expmonth.match(expMonthPattern)) {
                alert("Please enter a valid expiration month (e.g. 01 for January).");
                return false;
            }
            if (!expyear.match(expYearPattern)) {
                alert("Please enter a valid expiration year (e.g. 2023).");
                return false;
            }
            if (!cvv.match(cvvPattern)) {
                alert("Please enter a valid CVV code.");
                return false;
            }
        });
    });
</script>
<?php include("_footer.php"); ?>