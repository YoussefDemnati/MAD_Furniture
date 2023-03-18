<?php include("_header.php") ?>
        <div class="profile">
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
            </div>
            <div class="profile-options-container">
                <button class="cart option-button">
                    Cart
                </button>
                <button class="wishlist option-button">
                    Wishlist
                </button>
                <button class="orders option-button">
                    My orders
                </button>
                <button class="history option-button">
                    History
                </button>
                <button class="logout option-button">
                    Logout
                </button>
                <button class="delAcc option-button">
                    Delete account
                </button>
            </div>
        </div>
<?php include("_footer.php"); ?>