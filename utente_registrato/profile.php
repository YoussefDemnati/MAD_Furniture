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

            //province
            $province_list = $conn->query("SELECT * FROM provincia")->fetch_all(MYSQLI_ASSOC);
            print_r($province_list);
        }
    } else {
        header("Location: ../auth/login.php");
    }
?>
<div class="profile"><!--
    <div class="profile-desc-container">
        <div><img class="profile-image" src="../assets/img/profile-image.png" alt="profile image"></div>
        <div>
            <div class="profile-name"><input type="text" value="Mario Rossi"></div>
            <div class="profile-email"><input type="text" value="mario.rossi@gmail.com"></div>
        </div>
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
        <button class="save-button">Save</button>
    </div>-->
    <div class="profile-container">
        <div class="profile-row">
            <div class="profile-col-20">
                <img class="profile-image" src="../assets/img/profile-image.png" alt="profile image">
            </div>
            <div class="profile-col-80">
                <input class="profile-input profile-name" type="text" value="<?= $name . " " . $surname ?>">
                <input class="profile-input profile-email" type="text" value="<?= $email ?>">
            </div>
        </div>
        <div class="profile-row">
            <div class="profile-col-50">
                <label class="profile-label" for="adr">Address</label>
                <input class="profile-input profile-address" type="text" id="adr" name="address" placeholder="542 W. 15th Street" value="<?= $address ?>">
            </div>
            <div class="profile-col-50">
                <label class="profile-label" for="adr">Province</label>
                <select class="profile-province">
                    <option selected>Province</option>
                    <?php foreach($province_list as $province) { ?>
                    <option><?=$province["nome"]?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="profile-options-container">
        <button class="cart option-button">
            <i class="fa-solid fa-cart-shopping"></i>
            Cart
        </button>
        <button class="wishlist option-button">
            <i class="fa-solid fa-heart"></i>
            Wishlist
        </button>
        <button class="orders option-button">
            <i class="fa-solid fa-bag-shopping"></i>
            My orders
        </button>
        <button class="history option-button">
            <i class="fa-solid fa-clock-rotate-left"></i>
            History
        </button>
        <button class="logout option-button">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </button>
        <button class="delAcc option-button">
            <i class="fa-solid fa-user-minus"></i>
            Delete account
        </button>
    </div>
</div>
<?php include("_footer.php"); ?>