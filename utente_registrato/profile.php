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
        $user = get_user_profile($conn, $id);
        $name = $user["user_name"];
        $surname = $user["cognome"];
        $email = $user["email"];
        $address = $user["indirizzo"];
        $user_province = is_null($user["province_name"]) ? null : $user["province_name"];
        //print_r($user_province);

        //province
        $province_list = $conn->query("SELECT * FROM provincia")->fetch_all(MYSQLI_ASSOC);
    }
} else {
    header("Location: ../auth/login.php");
}
?>
<div class="profile">
    <div class="profile-container">
        <div class="profile-row">
            <div class="profile-col-20">
                <img class="profile-image" src="../assets/img/profile-image.png" alt="profile image">
            </div>
            <div class="profile-col-80">
                <div class="profile-row">
                    <div class="profile-col-50">
                        <label class="profile-label" for="name">Name</label>
                        <input class="profile-input profile-name" type="text" id="name" value="<?= $name ?>">
                        <i class="fa-solid fa-pen"></i>
                    </div>
                    <div class="profile-col-50">
                        <label class="profile-label" for="surname">Surname</label>
                        <input class="profile-input profile-surname" type="text" id="surname" value="<?= $surname ?>">
                        <i class="fa-solid fa-pen"></i>
                    </div>
                </div>
                <div class="profile-row">
                    <div class="profile-col-100">
                        <label class="profile-label" for="surname">Email</label>
                        <input class="profile-input profile-email" type="text" id="surname" value="<?= $email ?>">
                        <i class="fa-solid fa-pen"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-row">
            <div class="profile-col-50">
                <label class="profile-label" for="adr">Address</label>
                <input class="profile-input profile-address" type="text" id="adr" name="address" placeholder="542 W. 15th Street" value="<?= $address ?>">
                <i class="fa-solid fa-pen"></i>
            </div>
            <div class="profile-col-25">
                <label class="profile-label" for="province">Province</label>
                <select class="profile-province" id="province">
                    <option>Province</option>
                    <?php
                    foreach ($province_list as $province) {
                        if ($province["nome"] == $user_province) {
                    ?>
                            <option selected><?= $province["nome"] ?></option>
                        <?php } else { ?>
                            <option><?= $province["nome"] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="profile-col-25">
                <label class="profile-label">&nbsp;</label>
                <button class="profile-save-button">Save</button>
            </div>
        </div>
    </div>
    <div class="profile-row">
        <div class="profile-col-33">
            <div class="profile-options-container">
                <button class="cart option-button">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Cart
                </button>
            </div>
        </div>
        <div class="profile-col-33">
            <div class="profile-options-container">
                <button class="wishlist option-button">
                    <i class="fa-solid fa-heart"></i>
                    Wishlist
                </button>
            </div>
        </div>
        <div class="profile-col-33">
            <div class="profile-options-container">
                <button class="orders option-button">
                    <i class="fa-solid fa-bag-shopping"></i>
                    My orders
                </button>
            </div>
        </div>
    </div>
    <div class="profile-row">
        <div class="profile-col-33">
            <div class="profile-options-container">
                <button class="history option-button">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    History
                </button>
            </div>
        </div>
        <div class="profile-col-33">
            <div class="profile-options-container">
                <button class="logout option-button">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </div>
        </div>
        <div class="profile-col-33">
            <div class="profile-options-container">
                <button class="delAcc option-button">
                    <i class="fa-solid fa-user-minus"></i>
                    Delete account
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("button.cart").click(function() {
            window.location.href = "cart.php";
        });
        $("button.wishlist").click(function() {
            window.location.href = "wishlist.php";
        });
        $("button.orders").click(function() {
            window.location.href = "history.php?state=waiting";
        });
        $("button.history").click(function() {
            window.location.href = "history.php";
        });
        $("button.logout").click(function() {
            window.location.href = "../auth/logout.php";
        });
        $("button.delAcc").click(function() {
            if (confirm("Are you sure you want to delete your account?")) {
                const xhttp = new XMLHttpRequest();
                const url = "delete_account.php";
                xhttp.onload = function() {
                    console.log(this.responseText);
                }
                xhttp.open("POST", url);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send(`id_u=${<?= $id ?>}`);
                window.location.href = "../auth/logout.php";
            }
        });

        // profile validation
        $('.profile-save-button').click(function() {
            // define validation patterns
            const namePattern = /^[A-Za-z]+$/;
            const emailPattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
            const addressPattern = /^[a-zA-Z0-9\s,'-]*$/;

            var name = $('.profile-name').val();
            var surname = $('.profile-surname').val();
            var email = $('.profile-email').val();
            var address = $('.profile-address').val();
            var province = $('.profile-province').val();

            if (name == '' || !name.match(namePattern)) {
                alert('Please enter your name.');
                return false;
            }

            if (surname == '' || !surname.match(namePattern)) {
                alert('Please enter your surname.');
                return false;
            }

            if (email == '' || !email.match(emailPattern)) {
                alert('Please enter your email address.');
                return false;
            }

            if (address == '' || !address.match(addressPattern)) {
                alert('Please enter your address.');
                return false;
            }

            // if (province == 'Province') {
            //     alert('Please select your province.');
            //     return false;
            // }

            console.log([name, surname, email, address, province]);
            // prepare AJAX request
            const xhttp = new XMLHttpRequest();
            const url = "update_profile.php";
            xhttp.onload = function() {
                // btnUp.attr("disabled", false);
                // btnDown.attr("disabled", false);
                // $(".quantity-button").css("cursor", "pointer");
                console.log(this.responseText);
            }
            xhttp.open("POST", url);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhttp.send(`id_u=${<?= $id ?>}&name=${name}&surname=${surname}&email=${email}&address=${address}&province=${province}`);
        });
    });
</script>
<?php include("_footer.php"); ?>